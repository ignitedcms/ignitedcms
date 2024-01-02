@extends('ignitedcms::admin.fields.layout')
@section('content')
    <div id="app" class="full-screen">
        @include('ignitedcms::admin.sidebar')
        <div class="main-content p-3" id="main-content">

          <drawer title="Help">
              <div class="p-3">
                 <h4>Fields</h4>
                 <p class="text-muted">For more help please see</p>
                 <a href="https://www.ignitedcms.com/documentation/fields" target="_blank">Fields</a>
              </div>
           </drawer>

            <div class="breadcrumb m-b-3">
                <div class="breadcrumb-item">
                    <a href="{{ url('admin/dashboard') }}">Dashboard</a>
                </div>
                <div class="breadcrumb-item">Fields</div>
            </div>

            @if (session('status'))
                <div class="alert alert-success m-b-3">
                    {{ session('status') }}
                </div>
            @endif


            <div class="row">
                <div class="col-12 right">
                    <a href="{{ url('admin/fields/create') }}">
                        <button type="button" class="btn btn-primary">New field</button>
                    </a>

                    <a href="{{ url('admin/matrix/create') }}">
                        <button type="button" class="btn btn-white m-l-2">New matrix</button>
                    </a>
                </div>
            </div>
            <!--main part for section styles -->
            <div class="panel br drop-shadow p-b-5">

                <h3>Fields</h3>

                <table id="example" class="display" style="width:100%">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Handle</th>
                            <th>Type</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($data as $field)
                            <tr>
                                <td>{{ $field->id }}</td>
                                <td><a href="{{ url('admin/fields/update', $field->id) }}">{{ $field->name }}</a></td>
                                <td>{{ $field->type }}</td>
                                <td>
                                    <span class="right">
                                        <popover link="Delete">
                                            <form action="{{ url('/admin/fields/delete', $field->id) }}" method="POST">
                                                @csrf
                                                <button type="submit" class="btn  rm-btn-styles">Ok</button>
                                            </form>
                                        </popover>
                                    </span>
                                </td>
                            </tr>
                        @endforeach

                    </tbody>

                </table>

            </div>
            <div class="gap"></div>
        </div>
    </div>
@endsection
