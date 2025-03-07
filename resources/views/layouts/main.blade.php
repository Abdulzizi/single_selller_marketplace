<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Simple Layout</title>
    {{-- <link rel="stylesheet" href="{{ asset('css/app.css') }}"> --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    <header class="bg-gray-800 text-white py-4">
        <div class="container mx-auto">
            <h1 class="text-2xl font-bold">My Website</h1>
        </div>
    </header>

    {{-- Navbar --}}
    @include('components.navbar')

    {{-- Content --}}
    <main class="container mx-auto my-16 px-6">
        @yield('content')
    </main>

    {{-- Scripts --}}
    @yield('scripts')
</body>

</html>
