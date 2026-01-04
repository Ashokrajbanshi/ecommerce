{{-- @extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold mb-6 text-gray-800">My Wishlist</h1>

    @if($wishlistItems->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach($wishlistItems as $item)
                <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow">
                    <div class="relative">
                        @if($item->product->image)
                            <img src="{{ asset('storage/' . $item->product->image) }}"
                                 alt="{{ $item->product->name }}"
                                 class="w-full h-48 object-cover">
                        @else
                            <div class="w-full h-48 bg-gray-200 flex items-center justify-center">
                                <i class="fas fa-image text-gray-400 text-4xl"></i>
                            </div>
                        @endif

                        <button onclick="removeFromWishlist({{ $item->id }})"
                                class="absolute top-3 right-3 bg-white rounded-full p-2 shadow-md hover:bg-red-50">
                            <i class="fas fa-heart text-pink-500"></i>
                        </button>

                        @if($item->product->discount > 0)
                            <span class="absolute top-3 left-3 bg-red-500 text-white text-xs px-2 py-1 rounded">
                                -{{ $item->product->discount }}%
                            </span>
                        @endif
                    </div>

                    <div class="p-4">
                        <h3 class="font-semibold text-lg mb-2">{{ $item->product->name }}</h3>

                        <div class="flex items-center justify-between mb-3">
                            <div>
                                @if($item->product->discount > 0)
                                    <span class="text-gray-400 line-through mr-2">
                                        ₹{{ $item->product->price }}
                                    </span>
                                @endif
                                <span class="text-xl font-bold text-amber-600">
                                    ₹{{ $item->product->price - ($item->product->price * $item->product->discount / 100) }}
                                </span>
                            </div>
                        </div>

                        <div class="flex space-x-2">
                            <form action="{{ route('cart.add') }}" method="POST" class="flex-1">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $item->product->id }}">
                                <input type="hidden" name="qty" value="1">
                                <button type="submit"
                                        class="w-full bg-amber-500 hover:bg-amber-600 text-white py-2 px-4 rounded-md transition-colors">
                                    Add to Cart
                                </button>
                            </form>

                            <a href="{{ route('product', $item->product->id) }}"
                               class="bg-gray-100 hover:bg-gray-200 text-gray-800 py-2 px-4 rounded-md transition-colors">
                                View
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="mt-8 flex justify-between items-center">
            <div class="text-gray-600">
                {{ $totalItems }} item{{ $totalItems > 1 ? 's' : '' }} in wishlist
            </div>
            <button onclick="clearWishlist()"
                    class="bg-red-500 hover:bg-red-600 text-white py-2 px-6 rounded-md transition-colors">
                Clear All
            </button>
        </div>
    @else
        <div class="text-center py-12">
            <i class="fas fa-heart text-gray-300 text-6xl mb-4"></i>
            <h2 class="text-2xl font-semibold text-gray-600 mb-2">Your wishlist is empty</h2>
            <p class="text-gray-500 mb-6">Save items you like to your wishlist.</p>
            <a href="{{ route('home') }}"
               class="bg-amber-500 hover:bg-amber-600 text-white py-3 px-8 rounded-md transition-colors">
                Continue Shopping
            </a>
        </div>
    @endif
</div>

@push('scripts')
<script>
function removeFromWishlist(wishlistId) {
    if (confirm('Remove this item from wishlist?')) {
        fetch(`/wishlist/remove/${wishlistId}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        })
        .then(response => {
            if (response.ok) {
                location.reload();
            }
        });
    }
}

function clearWishlist() {
    if (confirm('Clear all items from wishlist?')) {
        fetch('/wishlist/clear', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                location.reload();
            }
        });
    }
}
</script>
@endpush
@endsection --}}
