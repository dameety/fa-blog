<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="csrf-token" content="{{ csrf_token() }}"/>

    <title> Falive - 3 </title>

    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Playfair+Display:400,700,900" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
    <link rel="stylesheet" href="{{asset('/frontend/css/uikit.min.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/css/frontend.css')}}">

</head>
<body>

<div id="app">

    <div id="top_bar_container" class="uk-background-default">
        @include('frontend.partials.top_bar')
    </div>

    <div id="page-heading" class="uk-section uk-padding-remove-bottom uk-text-center">
        <div class="uk-container uk-container-medium">

            <h1 class="uk-text-bold">
                <a href="{{ url('/') }}">
                    Falive
                </a>
            </h1>

        </div>
    </div>


    @yield('hr-content') {{--used on show page--}}

    <div  class="uk-section uk-padding-remove-top">
        <div class="uk-container uk-container-medium">
            <div class="uk-grid">

                @yield('main-content')

            </div>
        </div>
    </div>


    @include('frontend.partials.newsletter')


    <div id="footer" class="uk-section uk-section-secondary uk-padding-small uk-light">
        <div class="uk-container uk-container-medium uk-grid">

            <div class="uk-width-1-3">
                <h3 class="uk-heading">
                    Falive
                </h3>
            </div>

            <div class="uk-width-2-3 uk-flex uk-flex-right">
                <ul class="uk-list uk-list-large uk-flex">
                    <li class="uk-margin-remove-top uk-padding-tiny">
                        Terms and conditions
                    </li>
                    <li class="uk-margin-remove-top uk-padding-tiny">
                        Cookie Statement
                    </li>
                    <li class="uk-margin-remove-top uk-padding-tiny">
                        Privacy Policy
                    </li>
                    <li class="uk-margin-remove-top uk-padding-tiny">
                        Contact
                    </li>
                    <li class="uk-margin-remove uk-padding-tiny">
                        Privacy
                    </li>
                </ul>
            </div>


        </div>
    </div>


</div>

<script src="{{asset('/frontend/js/uikit.min.js')}}"></script>
<script src="{{asset('js/app.js')}}"></script>

</body>
</html>
