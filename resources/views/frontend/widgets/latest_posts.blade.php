<div id="latest_posts" style="z-index: 980;"
     uk-sticky="bottom: #footer">
    <div class="uk-card-header uk-padding-remove-horizontal uk-padding-remove-bottom">
        <h5 class="sub-heading uk-heading-line uk-text-center">
            <span>Latest Posts</span>
        </h5>
    </div>
    @foreach($latestPosts as $post)

        <div class="uk-card uk-card-defadult uk-grid-collapse uk-width-1-1@m uk-margin" uk-grid>
            <div class="uk-card-media-left uk-width-auto uk-cover-container">
                {{--<img src="{{ Voyager::image( $post->image ) }}" alt="" uk-cover>--}}
                <img src="{{asset('/img/construction.jpeg')}}" alt="" uk-cover>
                <canvas width="100" height="100"></canvas>
            </div>
            <div class="uk-width-expand uk-padding-small uk-padding-remove-top">
                <a href="{{route('posts.show', $post->slug)}}">
                    <h5 class="heading uk-margin-remove-bottom">
                        {{$post->title}}
                    </h5>
                    <p class="uk-margin-remove-top date">
                       On {{ \Carbon\Carbon::parse($post->created_at)->toFormattedDateString() }}
                    </p>
                </a>
            </div>
        </div>

    @endforeach
</div>