@extends('layouts.app')

@section('content')
    @include('partials.page-header')

    <div class="page-single">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="page-content">
                        {!! $page->content !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
