
    @push('css')
    <style>
        /* Custom styles for enhanced UI */
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

        /* Smooth hover effect for social icons */
        .social-icon {
            transition: all 0.3s ease;
        }

        .social-icon:hover {
            transform: translateY(-3px);
        }

        /* Sticky header effect */
        .sticky-header {
            position: sticky;
            top: 0;
            z-index: 100;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        }

        /* Animation for badge */
        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.1); }
            100% { transform: scale(1); }
        }

        .animate-pulse {
            animation: pulse 2s infinite;
        }
    </style>

    @endpush

    <div class="container mx-auto px-2 py-4 rounded-4xl">
        <!-- E-commerce Header -->

            <!-- Top contact info, email, and social icons -->
            <div class="bg-gray-800 text-gray-300 py-2 px-4">
                <div class="container mx-auto flex flex-col md:flex-row justify-between items-center">
                    <!-- Contact and email info -->
                    <div class="flex flex-wrap items-center justify-center md:justify-start space-x-4 md:space-x-6 mb-2 md:mb-0">
                        <div class="flex items-center text-sm">
                            <i class="fas fa-phone-alt mr-2 text-amber-400"></i>
                            <span>+1 (800) 123-4567</span>
                        </div>
                        <div class="hidden md:block text-gray-600">|</div>
                        <div class="flex items-center text-sm">
                            <i class="fas fa-envelope mr-2 text-amber-400"></i>
                            <span>support@shopnow.com</span>
                        </div>
                        <div class="hidden md:block text-gray-600">|</div>
                        <div class="flex items-center text-sm">
                            <i class="fas fa-clock mr-2 text-amber-400"></i>
                            <span>Mon-Fri: 9AM-6PM</span>
                        </div>
                    </div>

                    <!-- Social media icons -->
                    <div class="flex items-center space-x-4">
                        <span class="text-xs hidden md:block">Follow us:</span>
                        <div class="flex space-x-3">
                            <a href="#" class="social-icon text-gray-400 hover:text-blue-500" title="Facebook">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                            <a href="#" class="social-icon text-gray-400 hover:text-pink-500" title="Instagram">
                                <i class="fab fa-instagram"></i>
                            </a>
                            <a href="#" class="social-icon text-gray-400 hover:text-blue-400" title="Twitter">
                                <i class="fab fa-twitter"></i>
                            </a>
                            <a href="#" class="social-icon text-gray-400 hover:text-red-500" title="YouTube">
                                <i class="fab fa-youtube"></i>
                            </a>
                            <a href="#" class="social-icon text-gray-400 hover:text-blue-700" title="LinkedIn">
                                <i class="fab fa-linkedin-in"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Main header with logo, search, and user actions -->
            <div class="py-4 px-4 border-b">
                <div class="container mx-auto">
                    <div class="flex flex-col md:flex-row items-center justify-between">
                        <!-- Logo -->
                        <div class="mb-4 md:mb-0">
                            <a href="{{ route('home') }}" class="flex items-center group">
                                <div class="bg-linear-to-r from-amber-500 to-orange-500 rounded-xl p-3 mr-3 shadow-md group-hover:shadow-lg transition-shadow">
                                    <i class="fas fa-shopping-bag text-2xl text-white"></i>
                                </div>
                                <div>
                                    <h1 class="text-2xl font-bold tracking-tight text-gray-900">SHOP<span class="text-amber-600">NOW</span></h1>
                                    <p class="text-xs text-gray-600 -mt-1">Premium Online Store</p>
                                </div>
                            </a>
                        </div>

                        <!-- Search bar -->
                        <div class="w-full md:w-1/3 mb-4 md:mb-0">
                            <div class="relative">
                                <form action="{{ route('search') }}" method="get">
                                    <input type="text" name="q"
                                       placeholder="Search products, brands, categories..."
                                       class="w-full py-3 px-4 pl-12 rounded-lg border border-gray-300 bg-gray-50 text-gray-800 focus:outline-none focus:border-amber-400 search-input">
                                    <div class="absolute left-4 top-3.5 text-gray-500">
                                        <i class="fas fa-search"></i>
                                    </div>
                                    <button class="absolute right-2 top-2 bg-linear-to-r from-amber-500 to-orange-500 hover:from-amber-600 hover:to-orange-600 text-white py-1.5 px-5 rounded-md transition-all duration-300 shadow hover:shadow-md">
                                        <i class="fas fa-search mr-1"></i> Search
                                    </button>
                                </form>
                            </div>
                            <div class="text-xs text-gray-500 mt-2 pl-2">
                                Try: <a href="#" class="text-amber-600 hover:text-amber-700 font-medium ml-1">iPhone 15</a>,
                                <a href="#" class="text-amber-600 hover:text-amber-700 font-medium ml-2">MacBook Pro</a>,
                                <a href="#" class="text-amber-600 hover:text-amber-700 font-medium ml-2">AirPods</a>
                            </div>
                        </div>

                        <!-- User actions: Login, Cart, Wishlist -->
                        <div class="flex items-center space-x-5">
                            <!-- Login / User Account -->
                            {{-- <div class="dropdown relative">
                                <button class="flex flex-col md:flex-row items-center text-gray-700 hover:text-amber-600 transition-colors focus:outline-none">
                                    <div class="bg-gray-100 text-gray-800 rounded-full p-2 mb-1 md:mb-0 md:mr-2">
                                        <i class="fas fa-user text-lg"></i>
                                    </div>
                                    <div class="text-left hidden md:block">
                                        <div class="text-sm font-medium">Login / Register</div>
                                        <div class="text-xs text-gray-500">My Account</div>
                                    </div>
                                    <i class="fas fa-chevron-down ml-1 text-xs hidden md:block"></i>
                                </button>
                                <div class="dropdown-menu absolute right-0 mt-2 w-64 bg-white text-gray-800 rounded-lg shadow-xl z-50 py-4 border">
                                    <div class="px-4 pb-3 border-b">
                                        <h3 class="font-bold text-gray-900 mb-2">Welcome to ShopNow</h3>
                                        <p class="text-sm text-gray-600">Access your account to track orders, save items, and more.</p>
                                    </div>
                                    <div class="px-4 py-3">
                                        <a href="{{ route('login') }}" class="flex items-center justify-center w-full py-2.5 bg-amber-500 hover:bg-amber-600 text-white rounded-lg mb-3 transition-colors">
                                            <i class="fas fa-sign-in-alt mr-2"></i>
                                            <span>Login to Account</span>
                                        </a>
                                        <a href="{{ route('register') }}" class="flex items-center justify-center w-full py-2.5 border border-gray-300 hover:bg-gray-50 text-gray-700 rounded-lg transition-colors">
                                            <i class="fas fa-user-plus mr-2"></i>
                                            <span>Create New Account</span>
                                        </a>
                                    </div>
                                    <div class="border-t pt-3 px-4">
                                        <a href="#" class="flex items-center py-2 hover:text-amber-600">
                                            <i class="fas fa-box mr-3 text-gray-500"></i>
                                            <span>My Orders</span>
                                        </a>
                                        <a href="#" class="flex items-center py-2 hover:text-amber-600">
                                            <i class="fas fa-heart mr-3 text-gray-500"></i>
                                            <span>My Wishlist</span>
                                        </a>
                                        <a href="#" class="flex items-center py-2 hover:text-amber-600">
                                            <i class="fas fa-cog mr-3 text-gray-500"></i>
                                            <span>Account Settings</span>
                                        </a>
                                    </div>
                                </div>
                            </div> --}}
                            <div class="dropdown relative">
                            <button class="flex flex-col md:flex-row items-center text-gray-700 hover:text-amber-600 transition-colors focus:outline-none">
                                <div class="bg-gray-100 text-gray-800 rounded-full p-2 mb-1 md:mb-0 md:mr-2">
                                    <i class="fas fa-user text-lg"></i>
                                </div>

                                <div class="text-left hidden md:block">
                                    @guest
                                        <div class="text-sm font-medium">Login / Register</div>
                                        <div class="text-xs text-gray-500">My Account</div>
                                    @endguest

                                    @auth
                                        <div class="text-sm font-medium">{{ Auth::user()->name }}</div>
                                        <div class="text-xs text-gray-500">My Account</div>
                                    @endauth
                                </div>

                                <i class="fas fa-chevron-down ml-1 text-xs hidden md:block"></i>
                            </button>

                            <div class="dropdown-menu absolute right-0 mt-2 w-64 bg-white text-gray-800 rounded-lg shadow-xl z-50 py-4 border">

                                {{-- Guest (Not Logged In) --}}
                                @guest
                                    <div class="px-4 pb-3 border-b">
                                        <h3 class="font-bold text-gray-900 mb-2">Welcome to ShopNow</h3>
                                        <p class="text-sm text-gray-600">
                                            Access your account to track orders, save items, and more.
                                        </p>
                                    </div>

                                    <div class="px-4 py-3">
                                        <a href="{{ route('login') }}"
                                        class="flex items-center justify-center w-full py-2.5 bg-amber-500 hover:bg-amber-600 text-white rounded-lg mb-3">
                                            <i class="fas fa-sign-in-alt mr-2"></i>
                                            Login to Account
                                        </a>

                                        <a href="{{ route('register') }}"
                                        class="flex items-center justify-center w-full py-2.5 border border-gray-300 hover:bg-gray-50 rounded-lg">
                                            <i class="fas fa-user-plus mr-2"></i>
                                            Create New Account
                                        </a>
                                    </div>
                                @endguest

                                {{-- Authenticated User --}}
                                @auth
                                    <div class="px-4 pb-3 border-b">
                                        <h3 class="font-bold text-gray-900 mb-1">
                                            Hello, {{ Auth::user()->name }} 👋
                                        </h3>
                                        <p class="text-sm text-gray-600">
                                            Manage your account & orders
                                        </p>
                                    </div>

                                    <div class="px-4 py-3">
                                        <a href="" class="flex items-center py-2 hover:text-amber-600">
                                            <i class="fas fa-box mr-3 text-gray-500"></i>
                                            My Orders
                                        </a>

                                        <a href="" class="flex items-center py-2 hover:text-amber-600">
                                            <i class="fas fa-heart mr-3 text-gray-500"></i>
                                            My Wishlist
                                        </a>

                                        <a href="{{ route('profile.edit') }}" class="flex items-center py-2 hover:text-amber-600">
                                            <i class="fas fa-cog mr-3 text-gray-500"></i>
                                            Account Settings
                                        </a>
                                    </div>

                                    <div class="border-t px-4 pt-3">
                                        <form method="POST" action="{{ route('logout') }}">
                                            @csrf
                                            <button type="submit"
                                                    class="flex items-center w-full py-2 text-red-600 hover:text-red-700">
                                                <i class="fas fa-sign-out-alt mr-3"></i>
                                                Logout
                                            </button>
                                        </form>
                                    </div>
                                @endauth
                            </div>
                        </div>


                            <!-- Wishlist -->
                            <a href="#" class="flex flex-col md:flex-row items-center text-gray-700 hover:text-amber-600 transition-colors relative group">
                                <div class="relative">
                                    <div class="bg-gray-100 text-gray-800 rounded-full p-2 mb-1 md:mb-0 md:mr-2">
                                        <i class="fas fa-heart text-lg"></i>
                                    </div>
                                    <span class="absolute -top-1 -right-1 bg-pink-500 text-white text-xs w-5 h-5 rounded-full flex items-center justify-center">5</span>
                                </div>
                                <div class="text-left hidden md:block">
                                    <div class="text-sm font-medium">Wishlist</div>
                                    <div class="text-xs text-gray-500">Saved Items</div>
                                </div>
                            </a>

                            <!-- Cart -->
                            <a href="{{ route('cart') }}" class="flex flex-col md:flex-row items-center text-gray-700 hover:text-amber-600 transition-colors relative group">
                                <div class="relative">
                                    <div class="bg-gray-100 text-gray-800 rounded-full p-2 mb-1 md:mb-0 md:mr-2">
                                        <i class="fas fa-shopping-cart text-lg"></i>
                                    </div>
                                    <div class="cart-count animate-pulse"></div>
                                </div>
                                <div class="text-left hidden md:block">
                                    <div class="text-sm font-medium">My Cart</div>
                                    <div class="text-xs text-gray-500"></div>
                                </div>
                            </a>

                            <!-- Mobile menu toggle -->
                            <button id="mobileMenuToggle" class="md:hidden text-2xl text-gray-700">
                                <i class="fas fa-bars"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Navigation menu -->
            {{-- <div class="bg-white hidden md:block">
                <div class="container mx-auto px-4">
                    <nav class="flex items-center justify-between py-3">
                        <div class="flex space-x-1">
                            <a href="#" class="nav-item group">
                                <i class="fas fa-bars mr-2 text-gray-600 group-hover:text-amber-500"></i>
                                <span>All Categories</span>
                                <i class="fas fa-chevron-down ml-2 text-xs"></i>
                            </a>
                            <a href="#" class="nav-item">
                                <i class="fas fa-home mr-2"></i>
                                <span>Home</span>
                            </a>
                            <a href="#" class="nav-item">
                                <i class="fas fa-fire-alt mr-2"></i>
                                <span>Today's Deals</span>
                                <span class="ml-2 bg-red-500 text-white text-xs px-2 py-0.5 rounded-full">HOT</span>
                            </a>
                            <a href="#" class="nav-item">
                                <i class="fas fa-mobile-alt mr-2"></i>
                                <span>Electronics</span>
                            </a>
                            <a href="#" class="nav-item">
                                <i class="fas fa-tshirt mr-2"></i>
                                <span>Fashion</span>
                            </a>
                            <a href="#" class="nav-item">
                                <i class="fas fa-home mr-2"></i>
                                <span>Home & Garden</span>
                            </a>
                            <a href="#" class="nav-item">
                                <i class="fas fa-dumbbell mr-2"></i>
                                <span>Sports</span>
                            </a>
                        </div>
                        <div class="flex items-center">
                            <a href="#" class="text-amber-600 hover:text-amber-700 font-medium flex items-center text-sm">
                                <i class="fas fa-percent mr-2"></i>
                                <span>Special Offers</span>
                            </a>
                        </div>
                    </nav>
                </div>
            </div> --}}

            <!-- Mobile navigation menu -->
            {{-- <div id="mobileMenu" class="mobile-menu md:hidden bg-gray-50">
                <div class="px-4 py-3 border-t">
                    <div class="mb-4">
                        <h3 class="font-bold text-gray-900 mb-2 px-2">Categories</h3>
                        <div class="flex flex-wrap gap-2">
                            <a href="#" class="inline-flex items-center px-3 py-1.5 bg-amber-100 text-amber-800 rounded-full text-sm">
                                <i class="fas fa-mobile-alt mr-1.5"></i> Electronics
                            </a>
                            <a href="#" class="inline-flex items-center px-3 py-1.5 bg-blue-100 text-blue-800 rounded-full text-sm">
                                <i class="fas fa-tshirt mr-1.5"></i> Fashion
                            </a>
                            <a href="#" class="inline-flex items-center px-3 py-1.5 bg-green-100 text-green-800 rounded-full text-sm">
                                <i class="fas fa-home mr-1.5"></i> Home
                            </a>
                        </div>
                    </div>

                    <div class="space-y-2">
                        <a href="#" class="flex items-center py-2.5 px-3 rounded-lg hover:bg-gray-200 bg-white shadow-sm">
                            <i class="fas fa-home mr-3 text-amber-500 w-5"></i>
                            <span>Home</span>
                        </a>
                        <a href="#" class="flex items-center py-2.5 px-3 rounded-lg hover:bg-gray-200 bg-white shadow-sm">
                            <i class="fas fa-fire-alt mr-3 text-red-500 w-5"></i>
                            <span>Today's Deals</span>
                            <span class="ml-auto bg-red-500 text-white text-xs px-2 py-0.5 rounded-full">HOT</span>
                        </a>
                        <a href="#" class="flex items-center py-2.5 px-3 rounded-lg hover:bg-gray-200 bg-white shadow-sm">
                            <i class="fas fa-percent mr-3 text-green-500 w-5"></i>
                            <span>Special Offers</span>
                        </a>
                        <a href="#" class="flex items-center py-2.5 px-3 rounded-lg hover:bg-gray-200 bg-white shadow-sm">
                            <i class="fas fa-question-circle mr-3 text-blue-500 w-5"></i>
                            <span>Help Center</span>
                        </a>
                    </div>

                    <div class="mt-6 pt-4 border-t">
                        <h3 class="font-bold text-gray-900 mb-3 px-2">Contact Us</h3>
                        <div class="space-y-2">
                            <div class="flex items-center px-2">
                                <i class="fas fa-phone text-amber-500 mr-3 w-5"></i>
                                <span class="text-sm">+1 (800) 123-4567</span>
                            </div>
                            <div class="flex items-center px-2">
                                <i class="fas fa-envelope text-amber-500 mr-3 w-5"></i>
                                <span class="text-sm">support@shopnow.com</span>
                            </div>
                            <div class="flex items-center px-2 mt-3">
                                <span class="text-sm text-gray-600 mr-3">Follow us:</span>
                                <div class="flex space-x-3">
                                    <a href="#" class="text-blue-600"><i class="fab fa-facebook-f"></i></a>
                                    <a href="#" class="text-pink-600"><i class="fab fa-instagram"></i></a>
                                    <a href="#" class="text-blue-400"><i class="fab fa-twitter"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
     --}}

        <!-- Feature showcase -->
        {{-- <div class="bg-white rounded-xl shadow p-6 mb-8">
            <h2 class="text-2xl font-bold mb-6 text-gray-800 border-b pb-3">Header Features Included</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <div class="border border-gray-200 rounded-lg p-5 hover:shadow-md transition-shadow">
                    <div class="flex items-center mb-4">
                        <div class="bg-amber-100 text-amber-800 p-3 rounded-lg mr-3">
                            <i class="fas fa-phone-alt text-xl"></i>
                        </div>
                        <h3 class="font-bold text-lg">Contact Info</h3>
                    </div>
                    <p class="text-gray-600">Phone number, email address, and business hours displayed prominently.</p>
                </div>

                <div class="border border-gray-200 rounded-lg p-5 hover:shadow-md transition-shadow">
                    <div class="flex items-center mb-4">
                        <div class="bg-blue-100 text-blue-800 p-3 rounded-lg mr-3">
                            <i class="fab fa-font-awesome text-xl"></i>
                        </div>
                        <h3 class="font-bold text-lg">Social Icons</h3>
                    </div>
                    <p class="text-gray-600">Font Awesome social media icons for Facebook, Instagram, Twitter, YouTube, and LinkedIn.</p>
                </div>

                <div class="border border-gray-200 rounded-lg p-5 hover:shadow-md transition-shadow">
                    <div class="flex items-center mb-4">
                        <div class="bg-green-100 text-green-800 p-3 rounded-lg mr-3">
                            <i class="fas fa-search text-xl"></i>
                        </div>
                        <h3 class="font-bold text-lg">Search Bar</h3>
                    </div>
                    <p class="text-gray-600">Prominent search functionality with autocomplete suggestions and search button.</p>
                </div>

                <div class="border border-gray-200 rounded-lg p-5 hover:shadow-md transition-shadow">
                    <div class="flex items-center mb-4">
                        <div class="bg-purple-100 text-purple-800 p-3 rounded-lg mr-3">
                            <i class="fas fa-user-circle text-xl"></i>
                        </div>
                        <h3 class="font-bold text-lg">Login/Account</h3>
                    </div>
                    <p class="text-gray-600">User login/registration with dropdown for account management and order tracking.</p>
                </div>
            </div>
        </div> --}}

        <!-- Implementation guide -->
        {{-- <div class="bg-gray-900 text-white rounded-xl shadow p-6">
            <h2 class="text-2xl font-bold mb-4 text-amber-300">Implementation Guide</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <h3 class="text-xl font-bold mb-3 text-white">Required Dependencies</h3>
                    <ul class="space-y-2">
                        <li class="flex items-start">
                            <i class="fas fa-check text-green-400 mt-1 mr-2"></i>
                            <span><strong>Tailwind CSS:</strong> Via CDN or local installation</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-check text-green-400 mt-1 mr-2"></i>
                            <span><strong>Font Awesome 6:</strong> For all icons including social media</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-check text-green-400 mt-1 mr-2"></i>
                            <span><strong>Custom JavaScript:</strong> For mobile menu toggle and interactions</span>
                        </li>
                    </ul>
                </div>
                <div>
                    <h3 class="text-xl font-bold mb-3 text-white">Key Features</h3>
                    <ul class="space-y-2">
                        <li class="flex items-start">
                            <i class="fas fa-star text-amber-400 mt-1 mr-2"></i>
                            <span>Fully responsive design with mobile menu</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-star text-amber-400 mt-1 mr-2"></i>
                            <span>Hover effects on all interactive elements</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-star text-amber-400 mt-1 mr-2"></i>
                            <span>Dropdown menus for login and categories</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-star text-amber-400 mt-1 mr-2"></i>
                            <span>Shopping cart with item counter</span>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="mt-6 p-4 bg-gray-800 rounded-lg">
                <p class="text-amber-300 font-medium"><i class="fas fa-info-circle mr-2"></i>To use this header, simply copy the HTML, CSS, and JavaScript into your project. All elements are fully customizable.</p>
            </div>
        </div>
    </div> --}}
</div>

    <script>
        // Toggle mobile menu
        const mobileMenuToggle = document.getElementById('mobileMenuToggle');
        const mobileMenu = document.getElementById('mobileMenu');

        mobileMenuToggle.addEventListener('click', function(e) {
            e.stopPropagation();
            mobileMenu.classList.toggle('active');

            // Change icon based on menu state
            const icon = mobileMenuToggle.querySelector('i');
            if (mobileMenu.classList.contains('active')) {
                icon.classList.remove('fa-bars');
                icon.classList.add('fa-times');
            } else {
                icon.classList.remove('fa-times');
                icon.classList.add('fa-bars');
            }
        });

        // Close mobile menu when clicking outside
        document.addEventListener('click', function(event) {
            if (!mobileMenu.contains(event.target) && !mobileMenuToggle.contains(event.target)) {
                mobileMenu.classList.remove('active');
                const icon = mobileMenuToggle.querySelector('i');
                icon.classList.remove('fa-times');
                icon.classList.add('fa-bars');
            }
        });

        // Cart count animation
        const cartCount = document.querySelector('.cart-count');
        if (cartCount) {
            setInterval(() => {
                cartCount.classList.toggle('animate-pulse');
            }, 4000);
        }

        // Add hover effect to navigation items
        document.querySelectorAll('.nav-item').forEach(item => {
            item.classList.add('px-3', 'py-2', 'rounded-md', 'flex', 'items-center', 'text-gray-700', 'hover:bg-amber-50', 'hover:text-amber-700', 'transition-colors');
        });

        // Function to update cart count in header
        function updateHeaderCartCount() {
            @auth
            fetch("{{ route('cart.count') }}")
                .then(response => response.json())
                .then(data => {
                    const cartCountElement = document.querySelector('.cart-count');
                    const cartAmountElement = document.querySelector('.cart-amount');

                    if (cartCountElement) {
                        cartCountElement.textContent = data.count;
                        if (data.count > 0) {
                            cartCountElement.style.display = 'flex';
                        } else {
                            cartCountElement.style.display = 'none';
                        }
                    }

                    // Optional: Update cart amount if you have that element
                    if (cartAmountElement && data.total) {
                        cartAmountElement.textContent = '₹' + data.total;
                    }
                })
                .catch(error => console.error('Error fetching cart count:', error));
            @endauth
        }

        // Update cart count on page load
        document.addEventListener('DOMContentLoaded', function() {
            updateHeaderCartCount();

            // Update cart count every 30 seconds (optional)
            setInterval(updateHeaderCartCount, 30000);
        });
    </script>
