<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Checkout - {{ config('app.name', 'Laravel') }}</title>

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
                            <h1 class="text-2xl font-semibold mb-6">Checkout</h1>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                                <div>
                                    <h2 class="text-lg font-medium text-gray-900 mb-4">Order Summary</h2>
                                    <div class="bg-gray-50 rounded-lg p-4">
                                        <div class="flex items-center space-x-4">
                                            @if($item->image_path)
                                                <img src="{{ Storage::url($item->image_path) }}" alt="{{ $item->denotation }}" class="w-20 h-20 object-cover rounded">
                                            @else
                                                <div class="w-20 h-20 bg-gray-200 rounded flex items-center justify-center">
                                                    <span class="text-gray-400">No Image</span>
                                                </div>
                                            @endif
                                            <div>
                                                <h3 class="text-lg font-medium text-gray-900">{{ $item->denotation }}</h3>
                                                <p class="text-sm text-gray-600">{{ $item->item_type }} - {{ $item->item_group }}</p>
                                                <p class="text-sm text-gray-600">Quantity: {{ request('quantity') }}</p>
                                            </div>
                                        </div>
                                        <div class="mt-4 pt-4 border-t border-gray-200">
                                            <div class="flex justify-between">
                                                <span class="text-gray-600">Subtotal</span>
                                                <span class="text-gray-900">{{ number_format($total, 2) }}</span>
                                            </div>
                                            <div class="flex justify-between mt-2">
                                                <span class="text-gray-600">Tax (10%)</span>
                                                <span class="text-gray-900">{{ number_format($total * 0.1, 2) }}</span>
                                            </div>
                                            <div class="flex justify-between mt-2 font-semibold">
                                                <span class="text-gray-900">Total</span>
                                                <span class="text-gray-900">{{ number_format($total * 1.1, 2) }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div>
                                    <h2 class="text-lg font-medium text-gray-900 mb-4">Shipping Information</h2>
                                    <form action="#" method="POST" class="space-y-4">
                                        @csrf
                                        <div>
                                            <label for="name" class="block text-sm font-medium text-gray-700">Full Name</label>
                                            <input type="text" name="name" id="name" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                        </div>

                                        <div>
                                            <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                                            <input type="email" name="email" id="email" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                        </div>

                                        <div>
                                            <label for="phone" class="block text-sm font-medium text-gray-700">Phone</label>
                                            <input type="tel" name="phone" id="phone" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                        </div>

                                        <div>
                                            <label for="address" class="block text-sm font-medium text-gray-700">Address</label>
                                            <textarea name="address" id="address" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"></textarea>
                                        </div>

                                        <div>
                                            <label for="city" class="block text-sm font-medium text-gray-700">City</label>
                                            <input type="text" name="city" id="city" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                        </div>

                                        <div>
                                            <label for="postal_code" class="block text-sm font-medium text-gray-700">Postal Code</label>
                                            <input type="text" name="postal_code" id="postal_code" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                        </div>

                                        <div class="mt-6">
                                            <button type="submit" class="w-full bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                                Place Order
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