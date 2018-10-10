@extends('frontend.layouts.master')

@section('slider-content')
    <div id="slider" class="uk-section uk-padding-remove-bottom">
        <div class="uk-container uk-container-medium">

            <div class="uk-position-relative uk-visible-toggle uk-light" uk-slideshow>
                <ul class="uk-slideshow-items">

                    @foreach($sliders as $slider)

                    <li>
                        <img src="{{$slider->getFirstMediaUrl()}}" alt="" uk-cover>
                        <div id="slider_content" class="uk-position-center uk-position-small uk-text-center uk-light uk-width-1-2">
                            <a href="{{route('posts.show', $slider->slug)}}">
                                <h1 class="uk-margin-remove uk-text-bold">
                                    {{$slider->title}}
                                </h1>
                                <p class="uk-margin-remove">
                                    {{$slider->excerpt}}
                                </p>
                            </a>
                        </div>
                    </li>

                    @endforeach
                </ul>

                <a class="uk-position-center-left uk-position-small uk-hidden-hover" href="#" uk-slidenav-previous uk-slideshow-item="previous"></a>
                <a class="uk-position-center-right uk-position-small uk-hidden-hover" href="#" uk-slidenav-next uk-slideshow-item="next"></a>

            </div>

        </div>
    </div>
@endsection


@section('trending-content')
    <div id="trending" class="uk-section">
        @widget('FeaturedPost')
    </div>
@endsection


@section('main-content')

    @foreach($posts as $post)

        <div class="uk-card uk-width-1-1">
            <div class="uk-card-header uk-flex uk-flex-center uk-flex-around">
                <ul class="uk-list uk-list-lassrge uk-list-bssullet uk-flex uk-text-uppercase post-meta">
                    <li class="uk-padding-tiny">
                        by {{$post->author->name }}
                    </li>
                    <li class="uk-margin-remove-top uk-padding-tiny">
                        {{ \Carbon\Carbon::parse($post->created_at)->toFormattedDateString() }}
                    </li>
                    <li class="uk-margin-remove-top uk-padding-tiny">

                        @foreach($post->categories as $category)
                            In {{$category->name }}
                        @endforeach

                    </li>
                </ul>
            </div>
            <div class="uk-card-body uk-padding-remove-top uk-text-center">
                <h2 class="post-title"> {{$post->title}} </h2>
                <hr class="uk-divider-small">
            </div>
            <div class="uk-card-media-top">
                <img src="{{ $post->getFirstMediaUrl() }}" alt="" style="width:100%">
            </div>
            <div class="uk-card-body uk-text-center excerpt">
                <p>
                    {{ $post->excerpt }}
                </p>
                <a href="{{route('posts.show', $post->slug)}}" class="uk-button uk-button-primary">
                    Read more
                </a>
            </div>
            <div class="uk-card-footer uk-text-center">
                <div class="uk-width-1-2 uk-align-center">
                    <p class="uk-heading-line uk-text-center post-share">
                        <span>Share this article</span>
                    </p>
                </div>
                <a href="#" class="fa fa-facebook"></a>
                <a href="#" class="fa fa-twitter"></a>
                <a href="#" class="fa fa-google-plus"></a>
            </div>
            <hr>
        </div>

    @endforeach

    {{ $posts->links('vendor.pagination.simple-default') }}

@endsection