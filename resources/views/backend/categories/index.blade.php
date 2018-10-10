@extends('backend.layouts.master')
@section('main-content')

    <div class="my-3 my-md-5">
        <div class="container">
            <div class="page-header">
                <h1 class="page-title">
                    Categories
                </h1>
            </div>

            <div class="row row-cards row-deck">
                <div class="col-12">

                    <categories-index></categories-index>

                </div>
            </div>

        </div>
    </div>

@endsection
