@extends('layouts.main')

@section('content')
    <div class="container mx-auto px-4">
        <!-- Banner Section -->
        <div class="relative w-full h-[500px] rounded-3xl overflow-hidden shadow-lg mb-[5em]">
            <img src="{{ asset('assets/img/marketplace-banner-2.jpg') }}" alt="Marketplace Banner"
                class="w-full h-full object-cover" />
            <div class="absolute inset-0 flex flex-col items-center justify-center text-white text-center p-6 ">
                <h2 class="text-4xl font-bold">Welcome to Our Marketplace</h2>
                <p class="text-lg mt-2">Find the best products at unbeatable prices!</p>
            </div>
        </div>

        <!-- Main Content -->
        <div class="grid grid-cols-4 gap-6">
            <!-- Filtering Section -->
            <div class="col-span-1 bg-white p-8 rounded-lg shadow-md h-[500px] overflow-auto">
                <h3 class="text-xl font-bold mb-4 text-gray-900">Filter by Category</h3>
                <div class="space-y-3">
                    <div class="flex items-center">
                        <input id="cat1" type="checkbox" class="w-4 h-4 text-blue-600 border-gray-300 rounded-sm">
                        <label for="cat1" class="ms-2 text-sm font-medium text-gray-900">Electronics</label>
                    </div>
                    <div class="flex items-center">
                        <input id="cat2" type="checkbox" class="w-4 h-4 text-blue-600 border-gray-300 rounded-sm">
                        <label for="cat2" class="ms-2 text-sm font-medium text-gray-900">Fashion</label>
                    </div>
                    <div class="flex items-center">
                        <input id="cat3" type="checkbox" class="w-4 h-4 text-blue-600 border-gray-300 rounded-sm">
                        <label for="cat3" class="ms-2 text-sm font-medium text-gray-900">Home & Garden</label>
                    </div>
                </div>

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
            </div>


            <!-- Product List Wrapper -->
            <div class="col-span-3 bg-white p-8 rounded-lg shadow-md">
                <h3 class="text-xl font-bold mb-4 text-gray-900">Available Products</h3>
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
                    <!-- Product 1 -->
                    <div class="bg-white border rounded-lg shadow-md p-5 col-span-1">
                        <img class="w-full h-48 object-cover rounded-md" src="/assets/img/product-1.jpg" alt="Product 1">
                        <h5 class="text-xl font-bold mt-4">Smartphone X</h5>
                        <p class="text-gray-700 mt-1">High-end smartphone with great features.</p>
                        <p class="text-blue-600 font-bold mt-2">$699</p>
                    </div>
                    <!-- Product 2 -->
                    <div class="bg-white border rounded-lg shadow-md p-5 col-span-1">
                        <img class="w-full h-48 object-cover rounded-md" src="/assets/img/product-2.jpg" alt="Product 2">
                        <h5 class="text-xl font-bold mt-4">Wireless Headphones</h5>
                        <p class="text-gray-700 mt-1">Noise-canceling over-ear headphones.</p>
                        <p class="text-blue-600 font-bold mt-2">$199</p>
                    </div>
                    <!-- Product 3 -->
                    <div class="bg-white border rounded-lg shadow-md p-5 col-span-1">
                        <img class="w-full h-48 object-cover rounded-md" src="/assets/img/product-3.jpg" alt="Product 3">
                        <h5 class="text-xl font-bold mt-4">Gaming Laptop</h5>
                        <p class="text-gray-700 mt-1">Powerful gaming laptop with RTX graphics.</p>
                        <p class="text-blue-600 font-bold mt-2">$1299</p>
                    </div>

                    <!-- Product 1 -->
                    <div class="bg-white border rounded-lg shadow-md p-5 col-span-1">
                        <img class="w-full h-48 object-cover rounded-md" src="/assets/img/product-1.jpg" alt="Product 1">
                        <h5 class="text-xl font-bold mt-4">Smartphone X</h5>
                        <p class="text-gray-700 mt-1">High-end smartphone with great features.</p>
                        <p class="text-blue-600 font-bold mt-2">$699</p>
                    </div>
                    <!-- Product 2 -->
                    <div class="bg-white border rounded-lg shadow-md p-5 col-span-1">
                        <img class="w-full h-48 object-cover rounded-md" src="/assets/img/product-2.jpg" alt="Product 2">
                        <h5 class="text-xl font-bold mt-4">Wireless Headphones</h5>
                        <p class="text-gray-700 mt-1">Noise-canceling over-ear headphones.</p>
                        <p class="text-blue-600 font-bold mt-2">$199</p>
                    </div>
                    <!-- Product 3 -->
                    <div class="bg-white border rounded-lg shadow-md p-5 col-span-1">
                        <img class="w-full h-48 object-cover rounded-md" src="/assets/img/product-3.jpg" alt="Product 3">
                        <h5 class="text-xl font-bold mt-4">Gaming Laptop</h5>
                        <p class="text-gray-700 mt-1">Powerful gaming laptop with RTX graphics.</p>
                        <p class="text-blue-600 font-bold mt-2">$1299</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
