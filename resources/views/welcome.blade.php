<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'Appointment System') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet"/>

    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-gray-50">
<div class="relative min-h-screen flex flex-col">
    <!-- Navigation -->
    <header class="bg-white shadow-sm border-b">
        <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
            <div class="flex items-center space-x-2">
                <x-application-logo class="h-10 w-10 text-red-600"/>
                <span class="text-xl font-semibold text-gray-800">Appointment System</span>
            </div>

            @if (Route::has('login'))
                <livewire:welcome.navigation/>
            @endif
        </div>
    </header>

    <!-- Hero Section -->
    <section
        class="flex flex-col flex-1 items-center justify-center text-center px-6 py-20 bg-gradient-to-br from-red-50 to-white">
        <h1 class="text-4xl sm:text-5xl font-bold text-gray-900 mb-6">
            Book Appointments Effortlessly
        </h1>
        <p class="text-lg text-gray-600 max-w-2xl mb-8">
            A simple and modern appointment booking system for customers and admins.
            Manage schedules, track bookings, and stay organized — all in one place.
        </p>
        <div class="flex space-x-4">
            @auth
                <a href="{{ route('dashboard') }}"
                   class="px-6 py-3 rounded-lg bg-red-600 text-white font-medium hover:bg-red-700 transition">
                    Go to Dashboard
                </a>
            @else
                <a href="{{ route('register') }}"
                   class="px-6 py-3 rounded-lg bg-red-600 text-white font-medium hover:bg-red-700 transition">
                    Get Started
                </a>
                <a href="{{ route('login') }}"
                   class="px-6 py-3 rounded-lg bg-gray-200 text-gray-700 font-medium hover:bg-gray-300 transition">
                    Log In
                </a>
            @endauth
        </div>
    </section>

    <!-- Features Section -->
    <section class="max-w-7xl mx-auto py-16 px-6 grid gap-10 sm:grid-cols-2 lg:grid-cols-3">
        <div class="bg-white rounded-xl shadow-md p-6 hover:shadow-lg transition">
            <div class="text-red-600 mb-4">
                <x-heroicon-o-calendar class="h-10 w-10"/>
            </div>
            <h3 class="text-lg font-semibold mb-2">Easy Scheduling</h3>
            <p class="text-gray-600">Customers can book appointments quickly with a clean, user-friendly interface.</p>
        </div>

        <div class="bg-white rounded-xl shadow-md p-6 hover:shadow-lg transition">
            <div class="text-red-600 mb-4">
                <x-heroicon-o-user-group class="h-10 w-10"/>
            </div>
            <h3 class="text-lg font-semibold mb-2">Role-Based Access</h3>
            <p class="text-gray-600">Admins and customers have separate dashboards with tailored functionalities.</p>
        </div>

        <div class="bg-white rounded-xl shadow-md p-6 hover:shadow-lg transition">
            <div class="text-red-600 mb-4">
                <x-heroicon-o-chart-bar class="h-10 w-10"/>
            </div>
            <h3 class="text-lg font-semibold mb-2">Analytics & Tracking</h3>
            <p class="text-gray-600">Admins can monitor appointments, customer activity, and performance at a
                glance.</p>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-white border-t py-6 text-center text-sm text-gray-500">
        &copy; {{ date('Y') }} Appointment System. All rights reserved.
    </footer>
</div>
</body>
</html>
