@extends('backend.layouts.master')
@section('main-content')

    <div class="my-3 my-md-5">
        <div class="container">
            <div class="page-header">
                <h1 class="page-title">
                    Edit Category
                </h1>
            </div>

            <add-edit-category
                type="edit"
                category_prop="{{$category}}">
            </add-edit-category>

        </div>
    </div>

@endsection

@section('scripts')

@endsection