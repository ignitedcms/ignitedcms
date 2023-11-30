@extends('ignitedcms::admin.matrix.layout')
@section('content')
    <div class="full-screen" id="app">
        @include('ignitedcms::admin.sidebar')
        <div class="main-content p-3">
            <form action="{{ url('admin/matrix/create') }}" method="POST">
                @csrf

                <div class="breadcrumb m-b-3">
                    <div class="breadcrumb-item">
                        <a href="{{ url('admin/dashboard') }}">Dashboard</a>
                    </div>
                    <div class="breadcrumb-item">
                        <a href="{{ url('admin/fields') }}">Fields</a>
                    </div>
                    <div class="breadcrumb-item">Create matrix</div>
                </div>
                <!--main part for section styles -->
                <div class="panel br drop-shadow">
                   le matrix
                </div>

                <div class="row">
                    <div class="col-12 right">
                        <button type="submit" class="btn btn-white">Save matrix</button>
                    </div>
                </div>

                <div class="gap"></div>
                <!--end main part-->

            </form>
        </div>
    </div>
@endsection
