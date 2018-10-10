@extends('auth.layouts.master')

@section('main-content')
    <div class="row">
        <div class="col col-login mx-auto">
            <div class="text-center mb-6">
                <img src="./demo/brand/tabler.svg" class="h-6" alt="">
            </div>
            <form class="card" method="POST" action="{{ route('login') }}">
                @csrf
                <div class="card-body p-6">
                    <div class="card-title">Login to your account</div>
                    <div class="form-group">
                        <label for="email" class="form-label">Email address</label>
                        <input type="email" class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}" id="email" aria-describedby="email" name="email" value="{{ old('email') }}" required autofocus>
                        @if ($errors->has('email'))
                            <small class="form-text text-danger" role="alert"> {{ $errors->first('email') }} </small>
                        @endif
                    </div>
                    <div class="form-group">
                        <label class="form-label">
                            Password
                            <a href="{{route('password.request')}}" class="float-right small">I forgot password</a>
                        </label>
                        <input type="password" class="form-control {{ $errors->has('password') ? ' is-invalid' : '' }}" id="password" name="password" required>
                        @if ($errors->has('password'))
                            <small class="form-text text-danger" role="alert"> {{ $errors->first('password') }} </small>
                        @endif
                    </div>
                    <div class="form-group">
                        <label class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" />
                            <span class="custom-control-label">Remember me</span>
                        </label>
                    </div>
                    <div class="form-footer">
                        <button type="submit" class="btn btn-primary btn-block">Sign in</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
