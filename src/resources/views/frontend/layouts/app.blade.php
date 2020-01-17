<!DOCTYPE html>
@langrtl
    <html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="rtl" class="no-js">
@else
    <html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="no-js">
@endlangrtl
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>@yield('title', app_name())</title>
        <meta name="description" content="@yield('meta_description', 'Laravel 5 Boilerplate')">
        <meta name="author" content="@yield('meta_author', 'Anthony Rappa')">
        @yield('meta')

        {{-- See https://laravel.com/docs/5.5/blade#stacks for usage --}}
        @stack('before-styles')
        
        {{ style(mix('css/frontend.css')) }}

        <!-- Check if the language is set to RTL, so apply the RTL layouts -->
        <!-- Otherwise apply the normal LTR layouts -->
        <link href="https://fonts.googleapis.com/css?family=Poppins:100,200,400,300,500,600,700" rel="stylesheet"> 
        <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
        <!--
        CSS
        ============================================= -->
        <link rel="stylesheet" href="{{ asset('restaurant/css/linearicons.css') }}">
        <link rel="stylesheet" href="{{ asset('restaurant/css/font-awesome.min.css') }}">
        
        <link rel="stylesheet" href="{{ asset('restaurant/css/magnific-popup.css') }}">
        <link rel="stylesheet" href="{{ asset('restaurant/css/nice-select.css') }}">					
        <link rel="stylesheet" href="{{ asset('restaurant/css/animate.min.css') }}">
        <link rel="stylesheet" href="{{ asset('restaurant/css/main.css') }}">
        <link rel="stylesheet" href="{{ asset('restaurant/css/custom.css') }}">


        @stack('after-styles')
    </head>
    <body>
        @include('includes.partials.logged-in-as')
        @include('frontend.includes.nav')

        <div class="app">
        @include('includes.partials.messages')
        @yield('content')
        </div>

        @include('frontend.includes.footer')
        <!-- Scripts -->
        @stack('before-scripts')
        {!! script(mix('js/manifest.js')) !!}
        {!! script(mix('js/vendor.js')) !!}
        {!! script(mix('js/frontend.js')) !!}
        		        
        <script src="{{ asset('restaurant/js/easing.min.js') }}"></script>			
        <script src="{{ asset('restaurant/js/hoverIntent.js') }}"></script>
        <script src="{{ asset('restaurant/js/superfish.min.js') }}"></script>	
        <script src="{{ asset('restaurant/js/jquery.ajaxchimp.min.js') }}"></script>
        <script src="{{ asset('restaurant/js/jquery.magnific-popup.min.js') }}"></script>	
        <script src="{{ asset('restaurant/js/jquery.sticky.js') }}"></script>
        <script src="{{ asset('restaurant/js/jquery.nice-select.min.js') }}"></script>			
        <script src="{{ asset('restaurant/js/parallax.min.js') }}"></script>	
        <script src="{{ asset('restaurant/js/mail-script.js') }}"></script>	
        <script src="{{ asset('restaurant/js/main.js') }}"></script>	

        @stack('after-scripts')

        @include('includes.partials.ga')
    </body>
</html>
