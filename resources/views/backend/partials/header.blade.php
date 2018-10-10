<div class="header py-4">
    <div class="container">
        <div class="d-flex">
            <a class="header-brand" href="{{url('/backend')}}">
                <img src="{{asset('/demo/brand/tabler.svg')}}" class="header-brand-img" alt="tabler logo">
            </a>
            <div class="d-flex order-lg-2 ml-auto">
                <div class="dropdown">
                    <a href="#" class="nav-link pr-0 leading-none" data-toggle="dropdown">
                        <span class="avatar" style="background-image: url( {{auth()->user()->avatar()}} )"></span>
                            <span class="ml-2 d-none d-lg-block">
                            <span class="text-default">{{auth()->user()->first_name}}</span>
                            <small class="text-muted d-block mt-1">Administrator</small>
                        </span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                        <a class="dropdown-item" href="{{route('backend.profile')}}">
                            <i class="dropdown-icon fe fe-user"></i> Profile
                        </a>
                        <a class="dropdown-item" href="{{route('backend.settings')}}">
                            <i class="dropdown-icon fe fe-settings"></i> Settings
                        </a>
                        <a class="dropdown-item" href="{{route('logout')}}">
                            <i class="dropdown-icon fe fe-log-out"></i> Sign out
                        </a>
                    </div>
                </div>
            </div>
            <a href="#" class="header-toggler d-lg-none ml-3 ml-lg-0"
               data-toggle="collapse" data-target="#headerMenuCollapse">
                <span class="header-toggler-icon"></span>
            </a>
        </div>
    </div>
</div>

<div class="header collapse d-lg-flex p-0" id="headerMenuCollapse">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-3 ml-auto">
                <form class="input-icon my-3 my-lg-0">
                    <input type="search" class="form-control header-search" placeholder="Search&hellip;" tabindex="1">
                    <div class="input-icon-addon">
                        <i class="fe fe-search"></i>
                    </div>
                </form>
            </div>
            <div class="col-lg order-lg-first">
                <ul class="nav nav-tabs border-0 flex-column flex-lg-row">
                    <li class="nav-item">
                        <a href="./index.html" class="nav-link active"><i class="fe fe-home"></i> Home </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a href="javascript:void(0)" class="nav-link" data-toggle="dropdown"><i class="fe fe-calendar"></i> Posts </a>
                        <div class="dropdown-menu dropdown-menu-arrow">
                            <a href="{{route('backend.posts.index')}}" class="dropdown-item ">All Posts</a>
                            <a href="{{route('backend.posts.create')}}" class="dropdown-item ">Create New</a>
                            <a href="{{route('backend.posts.deleted')}}" class="dropdown-item ">Deleted</a>
                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a href="javascript:void(0)" class="nav-link" data-toggle="dropdown"><i class="fe fe-calendar"></i> Categories </a>
                        <div class="dropdown-menu dropdown-menu-arrow">
                            <a href="{{route('backend.categories.index')}}" class="dropdown-item ">All Categories</a>
                            <a href="{{route('backend.categories.create')}}" class="dropdown-item ">Create New</a>
                            <a href="{{route('backend.categories.deleted')}}" class="dropdown-item ">Deleted</a>
                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a href="{{route('backend.subscribers.index')}}" class="nav-link">
                            <i class="fe fe-check-square"></i> Subscribers
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>