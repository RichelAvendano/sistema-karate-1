<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Scripts -->
        @vite(['resources/css/bootstrap.css'])
 
    </head>
    <body class="font-sans antialiased">

         @include('layouts.home.navbar')

        <!-- Page Content -->
        <main>
            {{ $slot }}
        </main>

        @include('layouts.home.footer')
        
        @vite(['resources/js/app.js'])
    </body>
</html>
