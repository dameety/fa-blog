<div class="uk-container uk-container-medium">
    <nav class="uk-navbar-container bg-white" uk-navbar>

        <div class="uk-navbar-left">
            <ul class="uk-navbar-nav">
                <li>
                    <a href="#">
                        About
                    </a>
                </li>
            </ul>
        </div>


        <div class="uk-navbar-right">

            <ul class="uk-navbar-nav">
                <li class="uk-active">
                    <a href="{{ Setting::get('facebook') }}">
                        <i class="fa fa-facebook"></i>
                    </a>
                </li>
                <li class="uk-active">
                    <a href="{{ Setting::get('twitter') }}">
                        <i class="fa fa-twitter"></i>
                    </a>
                </li>
                <li class="uk-active">
                    <a href="{{ Setting::get('google_plus')  }}">
                        <i class="fa fa-google-plus"></i>
                    </a>
                </li>
            </ul>

        </div>

    </nav>
</div>