<x-frontend-layout>
    @push('css')
    <style>
        /* ... (your existing CSS remains the same) ... */
    </style>
    @endpush

    @push('scripts')
    <script>
        // Product data
        const product = @json($product);
        let cart = JSON.parse(localStorage.getItem('cart')) || [];
        let currentImageIndex = 0;

        // Initialize on page load
        document.addEventListener('DOMContentLoaded', function() {
            updateCartCount();
            initializeDropdowns();
        });

        // Initialize dropdown functionality
        function initializeDropdowns() {
            // Add click event to all dropdown toggles
            document.querySelectorAll('.dropdown-toggle').forEach(toggle => {
                toggle.addEventListener('click', function(e) {
                    e.preventDefault();
                    e.stopPropagation();

                    const dropdown = this.closest('.dropdown');
                    const menu = dropdown.querySelector('.dropdown-menu');

                    // Close all other dropdowns
                    document.querySelectorAll('.dropdown-menu').forEach(otherMenu => {
                        if (otherMenu !== menu) {
                            otherMenu.classList.remove('show');
                        }
                    });

                    // Toggle current dropdown
                    menu.classList.toggle('show');
                });
            });

            // Close dropdowns when clicking outside
            document.addEventListener('click', function(e) {
                if (!e.target.closest('.dropdown')) {
                    document.querySelectorAll('.dropdown-menu').forEach(menu => {
                        menu.classList.remove('show');
                    });
                }
            });

            // Close dropdowns when pressing ESC
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape') {
                    document.querySelectorAll('.dropdown-menu').forEach(menu => {
                        menu.classList.remove('show');
                    });
                }
            });
        }

        // Image gallery functions
        function changeImage(imageUrl, index) {
            const mainImage = document.getElementById('mainImage');
            const thumbnails = document.querySelectorAll('.thumbnail');

            // Remove active class from all thumbnails
            thumbnails.forEach(thumb => {
                thumb.classList.remove('active');
                thumb.classList.remove('border-amber-500');
                thumb.classList.add('border-gray-200');
            });

            // Add active class to clicked thumbnail
            thumbnails[index].classList.add('active');
            thumbnails[index].classList.add('border-amber-500');
            thumbnails[index].classList.remove('border-gray-200');

            // Fade out current image
            mainImage.style.opacity = '0';

            // Change image after fade out
            setTimeout(() => {
                mainImage.src = imageUrl;
                mainImage.style.opacity = '1';
                currentImageIndex = index;
            }, 200);
        }

        // Alternative plus/minus functions
        let qty = document.getElementById('qty');
        function incQty() {
            if(qty.value < 10){
                qty.value++;
            }
        }


        function decQty() {
            if(qty.value > 1){
                qty.value--;
            }
        }

        // Update cart count in header
        function updateCartCount() {
            const cartCount = cart.reduce((total, item) => total + item.quantity, 0);
            const cartCountElement = document.getElementById('cartCount');
            if (cartCountElement) {
                cartCountElement.textContent = cartCount;
            }
        }

        // Cart functions
        function addToCart() {
            const quantity = parseInt(document.getElementById('qty').value) || 1;

            // Check if product is already in cart
            const existingItemIndex = cart.findIndex(item => item.id === product.id);

            if (existingItemIndex > -1) {
                // Update quantity if already in cart
                cart[existingItemIndex].quantity += quantity;
            } else {
                // Add new item to cart
                const cartItem = {
                    id: product.id,
                    name: product.name,
                    price: product.discount > 0
                        ? product.price - (product.price * product.discount / 100)
                        : product.price,
                    originalPrice: product.price,
                    discount: product.discount,
                    image: product.image[0],
                    quantity: quantity,
                    stock: product.stock
                };
                cart.push(cartItem);
            }

            // Save to localStorage
            localStorage.setItem('cart', JSON.stringify(cart));

            // Update cart UI
            updateCartCount();

            // Show notification
            showNotification(`${quantity} ${product.name} added to cart!`);

            // Update cart icon animation
            animateCartIcon();
        }

        function buyNow() {
            addToCart();
            // Redirect to checkout page
            window.location.href = '';
        }

        function showNotification(message) {
            // Create notification element
            const notification = document.createElement('div');
            notification.className = 'fixed top-20 right-4 bg-green-500 text-white px-4 py-3 rounded-lg shadow-lg z-50 cart-notification';
            notification.innerHTML = `
                <i class="fas fa-check-circle mr-2"></i>
                <span>${message}</span>
            `;

            document.body.appendChild(notification);

            // Remove after 3 seconds
            setTimeout(() => {
                notification.remove();
            }, 3000);
        }

        function animateCartIcon() {
            const cartIcon = document.getElementById('cartButton');
            cartIcon.classList.add('animate-bounce');
            setTimeout(() => {
                cartIcon.classList.remove('animate-bounce');
            }, 1000);
        }

        // Tab functions
        function showTab(tabName) {
            // Update tab buttons
            document.querySelectorAll('.tab').forEach(tab => {
                tab.classList.remove('active');
                tab.classList.remove('text-amber-600');
                tab.classList.remove('border-amber-500');
            });

            const activeTab = document.querySelector(`[data-tab="${tabName}"]`);
            activeTab.classList.add('active');
            activeTab.classList.add('text-amber-600');
            activeTab.classList.add('border-amber-500');

            // Update tab content
            document.querySelectorAll('.tab-content').forEach(content => {
                content.classList.add('hidden');
            });

            document.getElementById(`${tabName}Tab`).classList.remove('hidden');
        }

        // Share functions
        function shareProduct(platform) {
            const productUrl = window.location.href;
            const productName = product.name;
            let shareUrl = '';

            switch(platform) {
                case 'facebook':
                    shareUrl = `https://www.facebook.com/sharer/sharer.php?u=${encodeURIComponent(productUrl)}`;
                    break;
                case 'twitter':
                    shareUrl = `https://twitter.com/intent/tweet?url=${encodeURIComponent(productUrl)}&text=${encodeURIComponent(productName)}`;
                    break;
                case 'whatsapp':
                    shareUrl = `https://wa.me/?text=${encodeURIComponent(productName + ' ' + productUrl)}`;
                    break;
            }

            if (shareUrl) {
                window.open(shareUrl, '_blank', 'width=600,height=400');
            }
        }

        // Review functions
        function submitReview() {
            const rating = document.querySelector('input[name="rating"]:checked');
            const reviewText = document.getElementById('reviewText').value;

            if (!rating || !reviewText) {
                alert('Please provide both rating and review text');
                return;
            }

            // In a real application, you would send this to your backend
            alert('Thank you for your review!');
            document.getElementById('reviewForm').reset();
        }
    </script>
    @endpush

    <!-- Cart Notification -->
    <div id="cartNotification" class="hidden fixed top-20 right-4 bg-green-500 text-white px-4 py-3 rounded-lg shadow-lg z-50 cart-notification">
        <i class="fas fa-check-circle mr-2"></i>
        <span id="notificationMessage">Item added to cart!</span>
    </div>

    <!-- Main Product Content -->
    <main class="container mx-auto px-4 py-8">
        <!-- Breadcrumb -->
        <div class="mb-6">
            <nav class="text-sm">
                <ol class="flex items-center space-x-2">
                    <li><a href="/" class="text-gray-500 hover:text-amber-600 transition">Home</a></li>
                    <li><i class="fas fa-chevron-right text-gray-400 text-xs"></i></li>
                    <li><a href="/products" class="text-gray-500 hover:text-amber-600 transition">Products</a></li>
                    <li><i class="fas fa-chevron-right text-gray-400 text-xs"></i></li>
                    <li class="text-gray-700">{{ $product->name }}</li>
                </ol>
            </nav>
        </div>

        <!-- Product Details Section -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-12">
            <!-- Product Images -->
            <div class="product-gallery">
                <!-- Main Image -->
                <div class="mb-4 bg-white rounded-xl shadow-lg overflow-hidden product-image-container">
                    <img
                        id="mainImage"
                        src="{{ asset('storage/' . $product->image[0]) }}"
                        alt="{{ $product->name }}"
                        class="w-full h-auto object-contain main-image fade-in"
                        style="max-height: 500px;"
                    >
                </div>

                <!-- Thumbnails -->
                @if(count($product->image) > 1)
                <div class="thumbnail-container overflow-x-auto py-2">
                    <div class="flex space-x-3">
                        @foreach($product->image as $index => $image)
                        <button
                            onclick="changeImage('{{ asset('storage/' . $image) }}', {{ $index }})"
                            class="thumbnail shrink-0 w-20 h-20 rounded-lg overflow-hidden border-2 {{ $index === 0 ? 'active border-amber-500' : 'border-gray-200' }}"
                            data-index="{{ $index }}"
                        >
                            <img
                                src="{{ asset('storage/' . $image) }}"
                                alt="{{ $product->name }} - Image {{ $index + 1 }}"
                                class="w-full h-full object-cover"
                            >
                        </button>
                        @endforeach
                    </div>
                </div>
                @endif
            </div>

            <!-- Product Info -->
            <div class="bg-white rounded-xl shadow-lg p-6 lg:p-8">
                <!-- Product Header -->
                <div class="mb-6">
                    <div class="flex justify-between items-start">
                        <div>
                            <h1 class="text-2xl lg:text-3xl font-bold text-gray-900 mb-2">{{ $product->name }}</h1>
                            <div class="flex items-center space-x-2 mb-3">
                                <div class="flex items-center">
                                    @for($i = 1; $i <= 5; $i++)
                                        <i class="fas fa-star {{ $i <= 4 ? 'text-amber-500' : 'text-gray-300' }}"></i>
                                    @endfor
                                </div>
                                <span class="text-gray-500 text-sm">(128 reviews)</span>
                                <span class="text-green-600 text-sm font-medium">
                                    <i class="fas fa-check-circle mr-1"></i>Verified Product
                                </span>
                            </div>
                        </div>
                        <button class="p-2 text-gray-400 hover:text-red-500 transition">
                            <i class="far fa-heart text-xl"></i>
                        </button>
                    </div>
                </div>

                <!-- Price Section -->
                <div class="mb-6 p-4 bg-linear-to-r from-amber-50 to-orange-50 rounded-lg">
                    <div class="flex items-center space-x-4">
                        @if($product->discount > 0)
                        <div class="text-4xl font-bold text-gray-900">
                            ₹{{ number_format($product->price - ($product->price * $product->discount / 100), 2) }}
                        </div>
                        <div class="text-xl text-gray-500 line-through">
                            ₹{{ number_format($product->price, 2) }}
                        </div>
                        <div class="discount-badge bg-red-500 text-white px-3 py-1 rounded-full text-sm font-bold">
                            -{{ $product->discount }}%
                        </div>
                        @else
                        <div class="text-4xl font-bold text-gray-900">
                            ₹{{ number_format($product->price, 2) }}
                        </div>
                        @endif
                    </div>
                    @if($product->discount > 0)
                    <div class="mt-2 text-green-600 font-medium">
                        <i class="fas fa-bolt mr-1"></i>You save ₹{{ number_format($product->price * $product->discount / 100, 2) }}
                    </div>
                    @endif
                </div>

                <!-- Stock Status -->
                {{-- <div class="mb-6">
                    @if($product->stock > 0)
                    <div class="inline-flex items-center px-4 py-2 bg-green-100 text-green-800 rounded-full">
                        <div class="w-2 h-2 bg-green-500 rounded-full mr-2"></div>
                        <span class="font-medium">In Stock</span>
                        @if($product->stock < 10)
                        <span class="ml-2 px-2 py-1 bg-red-100 text-red-800 text-xs rounded-full stock-badge">
                            Only {{ $product->stock }} left!
                        </span>
                        @endif
                    </div>
                    @else
                    <div class="inline-flex items-center px-4 py-2 bg-red-100 text-red-800 rounded-full">
                        <div class="w-2 h-2 bg-red-500 rounded-full mr-2"></div>
                        <span class="font-medium">Out of Stock</span>
                    </div>
                    @endif
                </div> --}}

                <!-- Quantity Selector - FIXED -->
                <div class="mb-6">
                    <label class="block text-gray-700 mb-2 font-medium">Quantity:</label>
                    <div class="flex items-center space-x-3">
                        <!-- Minus Button -->
                        <button type="button"
                            onclick="decQty()"
                            class="quantity-btn w-10 h-10 rounded-lg border border-gray-300 flex items-center justify-center hover:bg-amber-100"
                        >
                            <i class="fas fa-minus"></i>
                        </button>

                        <!-- Quantity Input -->
                        <input
                            type="number"
                            name="quantity"
                            id="qty"
                            value="1"
                            min="1"
                            {{-- max="{{ $product->stock }}" --}}
                            class="w-20 h-10 border border-gray-300 rounded-lg text-center font-medium"
                            required
                        >

                        <!-- Plus Button -->
                        <button type="button"
                            onclick="incQty()"
                            class="quantity-btn w-10 h-10 rounded-lg border border-gray-300 flex items-center justify-center hover:bg-amber-100"
                        >
                            <i class="fas fa-plus"></i>
                        </button>

                        <div class="text-gray-500 text-sm ml-2">
                            Max {{ $product->stock }} per order
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="space-y-3 mb-8">
                    @if($product->stock > 0)
                    <button
                        onclick="addToCart()"
                        class="add-to-cart-btn w-full bg-linear-to-r from-amber-500 to-orange-500 hover:from-amber-600 hover:to-orange-600 text-white font-bold py-4 rounded-lg transition-all duration-300 shadow-lg hover:shadow-xl flex items-center justify-center space-x-3"
                    >
                        <i class="fas fa-shopping-cart"></i>
                        <span>Add to Cart</span>
                    </button>
                    <button
                        onclick="buyNow()"
                        class="w-full bg-linear-to-r from-gray-900 to-gray-700 hover:from-gray-800 hover:to-gray-600 text-white font-bold py-4 rounded-lg transition-all duration-300 shadow-lg hover:shadow-xl flex items-center justify-center space-x-3"
                    >
                        <i class="fas fa-bolt"></i>
                        <span>Buy Now</span>
                    </button>
                    @else
                    <button
                        disabled
                        class="w-full bg-gray-300 text-gray-500 font-bold py-4 rounded-lg cursor-not-allowed flex items-center justify-center space-x-3"
                    >
                        <i class="fas fa-times-circle"></i>
                        <span>Out of Stock</span>
                    </button>
                    @endif
                </div>

                <!-- Delivery Info -->
                <div class="border-t border-b border-gray-200 py-4 mb-6">
                    <div class="space-y-3">
                        <div class="flex items-center space-x-3">
                            <i class="fas fa-shipping-fast text-amber-600 text-xl"></i>
                            <div>
                                <div class="font-medium">Free Delivery</div>
                                <div class="text-gray-600 text-sm">Delivered by tomorrow</div>
                            </div>
                        </div>
                        <div class="flex items-center space-x-3">
                            <i class="fas fa-shield-alt text-amber-600 text-xl"></i>
                            <div>
                                <div class="font-medium">Warranty</div>
                                <div class="text-gray-600 text-sm">1 Year Manufacturer Warranty</div>
                            </div>
                        </div>
                        <div class="flex items-center space-x-3">
                            <i class="fas fa-sync-alt text-amber-600 text-xl"></i>
                            <div>
                                <div class="font-medium">Easy Returns</div>
                                <div class="text-gray-600 text-sm">10 Days Return Policy</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Share & Social -->
                <div>
                    <label class="block text-gray-700 mb-2 font-medium">Share this product:</label>
                    <div class="flex space-x-3">
                        <button onclick="shareProduct('facebook')" class="w-10 h-10 bg-blue-500 text-white rounded-full flex items-center justify-center hover:bg-blue-600 transition">
                            <i class="fab fa-facebook-f"></i>
                        </button>
                        <button onclick="shareProduct('twitter')" class="w-10 h-10 bg-blue-400 text-white rounded-full flex items-center justify-center hover:bg-blue-500 transition">
                            <i class="fab fa-twitter"></i>
                        </button>
                        <button onclick="shareProduct('whatsapp')" class="w-10 h-10 bg-green-500 text-white rounded-full flex items-center justify-center hover:bg-green-600 transition">
                            <i class="fab fa-whatsapp"></i>
                        </button>
                        <button onclick="window.print()" class="w-10 h-10 bg-gray-500 text-white rounded-full flex items-center justify-center hover:bg-gray-600 transition">
                            <i class="fas fa-print"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Product Tabs -->
        <div class="bg-white rounded-xl shadow-lg mb-8">
            <!-- Tab Headers -->
            <div class="border-b border-gray-200">
                <div class="flex space-x-8 px-6 overflow-x-auto">
                    <button
                        onclick="showTab('description')"
                        class="tab py-4 font-medium text-gray-700 hover:text-amber-600 border-b-2 border-transparent whitespace-nowrap active"
                        data-tab="description"
                    >
                        Description
                    </button>
                    <button
                        onclick="showTab('specifications')"
                        class="tab py-4 font-medium text-gray-700 hover:text-amber-600 border-b-2 border-transparent whitespace-nowrap"
                        data-tab="specifications"
                    >
                        Specifications
                    </button>
                    <button
                        onclick="showTab('reviews')"
                        class="tab py-4 font-medium text-gray-700 hover:text-amber-600 border-b-2 border-transparent whitespace-nowrap"
                        data-tab="reviews"
                    >
                        Reviews (128)
                    </button>
                    <button
                        onclick="showTab('shipping')"
                        class="tab py-4 font-medium text-gray-700 hover:text-amber-600 border-b-2 border-transparent whitespace-nowrap"
                        data-tab="shipping"
                    >
                        Shipping & Returns
                    </button>
                </div>
            </div>

            <!-- Tab Content -->
            <div class="p-6">
                <!-- Description Tab -->
                <div id="descriptionTab" class="tab-content">
                    <div class="prose max-w-none">
                        {!! $product->description ?? '<p class="text-gray-500">No description available.</p>' !!}
                    </div>
                </div>

                <!-- Specifications Tab -->
                <div id="specificationsTab" class="tab-content hidden">
                    <div class="space-y-4">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="bg-gray-50 p-4 rounded-lg">
                                <div class="text-gray-600 text-sm">Brand</div>
                                <div class="font-medium">Apple</div>
                            </div>
                            <div class="bg-gray-50 p-4 rounded-lg">
                                <div class="text-gray-600 text-sm">Model</div>
                                <div class="font-medium">iPhone 17</div>
                            </div>
                            <div class="bg-gray-50 p-4 rounded-lg">
                                <div class="text-gray-600 text-sm">Color</div>
                                <div class="font-medium">Sage Green</div>
                            </div>
                            <div class="bg-gray-50 p-4 rounded-lg">
                                <div class="text-gray-600 text-sm">Storage</div>
                                <div class="font-medium">256 GB</div>
                            </div>
                            <div class="bg-gray-50 p-4 rounded-lg">
                                <div class="text-gray-600 text-sm">Condition</div>
                                <div class="font-medium">New</div>
                            </div>
                            <div class="bg-gray-50 p-4 rounded-lg">
                                <div class="text-gray-600 text-sm">Warranty</div>
                                <div class="font-medium">1 Year</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Reviews Tab -->
                <div id="reviewsTab" class="tab-content hidden">
                    <div class="space-y-6">
                        <!-- Overall Rating -->
                        <div class="flex flex-col md:flex-row items-center md:items-start space-y-4 md:space-y-0 md:space-x-6">
                            <div class="text-center">
                                <div class="text-5xl font-bold text-gray-900">4.5</div>
                                <div class="flex text-amber-500 mt-1 justify-center">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star-half-alt"></i>
                                </div>
                                <div class="text-gray-600 mt-1">128 reviews</div>
                            </div>
                            <div class="flex-1">
                                <div class="space-y-2">
                                    @for($i = 5; $i >= 1; $i--)
                                    <div class="flex items-center">
                                        <div class="w-12 text-right mr-2">{{ $i }} ★</div>
                                        <div class="flex-1 h-2 bg-gray-200 rounded-full overflow-hidden">
                                            <div class="h-full bg-amber-500" style="width: {{ ($i/5)*100 }}%"></div>
                                        </div>
                                        <div class="w-12 text-left ml-2 text-gray-600">{{ rand(20, 50) }}</div>
                                    </div>
                                    @endfor
                                </div>
                            </div>
                        </div>

                        <!-- Review Form -->
                        <div class="border-t border-gray-200 pt-6">
                            <h4 class="font-bold text-lg mb-4">Write a Review</h4>
                            <form id="reviewForm" class="space-y-4">
                                <div>
                                    <label class="block text-gray-700 mb-2">Your Rating</label>
                                    <div class="star-rating">
                                        @for($i = 5; $i >= 1; $i--)
                                            <input type="radio" id="star{{ $i }}" name="rating" value="{{ $i }}" {{ $i == 5 ? 'checked' : '' }}>
                                            <label for="star{{ $i }}">★</label>
                                        @endfor
                                    </div>
                                </div>
                                <div>
                                    <textarea
                                        id="reviewText"
                                        class="w-full border border-gray-300 rounded-lg p-3 focus:outline-none focus:border-amber-500 focus:ring-2 focus:ring-amber-200"
                                        rows="4"
                                        placeholder="Share your experience with this product..."
                                    ></textarea>
                                </div>
                                <button type="button" onclick="submitReview()" class="bg-linear-to-r from-amber-500 to-orange-500 text-white px-6 py-3 rounded-lg hover:from-amber-600 hover:to-orange-600 transition font-medium">
                                    Submit Review
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Shipping Tab -->
                <div id="shippingTab" class="tab-content hidden">
                    <div class="space-y-6">
                        <div class="bg-amber-50 p-4 rounded-lg">
                            <h4 class="font-bold text-lg mb-3">Shipping Information</h4>
                            <ul class="space-y-3">
                                <li class="flex items-start">
                                    <i class="fas fa-check text-green-500 mt-1 mr-3"></i>
                                    <span class="flex-1">Free shipping on orders above ₹999. Standard shipping charges apply for orders below this amount.</span>
                                </li>
                                <li class="flex items-start">
                                    <i class="fas fa-check text-green-500 mt-1 mr-3"></i>
                                    <span class="flex-1">Delivery within 3-7 business days across India. Express delivery available for selected pin codes.</span>
                                </li>
                                <li class="flex items-start">
                                    <i class="fas fa-check text-green-500 mt-1 mr-3"></i>
                                    <span class="flex-1">Cash on delivery available for orders up to ₹5,000.</span>
                                </li>
                                <li class="flex items-start">
                                    <i class="fas fa-check text-green-500 mt-1 mr-3"></i>
                                    <span class="flex-1">Real-time tracking available for all orders through SMS and email notifications.</span>
                                </li>
                            </ul>
                        </div>

                        <div class="bg-green-50 p-4 rounded-lg">
                            <h4 class="font-bold text-lg mb-3">Return & Exchange Policy</h4>
                            <ul class="space-y-3">
                                <li class="flex items-start">
                                    <i class="fas fa-exchange-alt text-blue-500 mt-1 mr-3"></i>
                                    <span class="flex-1">10 days return policy from the date of delivery. Product must be in original, unused condition with all tags and accessories.</span>
                                </li>
                                <li class="flex items-start">
                                    <i class="fas fa-times-circle text-red-500 mt-1 mr-3"></i>
                                    <span class="flex-1">Certain products like personal care items, innerwear, and software are non-returnable.</span>
                                </li>
                                <li class="flex items-start">
                                    <i class="fas fa-money-bill-wave text-green-500 mt-1 mr-3"></i>
                                    <span class="flex-1">Full refund will be processed within 7-10 business days to the original payment method.</span>
                                </li>
                                <li class="flex items-start">
                                    <i class="fas fa-undo text-purple-500 mt-1 mr-3"></i>
                                    <span class="flex-1">Free return pickup available for most locations. In other cases, shipping charges will be deducted from the refund amount.</span>
                                </li>
                            </ul>
                        </div>

                        <div class="bg-blue-50 p-4 rounded-lg">
                            <h4 class="font-bold text-lg mb-3">Warranty Information</h4>
                            <ul class="space-y-3">
                                <li class="flex items-start">
                                    <i class="fas fa-shield-alt text-blue-500 mt-1 mr-3"></i>
                                    <span class="flex-1">1 Year manufacturer warranty for manufacturing defects.</span>
                                </li>
                                <li class="flex items-start">
                                    <i class="fas fa-tools text-blue-500 mt-1 mr-3"></i>
                                    <span class="flex-1">Warranty does not cover physical damage, water damage, or misuse of the product.</span>
                                </li>
                                <li class="flex items-start">
                                    <i class="fas fa-headset text-blue-500 mt-1 mr-3"></i>
                                    <span class="flex-1">Dedicated customer support available for warranty claims and technical assistance.</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Related Products Section -->
        <section class="mb-16">
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8">
                <div class="mb-4 md:mb-0">
                    <h2 class="text-2xl md:text-3xl font-bold text-gray-900 relative pb-3 mb-2">
                        Related Products
                        <span class="absolute bottom-0 left-0 w-16 h-1 bg-linear-to-r from-amber-500 to-orange-500 rounded-full"></span>
                    </h2>
                    <p class="text-gray-600 mt-2">Discover similar products you might like</p>
                </div>
                <a href="" class="inline-flex items-center text-amber-600 hover:text-amber-700 font-semibold transition-all duration-300 group">
                    View All Products
                    <i class="fas fa-arrow-right ml-2 group-hover:ml-3 transition-all duration-300"></i>
                </a>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- You can loop through related products here -->
                <!-- Example product card -->
                @for($i = 0; $i < 4; $i++)
                <div class="bg-white rounded-xl shadow-md hover:shadow-xl border border-gray-200 hover:border-amber-300 transition-all duration-300 overflow-hidden group">
                    <div class="relative overflow-hidden h-48">
                        <img src="https://images.unsplash.com/photo-1601784551446-20c9e07cdbdb?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80"
                             alt="Related Product"
                             class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                        <div class="absolute top-3 right-3 w-10 h-10 bg-white rounded-full flex items-center justify-center shadow-md cursor-pointer hover:bg-red-50 hover:text-red-500 transition-colors duration-300">
                            <i class="far fa-heart text-gray-600"></i>
                        </div>
                    </div>
                    <div class="p-4">
                        <h3 class="text-sm font-semibold text-gray-900 mb-2 line-clamp-2">Similar Premium Product</h3>
                        <div class="flex items-center justify-between mb-3">
                            <div class="text-lg font-bold text-gray-900">₹{{ rand(5000, 50000) }}</div>
                            <div class="flex text-amber-500 text-sm">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="far fa-star"></i>
                            </div>
                        </div>
                        <button class="w-full bg-linear-to-r from-amber-500 to-orange-500 hover:from-amber-600 hover:to-orange-600 text-white font-medium py-2.5 rounded-lg transition-all duration-300 flex items-center justify-center gap-2">
                            <i class="fas fa-shopping-cart"></i>
                            <span>Add to Cart</span>
                        </button>
                    </div>
                </div>
                @endfor
            </div>
        </section>
    </main>

</x-frontend-layout>
