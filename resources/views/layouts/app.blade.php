<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="userId" content="{{ auth()->check() ? auth()->id() : ''}}">
    <meta name="description" content="">


    <title>{{ config('app.name', 'Laravel') }}</title>
	<!-- Favicons -->
	<link rel="shortcut icon" href="images/favicon.ico">
	<link rel="apple-touch-icon" href="images/icon.png">

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <!-- Google font (font-family: 'Roboto', sans-serif; Poppins ; Satisfy) -->
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Poppins:300,300i,400,400i,500,600,600i,700,700i,800" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
<!-- Stylesheets -->
    <link rel="stylesheet" href="{{asset('frontend/css/plugins.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/css/style.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/css/style.css')}}">
    <link href="{{ asset('frontend/js/bootstrap-fileinput/css/fileinput.min.css')}}" media="all" rel="stylesheet" type="text/css" />

	<!-- Modernizer js -->
    <script   src="{{asset('frontend/js/vendor/modernizr-3.5.0.min.js')}}" ></script>
    <script   src="{{asset('frontend/js/vendor/modernizr-3.5.0.min.js')}}" ></script>

    @yield('style')

</head>
<body>
    <div id="app">

        <div class="wrapper" id="wrapper">
            @include('partial.frontend.header')

        <main>
            @include('partial.flash')

            @yield('content')

        </main>

        @include('partial.frontend.footer')
    </div>
    </div>
    {{-- Scripts --}}
    <script src="{{ asset('js/app.js') }}"></script>
	<script  src="{{ asset('frontend/js/plugins.js') }}"></script>
	<script  src="{{ asset('frontend/js/active.js') }}"></script>
    <script  src="{{ asset('frontend/js/custome.js') }}"></script>

    <script src="{{ asset('frontend/js/bootstrap-fileinput/js/plugins/piexif.min.js') }}"></script>
    <script src="{{ asset('frontend/js/bootstrap-fileinput/js/plugins/sortable.min.js') }}"></script>
    <script src="{{ asset('frontend/js/bootstrap-fileinput/js/plugins/purify.min.js') }}"></script>

    <script src="{{ asset('frontend/js/bootstrap-fileinput/js/fileinput.min.js') }}"></script>
    <script src="{{ asset('frontend/js/bootstrap-fileinput/themes/fa/theme.js') }}"></script>



    @yield('script')
</body>
</html>
