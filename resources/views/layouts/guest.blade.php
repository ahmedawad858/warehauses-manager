<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}"
      dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet"/>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="relative font-sans text-gray-900 antialiased">
@if (Route::has('login'))
    <div class="fixed flex gap-4 top-0 end-0  px-6 py-4 ">
        <a id="toggle" class="text-sm text-gray-700 dark:text-gray-500 underline cursor-pointer"
           onclick="toggleDarkMode()">Light</a>

        @auth
            <a href="{{ url('/dashboard') }}"
               class="text-sm text-gray-700 dark:text-gray-500 underline">Dashboard</a>
        @else
            <a href="{{ route('login') }}"
               class="text-sm text-gray-700 dark:text-gray-500 underline">{{__("welcome_text.login")}}</a>

            @if (Route::has('register'))
                <a href="{{ route('register') }}"
                   class="text-sm text-gray-700 dark:text-gray-500 underline">{{__("welcome_text.register")}}</a>
            @endif
        @endauth
        @if(app()->getLocale() === "ar")
            <a href="{{ url('language/en') }}"
               class="text-sm text-gray-700 dark:text-gray-500 underline">English</a>
        @else
            <a href="{{ url('language/ar') }}"
               class="text-sm text-gray-700 dark:text-gray-500 underline">العربية</a>
        @endif
    </div>
@endif
<div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100 dark:bg-gray-900">
    <div>
        <a href="/">
            <img src="assets/logo3.png" class="w-20 h-20 fill-current text-gray-500" alt=""/>
        </a>
    </div>

    <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white dark:bg-gray-800 shadow-md overflow-hidden sm:rounded-lg">
        {{ $slot }}
    </div>
</div>
</body>
</html>
