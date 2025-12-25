<x-frontend-layout>
    @push('css')
     <style>
        /* Custom styles */
        .search-input:focus {
            box-shadow: 0 0 0 3px rgba(251, 191, 36, 0.2);
        }

        .cart-count {
            position: absolute;
            top: -8px;
            right: -8px;
            background-color: #ef4444;
            color: white;
            border-radius: 50%;
            width: 20px;
            height: 20px;
            font-size: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .dropdown-menu {
            transition: all 0.3s ease;
            opacity: 0;
            visibility: hidden;
            transform: translateY(10px);
        }

        .dropdown:hover .dropdown-menu {
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
        }

        .mobile-menu {
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.5s ease;
        }

        .mobile-menu.active {
            max-height: 500px;
        }

        .social-icon {
            transition: all 0.3s ease;
        }

        .social-icon:hover {
            transform: translateY(-3px);
        }

        .sticky-header {
            position: sticky;
            top: 0;
            z-index: 100;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        }

        /* Form styling */
        .form-input:focus {
            border-color: #f59e0b;
            box-shadow: 0 0 0 3px rgba(245, 158, 11, 0.1);
        }

        .floating-label {
            position: absolute;
            top: 0;
            left: 0;
            pointer-events: none;
            transition: all 0.3s ease;
            transform-origin: left top;
            color: #9ca3af;
        }

        .form-group:focus-within .floating-label,
        .form-input:not(:placeholder-shown) + .floating-label {
            transform: translateY(-22px) scale(0.85);
            color: #f59e0b;
        }

        /* Animation for form image */
        @keyframes float {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-15px); }
        }

        .floating-img {
            animation: float 6s ease-in-out infinite;
        }

        /* Gradient background for form section */
        .gradient-bg {
            background: linear-gradient(135deg, #fef3c7 0%, #fde68a 25%, #fbbf24 100%);
        }
    </style>

    @endpush
<section id="partner-form" class="mb-16">
                <div class="bg-white rounded-2xl shadow-xl overflow-hidden ">
                    <!-- Section header -->
                    <div class="gradient-bg py-6 px-8">
                        <div class="flex flex-col md:flex-row justify-between items-center">
                            <div>
                                <h2 class="text-3xl font-bold text-gray-900 mb-2">Join Our Platform as a Partner</h2>
                                <p class="text-gray-800">List your store and reach thousands of new customers</p>
                            </div>
                            <div class="mt-4 md:mt-0">
                                <span class="inline-flex items-center px-4 py-2 bg-white text-amber-700 rounded-full font-medium">
                                    <i class="fas fa-bolt mr-2"></i> Quick Application Process
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- Split layout: Form + Image/Info -->
                    <div class="flex flex-col lg:flex-row">
                        <!-- Form Section -->
                        <div class="lg:w-1/2 p-8 lg:p-12">
                            <div class="mb-8">
                                <h3 class="text-2xl font-bold text-gray-900 mb-3">Store Registration Form</h3>
                                <p class="text-gray-600 mb-6">Fill out the form below to request partnership. Our team will contact you within 24 hours.</p>

                                <div class="flex items-center mb-6">
                                    <div class="flex items-center text-green-600 mr-4">
                                        <i class="fas fa-check-circle mr-2"></i>
                                        <span class="text-sm">No setup fees</span>
                                    </div>
                                    <div class="flex items-center text-green-600 mr-4">
                                        <i class="fas fa-check-circle mr-2"></i>
                                        <span class="text-sm">24/7 Support</span>
                                    </div>
                                    <div class="flex items-center text-green-600">
                                        <i class="fas fa-check-circle mr-2"></i>
                                        <span class="text-sm">Fast onboarding</span>
                                    </div>
                                </div>
                            </div>

                            <!-- Request Form -->
                            <form action="{{route('client.request')}}" method="POST" class="space-y-6" >
                                @csrf
                                <!-- Client Name -->
                                <div class="form-group relative">
                                    <input type="text"
                                           id="client_name"
                                           name="client_name"
                                           placeholder=" "
                                           class="form-input w-full py-3 px-4 border border-gray-300 rounded-lg focus:outline-none transition-colors"
                                           required value="{{ old('client_name') }}">
                                    <label for="client_name" class="floating-label py-3 px-4">
                                        <i class="fas fa-user mr-2"></i>Client Full Name *
                                    </label>
                                    <div class="text-xs text-gray-500 mt-1 ml-1">Legal name of the business owner/representative</div>
                                </div>

                                <!-- Shop/Store Name -->
                                <div class="form-group relative">
                                    <input type="text"
                                           id="shop_name"
                                           name="shop_name"
                                           placeholder=" "
                                           class="form-input w-full py-3 px-4 border border-gray-300 rounded-lg focus:outline-none transition-colors"
                                           required value="{{old('shop_name')}}">
                                    <label for="shop_name" class="floating-label py-3 px-4">
                                        <i class="fas fa-store mr-2"></i>Shop/Store Name *
                                    </label>
                                    <div class="text-xs text-gray-500 mt-1 ml-1">Official business name as registered</div>
                                </div>

                                <!-- Contact Number -->
                                <div class="form-group relative">
                                    <input type="tel"
                                           id="contact"
                                           name="contact"
                                           placeholder=" "
                                           class="form-input w-full py-3 px-4 border border-gray-300 rounded-lg focus:outline-none transition-colors"
                                           pattern="[0-9]{10,}"
                                           required value="{{old('contact')}}">
                                    <label for="contact" class="floating-label py-3 px-4">
                                        <i class="fas fa-phone-alt mr-2"></i>Contact Number *
                                    </label>
                                    <div class="text-xs text-gray-500 mt-1 ml-1">Primary business contact number</div>
                                </div>

                                <!-- Email Address -->
                                <div class="form-group relative">
                                    <input type="email"
                                           id="email"
                                           name="email"
                                           placeholder=" "
                                           class="form-input w-full py-3 px-4 border border-gray-300 rounded-lg focus:outline-none transition-colors"
                                           required value="{{old('email')}}">
                                    <label for="email" class="floating-label py-3 px-4">
                                        <i class="fas fa-envelope mr-2"></i>Email Address *
                                    </label>
                                    <div class="text-xs text-gray-500 mt-1 ml-1">E-mail for your business account</div>
                                </div>

                                <!-- Address Field (Added) -->
                                <div class="textarea-group relative">
                                    <textarea
                                        id="address"
                                        name="address"
                                        placeholder=" "
                                        class="form-input address-input w-full py-3 px-4 border border-gray-300 rounded-lg focus:outline-none transition-colors"
                                        rows="4"
                                        required value="{{old('address')}}"></textarea>
                                    <label for="address" class="floating-label py-3 px-4">
                                        <i class="fas fa-map-marker-alt mr-2"></i>Business Address *
                                    </label>
                                    <div class="text-xs text-gray-500 mt-1 ml-1">Include street address, city, state/province, and postal code</div>
                                </div>

                                {{-- <!-- Business Type -->
                                <div class="form-group">
                                    <label class="block text-gray-700 mb-2">
                                        <i class="fas fa-tag mr-2"></i>Business Type *
                                    </label>
                                    <div class="grid grid-cols-2 gap-3">
                                        <label class="flex items-center p-3 border border-gray-300 rounded-lg hover:bg-amber-50 cursor-pointer">
                                            <input type="radio" name="business_type" value="wholesale" class="mr-3 text-amber-600" required>
                                            <div>
                                                <div class="font-medium">Wholesale Store</div>
                                                <div class="text-xs text-gray-500">Productsts & Goods</div>
                                            </div>
                                        </label>
                                        <label class="flex items-center p-3 border border-gray-300 rounded-lg hover:bg-amber-50 cursor-pointer">
                                            <input type="radio" name="business_type" value="retail" class="mr-3 text-amber-600" required>
                                            <div>
                                                <div class="font-medium">Retail Store</div>
                                                <div class="text-xs text-gray-500">Products & Goods</div>
                                            </div>
                                        </label>
                                    </div>
                                </div> --}}

                                <!-- Terms and Submit -->
                                <div class="pt-4">
                                    <div class="flex items-start mb-6">
                                        <input type="checkbox" id="terms" name="terms" class="mt-1 mr-3 text-amber-600" value="1" required>
                                        <label for="terms" class="text-sm text-gray-700">
                                            I agree to the <a href="#" class="text-amber-600 hover:text-amber-700 font-medium">Terms & Conditions</a> and <a href="#" class="text-amber-600 hover:text-amber-700 font-medium">Privacy Policy</a>. I confirm that the information provided is accurate.
                                        </label>
                                    </div>

                                    <div class="flex flex-col sm:flex-row gap-4">
                                        <button type="submit" class="flex-1 bg-linear-to-r from-amber-500 to-orange-500 hover:from-amber-600 hover:to-orange-600 text-white font-bold py-3.5 px-6 rounded-lg transition-all duration-300 shadow-md hover:shadow-lg flex items-center justify-center">
                                            <i class="fas fa-paper-plane mr-3"></i> Submit Partnership Request
                                        </button>
                                        {{-- <button type="button" id="clearForm" class="px-6 py-3.5 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors">
                                            Clear Form
                                        </button> --}}
                                    </div>

                                    <p class="text-xs text-gray-500 mt-4 text-center">
                                        <i class="fas fa-shield-alt mr-1"></i> Your information is secure and will not be shared with third parties.
                                    </p>
                                </div>
                            </form>
                        </div>

                        <!-- Image/Info Section -->
                        <div class="lg:w-1/2 bg-linear-to-br from-amber-50 to-orange-50 p-8 lg:p-12 flex flex-col justify-center">
                            <div class="max-w-md mx-auto">
                                <!-- Illustration/Image -->
                                <div class="mb-8 text-center">
                                    <div class="relative inline-block floating-img">
                                        <div class="w-64 h-64 bg-linear-to-r from-amber-400 to-orange-400 rounded-full flex items-center justify-center shadow-2xl">
                                            <i class="fas fa-store-alt text-white text-7xl"></i>
                                        </div>
                                        <div class="absolute -top-2 -right-2 w-16 h-16 bg-blue-500 rounded-full flex items-center justify-center shadow-lg">
                                            <i class="fas fa-chart-line text-white text-2xl"></i>
                                        </div>
                                        <div class="absolute -bottom-4 -left-4 w-20 h-20 bg-green-500 rounded-full flex items-center justify-center shadow-lg">
                                            <i class="fas fa-users text-white text-3xl"></i>
                                        </div>
                                    </div>
                                </div>

                                <!-- Benefits -->
                                <div class="space-y-6">
                                    <h3 class="text-2xl font-bold text-gray-900 mb-6">Why Partner With Us?</h3>

                                    <div class="flex items-start">
                                        <div class="bg-amber-100 text-amber-800 rounded-lg p-3 mr-4">
                                            <i class="fas fa-rocket text-xl"></i>
                                        </div>
                                        <div>
                                            <h4 class="font-bold text-gray-900 mb-1">Grow Your Business</h4>
                                            <p class="text-gray-700 text-sm">Access thousands of new customers and increase your sales by up to 40%</p>
                                        </div>
                                    </div>

                                    <div class="flex items-start">
                                        <div class="bg-blue-100 text-blue-800 rounded-lg p-3 mr-4">
                                            <i class="fas fa-tools text-xl"></i>
                                        </div>
                                        <div>
                                            <h4 class="font-bold text-gray-900 mb-1">Powerful Tools</h4>
                                            <p class="text-gray-700 text-sm">Get access to inventory management, analytics dashboard, and marketing tools</p>
                                        </div>
                                    </div>

                                    <div class="flex items-start">
                                        <div class="bg-green-100 text-green-800 rounded-lg p-3 mr-4">
                                            <i class="fas fa-headset text-xl"></i>
                                        </div>
                                        <div>
                                            <h4 class="font-bold text-gray-900 mb-1">Dedicated Support</h4>
                                            <p class="text-gray-700 text-sm">24/7 partner support and dedicated account manager for your business</p>
                                        </div>
                                    </div>

                                    <div class="flex items-start">
                                        <div class="bg-purple-100 text-purple-800 rounded-lg p-3 mr-4">
                                            <i class="fas fa-shield-alt text-xl"></i>
                                        </div>
                                        <div>
                                            <h4 class="font-bold text-gray-900 mb-1">Secure Payments</h4>
                                            <p class="text-gray-700 text-sm">Fast, secure payment processing with transparent fee structure</p>
                                        </div>
                                    </div>
                                </div>

                                <!-- Stats -->
                                <div class="mt-10 pt-8 border-t border-amber-200">
                                    <div class="grid grid-cols-3 gap-4 text-center">
                                        <div>
                                            <div class="text-2xl font-bold text-gray-900">5,000+</div>
                                            <div class="text-sm text-gray-700">Active Partners</div>
                                        </div>
                                        <div>
                                            <div class="text-2xl font-bold text-gray-900">2M+</div>
                                            <div class="text-sm text-gray-700">Monthly Customers</div>
                                        </div>
                                        <div>
                                            <div class="text-2xl font-bold text-gray-900">24h</div>
                                            <div class="text-sm text-gray-700">Avg. Response Time</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

</x-frontend-layout>
