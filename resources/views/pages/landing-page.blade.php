@extends('layouts.main')

@section('content')
    <div class="container mx-auto px-4">
        <!-- Banner Section -->
        <div class="relative w-full h-[400px] rounded-3xl overflow-hidden shadow-lg">
            <img src="{{ asset('assets/img/marketplace-banner-2.jpg') }}" alt="Marketplace Banner"
                class="w-full h-full object-cover" />

            <div
                class="absolute inset-0 bg-black bg-opacity-50 flex flex-col items-center justify-center text-white text-center p-6">
                <h2 class="text-4xl font-bold">Welcome to Our Marketplace</h2>
                <p class="text-lg mt-2">Find the best products at unbeatable prices!</p>
            </div>
        </div>

        <!-- Filtering Section -->
        <div class="mt-10 grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- Filter Options -->
            <div class="bg-white p-6 rounded-lg shadow-md dark:bg-gray-800">
                <h3 class="text-xl font-bold mb-4 text-gray-900 dark:text-white">Filter by Category</h3>

                <!-- Category Checkboxes -->
                <div class="space-y-3">
                    <div class="flex items-center">
                        <input id="cat1" type="checkbox"
                            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded-sm focus:ring-blue-500">
                        <label for="cat1" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Category
                            1</label>
                    </div>
                    <div class="flex items-center">
                        <input id="cat2" type="checkbox"
                            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded-sm focus:ring-blue-500">
                        <label for="cat2" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Category
                            2</label>
                    </div>
                    <div class="flex items-center">
                        <input id="cat3" type="checkbox"
                            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded-sm focus:ring-blue-500">
                        <label for="cat3" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Category
                            3</label>
                    </div>
                </div>
            </div>

            <!-- Category Cards -->
            <div class="col-span-2 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
                <a href="#"
                    class="block p-6 bg-white border border-gray-200 rounded-lg shadow-sm hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
                    <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">Category 1</h5>
                    <p class="font-normal text-gray-700 dark:text-gray-400">Explore the best deals in Category 1.</p>
                </a>
                <a href="#"
                    class="block p-6 bg-white border border-gray-200 rounded-lg shadow-sm hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
                    <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">Category 2</h5>
                    <p class="font-normal text-gray-700 dark:text-gray-400">Discover top products in Category 2.</p>
                </a>
                <a href="#"
                    class="block p-6 bg-white border border-gray-200 rounded-lg shadow-sm hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
                    <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">Category 3</h5>
                    <p class="font-normal text-gray-700 dark:text-gray-400">Find exclusive offers in Category 3.</p>
                </a>
            </div>
        </div>

        <!-- Product List -->
        <div class="mt-10 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            <!-- Product 1 -->
            <div
                class="max-w-sm bg-white border border-gray-200 rounded-lg shadow-md dark:bg-gray-800 dark:border-gray-700">
                <a href="#">
                    <img class="rounded-t-lg w-full h-48 object-cover" src="/docs/images/blog/image-1.jpg"
                        alt="Product 1" />
                </a>
                <div class="p-5">
                    <a href="#">
                        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">Product 1</h5>
                    </a>
                    <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">Short description of the product.</p>
                    <a href="#"
                        class="inline-flex items-center px-3 py-2 text-sm font-medium text-white bg-blue-700 rounded-lg hover:bg-blue-800">
                        View Details
                        <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 14 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M1 5h12m0 0L9 1m4 4L9 9" />
                        </svg>
                    </a>
                </div>
            </div>

            <!-- Product 2 -->
            <div
                class="max-w-sm bg-white border border-gray-200 rounded-lg shadow-md dark:bg-gray-800 dark:border-gray-700">
                <a href="#">
                    <img class="rounded-t-lg w-full h-48 object-cover" src="/docs/images/blog/image-2.jpg"
                        alt="Product 2" />
                </a>
                <div class="p-5">
                    <a href="#">
                        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">Product 2</h5>
                    </a>
                    <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">Short description of the product.</p>
                    <a href="#"
                        class="inline-flex items-center px-3 py-2 text-sm font-medium text-white bg-blue-700 rounded-lg hover:bg-blue-800">
                        View Details
                        <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 14 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M1 5h12m0 0L9 1m4 4L9 9" />
                        </svg>
                    </a>
                </div>
            </div>

            <!-- Product 3 -->
            <div
                class="max-w-sm bg-white border border-gray-200 rounded-lg shadow-md dark:bg-gray-800 dark:border-gray-700">
                <a href="#">
                    <img class="rounded-t-lg w-full h-48 object-cover" src="/docs/images/blog/image-3.jpg"
                        alt="Product 3" />
                </a>
                <div class="p-5">
                    <a href="#">
                        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">Product 3</h5>
                    </a>
                    <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">Short description of the product.</p>
                    <a href="#"
                        class="inline-flex items-center px-3 py-2 text-sm font-medium text-white bg-blue-700 rounded-lg hover:bg-blue-800">
                        View Details
                        <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 14 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M1 5h12m0 0L9 1m4 4L9 9" />
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
