<h3 class="text-2xl font-bold mb-6 text-gray-900 text-center">Available Products</h3>
<div id="product-container" class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
    @include('components.product-grid-items', ['products' => $products])
</div>

<!-- Load More Button -->
<div class="flex justify-center mt-6">
    <button id="loadMoreBtn" class="bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-blue-700 transition">
        Load More
    </button>
</div>
