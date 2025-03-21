<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet"/>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            font-family: 'Roboto', sans-serif;
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .fade-in {
            animation: fadeIn 0.5s ease-out;
        }
    </style>
</head>
<body class="flex items-center justify-center min-h-screen bg-gray-100">

    <div class="bg-white rounded-lg shadow-lg flex max-w-4xl w-full fade-in">
        <!-- Bagian Kiri: Welcome -->
        <div class="w-1/2 p-8 bg-gradient-to-r from-blue-800 to-orange-400 text-white rounded-l-lg flex flex-col justify-center items-center">
            <div class="mb-8 text-center">
                <!-- <img alt="Logo" class="mb-4" src="https://placehold.co/100x100"/> -->
                <h1 class="text-4xl font-bold">Welcome Page</h1>
                <p class="mt-2">Sign in to continue access</p>
            </div>
        </div>

        <!-- Bagian Kanan: Slot Form -->
        <div class="w-1/2 p-8 flex flex-col justify-center">
            {{ $slot }}
        </div>
    </div>

    <!-- Footer -->
    <div class="absolute bottom-4 text-center text-gray-600 text-sm fade-in">
        <p>&copy; {{ date('Y') }} {{ config('OLIVA', 'OLIVIA') }}. All rights reserved.</p>
    </div>
</body>
</html>
