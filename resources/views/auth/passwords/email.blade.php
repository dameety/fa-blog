@extends('auth.layouts.master')

@section('main-content')
    <div class="row">
        <div class="col col-login mx-auto">
            <div class="text-center mb-6">
                <img src="./demo/brand/tabler.svg" class="h-6" alt="">
            </div>
            <form class="card" method="POST" action="{{ route('password.email') }}">
                @csrf
                <div class="card-body p-6">
                    <div class="card-title">Forgot password</div>
                    <p class="text-muted">Enter your email address and your password will be reset and emailed to you.</p>
                    <div class="form-group">
                        <label for="email" class="form-label">Email address</label>
                        <input type="email" class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}" id="email" aria-describedby="email" name="email" value="{{ old('email') }}" required autofocus>
                        @if ($errors->has('email'))
                            <small class="form-text text-danger" role="alert"> {{ $errors->first('email') }} </small>
                        @endif
                    </div>
                    <div class="form-footer">
                        <button type="submit" class="btn btn-primary btn-block">
                            Send me new password
                        </button>
                    </div>
                </div>
            </form>
            <div class="text-center text-muted">
                Forget it, <a href="{{route('login')}}">send me back</a> to the sign in screen.
            </div>
        </div>
    </div>
@endsection