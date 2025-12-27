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
<section class="py-12 px-4 md:px-8 bg-gray-50">
    <div class="container mx-auto">
        <!-- Section Header -->
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8 md:mb-12">
            <div class="mb-4 md:mb-0">
                <h2 class="text-2xl md:text-3xl lg:text-4xl font-bold text-gray-900 relative pb-3 mb-2">
                    Featured Products
                    <span class="absolute bottom-0 left-0 w-16 h-1 bg-linear-to-r from-amber-500 to-orange-500 rounded-full"></span>
                </h2>
                <p class="text-gray-600 mt-2">Discover our best-selling items with exclusive discounts</p>
            </div>
            <a href="#" class="inline-flex items-center text-amber-600 hover:text-amber-700 font-semibold transition-all duration-300 group">
                View All Products
                <i class="fas fa-arrow-right ml-2 group-hover:ml-3 transition-all duration-300"></i>
            </a>
        </div>

        <!-- Filter Tabs -->
        <div class="flex flex-wrap gap-2 md:gap-3 mb-8 md:mb-12">
            <button class="filter-tab-active px-4 md:px-6 py-2 bg-linear-to-r from-amber-500 to-orange-500 text-white rounded-full text-sm md:text-base font-medium border border-amber-500 transition-all duration-300 hover:shadow-lg" data-filter="all">
                All Products
            </button>
            <button class="filter-tab px-4 md:px-6 py-2 bg-gray-100 text-gray-600 rounded-full text-sm md:text-base font-medium border border-gray-200 transition-all duration-300 hover:bg-linear-to-r hover:from-amber-500 hover:to-orange-500 hover:text-white hover:border-amber-500" data-filter="electronics">
                Electronics
            </button>
            <button class="filter-tab px-4 md:px-6 py-2 bg-gray-100 text-gray-600 rounded-full text-sm md:text-base font-medium border border-gray-200 transition-all duration-300 hover:bg-linear-to-r hover:from-amber-500 hover:to-orange-500 hover:text-white hover:border-amber-500" data-filter="fashion">
                Fashion
            </button>
            <button class="filter-tab px-4 md:px-6 py-2 bg-gray-100 text-gray-600 rounded-full text-sm md:text-base font-medium border border-gray-200 transition-all duration-300 hover:bg-linear-to-r hover:from-amber-500 hover:to-orange-500 hover:text-white hover:border-amber-500" data-filter="home">
                Home & Kitchen
            </button>
            <button class="filter-tab px-4 md:px-6 py-2 bg-gray-100 text-gray-600 rounded-full text-sm md:text-base font-medium border border-gray-200 transition-all duration-300 hover:bg-linear-to-r hover:from-amber-500 hover:to-orange-500 hover:text-white hover:border-amber-500" data-filter="sports">
                Sports
            </button>
        </div>

        <!-- Products Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 md:gap-8">
            <!-- Product 1 -->
            @foreach ($products as $product)
                <x-product-card :product="$product" />
            @endforeach

            {{-- <!-- Product 2 -->
            <div class="product-card bg-white rounded-xl shadow-md hover:shadow-xl border border-gray-200 hover:border-amber-300 transition-all duration-300 overflow-hidden group" data-category="fashion">
                <div class="relative overflow-hidden h-48 md:h-56">
                    <img src="https://images.unsplash.com/photo-1523381210434-271e8be1f52b?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1000&q=80"
                         alt="Men's Casual Shirt"
                         class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                    <div class="absolute top-3 left-3 bg-blue-500 text-white text-xs font-bold px-3 py-1 rounded-full">
                        New
                    </div>
                    <div class="absolute top-3 right-3 w-8 h-8 md:w-10 md:h-10 bg-white rounded-full flex items-center justify-center shadow-md cursor-pointer hover:bg-red-50 hover:text-red-500 transition-colors duration-300">
                        <i class="far fa-heart text-gray-600 hover:text-red-500"></i>
                    </div>
                </div>
                <div class="p-4 md:p-5">
                    <div class="text-xs text-gray-500 uppercase tracking-wider mb-2">Fashion</div>
                    <h3 class="text-sm md:text-base font-semibold text-gray-900 mb-3 line-clamp-2 h-10 md:h-12">
                        Men's Casual Cotton Shirt - Premium Quality Fit
                    </h3>

                    <div class="flex items-center flex-wrap gap-2 mb-3">
                        <span class="text-lg md:text-xl font-bold text-gray-900">$34.99</span>
                    </div>

                    <div class="flex items-center gap-1 mb-4">
                        <div class="flex text-amber-500">
                            <i class="fas fa-star text-xs md:text-sm"></i>
                            <i class="fas fa-star text-xs md:text-sm"></i>
                            <i class="fas fa-star text-xs md:text-sm"></i>
                            <i class="fas fa-star text-xs md:text-sm"></i>
                            <i class="far fa-star text-xs md:text-sm"></i>
                        </div>
                        <span class="text-xs text-gray-500 ml-1">(56)</span>
                    </div>

                    <div class="flex gap-2">
                        <button class="add-to-cart-btn flex-1 bg-linear-to-r from-amber-500 to-orange-500 hover:from-amber-600 hover:to-orange-600 text-white font-semibold py-2.5 px-4 rounded-lg transition-all duration-300 flex items-center justify-center gap-2 group/btn">
                            <i class="fas fa-shopping-cart"></i>
                            <span class="text-sm">Add to Cart</span>
                        </button>
                        <button class="quick-view-btn w-10 h-10 border border-gray-300 rounded-lg flex items-center justify-center hover:bg-gray-50 transition-colors duration-300">
                            <i class="fas fa-eye text-gray-600"></i>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Product 3 -->
            <div class="product-card bg-white rounded-xl shadow-md hover:shadow-xl border border-gray-200 hover:border-amber-300 transition-all duration-300 overflow-hidden group" data-category="home">
                <div class="relative overflow-hidden h-48 md:h-56">
                    <img src="https://images.unsplash.com/photo-1556228453-efd6c1ff04f6?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1000&q=80"
                         alt="Smart Watch"
                         class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                    <div class="absolute top-3 left-3 bg-red-600 text-white text-xs font-bold px-3 py-1 rounded-full">
                        Hot
                    </div>
                    <div class="absolute top-3 right-3 w-8 h-8 md:w-10 md:h-10 bg-white rounded-full flex items-center justify-center shadow-md cursor-pointer hover:bg-red-50 hover:text-red-500 transition-colors duration-300">
                        <i class="fas fa-heart text-red-500"></i>
                    </div>
                </div>
                <div class="p-4 md:p-5">
                    <div class="text-xs text-gray-500 uppercase tracking-wider mb-2">Electronics</div>
                    <h3 class="text-sm md:text-base font-semibold text-gray-900 mb-3 line-clamp-2 h-10 md:h-12">
                        Smart Watch with Heart Rate Monitor & Sleep Tracking
                    </h3>

                    <div class="flex items-center flex-wrap gap-2 mb-3">
                        <span class="text-lg md:text-xl font-bold text-gray-900">$199.99</span>
                        <span class="text-sm md:text-base text-gray-400 line-through">$249.99</span>
                        <span class="text-xs bg-green-100 text-green-800 px-2 py-1 rounded font-semibold">-20%</span>
                    </div>

                    <div class="flex items-center gap-1 mb-4">
                        <div class="flex text-amber-500">
                            <i class="fas fa-star text-xs md:text-sm"></i>
                            <i class="fas fa-star text-xs md:text-sm"></i>
                            <i class="fas fa-star text-xs md:text-sm"></i>
                            <i class="fas fa-star text-xs md:text-sm"></i>
                            <i class="fas fa-star text-xs md:text-sm"></i>
                        </div>
                        <span class="text-xs text-gray-500 ml-1">(342)</span>
                    </div>

                    <div class="flex gap-2">
                        <button class="add-to-cart-btn flex-1 bg-linear-to-r from-amber-500 to-orange-500 hover:from-amber-600 hover:to-orange-600 text-white font-semibold py-2.5 px-4 rounded-lg transition-all duration-300 flex items-center justify-center gap-2 group/btn">
                            <i class="fas fa-shopping-cart"></i>
                            <span class="text-sm">Add to Cart</span>
                        </button>
                        <button class="quick-view-btn w-10 h-10 border border-gray-300 rounded-lg flex items-center justify-center hover:bg-gray-50 transition-colors duration-300">
                            <i class="fas fa-eye text-gray-600"></i>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Product 4 -->
            <div class="product-card bg-white rounded-xl shadow-md hover:shadow-xl border border-gray-200 hover:border-amber-300 transition-all duration-300 overflow-hidden group" data-category="electronics">
                <div class="relative overflow-hidden h-48 md:h-56">
                    <img src="https://images.unsplash.com/photo-1606788075767-10c6c2e5f1d3?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1000&q=80"
                         alt="Coffee Maker"
                         class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                    <div class="absolute top-3 right-3 w-8 h-8 md:w-10 md:h-10 bg-white rounded-full flex items-center justify-center shadow-md cursor-pointer hover:bg-red-50 hover:text-red-500 transition-colors duration-300">
                        <i class="far fa-heart text-gray-600 hover:text-red-500"></i>
                    </div>
                    <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 bg-gray-900/80 text-white px-4 py-2 rounded-full text-sm font-semibold">
                        Out of Stock
                    </div>
                </div>
                <div class="p-4 md:p-5">
                    <div class="text-xs text-gray-500 uppercase tracking-wider mb-2">Home & Kitchen</div>
                    <h3 class="text-sm md:text-base font-semibold text-gray-900 mb-3 line-clamp-2 h-10 md:h-12">
                        Programmable Coffee Maker with Thermal Carafe
                    </h3>

                    <div class="flex items-center flex-wrap gap-2 mb-3">
                        <span class="text-lg md:text-xl font-bold text-gray-900">$79.99</span>
                    </div>

                    <div class="flex items-center gap-1 mb-4">
                        <div class="flex text-amber-500">
                            <i class="fas fa-star text-xs md:text-sm"></i>
                            <i class="fas fa-star text-xs md:text-sm"></i>
                            <i class="fas fa-star text-xs md:text-sm"></i>
                            <i class="fas fa-star text-xs md:text-sm"></i>
                            <i class="far fa-star text-xs md:text-sm"></i>
                        </div>
                        <span class="text-xs text-gray-500 ml-1">(89)</span>
                    </div>

                    <div class="flex gap-2">
                        <button class="flex-1 bg-gray-200 text-gray-500 font-semibold py-2.5 px-4 rounded-lg cursor-not-allowed flex items-center justify-center gap-2" disabled>
                            <i class="fas fa-shopping-cart"></i>
                            <span class="text-sm">Out of Stock</span>
                        </button>
                        <button class="quick-view-btn w-10 h-10 border border-gray-300 rounded-lg flex items-center justify-center hover:bg-gray-50 transition-colors duration-300">
                            <i class="fas fa-eye text-gray-600"></i>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Product 5 -->
            <div class="product-card bg-white rounded-xl shadow-md hover:shadow-xl border border-gray-200 hover:border-amber-300 transition-all duration-300 overflow-hidden group" data-category="sports">
                <div class="relative overflow-hidden h-48 md:h-56">
                    <img src="https://images.unsplash.com/photo-1571019613454-1cb2f99b2d8b?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1000&q=80"
                         alt="Yoga Mat"
                         class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                    <div class="absolute top-3 left-3 bg-red-500 text-white text-xs font-bold px-3 py-1 rounded-full">
                        Sale -15%
                    </div>
                    <div class="absolute top-3 right-3 w-8 h-8 md:w-10 md:h-10 bg-white rounded-full flex items-center justify-center shadow-md cursor-pointer hover:bg-red-50 hover:text-red-500 transition-colors duration-300">
                        <i class="far fa-heart text-gray-600 hover:text-red-500"></i>
                    </div>
                </div>
                <div class="p-4 md:p-5">
                    <div class="text-xs text-gray-500 uppercase tracking-wider mb-2">Sports</div>
                    <h3 class="text-sm md:text-base font-semibold text-gray-900 mb-3 line-clamp-2 h-10 md:h-12">
                        Premium Non-Slip Yoga Mat with Carrying Strap
                    </h3>

                    <div class="flex items-center flex-wrap gap-2 mb-3">
                        <span class="text-lg md:text-xl font-bold text-gray-900">$42.49</span>
                        <span class="text-sm md:text-base text-gray-400 line-through">$49.99</span>
                        <span class="text-xs bg-green-100 text-green-800 px-2 py-1 rounded font-semibold">-15%</span>
                    </div>

                    <div class="flex items-center gap-1 mb-4">
                        <div class="flex text-amber-500">
                            <i class="fas fa-star text-xs md:text-sm"></i>
                            <i class="fas fa-star text-xs md:text-sm"></i>
                            <i class="fas fa-star text-xs md:text-sm"></i>
                            <i class="fas fa-star text-xs md:text-sm"></i>
                            <i class="fas fa-star-half-alt text-xs md:text-sm"></i>
                        </div>
                        <span class="text-xs text-gray-500 ml-1">(67)</span>
                    </div>

                    <div class="flex gap-2">
                        <button class="add-to-cart-btn flex-1 bg-linear-to-r from-amber-500 to-orange-500 hover:from-amber-600 hover:to-orange-600 text-white font-semibold py-2.5 px-4 rounded-lg transition-all duration-300 flex items-center justify-center gap-2 group/btn">
                            <i class="fas fa-shopping-cart"></i>
                            <span class="text-sm">Add to Cart</span>
                        </button>
                        <button class="quick-view-btn w-10 h-10 border border-gray-300 rounded-lg flex items-center justify-center hover:bg-gray-50 transition-colors duration-300">
                            <i class="fas fa-eye text-gray-600"></i>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Product 6 -->
            <div class="product-card bg-white rounded-xl shadow-md hover:shadow-xl border border-gray-200 hover:border-amber-300 transition-all duration-300 overflow-hidden group" data-category="fashion">
                <div class="relative overflow-hidden h-48 md:h-56">
                    <img src="https://images.unsplash.com/photo-1542291026-7eec264c27ff?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1000&q=80"
                         alt="Running Shoes"
                         class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                    <div class="absolute top-3 left-3 bg-purple-600 text-white text-xs font-bold px-3 py-1 rounded-full">
                        Best Seller
                    </div>
                    <div class="absolute top-3 right-3 w-8 h-8 md:w-10 md:h-10 bg-white rounded-full flex items-center justify-center shadow-md cursor-pointer hover:bg-red-50 hover:text-red-500 transition-colors duration-300">
                        <i class="far fa-heart text-gray-600 hover:text-red-500"></i>
                    </div>
                </div>
                <div class="p-4 md:p-5">
                    <div class="text-xs text-gray-500 uppercase tracking-wider mb-2">Sports</div>
                    <h3 class="text-sm md:text-base font-semibold text-gray-900 mb-3 line-clamp-2 h-10 md:h-12">
                        Professional Running Shoes with Cushion Technology
                    </h3>

                    <div class="flex items-center flex-wrap gap-2 mb-3">
                        <span class="text-lg md:text-xl font-bold text-gray-900">$124.99</span>
                    </div>

                    <div class="flex items-center gap-1 mb-4">
                        <div class="flex text-amber-500">
                            <i class="fas fa-star text-xs md:text-sm"></i>
                            <i class="fas fa-star text-xs md:text-sm"></i>
                            <i class="fas fa-star text-xs md:text-sm"></i>
                            <i class="fas fa-star text-xs md:text-sm"></i>
                            <i class="fas fa-star text-xs md:text-sm"></i>
                        </div>
                        <span class="text-xs text-gray-500 ml-1">(231)</span>
                    </div>

                    <div class="flex gap-2">
                        <button class="add-to-cart-btn flex-1 bg-linear-to-r from-amber-500 to-orange-500 hover:from-amber-600 hover:to-orange-600 text-white font-semibold py-2.5 px-4 rounded-lg transition-all duration-300 flex items-center justify-center gap-2 group/btn">
                            <i class="fas fa-shopping-cart"></i>
                            <span class="text-sm">Add to Cart</span>
                        </button>
                        <button class="quick-view-btn w-10 h-10 border border-gray-300 rounded-lg flex items-center justify-center hover:bg-gray-50 transition-colors duration-300">
                            <i class="fas fa-eye text-gray-600"></i>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Product 7 -->
            <div class="product-card bg-white rounded-xl shadow-md hover:shadow-xl border border-gray-200 hover:border-amber-300 transition-all duration-300 overflow-hidden group" data-category="home">
                <div class="relative overflow-hidden h-48 md:h-56">
                    <img src="https://images.unsplash.com/photo-1558618047-3c8c76ca7d13?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1000&q=80"
                         alt="Cookware Set"
                         class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                    <div class="absolute top-3 left-3 bg-red-500 text-white text-xs font-bold px-3 py-1 rounded-full">
                        Sale -25%
                    </div>
                    <div class="absolute top-3 right-3 w-8 h-8 md:w-10 md:h-10 bg-white rounded-full flex items-center justify-center shadow-md cursor-pointer hover:bg-red-50 hover:text-red-500 transition-colors duration-300">
                        <i class="fas fa-heart text-red-500"></i>
                    </div>
                </div>
                <div class="p-4 md:p-5">
                    <div class="text-xs text-gray-500 uppercase tracking-wider mb-2">Home & Kitchen</div>
                    <h3 class="text-sm md:text-base font-semibold text-gray-900 mb-3 line-clamp-2 h-10 md:h-12">
                        Non-Stick Cookware Set 10-Piece with Glass Lids
                    </h3>

                    <div class="flex items-center flex-wrap gap-2 mb-3">
                        <span class="text-lg md:text-xl font-bold text-gray-900">$149.99</span>
                        <span class="text-sm md:text-base text-gray-400 line-through">$199.99</span>
                        <span class="text-xs bg-green-100 text-green-800 px-2 py-1 rounded font-semibold">-25%</span>
                    </div>

                    <div class="flex items-center gap-1 mb-4">
                        <div class="flex text-amber-500">
                            <i class="fas fa-star text-xs md:text-sm"></i>
                            <i class="fas fa-star text-xs md:text-sm"></i>
                            <i class="fas fa-star text-xs md:text-sm"></i>
                            <i class="fas fa-star text-xs md:text-sm"></i>
                            <i class="far fa-star text-xs md:text-sm"></i>
                        </div>
                        <span class="text-xs text-gray-500 ml-1">(112)</span>
                    </div>

                    <div class="flex gap-2">
                        <button class="add-to-cart-btn flex-1 bg-linear-to-r from-amber-500 to-orange-500 hover:from-amber-600 hover:to-orange-600 text-white font-semibold py-2.5 px-4 rounded-lg transition-all duration-300 flex items-center justify-center gap-2 group/btn">
                            <i class="fas fa-shopping-cart"></i>
                            <span class="text-sm">Add to Cart</span>
                        </button>
                        <button class="quick-view-btn w-10 h-10 border border-gray-300 rounded-lg flex items-center justify-center hover:bg-gray-50 transition-colors duration-300">
                            <i class="fas fa-eye text-gray-600"></i>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Product 8 -->
            <div class="product-card bg-white rounded-xl shadow-md hover:shadow-xl border border-gray-200 hover:border-amber-300 transition-all duration-300 overflow-hidden group" data-category="electronics">
                <div class="relative overflow-hidden h-48 md:h-56">
                    <img src="https://images.unsplash.com/photo-1546868871-7041f2a55e12?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1000&q=80"
                         alt="Smartphone"
                         class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                    <div class="absolute top-3 left-3 bg-blue-500 text-white text-xs font-bold px-3 py-1 rounded-full">
                        New
                    </div>
                    <div class="absolute top-3 right-3 w-8 h-8 md:w-10 md:h-10 bg-white rounded-full flex items-center justify-center shadow-md cursor-pointer hover:bg-red-50 hover:text-red-500 transition-colors duration-300">
                        <i class="far fa-heart text-gray-600 hover:text-red-500"></i>
                    </div>
                </div>
                <div class="p-4 md:p-5">
                    <div class="text-xs text-gray-500 uppercase tracking-wider mb-2">Electronics</div>
                    <h3 class="text-sm md:text-base font-semibold text-gray-900 mb-3 line-clamp-2 h-10 md:h-12">
                        Latest Smartphone with Triple Camera & 128GB Storage
                    </h3>

                    <div class="flex items-center flex-wrap gap-2 mb-3">
                        <span class="text-lg md:text-xl font-bold text-gray-900">$699.99</span>
                    </div>

                    <div class="flex items-center gap-1 mb-4">
                        <div class="flex text-amber-500">
                            <i class="fas fa-star text-xs md:text-sm"></i>
                            <i class="fas fa-star text-xs md:text-sm"></i>
                            <i class="fas fa-star text-xs md:text-sm"></i>
                            <i class="fas fa-star text-xs md:text-sm"></i>
                            <i class="fas fa-star-half-alt text-xs md:text-sm"></i>
                        </div>
                        <span class="text-xs text-gray-500 ml-1">(456)</span>
                    </div>

                    <div class="flex gap-2">
                        <button class="add-to-cart-btn flex-1 bg-linear-to-r from-amber-500 to-orange-500 hover:from-amber-600 hover:to-orange-600 text-white font-semibold py-2.5 px-4 rounded-lg transition-all duration-300 flex items-center justify-center gap-2 group/btn">
                            <i class="fas fa-shopping-cart"></i>
                            <span class="text-sm">Add to Cart</span>
                        </button>
                        <button class="quick-view-btn w-10 h-10 border border-gray-300 rounded-lg flex items-center justify-center hover:bg-gray-50 transition-colors duration-300">
                            <i class="fas fa-eye text-gray-600"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div> --}}

        <!-- View More Button -->
        <div class="text-center mt-12">
            <button class="load-more-btn px-8 py-3 bg-white border-2 border-amber-500 text-amber-600 rounded-lg font-semibold hover:bg-amber-50 transition-colors duration-300">
                Load More Products
            </button>
        </div>
    </div>
</section>

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
