@if ($paginator->hasPages())
    <div class="uk-card uk-card-default uk-card-body uk-width-1-2@l uk-width-1-1@s uk-align-center">

        <ul class="uk-pagination">
            @if ($paginator->onFirstPage())
                <li class="disabled">
                    <a href="#">
                        <span class="uk-margin-small-right" uk-pagination-previous></span>
                        Previous
                    </a>
                </li>
            @else
                <li >
                    <a href="{{ $paginator->previousPageUrl() }}" class="uk-text-primary">
                        <span class="uk-margin-small-right" uk-pagination-previous></span>
                        Previous
                    </a>
                </li>
            @endif


            {{-- }}Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li class="uk-margin-auto-left">
                    <a href="{{ $paginator->nextPageUrl() }}" class="uk-text-primary">
                        Next
                        <span class="uk-margin-small-left" uk-pagination-next></span>
                    </a>
                </li>
            @else
                <li class="uk-margin-auto-left disabled uk-text-primary">
                    <a href="#" >
                        Next <span class="uk-margin-small-left" uk-pagination-next></span>
                    </a>
                </li>
            @endif

        </ul>

    </div>
    @endif
