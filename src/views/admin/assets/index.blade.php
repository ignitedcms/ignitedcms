@extends('ignitedcms::admin.assets.layout')
@section('content')
    <div id="app" class="full-screen">
        @include('ignitedcms::admin.sidebar')
        <div class="main-content p-3" id="main-content">


            <drawer title="Help"></drawer>


            @if (session('status'))
                <div class="alert alert-success m-b-3">
                    {{ session('status') }}
                </div>
            @endif

            <div class="breadcrumb m-b-3">
                <div class="breadcrumb-item">
                    <a href="{{ url('admin/dashboard') }}">Dashboard</a>
                </div>
                <div class="breadcrumb-item">Assets</div>
            </div>

            <div class="row">
                <div class="col-12 right">
                   <a href="{{ url('admin/assets/create') }}">
                        <button type="button" class="btn btn-primary">New asset</button>
                    </a>
                </div>
            </div>
            <!--main part for section styles -->
            <div class="panel br drop-shadow p-b-5">

                <h3>Assets</h3>

                <table id="example" class="display" style="width:100%">
                    <thead>
                        <tr>
                            <th>Preview</th>
                            <th>handle</th>
                            <th>type</th>
                            <th>action</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($data as $field)
                            <tr>
                                <td> <img src="{{ $field->thumb }}"></img></td>
                                <td ><a href="{{ url('admin/assets/update', $field->id) }}">{{ $field->filename }}</a></td>
                                <td>{{ $field->kind }}</td>
                                <td>
                                    <span class="right">
                                        <tooltip link="delete">
                                            <form action="{{ url('/admin/assets/delete', $field->id) }}" method="POST">
                                                @csrf
                                                <button type="submit" class="btn  rm-btn-styles">Ok</button>
                                            </form>
                                        </tooltip>
                                    </span>
                                </td>
                            </tr>
                        @endforeach

                    </tbody>

                </table>

            </div>

        </div>
        <div class="gap"></div>
    </div>
@endsection
