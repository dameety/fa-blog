@extends('backend.layouts.master')

@section('styles')
@endsection

@section('main-content')
    <div class="my-3 my-md-5">
        <div class="container">
            <div class="page-header">
                <h1 class="page-title">
                    Update Profile
                </h1>
            </div>

            <profile
                avatar="{{$avatar}}"
                user_prop="{{$user}}">
            </profile>

        </div>
    </div>
@endsection


@section('scripts')

@endsection
