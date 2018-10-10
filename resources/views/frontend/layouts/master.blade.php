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

    @widget('FrontendHeadScripts')
</head>
<body>

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

@yield('slider-content')

@yield('trending-content')


<div  class="uk-section uk-padding-remove-top">
    <div class="uk-container uk-container-medium">
        <div class="uk-grid">
            {{--blog post section--}}
            <div id="left_section" class="uk-width-2-3">

                @yield('main-content')

            </div>

            <div id="right-section" class="uk-width-1-3">
                <div class="uk-card">
                    <div class="uk-card-header uk-padding-remove-top uk-padding-remove-horizontal">
                        <h5 class="about-heading uk-heading-line uk-text-center post-share">
                            <span>About Blog</span>
                        </h5>
                    </div>
                    <div class="uk-card-media-top">
                        <img src="{{asset('/img/construction.jpeg')}}">
                    </div>
                    <div class="uk-card-body uk-padding-small uk-text-left uk-text-small uk-padding-remove-horizontal">
                        <p class="info">
                            Kreuzberg Apartment to talk with him about his career and his influences.
                            In his award-winning
                            thesis work, a photo series titled “Leuchtpunktordnungen"
                        </p>
                    </div>
                </div>

                @widget('CategoriesCount')

                @widget('LatestPosts')

            </div>
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



<script src="{{asset('/frontend/js/uikit.min.js')}}"></script>

</body>
</html>
