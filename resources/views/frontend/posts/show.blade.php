@extends('frontend.layouts.master')

@section('hr-content') {{--used on show page--}}
    <hr>
@endsection

@section('main-content')

    <div id="single_page" class="uk-section uk-padding-remove-top">
        <div class="uk-container uk-container-medium">


            <div class="uk-width-1-1">
                <ul class="uk-flex-center uk-list uk-list-large uk-list-bullet uk-flex uk-text-uppercase post-meta">
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

                <div class="uk-padding-remove-top uk-text-center">
                    <h2 class="post-title"> {{$post->title}} </h2>
                    <hr class="uk-divider-small">
                </div>

                <div>
                    <img src="{{ $post->getFirstMediaUrl() }}" style="width:100%">
                </div>

                <div class="excerpt">
                    {{$post->excerpt}}
                </div>
                <div class="excerpt">
                    {!! $post->body !!}
                </div>

                <p>
                    <span class="uk-text-bold">Artical tags:</span>
                    <span class="uk-text-meta">{{$post->meta_keywords}}</span>
                </p>

                <div class="uk-text-center">
                    <div class="uk-width-1-2 uk-align-center">
                        <p class="uk-heading-line uk-text-center post-share">
                            <span>Share this article</span>
                        </p>
                    </div>

                    <a href="#" class="fa fa-facebook"></a>
                    <a href="#" class="fa fa-twitter"></a>
                    <a href="#" class="fa fa-google-plus"></a>
                </div>
            </div>


            <div class="uk-card uk-padding uk-background-muted uk-grid-collapse uk-width-1-1@m uk-margin" uk-grid>
                <div class="uk-card-media-left uk-width-auto uk-cover-container">
                    <img class="round uk-width-1-1" src="{{ $post->author->avatar() }}" alt="" uk-cover>
                    <canvas width="150" height="150"></canvas>
                </div>
                <div class="uk-width-expand uk-padding-small uk-padding-remove-top">
                    <h3 class="heading uk-margin-remove-bottom">
                        {{$post->author->name}}
                    </h3>
                    <p class="uk-margin-remove-top date">
                        {{$post->author->bio}}
                    </p>
                </div>
            </div>


        </div>
    </div>

@endsection