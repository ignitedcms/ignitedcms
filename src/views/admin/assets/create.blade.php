@extends('ignitedcms::admin.fields.layout')
@section('content')
    <div id="app" class="full-screen">
        @include('ignitedcms::admin.sidebar')
        <div class="main-content p-3" id="main-content">
            <form action="{{ url('admin/fields/create') }}" method="POST">
                @csrf
                <div class="breadcrumb m-b-3">
                    <div class="breadcrumb-item">
                        <a href="{{ url('admin/dashboard') }}">Dashboard</a>
                    </div>
                    <div class="breadcrumb-item">
                        <a href="{{ url('admin/fields') }}">Asset</a>
                    </div>
                    <div class="breadcrumb-item">Add new asset</div>
                </div>

                <!--main part for section styles -->
                <div class="panel br drop-shadow">
                    <div class="row">
                        <div class="col">
                           fjdkslfd
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 right">
                        <button type="submit" class="m-l btn btn-primary">Save</button>
                    </div>
                </div>

            </form>
        </div>
    </div>
@endsection
