<x-frontend-layout>
    @push('scripts')
    <script>
        // Function to update cart count in header
        function updateCartCount() {
            @auth
            fetch("{{ route('cart.count') }}")
                .then(response => response.json())
                .then(data => {
                    const cartCountElement = document.querySelector('.cart-count');
                    if (cartCountElement) {
                        cartCountElement.textContent = data.count;
                        if (data.count > 0) {
                            cartCountElement.style.display = 'flex';
                        } else {
                            cartCountElement.style.display = 'none';
                        }
                    }
                })
                .catch(error => console.error('Error:', error));
            @endauth
        }

        // Function to update item quantity
        function updateQuantity(itemId, change) {
            const qtyInput = document.getElementById(`qty-${itemId}`);
            let newQty = parseInt(qtyInput.value) + change;

            // Validate minimum quantity
            if (newQty < 1) newQty = 1;

            // Validate maximum stock (if available)
            const maxStock = parseInt(qtyInput.getAttribute('data-max')) || 100;
            if (newQty > maxStock) newQty = maxStock;

            qtyInput.value = newQty;

            // Send update to server
            updateCartItem(itemId, newQty);
        }

        // Function to update cart item via AJAX
        function updateCartItem(itemId, quantity) {
            const formData = new FormData();
            formData.append('_token', '{{ csrf_token() }}');
            formData.append('qty', quantity);
            formData.append('_method', 'PUT');

            fetch(`/cart/update/${itemId}`, {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Update item total
                    document.getElementById(`item-total-${itemId}`).textContent =
                        '₹' + data.item_amount.toFixed(2);

                    // Update cart totals
                    document.getElementById('cart-subtotal').textContent =
                        '₹' + data.total_amount.toFixed(2);
                    document.getElementById('cart-total').textContent =
                        '₹' + data.total_amount.toFixed(2);

                    // Update header cart count
                    updateCartCount();

                    // Show success message
                    showNotification('Cart updated successfully!', 'success');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showNotification('Error updating cart', 'error');
            });
        }

        // Function to show notifications
        function showNotification(message, type = 'success') {
            const notification = document.createElement('div');
            notification.className = `fixed top-20 right-4 px-4 py-3 rounded-lg shadow-lg z-50 transition-all duration-300 ${
                type === 'success' ? 'bg-green-500 text-white' : 'bg-red-500 text-white'
            }`;
            notification.innerHTML = `
                <i class="fas ${type === 'success' ? 'fa-check-circle' : 'fa-exclamation-circle'} mr-2"></i>
                <span>${message}</span>
            `;

            document.body.appendChild(notification);

            // Remove after 3 seconds
            setTimeout(() => {
                notification.classList.add('opacity-0', 'translate-x-full');
                setTimeout(() => notification.remove(), 300);
            }, 3000);
        }

        // Initialize on page load
        document.addEventListener('DOMContentLoaded', function() {
            updateCartCount();
        });
    </script>
    @endpush

    <div class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold mb-8">Shopping Cart</h1>

        @if($cartItems->count() > 0)
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Cart Items -->
            <div class="lg:col-span-2">
                <div class="bg-white rounded-xl shadow-lg p-6">
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-xl font-bold">Your Items ({{ $cartItems->count() }})</h2>
                        <form action="{{ route('cart.clear') }}" method="POST" onsubmit="return confirm('Are you sure you want to clear your cart?')">
                            @csrf
                            @method('POST')
                            <button type="submit" class="text-red-600 hover:text-red-800 text-sm font-medium">
                                <i class="fas fa-trash-alt mr-1"></i> Clear Cart
                            </button>
                        </form>
                    </div>

                    @foreach($cartItems as $item)
                    <div class="flex items-center border-b border-gray-200 py-6 cart-item" id="cart-item-{{ $item->id }}">
                        @if($item->product)
                        <div class="w-24 h-24 rounded-lg overflow-hidden mr-4 shrink-0">
                            @if(isset($item->product->image) && is_array($item->product->image) && count($item->product->image) > 0)
                            <img src="{{ asset('storage/' . $item->product->image[0]) }}"
                                 alt="{{ $item->product->name }}"
                                 class="w-full h-full object-cover">
                            @else
                            <div class="w-full h-full bg-gray-200 flex items-center justify-center">
                                <i class="fas fa-image text-gray-400"></i>
                            </div>
                            @endif
                        </div>

                        <div class="flex-1">
                            <h3 class="font-bold text-lg mb-1">{{ $item->product->name }}</h3>
                            <p class="text-gray-600 text-sm mb-2">
                                Unit Price: ₹{{ number_format($item->product->price - ($item->product->price * $item->product->discount / 100), 2) }}
                                @if($item->product->discount > 0)
                                <span class="line-through text-gray-400 ml-2">₹{{ number_format($item->product->price, 2) }}</span>
                                <span class="ml-2 text-red-500 text-xs font-bold">-{{ $item->product->discount }}%</span>
                                @endif
                            </p>

                            <div class="flex items-center mt-3">
                                <div class="flex items-center border border-gray-300 rounded-lg">
                                    <button type="button" onclick="updateQuantity({{ $item->id }}, -1)"
                                            class="px-3 py-1 hover:bg-gray-100">
                                        <i class="fas fa-minus text-sm"></i>
                                    </button>
                                    <input type="number"
                                           id="qty-{{ $item->id }}"
                                           value="{{ $item->qty }}"
                                           min="1"
                                           max="{{ $item->product->stock }}"
                                           data-max="{{ $item->product->stock }}"
                                           class="w-12 text-center border-x border-gray-300 py-1"
                                           onchange="updateCartItem({{ $item->id }}, this.value)">
                                    <button type="button" onclick="updateQuantity({{ $item->id }}, 1)"
                                            class="px-3 py-1 hover:bg-gray-100">
                                        <i class="fas fa-plus text-sm"></i>
                                    </button>
                                </div>
                                <span class="font-bold ml-6 text-lg" id="item-total-{{ $item->id }}">
                                    ₹{{ number_format($item->amount, 2) }}
                                </span>
                            </div>
                        </div>
                        @else
                        <div class="text-red-500">
                            <i class="fas fa-exclamation-triangle mr-2"></i>
                            Product not available
                        </div>
                        @endif

                        <form action="{{ route('cart.remove', $item->id) }}" method="POST" class="ml-4">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                    class="text-red-500 hover:text-red-700 p-2 rounded-full hover:bg-red-50"
                                    onclick="return confirm('Remove this item from cart?')">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </div>
                    @endforeach
                </div>
            </div>

            <!-- Order Summary -->
            <div class="lg:col-span-1">
                <div class="bg-white rounded-xl shadow-lg p-6 sticky top-4">
                    <h2 class="text-xl font-bold mb-6">Order Summary</h2>

                    <div class="space-y-4">
                        <div class="flex justify-between">
                            <span class="text-gray-600">Subtotal ({{ $cartItems->sum('qty') }} items)</span>
                            <span class="font-bold" id="cart-subtotal">
                                ₹{{ number_format($totalAmount, 2) }}
                            </span>
                        </div>

                        <div class="flex justify-between">
                            <span class="text-gray-600">Shipping</span>
                            <span class="font-bold">₹0.00</span>
                        </div>

                        <div class="flex justify-between">
                            <span class="text-gray-600">Tax</span>
                            <span class="font-bold">₹0.00</span>
                        </div>

                        <div class="border-t border-gray-300 pt-4">
                            <div class="flex justify-between text-lg font-bold">
                                <span>Total</span>
                                <span id="cart-total">₹{{ number_format($totalAmount, 2) }}</span>
                            </div>
                        </div>

                        <a href="{{ route('home') }}" class="block text-center text-amber-600 hover:text-amber-700 mt-4 py-2 border border-amber-600 rounded-lg">
                            <i class="fas fa-arrow-left mr-2"></i>Continue Shopping
                        </a>

                        <button class="w-full bg-linear-to-r from-amber-500 to-orange-500 text-white font-bold py-3 rounded-lg mt-4 hover:from-amber-600 hover:to-orange-600 transition">
                            <i class="fas fa-lock mr-2"></i>Proceed to Checkout
                        </button>

                        <p class="text-xs text-gray-500 text-center mt-4">
                            <i class="fas fa-shield-alt mr-1"></i>
                            Secure checkout • Free shipping • Easy returns
                        </p>
                    </div>
                </div>
            </div>
        </div>
        @else
        <div class="text-center py-16">
            <div class="text-6xl text-gray-300 mb-6">
                <i class="fas fa-shopping-cart"></i>
            </div>
            <h2 class="text-2xl font-bold text-gray-700 mb-4">Your cart is empty</h2>
            <p class="text-gray-600 mb-8">Looks like you haven't added any items to your cart yet.</p>
            <a href="{{ route('home') }}" class="inline-flex items-center bg-linear-to-r from-amber-500 to-orange-500 text-white font-bold px-8 py-3 rounded-lg hover:from-amber-600 hover:to-orange-600 transition">
                <i class="fas fa-shopping-bag mr-2"></i>Start Shopping
            </a>
        </div>
        @endif
    </div>
</x-frontend-layout>
