<h3 class="text-xl font-bold mb-4 text-gray-900">Filter by Category</h3>
<div class="space-y-3" id="category-container">
    @foreach ($categories['data']['data'] as $index => $category)
        <div class="flex items-center category-item {{ $index >= 5 ? 'hidden' : '' }}">
            <input id="cat{{ $category->id }}" type="checkbox" class="w-4 h-4 text-blue-600 border-gray-300 rounded-sm">
            <label for="cat{{ $category->id }}"
                class="ms-2 text-sm font-medium text-gray-900">{{ $category->name }}</label>
        </div>
    @endforeach
</div>

<!-- Show More / Show Less Button -->
<button id="toggleCategories" class="mt-4 text-blue-600 font-medium hover:underline">
    Show More
</button>


<h3 class="text-xl font-bold mt-6 mb-4 text-gray-900">Price Range</h3>
<div class="space-y-3">
    <div class="flex items-center">
        <input id="price1" type="checkbox" class="w-4 h-4 text-blue-600 border-gray-300 rounded-sm">
        <label for="price1" class="ms-2 text-sm font-medium text-gray-900">Under $100</label>
    </div>
    <div class="flex items-center">
        <input id="price2" type="checkbox" class="w-4 h-4 text-blue-600 border-gray-300 rounded-sm">
        <label for="price2" class="ms-2 text-sm font-medium text-gray-900">$100 - $500</label>
    </div>
    <div class="flex items-center">
        <input id="price3" type="checkbox" class="w-4 h-4 text-blue-600 border-gray-300 rounded-sm">
        <label for="price3" class="ms-2 text-sm font-medium text-gray-900">$500 - $1000</label>
    </div>
    <div class="flex items-center">
        <input id="price4" type="checkbox" class="w-4 h-4 text-blue-600 border-gray-300 rounded-sm">
        <label for="price4" class="ms-2 text-sm font-medium text-gray-900">Over $1000</label>
    </div>
</div>

<button type="submit"
    class="mt-6 w-full bg-blue-600 text-white font-bold py-2 px-4 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
    Apply Filter
</button>
<a href="/products" class="mt-6 text-sm text-muted hover:underline"><i>Reset Filter</i></a>
