<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-theme="light"> 
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet" />
        <title>{{ config('app.name', 'Laravel') }}</title>

        @vite(['resources/css/app.css','resources/js/app.js'])
    </head>
    <body class="bg-gray-100">
        <div class="flex min-h-screen">
            <x-sidebar />
            <div class="flex-1 flex flex-col ml-64">
                <x-navbar />
                <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-100 pt-16">
                    <div class="container mx-auto px-6 py-8">
                        @yield('content')
                    </div>
                </main>
            </div>
        </div>
        @stack('before-scripts')
        @stack('after-scripts')
    </body>
</html>