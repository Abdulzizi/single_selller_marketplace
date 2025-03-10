@foreach ($products['data']['data'] as $product)
    <div
        class="bg-white border rounded-lg shadow-md p-5 transition-transform transform hover:scale-105 hover:shadow-lg flex flex-col justify-between">
        <div class="relative w-full h-56 bg-gray-100 rounded-md overflow-hidden">
            <img class="absolute inset-0 w-full h-full object-cover"
                src="{{ asset($product->photo_desktop ?? 'assets/img/no-image.png') }}" alt="{{ $product->name }}">
        </div>
        <div class="mt-4">
            <h5 class="text-lg font-semibold text-gray-900 truncate">{{ $product->name }}</h5>
            <p class="text-gray-600 mt-1 text-sm line-clamp-2">{{ $product->description }}</p>
            <p class="text-blue-600 font-bold mt-2 text-lg">Rp{{ number_format($product->price, 0, ',', '.') }}</p>
            <p class="text-gray-500 text-sm">{{ $product->category->name }}</p>
        </div>
        <button data-product-id="{{ $product->id }}"
            class="add-to-cart-btn mt-3 w-full bg-blue-600 text-white py-2 rounded-md hover:bg-blue-700 transition">
            Add to Cart
        </button>
    </div>
@endforeach
