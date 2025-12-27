<x-frontend-layout>
    <section class="py-12 px-4 md:px-8 bg-gray-50">
    <div class="container mx-auto">
        <!-- Section Header -->
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8 md:mb-12">
            <div class="mb-4 md:mb-0">
                <h2 class="text-2xl md:text-3xl lg:text-4xl font-bold text-gray-900 relative pb-3 mb-2">
                    Result of {{ $q }}
                    <span class="absolute bottom-0 left-0 w-16 h-1 bg-linear-to-r from-amber-500 to-orange-500 rounded-full"></span>
                </h2>
                {{-- <p class="text-gray-600 mt-2">Discover our best-selling items with exclusive discounts</p> --}}
            </div>
            {{-- <a href="#" class="inline-flex items-center text-amber-600 hover:text-amber-700 font-semibold transition-all duration-300 group"> --}}
                {{-- View All Products --}}
                {{-- <i class="fas fa-arrow-right ml-2 group-hover:ml-3 transition-all duration-300"></i>
            </a> --}}
        </div>

        {{-- <!-- Filter Tabs -->
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
        </div> --}}

        <!-- Products Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 md:gap-8">
            <!-- Product 1 -->
            @foreach ($products as $product)
                <x-product-card :product="$product" />
            @endforeach
         </div>
    </section>
</ x-frontend-layout>
