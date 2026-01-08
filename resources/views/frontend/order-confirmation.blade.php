<x-frontend-layout>
    <div class="min-h-screen bg-gray-50 py-12">
        <!-- Confirmation Header -->
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-10">
                <div class="inline-flex items-center justify-center w-20 h-20 bg-green-100 rounded-full mb-6">
                    <svg class="w-10 h-10 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M5 13l4 4L19 7"/>
                    </svg>
                </div>
                <h1 class="text-3xl font-bold text-gray-900 mb-3">
                    Order Confirmed!
                </h1>
                <p class="text-gray-600">
                    Thank you for your purchase, {{ Auth::user()->name ?? 'Customer' }}
                </p>
                <p class="text-sm text-gray-500 mt-2">
                    A confirmation email has been sent to {{ Auth::user()->email ?? 'your email' }}
                </p>
            </div>

            <!-- Order Summary Card -->
            <div class="bg-white rounded-2xl shadow-lg overflow-hidden mb-8">
                <div class="p-8">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                        <!-- Order Info -->
                        <div class="space-y-2">
                            <h3 class="text-sm font-medium text-gray-500 uppercase">Order Information</h3>
                            <div class="space-y-1">
                                <p class="text-lg font-semibold">#{{ $order->id }}</p>
                                <p class="text-sm text-gray-600">{{ $order->created_at->format('F d, Y • h:i A') }}</p>
                            </div>
                        </div>

                        <!-- Payment Status -->
                        <div class="space-y-2">
                            <h3 class="text-sm font-medium text-gray-500 uppercase">Payment Status</h3>
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium
                                {{ ($order->payment->status ?? 'pending') === 'completed' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                {{ ucfirst($order->payment->status ?? 'pending') }}
                            </span>
                        </div>

                        <!-- Total Amount -->
                        <div class="space-y-2">
                            <h3 class="text-sm font-medium text-gray-500 uppercase">Total Amount</h3>
                            <p class="text-2xl font-bold text-gray-900">Rs. {{ number_format($order->total_amount, 2) }}</p>
                        </div>
                    </div>

                    <!-- Order Items -->
                    <div class="border-t pt-8">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Order Items</h3>
                        <div class="space-y-4">
                            @foreach($order->order_Items as $item)
                            <div class="flex items-center space-x-4 p-4 bg-gray-50 rounded-lg">
                                <!-- Fixed Image Access -->
                                @if(isset($item->product->image) && is_array($item->product->image) && count($item->product->image) > 0)
                                    <img src="{{ asset('storage/' . $item->product->image[0]) }}"
                                         alt="{{ $item->product->name }}"
                                         class="w-16 h-16 object-cover rounded-lg">
                                @else
                                    <!-- Fallback Image -->
                                    <div class="w-16 h-16 bg-gray-200 rounded-lg flex items-center justify-center">
                                        <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                  d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                        </svg>
                                    </div>
                                @endif
                                <div class="flex-1">
                                    <h4 class="font-medium text-gray-900">{{ $item->product->name ?? 'Product Name' }}</h4>
                                    <p class="text-sm text-gray-500">Quantity: {{ $item->qty }}</p>
                                </div>
                                <div class="text-right">
                                    <p class="font-semibold text-gray-900">Rs. {{ number_format($item->amount, 2) }}</p>
                                    <p class="text-sm text-gray-500">Rs. {{ number_format($item->amount / $item->qty, 2) }} each</p>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Order Totals -->
                    <div class="mt-8 pt-6 border-t">
                        <div class="max-w-sm ml-auto space-y-3">
                            <div class="flex justify-between">
                                <span class="text-gray-600">Subtotal</span>
                                <span class="font-medium">Rs. {{ number_format($order->total_amount, 2) }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">Shipping</span>
                                <span class="font-medium">Rs. {{ number_format($order->shipping_charge ?? 0, 2) }}</span>
                            </div>
                            @if($order->discount_amount ?? 0)
                            <div class="flex justify-between text-green-600">
                                <span>Discount</span>
                                <span>-Rs. {{ number_format($order->discount_amount, 2) }}</span>
                            </div>
                            @endif
                            <div class="flex justify-between text-lg font-bold text-gray-900 pt-3 border-t">
                                <span>Total</span>
                                <span>Rs. {{ number_format($order->total_amount + ($order->shipping_charge ?? 0) - ($order->discount_amount ?? 0), 2) }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Customer & Shipping Info -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-10">
                <!-- Customer Info -->
                <div class="bg-white rounded-2xl shadow-lg p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Customer Information</h3>
                    <div class="space-y-2">
                        <p><span class="text-gray-600">Name:</span> {{ $order->client->name ?? 'N/A' }}</p>
                        <p><span class="text-gray-600">Email:</span> {{ $order->client->email ?? 'N/A' }}</p>
                        <p><span class="text-gray-600">Phone:</span> {{ $order->client->phone ?? 'N/A' }}</p>
                    </div>
                </div>

                <!-- Shipping Address -->
                <div class="bg-white rounded-2xl shadow-lg p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Shipping Address</h3>
                    <div class="space-y-2">
                        <p class="font-medium">{{ $order->client->name ?? 'N/A' }}</p>
                        <p class="text-gray-600">{{ $order->shipping_address ?? 'N/A' }}</p>
                        @if($order->shipping_city)
                        <p class="text-gray-600">{{ $order->shipping_city }}, {{ $order->shipping_state ?? '' }} {{ $order->shipping_zip ?? '' }}</p>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="flex flex-col sm:flex-row gap-4 justify-center items-center no-print">
                <a href="{{ route('home') }}"
                   class="inline-flex items-center justify-center px-8 py-3 border-2 border-amber-500 text-amber-600 font-semibold rounded-lg hover:bg-amber-50 transition duration-200 w-full sm:w-auto">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                    </svg>
                    Continue Shopping
                </a>

                {{-- @if(route('orders'))
                <a href="{{ route('orders') }}"
                   class="inline-flex items-center justify-center px-8 py-3 bg-gray-900 text-white font-semibold rounded-lg hover:bg-gray-800 transition duration-200 w-full sm:w-auto">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                    </svg>
                    View All Orders
                </a>
                @endif --}}

                <button onclick="window.print()"
                   class="inline-flex items-center justify-center px-8 py-3 border border-gray-300 text-gray-700 font-semibold rounded-lg hover:bg-gray-50 transition duration-200 w-full sm:w-auto">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/>
                    </svg>
                    Print Receipt
                </button>
            </div>

            <!-- Help Section -->
            <div class="mt-12 text-center no-print">
                <p class="text-gray-600 mb-4">Need help with your order?</p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="#"
                       class="text-amber-600 hover:text-amber-700 font-medium">
                        Contact Support
                    </a>
                    <span class="hidden sm:inline text-gray-300">•</span>
                    <a href="#"
                       class="text-amber-600 hover:text-amber-700 font-medium">
                        View FAQ
                    </a>
                    <span class="hidden sm:inline text-gray-300">•</span>
                    <a href="#"
                       class="text-amber-600 hover:text-amber-700 font-medium">
                        Track Order
                    </a>
                </div>
            </div>

            <!-- Order Timeline -->
            <div class="mt-12 bg-white rounded-2xl shadow-lg p-8 no-print">
                <h3 class="text-lg font-semibold text-gray-900 mb-6">Order Timeline</h3>
                <div class="relative">
                    <!-- Timeline Line -->
                    <div class="absolute left-4 top-0 bottom-0 w-0.5 bg-gray-200"></div>

                    <!-- Timeline Steps -->
                    <div class="space-y-8">
                        <!-- Step 1: Order Placed -->
                        <div class="relative flex items-start">
                            <div class="shrink-0 w-8 h-8 rounded-full bg-green-600 flex items-center justify-center">
                                <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                </svg>
                            </div>
                            <div class="ml-6">
                                <h4 class="font-medium text-gray-900">Order Placed</h4>
                                <p class="text-sm text-gray-500">{{ $order->created_at->format('F d, Y • h:i A') }}</p>
                            </div>
                        </div>

                        <!-- Step 2: Payment -->
                        <div class="relative flex items-start">
                            <div class="shrink-0 w-8 h-8 rounded-full
                                {{ ($order->payment->status ?? 'pending') === 'completed' ? 'bg-green-600' : 'bg-gray-300' }}
                                flex items-center justify-center">
                                @if(($order->payment->status ?? 'pending') === 'completed')
                                <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                </svg>
                                @endif
                            </div>
                            <div class="ml-6">
                                <h4 class="font-medium text-gray-900">Payment {{ ucfirst($order->payment->status ?? 'pending') }}</h4>
                                <p class="text-sm text-gray-500">
                                    {{ ($order->payment->status ?? 'pending') === 'completed' ? 'Payment completed successfully' : 'Awaiting payment confirmation' }}
                                </p>
                            </div>
                        </div>

                        <!-- Step 3: Processing -->
                        <div class="relative flex items-start">
                            <div class="shrink-0 w-8 h-8 rounded-full bg-gray-300 flex items-center justify-center">
                                <span class="text-xs font-medium text-gray-600">2</span>
                            </div>
                            <div class="ml-6">
                                <h4 class="font-medium text-gray-900">Processing</h4>
                                <p class="text-sm text-gray-500">Preparing your order</p>
                            </div>
                        </div>

                        <!-- Step 4: Shipped -->
                        <div class="relative flex items-start">
                            <div class="shrink-0 w-8 h-8 rounded-full bg-gray-200 flex items-center justify-center">
                                <span class="text-xs font-medium text-gray-400">3</span>
                            </div>
                            <div class="ml-6">
                                <h4 class="font-medium text-gray-400">Shipped</h4>
                                <p class="text-sm text-gray-400">Will update when shipped</p>
                            </div>
                        </div>

                        <!-- Step 5: Delivered -->
                        <div class="relative flex items-start">
                            <div class="shrink-0 w-8 h-8 rounded-full bg-gray-200 flex items-center justify-center">
                                <span class="text-xs font-medium text-gray-400">4</span>
                            </div>
                            <div class="ml-6">
                                <h4 class="font-medium text-gray-400">Delivered</h4>
                                <p class="text-sm text-gray-400">Estimated delivery: 3-5 business days</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Print Styles -->
    <style>
        @media print {
            .no-print {
                display: none !important;
            }

            body {
                background: white !important;
                font-size: 12px !important;
            }

            .bg-white {
                box-shadow: none !important;
                border: 1px solid #e5e7eb !important;
                margin-bottom: 10px !important;
            }

            .max-w-4xl {
                max-width: 100% !important;
                padding: 0 !important;
            }

            .py-12 {
                padding-top: 10px !important;
                padding-bottom: 10px !important;
            }

            .p-8, .p-6 {
                padding: 15px !important;
            }

            .text-3xl {
                font-size: 20px !important;
            }

            .text-2xl {
                font-size: 18px !important;
            }

            .grid, .flex {
                break-inside: avoid !important;
            }
        }
    </style>
</x-frontend-layout>
