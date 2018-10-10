@extends('frontend.layouts.category_posts')

@section('hr-content') {{--used on show page--}}
    <hr>
@endsection

@section('main-content')

    <div class="uk-align-center">
        <h4 class="uk-text-center">
            Showing Posts in: {{$category->name}}
        </h4>
    </div>

    <div class="uk-child-width-1-3@m uk-grid-matsch uk-grid">
        @foreach($posts as $post)

            <div>
                <div class="uk-card uk-card-default uk-margin-bottom">
                    <div class="uk-card-media-top">
                        <img src="{{ $post->getFirstMediaUrl() }}" alt="{{$post->slug}}" style="width:100%">
                    </div>
                    <div class="uk-card-body">
                        <h3 class="uk-card-title">
                            {{$post->title}}
                        </h3>
                        <p>{{$post->created_at->toFormattedDateString()}} | {{$post->reading_duration}}</p>

                        <a href="{{route('posts.show', $post->slug)}}"
                           class="uk-button uk-button-primary uk-button-small">
                            Read more
                        </a>
                    </div>
                </div>
            </div>

        @endforeach

        {{ $posts->links('vendor.pagination.simple-default') }}
    </div>

@endsection