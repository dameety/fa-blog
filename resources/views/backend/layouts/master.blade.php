<!doctype html>
<html lang="{{ app()->getLocale() }}" dir="ltr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="Content-Language" content="en" />
    <meta name="msapplication-TileColor" content="#2d89ef">
    <meta name="theme-color" content="#4188c9">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent"/>
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="HandheldFriendly" content="True">
    <meta name="MobileOptimized" content="320">

    <meta name="csrf-token" content="{{ csrf_token() }}"/>

    <link rel="icon" href="./favicon.ico" type="image/x-icon"/>
    <link rel="shortcut icon" type="image/x-icon" href="./favicon.ico" />
    <title> Admin </title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,300i,400,400i,500,500i,600,600i,700,700i&amp;subset=latin-ext">

    <link href="{{asset('assets/css/dashboard.css')}}" rel="stylesheet" />
    <link href="{{asset('css/backend.css')}}" rel="stylesheet" />

    @yield('styles')

    <script src="{{asset('assets/js/require.min.js')}}"></script>
    <script>
        requirejs.config({
            baseUrl: '{{asset('/')}}'
        });
    </script>

    <script src="{{asset('assets/js/dashboard.js')}}"></script>
    {{--<script src="{{asset('assets/plugins/input-mask/plugin.js')}}"></script>--}}

    <!-- c3.js Charts Plugin -->
    {{--<link href="./assets/plugins/charts-c3/plugin.css" rel="stylesheet" />--}}
    {{--<script src="./assets/plugins/charts-c3/plugin.js"></script>--}}
    <!-- Google Maps Plugin -->
    {{--<link href="./assets/plugins/maps-google/plugin.css" rel="stylesheet" />--}}
    {{--<script src="./assets/plugins/maps-google/plugin.js"></script>--}}
</head>

<body>
    <div id="app" class="page">
        <div class="page-main">
            @include('backend.partials.header')

            @yield('main-content')

        </div>
        @include('backend.partials.footer')

        @if (session('success'))
            <alert-success message="{{ session('success') }}"></alert-success>
        @endif
        @if (session('error'))
            <alert-error message="{{ session('error') }}"></alert-error>
        @endif
    </div>

    <script src="{{asset('js/app.js') }}"></script>


    @yield('scripts')
</body>

</html>