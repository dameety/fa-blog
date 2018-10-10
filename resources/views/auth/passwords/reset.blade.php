@extends('auth.layouts.master')

@section('main-content')

    <div class="row">
        <div class="col col-login mx-auto">
            <div class="text-center mb-6">
                <img src="./demo/brand/tabler.svg" class="h-6" alt="">
            </div>
            <form class="card" method="POST" action="{{ route('password.request') }}">
                @csrf

                <input type="hidden" name="token" value="{{ $token }}">

                <div class="card-body p-6">
                    <div class="card-title">Reset Password</div>
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
                        </label>
                        <input type="password" class="form-control {{ $errors->has('password') ? ' is-invalid' : '' }}" id="password" name="password" required>
                        @if ($errors->has('password'))
                            <small class="form-text text-danger" role="alert"> {{ $errors->first('password') }} </small>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="password_confirmation" class="form-label">
                            Confirm Password
                        </label>
                        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
                    </div>
                    <div class="form-footer">
                        <button type="submit" class="btn btn-primary btn-block">
                            Reset Password
                        </button>
                    </div>
                </div>
            </form>
            <div class="text-center text-muted">
                Already have account? <a href="{{route('login')}}">Sign in</a>
            </div>
        </div>
    </div>

@endsection