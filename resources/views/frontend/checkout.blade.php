<x-frontend-layout>
    @push('css')
    <style>
        .store-card {
            @apply bg-linear-to-r from-amber-50 to-orange-50 border border-amber-200 rounded-xl p-4;
        }

        .payment-option {
            @apply border-2 rounded-xl p-4 flex items-start gap-4 cursor-pointer transition-all duration-300;
        }

        .payment-option input[type="radio"] {
            @apply mt-1;
        }

        .payment-info {
            @apply mt-4 text-sm text-gray-700 bg-gray-50 border rounded-lg p-3;
        }

        /* Payment method colors */
        .cod-color {
            @apply border-blue-500 bg-blue-50;
        }

        .khalti-color {
            @apply border-purple-500 bg-purple-50;
        }

        .bank-color {
            @apply border-red-500 bg-red-50;
        }

        .payment-icon {
            @apply w-10 h-10 rounded-lg flex items-center justify-center;
        }

        .form-group {
            @apply mb-4;
        }
    </style>
    @endpush

    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Payment method selection
            const paymentOptions = document.querySelectorAll('.payment-option');
            const paymentInput = document.getElementById('payment_method');
            const paymentInfo = document.getElementById('payment-info');

            const paymentLabels = {
                cod: 'You will pay cash when the order is delivered. No advance payment required.',
                khalti: 'You will be redirected to Khalti for secure payment. Instant confirmation.',
                bank: 'Direct bank transfer using net banking. Processed within 24 hours.'
            };

            paymentOptions.forEach(option => {
                option.addEventListener('click', function() {
                    // Reset all payment options
                    paymentOptions.forEach(opt => {
                        opt.classList.remove('cod-color', 'khalti-color', 'bank-color', 'border-blue-500', 'border-purple-500', 'border-red-500', 'bg-blue-50', 'bg-purple-50', 'bg-red-50');
                        opt.classList.add('border-gray-300');
                    });

                    // Get the radio input inside this option
                    const radio = this.querySelector('input[type="radio"]');
                    if (radio) {
                        radio.checked = true;
                        const paymentValue = radio.value;

                        // Update hidden input
                        if (paymentInput) {
                            paymentInput.value = paymentValue;
                        }

                        // Apply selected styles
                        this.classList.remove('border-gray-300');

                        if (paymentValue === 'cod') {
                            this.classList.add('cod-color');
                        } else if (paymentValue === 'khalti') {
                            this.classList.add('khalti-color');
                        } else if (paymentValue === 'bank') {
                            this.classList.add('bank-color');
                        }

                        // Show payment info
                        if (paymentInfo && paymentLabels[paymentValue]) {
                            paymentInfo.textContent = paymentLabels[paymentValue];
                            paymentInfo.classList.remove('hidden');
                        }

                        // Show/hide payment buttons
                        const khaltiPayBtn = document.getElementById('khalti-pay-btn');
                        const regularSubmitBtn = document.getElementById('regular-submit-btn');

                        if (khaltiPayBtn) khaltiPayBtn.style.display = paymentValue === 'khalti' ? 'block' : 'none';
                        if (regularSubmitBtn) regularSubmitBtn.style.display = paymentValue === 'khalti' ? 'none' : 'block';
                    }
                });
            });

            // Initialize with COD selected
            const codOption = document.querySelector('.payment-option input[value="cod"]');
            if (codOption) {
                codOption.checked = true;
                const codLabel = codOption.closest('.payment-option');
                if (codLabel) {
                    codLabel.classList.add('cod-color');
                    codLabel.classList.remove('border-gray-300');
                }

                if (paymentInfo && paymentLabels.cod) {
                    paymentInfo.textContent = paymentLabels.cod;
                    paymentInfo.classList.remove('hidden');
                }
            }

            // Form validation
            const checkoutForm = document.getElementById('checkoutForm');
            if (checkoutForm) {
                checkoutForm.addEventListener('submit', function(e) {
                    const requiredFields = this.querySelectorAll('[required]');
                    let isValid = true;

                    requiredFields.forEach(field => {
                        if (!field.value.trim()) {
                            isValid = false;
                            field.classList.add('border-red-500');

                            if (!field.nextElementSibling || !field.nextElementSibling.classList.contains('text-red-500')) {
                                const error = document.createElement('p');
                                error.className = 'text-red-500 text-sm mt-1';
                                error.textContent = 'This field is required';
                                field.parentNode.appendChild(error);
                            }
                        } else {
                            field.classList.remove('border-red-500');
                            const error = field.parentNode.querySelector('.text-red-500');
                            if (error) error.remove();
                        }
                    });

                    if (!isValid) {
                        e.preventDefault();
                        showNotification('Please fill in all required fields', 'error');
                    }
                });
            }

            // Show notification
            function showNotification(message, type = 'success') {
                const notification = document.createElement('div');
                notification.className = `fixed top-20 right-4 px-4 py-3 rounded-lg shadow-lg z-50 transition-all duration-300 ${
                    type === 'success' ? 'bg-green-500' : 'bg-red-500'
                } text-white`;
                notification.innerHTML = `
                    <i class="fas ${type === 'success' ? 'fa-check-circle' : 'fa-exclamation-circle'} mr-2"></i>
                    ${message}
                `;
                document.body.appendChild(notification);

                setTimeout(() => {
                    notification.remove();
                }, 3000);
            }

            // Khalti Payment Integration
            function initiateKhaltiPayment() {
                const amount = parseFloat(document.getElementById('cart-total').textContent.replace('₹', '')) * 100;
                const khaltiBtn = document.getElementById('khalti-pay-btn');
                const originalText = khaltiBtn.innerHTML;

                khaltiBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i> Processing with Khalti...';
                khaltiBtn.disabled = true;

                }, 2000);
            }

            // Attach khalti payment button click event

            }
        });
    </script>
    @endpush

    <div class="max-w-6xl mx-auto px-4 py-8 grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- LEFT SIDE -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Store Information Card -->
            <div class="store-card mb-6">
                <div class="flex items-center">
                    @if($client->logo)
                    <img src="{{ asset('storage/' . $client->logo) }}"
                         alt="{{ $client->shop_name }}"
                         class="w-14 h-14 rounded-xl object-cover border-2 border-white shadow mr-4">
                    @else
                    <div class="w-14 h-14 bg-amber-100 rounded-xl flex items-center justify-center border-2 border-white shadow mr-4">
                        <i class="fas fa-store text-amber-600 text-2xl"></i>
                    </div>
                    @endif
                    <div>
                        <h3 class="font-bold text-lg text-gray-900">{{ $client->shop_name }}</h3>
                        <p class="text-sm text-gray-600">{{ $client->address }}</p>
                    </div>
                </div>
            </div>

            <form id="checkoutForm" action="{{ route('checkout.process') }}" method="POST">
                @csrf
                <input type="hidden" name="client_id" value="{{ $client->id }}">
                <input type="hidden" id="payment_method" name="payment_method" value="cod">
                <input type="hidden" id="khalti_token" name="khalti_token">

                <!-- Delivery Information -->
                <div class="bg-white rounded-2xl shadow-lg p-8 mb-8 border border-gray-100">
                    <h2 class="text-2xl font-bold text-gray-900 tracking-tight mb-6">Delivery Information</h2>

                    <!-- Personal Details -->
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
                        <!-- Full Name -->
                        <div class="form-group">
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Full Name <span class="text-red-500">*</span>
                            </label>
                            <div class="relative">
                                <div class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400">
                                    <i class="fas fa-user"></i>
                                </div>
                                <input type="text"
                                    name="full_name"
                                    class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-300"
                                    required
                                    value="{{ auth()->user()->name }}"
                                    placeholder="John Doe">
                            </div>
                        </div>

                        <!-- Phone Number -->
                        <div class="form-group">
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Phone Number <span class="text-red-500">*</span>
                            </label>
                            <div class="relative">
                                <div class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400">
                                    <i class="fas fa-phone"></i>
                                </div>
                                <input type="tel"
                                    name="phone"
                                    class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-300"
                                    required
                                    placeholder="98XXXXXXXX"
                                    pattern="[0-9]{10}"
                                    maxlength="10">
                            </div>
                        </div>
                    </div>

                    <!-- Email -->
                    <div class="form-group mb-6">
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Email Address <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <div class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400">
                                <i class="fas fa-envelope"></i>
                            </div>
                            <input type="email"
                                name="email"
                                class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-300"
                                required
                                value="{{ auth()->user()->email }}"
                                placeholder="john@example.com">
                        </div>
                    </div>

                    <!-- Delivery Address -->
                    <div class="form-group mb-6">
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Full Delivery Address <span class="text-red-500">*</span>
                        </label>
                        <textarea
                            name="address"
                            required
                            class="w-full h-32 border border-gray-300 rounded-lg p-4 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-300"
                            placeholder="House no., Street, Area, City (e.g., Koteshwor-32, Kathmandu)"
                        ></textarea>
                        <p class="text-sm text-gray-500 mt-2">
                            We'll deliver your order to this address
                        </p>
                    </div>

                    <!-- City & Province -->
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
                        <!-- City -->
                        <div class="form-group">
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                City <span class="text-red-500">*</span>
                            </label>
                            <div class="relative">
                                <div class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400">
                                    <i class="fas fa-city"></i>
                                </div>
                                <input type="text"
                                    name="city"
                                    class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-300"
                                    required
                                    placeholder="Kathmandu">
                            </div>
                        </div>

                        <!-- Province -->
                        <div class="form-group">
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Province <span class="text-red-500">*</span>
                            </label>
                            <div class="relative">
                                <div class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400">
                                    <i class="fas fa-landmark"></i>
                                </div>
                                <select name="state"
                                        class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-300 appearance-none cursor-pointer">
                                    <option value="">Select Province</option>
                                    <option value="Bagmati">Bagmati Province</option>
                                    <option value="Gandaki">Gandaki Province</option>
                                    <option value="Koshi">Koshi Province</option>
                                    <option value="Lumbini">Lumbini Province</option>
                                    <option value="Madhesh">Madhesh Province</option>
                                    <option value="Sudurpaschim">Sudurpaschim Province</option>
                                    <option value="Karnali">Karnali Province</option>
                                </select>
                                <div class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400 pointer-events-none">
                                    <i class="fas fa-chevron-down"></i>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- ZIP Code -->
                    <div class="form-group mb-6">
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            ZIP Code (Optional)
                        </label>
                        <div class="relative">
                            <div class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400">
                                <i class="fas fa-mail-bulk"></i>
                            </div>
                            <input type="text"
                                name="zip_code"
                                class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-300"
                                placeholder="44600">
                        </div>
                    </div>

                    <!-- Delivery Instructions -->
                    <div class="form-group mb-6">
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Delivery Instructions (Optional)
                        </label>
                        <div class="relative">
                            <div class="absolute left-3 top-4 text-gray-400">
                                <i class="fas fa-sticky-note"></i>
                            </div>
                            <textarea name="delivery_instructions"
                                    class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-300 resize-none"
                                    rows="2"
                                    placeholder="Any specific delivery instructions, gate codes, or preferred delivery times..."></textarea>
                        </div>
                        <p class="text-xs text-gray-500 mt-2">We'll do our best to accommodate your request</p>
                    </div>

                    <!-- Save Address Toggle -->
                    <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg border border-gray-200">
                        <div class="flex items-center">
                            <div class="flex items-center justify-center w-10 h-10 bg-blue-100 text-blue-600 rounded-lg mr-4">
                                <i class="fas fa-save"></i>
                            </div>
                            <div>
                                <h4 class="font-medium text-gray-900">Save this address</h4>
                                <p class="text-sm text-gray-600">Save for faster checkout next time</p>
                            </div>
                        </div>
                        <label class="relative inline-flex items-center cursor-pointer">
                            <input type="checkbox" name="save_address" class="sr-only peer">
                            <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-100 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:left-0.5 after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-500"></div>
                        </label>
                    </div>
                </div>

                <!-- PAYMENT METHOD -->
                <div class="bg-white rounded-xl shadow p-6">
                    <h2 class="text-lg font-semibold mb-4 flex items-center gap-2">
                        <i class="fas fa-credit-card text-blue-600"></i>
                        Payment Method
                    </h2>

                    <!-- COD -->
                    <label class="payment-option border-2 border-blue-500 bg-blue-50 rounded-xl p-4 flex items-start gap-4 cursor-pointer mb-4">
                        <input type="radio" name="payment_method" value="cod" checked class="mt-1">
                        <div class="flex-1">
                            <div class="flex items-center mb-2">
                                <div class="payment-icon bg-blue-100 text-blue-600 mr-3">
                                    <i class="fas fa-money-bill-wave"></i>
                                </div>
                                <p class="font-semibold text-gray-900">Cash on Delivery (COD)</p>
                            </div>
                            <p class="text-sm text-gray-600">Pay with cash when your order arrives</p>
                        </div>
                    </label>

                    <!-- KHALTI -->
                    <label class="payment-option border-2 border-gray-300 rounded-xl p-4 flex items-start gap-4 cursor-pointer mb-4">
                        <input type="radio" name="payment_method" value="khalti" class="mt-1">
                        <div class="flex-1">
                            <div class="flex items-center mb-2">
                                <div class="payment-icon bg-purple-100 text-purple-600 mr-3">
                                    <span class="font-bold">K</span>
                                </div>
                                <p class="font-semibold text-gray-900">Khalti Digital Wallet</p>
                            </div>
                            <p class="text-sm text-gray-600">Pay instantly using Khalti wallet</p>
                        </div>
                    </label>

                    <!-- BANK -->
                    <label class="payment-option border-2 border-gray-300 rounded-xl p-4 flex items-start gap-4 cursor-pointer">
                        <input type="radio" name="payment_radio" value="bank" class="mt-1">
                        <div class="flex-1">
                            <div class="flex items-center mb-2">
                                <div class="payment-icon bg-red-100 text-red-600 mr-3">
                                    <i class="fas fa-university"></i>
                                </div>
                                <p class="font-semibold text-gray-900">Bank Transfer</p>
                            </div>
                            <p class="text-sm text-gray-600">Direct bank transfer using net banking</p>
                        </div>
                    </label>

                    <!-- INFO TEXT -->
                    <p id="payment-info"
                       class="mt-4 text-sm text-gray-700 bg-gray-50 border rounded-lg p-3">
                        You will pay cash when the order is delivered. No advance payment required.
                    </p>

                    <!-- Khalti Payment Button -->
                    <button type="button" id="khalti-pay-btn"
                            class="w-full bg-linear-to-r from-purple-600 to-indigo-700 text-white font-bold py-3.5 rounded-lg hover:from-purple-700 hover:to-indigo-800 transition-all duration-300 shadow-md hover:shadow-lg mt-4 hidden">
                        <i class="fas fa-bolt mr-2"></i>Pay with Khalti
                    </button>

                    <!-- Regular Submit Button -->
                    <button type="submit" id="regular-submit-btn"
                            class="w-full bg-linear-to-r from-blue-600 to-blue-700 text-white font-bold py-3.5 rounded-lg hover:from-blue-700 hover:to-blue-800 transition-all duration-300 shadow-md hover:shadow-lg mt-4">
                        <i class="fas fa-check-circle mr-2"></i>Place Order
                    </button>

                    <!-- Terms -->
                    <div class="mt-6 pt-6 border-t border-gray-200">
                        <label class="flex items-start">
                            <input type="checkbox" name="terms" class="mt-1 mr-3" required>
                            <span class="text-sm text-gray-700">
                                By placing this order, I agree to the <a href="#" class="text-blue-600 hover:underline font-medium">Terms of Service</a> and <a href="#" class="text-blue-600 hover:underline font-medium">Privacy Policy</a>.
                            </span>
                        </label>
                    </div>
                </div>
            </form>
        </div>

        <!-- RIGHT SIDE -->
        <div class="bg-white rounded-xl shadow p-6 h-fit sticky top-4">
            <h2 class="text-lg font-semibold mb-4 flex items-center gap-2">
                <i class="fas fa-lock text-blue-600"></i>
                Order Summary
            </h2>

            <!-- Items List -->
            <div class="space-y-4 mb-6 max-h-64 overflow-y-auto pr-2">
                @foreach($cartItems as $item)
                @if($item->product)
                <div class="flex items-center p-3 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors duration-300">
                    <div class="w-12 h-12 rounded-lg overflow-hidden mr-3 shrink-0 border border-gray-200">
                        @if(isset($item->product->image) && is_array($item->product->image) && count($item->product->image) > 0)
                        <img src="{{ asset('storage/' . $item->product->image[0]) }}"
                             class="w-full h-full object-cover">
                        @else
                        <div class="w-full h-full bg-gray-200 flex items-center justify-center">
                            <i class="fas fa-box text-gray-400"></i>
                        </div>
                        @endif
                    </div>
                    <div class="flex-1 min-w-0">
                        <h4 class="font-medium text-sm truncate text-gray-900">{{ $item->product->name }}</h4>
                        <div class="flex items-center justify-between text-xs text-gray-600">
                            <span>Qty: {{ $item->qty }}</span>
                            <span>₹{{ number_format($item->product->price - ($item->product->price * $item->product->discount / 100), 2) }}/unit</span>
                        </div>
                    </div>
                    <div class="font-bold text-gray-900 ml-2">
                        ₹{{ number_format($item->amount, 2) }}
                    </div>
                </div>
                @endif
                @endforeach
            </div>

            <!-- Order Summary -->
            <div class="space-y-3 border-t border-gray-200 pt-4">
                <div class="flex justify-between">
                    <span class="text-gray-600">Subtotal ({{ count($cartItems) }} items)</span>
                    <span class="font-medium">₹{{ number_format($totalAmount, 2) }}</span>
                </div>

                <div class="flex justify-between">
                    <span class="text-gray-600">Shipping Fee</span>
                    <span class="font-medium text-green-600">FREE</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-600">Tax (13% VAT)</span>
                    <span class="font-medium">₹{{ number_format($totalAmount * 0.13, 2) }}</span>
                </div>

                <div class="flex justify-between text-lg font-bold border-t border-gray-300 pt-4">
                    <span class="text-gray-900">Total Amount</span>
                    <span id="cart-total" class="text-blue-600">₹{{ number_format($totalAmount, 2) }}</span>
                </div>
            </div>

            <!-- Savings -->
            <div class="mt-4 p-3 bg-linear-to-r from-green-50 to-emerald-50 rounded-lg border border-green-100">
                <div class="flex items-center">
                    <i class="fas fa-piggy-bank text-green-500 mr-2"></i>
                    <span class="text-sm font-medium text-green-700">You save ₹{{ number_format($totalAmount * 0.02, 2) }} on this order</span>
                </div>
            </div>

            <!-- Need Help -->
            <div class="mt-6 pt-6 border-t border-gray-200">
                <div class="flex items-center text-gray-600">
                    <i class="fas fa-headset text-blue-500 mr-3"></i>
                    <div>
                        <p class="text-sm font-medium">Need help with your order?</p>
                        <p class="text-xs text-gray-500">Call {{ $client->contact }}</p>
                    </div>
                </div>
            </div>

            <!-- Back to Cart -->
            <a href="{{ route('cart') }}" class="block text-center text-blue-600 hover:text-blue-700 mt-6 py-3 border border-blue-600 rounded-lg hover:bg-blue-50 transition-colors duration-300">
                <i class="fas fa-arrow-left mr-2"></i>Return to Cart
            </a>

            <!-- Security Assurance -->
            <div class="mt-4 pt-4 border-t border-gray-200">
                <div class="flex items-center justify-center space-x-4">
                    <div class="text-center">
                        <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-1">
                            <i class="fas fa-lock text-blue-500 text-sm"></i>
                        </div>
                        <p class="text-xs text-gray-600">Secure</p>
                    </div>
                    <div class="text-center">
                        <div class="w-8 h-8 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-1">
                            <i class="fas fa-shield-alt text-green-500 text-sm"></i>
                        </div>
                        <p class="text-xs text-gray-600">Protected</p>
                    </div>
                    <div class="text-center">
                        <div class="w-8 h-8 bg-purple-100 rounded-full flex items-center justify-center mx-auto mb-1">
                            <i class="fas fa-truck text-purple-500 text-sm"></i>
                        </div>
                        <p class="text-xs text-gray-600">Fast Delivery</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-frontend-layout>
