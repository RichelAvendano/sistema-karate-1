<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <link href="{{asset('css\bootstrap.min.css')}}" rel="stylesheet">

        <!--Nifty Stylesheet [ REQUIRED ]-->
        <link href="{{asset('css\nifty.min.css')}}" rel="stylesheet">

        <!--Nifty Premium Icon [ DEMONSTRATION ]-->
        <link href="{{asset('css\nifty-demo-icons.min.css')}}" rel="stylesheet">
        <!-- Scripts -->
        {{-- @vite(['resources/css/app.css', 'resources/js/app.js']) --}}

        
    </head>
    <body class="font-sans">

        <div id="container" class="effect aside-float aside-bright mainnav-lg">
            {{ $slot }}           

            <!--NAVBAR-->
            <!--===================================================-->
            @include('layouts.navbar')    

            <!--MAIN NAVIGATION-->
            <!--===================================================-->
            @include('layouts.main-navbar')

            <!-- FOOTER -->
            <!--===================================================-->
            @include('layouts.footer')

            <!-- SCROLL PAGE BUTTON -->
            <!--===================================================-->
            <button class="scroll-top btn">
                <i class="pci-chevron chevron-up"></i>
            </button>
        </div>

        <script src="{{asset('js\jquery.min.js')}}"></script>
        <script src="{{asset('js\nifty.min.js')}}"></script>
        <script src="{{asset('js\bootstrap.min.js')}}"></script>
    </body>
</html>
