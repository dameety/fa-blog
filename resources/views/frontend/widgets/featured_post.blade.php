<div class="uk-container uk-container-medium uk-margin-bottom">
    <h1 id="heading" class="uk-heading-line uk-text-center">
        <span>Featured Posts</span>
    </h1>
</div>


<div class="uk-container uk-container-medium">

    <div class="uk-grid-small uk-child-width-1-3@s uk-grid">
        @foreach($featuredPosts as $post)
            <div>
                <div class="uk-card">
                    <div class="uk-card-media-top uk-margin uk-height-medium uk-cover-container">
                        <img src="{{ $post->getFirstMediaUrl() }}" alt="" uk-cover>
                        <div class="uk-position-large uk-position-cover uk-overlay uk-overlay-default uk-flex uk-flex-middle">
                            <a href="{{route('posts.show', $post->slug)}}">
                                <h3 class="uk-background-secondarwy">
                                    {{$post->title}}
                                </h3>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <hr>
</div>