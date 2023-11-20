@extends('admin.layout')

@section('content')
    <div class="full-screen v-a h-a bg-light-grey">
        <div class="container" id="app">
            <img class="img-responsive" src="{{ asset('admin/images/logo.svg') }}"></img>
            <div class="panel m-t-3 br drop-shadow text-center h-a v-a" style="height:150px; width:200px;">
                <a href="{{ url('installer/terms') }}">
                    <button type="button" class="btn btn-primary">Install</button>
                </a>
            </div>
        </div>
    </div>
@endsection
