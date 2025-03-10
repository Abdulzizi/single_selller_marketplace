@extends('layouts.main')

@section('content')
    <div class="container mx-auto px-4">
        <!-- Banner Section -->
        <div class="relative w-full rounded-3xl overflow-hidden shadow-lg mb-[5em] h-[600px]">
            <img src="{{ asset('assets/img/marketplace-banner-2.jpg') }}" alt="Marketplace Banner"
                class="w-full h-full object-cover" />
            <div class="absolute inset-0 flex flex-col items-center justify-center text-white text-center p-6 ">
                <h2 class="text-4xl font-bold">Welcome to Our Marketplace</h2>
                <p class="text-lg mt-2">Find the best products at unbeatable prices!</p>
            </div>
        </div>

        <!-- Main Content -->
        <div class="grid grid-cols-4 gap-6">

            <div class="col-span-1 bg-white p-8 rounded-lg shadow-md h-[500px]">
                <div class="max-h-[450px] overflow-y-auto">
                    @include('components.filter-card', ['categories' => $categories])
                </div>
            </div>


            <div class="col-span-3 bg-white p-8 rounded-lg shadow-md flex items-center justify-center flex-col">
                @include('components.product-grid', ['products' => $products])
            </div>
        </div>
    </div>
    </div>
@endsection
