<div id="categories" class="uk-card uk-width-1-1">
    <div class="uk-card-header uk-padding-remove-horizontal">
        <h5 class="about-heading uk-heading-line uk-text-center post-share">
            <span>Categories</span>
        </h5>
    </div>
    <div class="uk-card-body uk-padding-small uk-text-left uk-text-small uk-padding-remove-horizontal">
        <ul class="uk-list uk-list-divider">

            @foreach($categories as $category)
                
                <li>
                    <div class="uk-flex uk-flex-between">
                        <a href="{{route('categories.posts', $category->slug)}}">
                            <p class="uk-margin-remove">
                                {{$category->name}}
                            </p>
                        </a>
                        <p class="uk-margin-remove">
                            {{$category->count}}
                        </p>
                    </div>
                </li>
                {{--<li>--}}
                    {{--<div class="uk-flex uk-flex-between">--}}
                        {{--<p class="uk-margin-remove">List item 1</p>--}}
                        {{--<p class="uk-margin-remove">(29)</p>--}}
                    {{--</div>--}}
                {{--</li>--}}
                {{--<li>--}}
                    {{--<div class="uk-flex uk-flex-between">--}}
                        {{--<p class="uk-margin-remove">List item 1</p>--}}
                        {{--<p class="uk-margin-remove">(29)</p>--}}
                    {{--</div>--}}
                {{--</li>--}}
                {{--<li>--}}
                    {{--<div class="uk-flex uk-flex-between">--}}
                        {{--<p class="uk-margin-remove">List item 1</p>--}}
                        {{--<p class="uk-margin-remove">(29)</p>--}}
                    {{--</div>--}}
                {{--</li>--}}

            @endforeach
        </ul>
    </div>
</div>