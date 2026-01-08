<?php

namespace App\Http\Controllers\Frontend;

use App\Mail\ClientRequestNotification;
use App\Models\Admin;
use App\Models\Cart;
use App\Models\Client;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Payment;
use App\Models\Product;
use App\Models\User;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class PageController extends BaseController
{
    public function home()
    {
        $clients = Client::where("expire_date", ">=", now())->where('status', 'approved')->get();
        $products = Product::whereIn('client_id', $clients->pluck('id'))->where('stock', true)->get();
        return view('frontend.home', compact('products'));
    }

    public function search(Request $request)
    {
        $q = $request->input('q');
        $products = Product::where('name', 'like', '%'.$q.'%')->where('stock', true)->get();
        return view('frontend.search', compact('products', 'q'));
    }

    public function clientRequest(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'shop_name' => 'required',
            'contact' => 'required',
            'email' => 'required|unique:clients',
            'address' => 'required',
            'terms' => 'required',
        ]);

        $client = new Client();
        $client->name = $request->name;
        $client->shop_name = $request->shop_name;
        $client->contact = $request->contact;
        $client->email = $request->email;
        $client->address = $request->address;
        $client->save();
        $admin = Admin::first();
        Mail::to($admin)->send(new ClientRequestNotification($client));

        toast('Your request has been sent successfully!', 'success');

        return redirect()->back();
    }

    public function product($id)
    {
        $product = Product::findOrFail($id);
        return view('frontend.product', compact('product'));
    }

    // public function cart(Request $request)
    //  {
    //     // Cart functionality to be implemented
    //     $product = Product::findOrFail($request->product_id);
    //     $price = $product->price - ($product->price * $product->discount) / 100;
    //     $cart = new Cart();
    //     $cart->user_id = auth()->id;
    //     $cart->product_id = $request->product_id;
    //     $cart->quantity = $request->quantity;
    //     $cart->amount = $request->quantity * $price;
    //     $cart->save();
    //     toast('Product added to cart successfully!', 'success');
    //     return redirect()->back();
    // }

      // NEW METHOD: View cart page
    // ... other methods ...

    public function addToCart(Request $request)
    {
        // Debug logging
        Log::info('=== ADD TO CART REQUEST ===');
        Log::info('Request data:', $request->all());
        Log::info('User ID:', ['user_id' => Auth::id()]);

        $request->validate([
            'product_id' => 'required|exists:products,id',
            'qty' => 'required|integer|min:1',
        ]);

        // Check if user is authenticated
        if (!Auth::check()) {
            Log::warning('User not authenticated for cart');
            toast('Please login to add items to cart!', 'error');
            return redirect()->route('login');
        }

        try {
            $product = Product::findOrFail($request->product_id);
            Log::info('Product found:', ['id' => $product->id, 'name' => $product->name]);

            // Check if product is in stock
            if ($product->stock < $request->qty) {
                toast('Insufficient stock!', 'error');
                return redirect()->back();
            }

            // Calculate price with discount
            $price = $product->price - ($product->price * $product->discount / 100);
            $amount = $request->qty * $price;

            Log::info('Price calculation:', [
                'original_price' => $product->price,
                'discount' => $product->discount,
                'final_price' => $price,
                'amount' => $amount
            ]);

            // Check if item already exists in cart
            $existingCart = Cart::where('user_id', Auth::id())
                ->where('product_id', $request->product_id)
                ->first();

            if ($existingCart) {
                // Update quantity and amount
                $existingCart->qty += $request->qty;
                $existingCart->amount = $existingCart->qty * $price;
                $existingCart->save();
                Log::info('Cart item updated:', [
                    'cart_id' => $existingCart->id,
                    'new_qty' => $existingCart->qty,
                    'new_amount' => $existingCart->amount
                ]);
            } else {
                // Create new cart item
                $cart = new Cart();
                $cart->user_id = Auth::id();
                $cart->product_id = $request->product_id;
                $cart->qty = $request->qty;
                $cart->amount = $amount;
                $cart->save();
                Log::info('New cart item created:', [
                    'cart_id' => $cart->id,
                    'qty' => $cart->qty,
                    'amount' => $cart->amount
                ]);
            }

            // Get updated cart count
            $cartCount = Cart::where('user_id', Auth::id())->sum('qty');
            Log::info('Updated cart count:', ['count' => $cartCount]);

            toast('Product added to cart successfully!', 'success');
            return redirect()->back()->with('cart_updated', true);

        } catch (\Exception $e) {
            Log::error('Cart error: ' . $e->getMessage());
            Log::error('Stack trace: ' . $e->getTraceAsString());
            toast('Something went wrong! Please try again.', 'error');
            return redirect()->back();
        }
    }

    public function viewCart()
        {
            // Check if user is authenticated
            if (!Auth::check()) {
                toast('Please login to view your cart!', 'error');
                return redirect()->route('login');
            }

            // Get cart items with product relationship
            $cartItems = Cart::with(['product' => function($query) {
                $query->select('id', 'name', 'price', 'discount', 'image', 'stock');
            }])
            ->where('user_id', Auth::id())
            ->get();

            Log::info('View cart:', [
                'user_id' => Auth::id(),
                'cart_count' => $cartItems->count(),
                'total_items' => $cartItems->sum('qty')
            ]);

            $totalAmount = $cartItems->sum('amount');

            // Get the client - THIS IS WHAT'S MISSING
            // Option 1: Get client from the first product in cart
            $client = null;
            if ($cartItems->count() > 0) {
                foreach ($cartItems as $item) {
                    if ($item->product && $item->product->client) {
                        $client = $item->product->client;
                        break;
                    }
                }
            }

            // Option 2: If no client found in cart, get the first active client
            if (!$client) {
                $client = Client::where("expire_date", ">=", now())
                                ->where('status', 'approved')
                                ->first();
            }

            return view('frontend.cart', compact('cartItems', 'totalAmount', 'client'));
        }

    public function updateCart(Request $request, $id)
    {
        $request->validate([
            'qty' => 'required|integer|min:1'
        ]);

        if (!Auth::check()) {
            return response()->json(['error' => 'Not authenticated'], 401);
        }

        $cartItem = Cart::where('user_id', Auth::id())
            ->where('id', $id)
            ->firstOrFail();

        // Get product to calculate price
        $product = $cartItem->product;
        $price = $product->price - ($product->price * $product->discount / 100);

        // Update cart item
        $cartItem->qty = $request->qty;
        $cartItem->amount = $request->qty * $price;
        $cartItem->save();

        // Get updated totals
        $cartItems = Cart::where('user_id', Auth::id())->get();
        $totalAmount = $cartItems->sum('amount');
        $cartCount = $cartItems->sum('qty');

        return response()->json([
            'success' => true,
            'item_amount' => $cartItem->amount,
            'total_amount' => $totalAmount,
            'cart_count' => $cartCount,
            'message' => 'Cart updated successfully'
        ]);
    }

    public function removeFromCart($id)
    {
        if (!Auth::check()) {
            toast('Please login to manage your cart!', 'error');
            return redirect()->route('login');
        }

        $cartItem = Cart::where('user_id', Auth::id())
            ->where('id', $id)
            ->firstOrFail();

        $productName = $cartItem->product ? $cartItem->product->name : 'Item';
        $cartItem->delete();

        Log::info('Cart item removed:', [
            'cart_id' => $id,
            'product_name' => $productName
        ]);

        toast($productName . ' removed from cart!', 'success');
        return redirect()->route('cart');
    }

    public function clearCart()
    {
        if (!Auth::check()) {
            return response()->json(['error' => 'Not authenticated'], 401);
        }

        Cart::where('user_id', Auth::id())->delete();

        Log::info('Cart cleared for user:', ['user_id' => Auth::id()]);

        return response()->json([
            'success' => true,
            'message' => 'Cart cleared successfully'
        ]);
    }

    public function getCartCount()
    {
        if (!Auth::check()) {
            return response()->json(['count' => 0]);
        }

        $count = Cart::where('user_id', Auth::id())->sum('qty');
        return response()->json(['count' => $count]);
    }

    public function checkout($id)
{
    $client = Client::findOrFail($id);
    $user = Auth::user();

    // Get cart items for this user
    $cartItems = Cart::with('product')
        ->where('user_id', Auth::id())
        ->get();

    if ($cartItems->isEmpty()) {
        return redirect()->route('cart')->with('error', 'Your cart is empty!');
    }

    $totalAmount = $cartItems->sum('amount');

    return view('frontend.checkout', compact('client', 'cartItems', 'totalAmount'));
}

public function processCheckout(Request $request)
{
    //  dd($request->payment_method);

    $request->validate([
        'client_id' => 'required|exists:clients,id',
        'full_name' => 'required|string|max:255',
        'phone' => 'required|string|max:15',
        'email' => 'required|email|max:255',
        'address' => 'required|string',
        'city' => 'required|string|max:100',
        'state' => 'required|string|max:100',
        'payment_method' => 'required|in:cod,khalti,bank',
        'terms' => 'required|accepted',
    ]);

    try {
        DB::beginTransaction();

        $client = Client::findOrFail($request->client_id);
        $user = Auth::user();

        // Get cart items
        $cartItems = Cart::where('user_id', Auth::id())
            ->with('product')
            ->get();

        if ($cartItems->isEmpty()) {
            return redirect()->back()->with('error', 'Your cart is empty!');
        }

        // Calculate total amount
        $totalAmount = $cartItems->sum('amount');

        // Create delivery address
        $deliveryAddress = $request->address . ', ' . $request->city . ', ' . $request->state;
        if ($request->zip_code) {
            $deliveryAddress .= ' - ' . $request->zip_code;
        }

        // Create order
        $order = Order::create([
            'user_id' => $user->id,
            'client_id' => $client->id,
            'total_amount' => $totalAmount,
            'status' => 'pending',
            'delivery_address' => $deliveryAddress,
        ]);

        // Create order items
        foreach ($cartItems as $cartItem) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $cartItem->product_id,
                'qty' => $cartItem->qty,
                'amount' => $cartItem->amount,
            ]);
        }

        // Create payment record (status pending for Khalti)
        $payment = Payment::create([
            'user_id' => $user->id,
            'order_id' => $order->id,
            'payment_method' => $request->input('payment_method'),
            'status' => 'pending', // Set ALL payments as pending initially
            'amount' => $totalAmount,
        ]);


        // Clear the cart for this user
        Cart::where('user_id', Auth::id())->delete();

        // ========================
        // KHALTI PAYMENT SECTION
        // ========================
       if ($request->payment_method === 'khalti') {

            $returnUrl  = route('khalti.callback');
            $websiteUrl = config('app.url');

            try {
                $response = Http::withHeaders([
                    "Authorization" => "Key " . env("KHALTI_SECRET_KEY"),
                    "Content-Type"  => "application/json",
                ])->post('https://a.khalti.com/api/v2/epayment/initiate/', [
                    "return_url" => $returnUrl,
                    "website_url" => $websiteUrl,
                    "amount" => $totalAmount * 100,
                    "purchase_order_id" => $order->id,
                    "purchase_order_name" => "Order #{$order->id}",
                    "customer_info" => [
                        "name" => $request->full_name,
                        "email" => $request->email,
                        "phone" => $request->phone,
                    ],
                ]);

                if (!isset($response['payment_url'])) {
                    throw new \Exception('Khalti initiation failed');
                }

                session(['khalti_order_id' => $order->id]);

                DB::commit();
                return redirect($response['payment_url']);

            } catch (\Exception $e) {
                DB::rollBack();
                Log::error('Khalti Error: ' . $e->getMessage());
                return redirect()->back()->with('error', 'Khalti payment failed');
            }
        }

        DB::commit();

        // For COD/bank, redirect to confirmation
        return redirect()->route('order.confirmation', $order->id)
            ->with('success', 'Order placed successfully!');

    } catch (\Exception $e) {
        DB::rollBack();
        Log::error('Checkout Error: ' . $e->getMessage());
        return redirect()->back()
            ->with('error', 'Failed to place order. Please try again.')
            ->withInput();
    }
}

public function orderConfirmation($id)
{
    $order = Order::with(['client', 'order_Items.product', 'payment'])
        ->where('user_id', Auth::id())
        ->findOrFail($id);

    return view('frontend.order-confirmation', compact('order'));
}

public function khaltiCallback(Request $request)
{
    $orderId = session('khalti_order_id');

    if (!$orderId || !$request->pidx) {
        return redirect()->route('cart')->with('error', 'Invalid payment response');
    }

    $order = Order::with('payment')->findOrFail($orderId);

    $response = Http::withHeaders([
        "Authorization" => "Key " . env("KHALTI_SECRET_KEY"),
        "Content-Type"  => "application/json",
    ])->post('https://a.khalti.com/api/v2/epayment/lookup/', [
        "pidx" => $request->pidx,
    ]);

    if ($response['status'] === 'Completed') {

        $order->update(['status' => 'completed']);
        $order->payment->update(['status' => 'completed']);

        Cart::where('user_id', $order->user_id)->delete();

        return redirect()->route('order.confirmation', $order->id)
            ->with('success', 'Payment successful!');
    }

    return redirect()->route('order.confirmation', $order->id)
        ->with('error', 'Payment verification failed');
}


    // Add these methods to your PageController

    // public function viewWishlist()
    // {
    //     // Check if user is authenticated
    //     if (!Auth::check()) {
    //         toast('Please login to view your wishlist!', 'error');
    //         return redirect()->route('login');
    //     }

    //     // Get wishlist items with product relationship
    //     $wishlistItems = Wishlist::with(['product' => function($query) {
    //         $query->select('id', 'name', 'price', 'discount', 'image', 'stock');
    //     }])
    //     ->where('user_id', Auth::id())
    //     ->get();

    //     $totalItems = $wishlistItems->count();

    //     return view('frontend.wishlist', compact('wishlistItems', 'totalItems'));
    // }

    // public function addToWishlist($product_id)
    // {
    //     if (!Auth::check()) {
    //         return response()->json(['error' => 'Please login to add items to wishlist!'], 401);
    //     }

    //     try {
    //         $product = Product::findOrFail($product_id);

    //         // Check if already in wishlist
    //         $exists = Wishlist::where('user_id', Auth::id())
    //             ->where('product_id', $product_id)
    //             ->exists();

    //         if ($exists) {
    //             return response()->json(['error' => 'Product already in wishlist!'], 400);
    //         }

    //         // Add to wishlist
    //         Wishlist::create([
    //             'user_id' => Auth::id(),
    //             'product_id' => $product_id
    //         ]);

    //         $wishlistCount = Wishlist::where('user_id', Auth::id())->count();

    //         return response()->json([
    //             'success' => true,
    //             'message' => 'Added to wishlist!',
    //             'count' => $wishlistCount
    //         ]);

    //     } catch (\Exception $e) {
    //         Log::error('Wishlist error: ' . $e->getMessage());
    //         return response()->json(['error' => 'Something went wrong!'], 500);
    //     }
    // }

    // public function toggleWishlist($product_id)
    // {
    //     if (!Auth::check()) {
    //         return response()->json([
    //             'error' => 'Please login to manage wishlist!',
    //             'redirect' => route('login')
    //         ], 401);
    //     }

    //     try {
    //         $product = Product::findOrFail($product_id);

    //         // Check if already in wishlist
    //         $wishlistItem = Wishlist::where('user_id', Auth::id())
    //             ->where('product_id', $product_id)
    //             ->first();

    //         $action = '';
    //         if ($wishlistItem) {
    //             // Remove from wishlist
    //             $wishlistItem->delete();
    //             $action = 'removed';
    //             $message = 'Removed from wishlist!';
    //         } else {
    //             // Add to wishlist
    //             Wishlist::create([
    //                 'user_id' => Auth::id(),
    //                 'product_id' => $product_id
    //             ]);
    //             $action = 'added';
    //             $message = 'Added to wishlist!';
    //         }

    //         $wishlistCount = Wishlist::where('user_id', Auth::id())->count();

    //         return response()->json([
    //             'success' => true,
    //             'action' => $action,
    //             'message' => $message,
    //             'count' => $wishlistCount,
    //             'isInWishlist' => $action === 'added'
    //         ]);

    //     } catch (\Exception $e) {
    //         Log::error('Wishlist toggle error: ' . $e->getMessage());
    //         return response()->json(['error' => 'Something went wrong!'], 500);
    //     }
    // }

    // public function removeFromWishlist($id)
    // {
    //     if (!Auth::check()) {
    //         toast('Please login to manage your wishlist!', 'error');
    //         return redirect()->route('login');
    //     }

    //     $wishlistItem = Wishlist::where('user_id', Auth::id())
    //         ->where('id', $id)
    //         ->firstOrFail();

    //     $productName = $wishlistItem->product ? $wishlistItem->product->name : 'Item';
    //     $wishlistItem->delete();

    //     toast($productName . ' removed from wishlist!', 'success');
    //     return redirect()->route('wishlist.index');
    // }

    // public function clearWishlist()
    // {
    //     if (!Auth::check()) {
    //         return response()->json(['error' => 'Not authenticated'], 401);
    //     }

    //     Wishlist::where('user_id', Auth::id())->delete();

    //     return response()->json([
    //         'success' => true,
    //         'message' => 'Wishlist cleared successfully'
    //     ]);
    // }

    // public function getWishlistCount()
    // {
    //     if (!Auth::check()) {
    //         return response()->json(['count' => 0]);
    //     }

    //     $count = Wishlist::where('user_id', Auth::id())->count();
    //     return response()->json(['count' => $count]);
    // }

    // // Add this method to check if product is in wishlist
    // public function checkWishlistStatus($product_id)
    // {
    //     if (!Auth::check()) {
    //         return response()->json(['is_in_wishlist' => false]);
    //     }

    //     $isInWishlist = Wishlist::where('user_id', Auth::id())
    //         ->where('product_id', $product_id)
    //         ->exists();

    //     return response()->json(['is_in_wishlist' => $isInWishlist]);
    // }



}
