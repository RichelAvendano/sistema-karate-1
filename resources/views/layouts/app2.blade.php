<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>
        
        <link rel="icon" type="image/png" href="{{asset('image/icono-dojo.png')}}" sizes="64x64">

        <!-- Google Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
        <!-- Animate.css -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">

        <!-- Scripts -->
        @vite(['resources/css/bootstrap.css'])
        @vite(['resources/js/bootstrap.js'])
        @vite(['resources/css/app.css'])
        @stack('styles')      
        
    </head>
    <body class="font-sans antialiased" data-bs-spy="scroll" data-bs-target=".navbar" data-bs-offset="100">

        
        {{ $slot }}

    </body>
</html>
