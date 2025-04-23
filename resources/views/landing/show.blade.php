<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $item->denotation }} - {{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100">
        <!-- Navigation -->
        <nav class="bg-white border-b border-gray-100">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16">
                    <div class="flex">
                        <div class="flex-shrink-0 flex items-center">
                            <a href="{{ route('landing.index') }}" class="text-xl font-bold text-gray-800">
                                {{ config('app.name', 'Laravel') }}
                            </a>
                        </div>
                    </div>

                    <div class="flex items-center">
                        @auth
                            <a href="{{ route('dashboard') }}" class="text-gray-600 hover:text-gray-900">Dashboard</a>
                        @else
                            <a href="{{ route('login') }}" class="text-gray-600 hover:text-gray-900">Login</a>
                            <a href="{{ route('register') }}" class="ml-4 text-gray-600 hover:text-gray-900">Register</a>
                        @endauth
                    </div>
                </div>
            </div>
        </nav>

        <!-- Page Content -->
        <main>
            <div class="py-12">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 text-gray-900">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                                <div>
                                    @if($item->image_path)
                                        <img src="{{ Storage::url($item->image_path) }}" alt="{{ $item->denotation }}" class="w-full rounded-lg shadow-lg">
                                    @else
                                        <div class="w-full h-96 bg-gray-200 rounded-lg flex items-center justify-center">
                                            <span class="text-gray-400">No Image</span>
                                        </div>
                                    @endif
                                </div>

                                <div>
                                    <h1 class="text-3xl font-bold text-gray-900">{{ $item->denotation }}</h1>
                                    <p class="text-lg text-gray-600 mt-2">{{ $item->item_type }} - {{ $item->item_group }}</p>
                                    <p class="text-2xl font-bold text-blue-600 mt-4">{{ number_format($item->unit_price, 2) }}</p>

                                    <div class="mt-6">
                                        <h2 class="text-xl font-semibold text-gray-900">Description</h2>
                                        <p class="mt-2 text-gray-600">{{ $item->description }}</p>
                                    </div>

                                    <div class="mt-6">
                                        <h2 class="text-xl font-semibold text-gray-900">Details</h2>
                                        <dl class="mt-2 space-y-2">
                                            <div>
                                                <dt class="text-sm font-medium text-gray-500">Item Code</dt>
                                                <dd class="mt-1 text-sm text-gray-900">{{ $item->item_code }}</dd>
                                            </div>
                                            <div>
                                                <dt class="text-sm font-medium text-gray-500">UoM</dt>
                                                <dd class="mt-1 text-sm text-gray-900">{{ $item->uom }}</dd>
                                            </div>
                                            <div>
                                                <dt class="text-sm font-medium text-gray-500">Main Supplier</dt>
                                                <dd class="mt-1 text-sm text-gray-900">{{ $item->main_supplier }}</dd>
                                            </div>
                                            <div>
                                                <dt class="text-sm font-medium text-gray-500">Storage Location</dt>
                                                <dd class="mt-1 text-sm text-gray-900">{{ $item->storage_location }}</dd>
                                            </div>
                                        </dl>
                                    </div>

                                    <form action="{{ route('landing.checkout') }}" method="POST" class="mt-8">
                                        @csrf
                                        <input type="hidden" name="item_id" value="{{ $item->id }}">
                                        <div class="flex items-center space-x-4">
                                            <div>
                                                <label for="quantity" class="block text-sm font-medium text-gray-700">Quantity</label>
                                                <input type="number" name="quantity" id="quantity" value="1" min="1" class="mt-1 block w-20 rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                            </div>
                                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                                Add to Cart
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</body>
</html> 