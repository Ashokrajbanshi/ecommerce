@props(['product'])

<a href="{{route('product', $product->id)}}">

    <div class="product-card bg-white rounded-xl shadow-md hover:shadow-xl border border-gray-200 hover:border-amber-300 transition-all duration-300 overflow-hidden group" data-category="electronics">
                <div class="relative overflow-hidden h-48 md:h-56">
                    <img src="{{ asset(Storage::url($product->image[0])) }}"
                         alt="{{ $product->name }}"
                         class="w-full object-cover group-hover:scale-105 transition-transform duration-500">

                </div>
                <div class="p-4 md:p-5">
                    <div class="text-xs text-gray-500 uppercase tracking-wider mb-2"></div>
                    <h3 class="text-sm md:text-base font-semibold text-gray-900 mb-3 line-clamp-2 h-10 md:h-12">
                        {{ $product->name }}
                    </h3>


                    <div class="flex items-center flex-wrap gap-2 mb-3">
                        <span class="text-lg md:text-xl font-bold text-gray-900">Rs.{{ $product->price - ($product->price * $product->discount /100) }}</span>
                        @if ($product->discount > 0 )
                            <span class="text-sm md:text-base text-orange-500 line-through">Rs. {{ $product->price }}</span>
                            <span class="text-xs bg-blue-400 text-white px-2 py-1 rounded font-semibold">{{ $product->discount }} %</span>
                        @endif
                    </div>

                    <div class="flex items-center gap-1 mb-4">
                        <div class="flex text-amber-500">
                            <i class="fas fa-star text-xs md:text-sm"></i>
                            <i class="fas fa-star text-xs md:text-sm"></i>
                            <i class="fas fa-star text-xs md:text-sm"></i>
                            <i class="fas fa-star text-xs md:text-sm"></i>
                            <i class="fas fa-star-half-alt text-xs md:text-sm"></i>
                        </div>
                        <span class="text-xs text-gray-500 ml-1">(128)</span>
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
</a>
