{{--<div class="card-body">--}}
    {{--<form method="POST" action="{{ route('register') }}">--}}
        {{--@csrf--}}

        {{--<div class="form-group row">--}}
            {{--<label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>--}}

            {{--<div class="col-md-6">--}}
                {{--<input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>--}}

                {{--@if ($errors->has('name'))--}}
                    {{--<span class="invalid-feedback" role="alert">--}}
                        {{--<strong>{{ $errors->first('name') }}</strong>--}}
                    {{--</span>--}}
                {{--@endif--}}
            {{--</div>--}}
        {{--</div>--}}

        {{--<div class="form-group row">--}}
            {{--<label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>--}}

            {{--<div class="col-md-6">--}}
                {{--<input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>--}}

                {{--@if ($errors->has('email'))--}}
                    {{--<span class="invalid-feedback" role="alert">--}}
                        {{--<strong>{{ $errors->first('email') }}</strong>--}}
                    {{--</span>--}}
                {{--@endif--}}
            {{--</div>--}}
        {{--</div>--}}

        {{--<div class="form-group row">--}}
            {{--<label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>--}}

            {{--<div class="col-md-6">--}}
                {{--<input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>--}}

                {{--@if ($errors->has('password'))--}}
                    {{--<span class="invalid-feedback" role="alert">--}}
                        {{--<strong>{{ $errors->first('password') }}</strong>--}}
                    {{--</span>--}}
                {{--@endif--}}
            {{--</div>--}}
        {{--</div>--}}

        {{--<div class="form-group row">--}}
            {{--<label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>--}}

            {{--<div class="col-md-6">--}}
                {{--<input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>--}}
            {{--</div>--}}
        {{--</div>--}}

        {{--<div class="form-group row mb-0">--}}
            {{--<div class="col-md-6 offset-md-4">--}}
                {{--<button type="submit" class="btn btn-primary">--}}
                    {{--{{ __('Register') }}--}}
                {{--</button>--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</form>--}}
</div>


@extends('auth.layouts.master')

@section('main-content')
    <div class="row">
        <div class="col col-login mx-auto">
            <div class="text-center mb-6">
                <img src="./demo/brand/tabler.svg" class="h-6" alt="">
            </div>
            <form class="card" method="POST" action="{{ route('password.request') }}" aria-label="{{ __('Reset Password') }}">
                @csrf

                <input type="hidden" name="token" value="{{ $token }}">

                <div class="card-body p-6">
                    <div class="card-title">Create new account</div>
                    <div class="form-group">
                        <label class="form-label">Name</label>
                        <input type="text" class="form-control" placeholder="Enter name">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Email address</label>
                        <input type="email" class="form-control" placeholder="Enter email">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Password</label>
                        <input type="password" class="form-control" placeholder="Password">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Password Confirmation</label>
                        <input type="password" class="form-control" name="password_confirmation" placeholder="Password">
                    </div>
                    <div class="form-group">
                        <label class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" />
                            <span class="custom-control-label">Agree the <a href="{{route('terms')}}">terms and policy</a></span>
                        </label>
                    </div>
                    <div class="form-footer">
                        <button type="submit" class="btn btn-primary btn-block">Create new account</button>
                    </div>
                </div>
            </form>
            <div class="text-center text-muted">
                Already have account? <a href="{{route('login')}}">Sign in</a>
            </div>
        </div>
    </div>
@endsection

