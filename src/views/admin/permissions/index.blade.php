@extends('ignitedcms::admin.dashboard.layout')
@section('content')
    <div class="full-screen" id="app">
        @include('ignitedcms::admin.sidebar')

        <div class="main-content p-3">

            <drawer title="Help"></drawer>

            <div class="breadcrumb m-b-3">
                <div class="breadcrumb-item">
                    <a href="{{ url('admin/dashboard') }}">Dashboard</a>
                </div>
                <div class="breadcrumb-item">Permissions</div>
            </div>

            <div class="row">
                <div class="col-12 right">
                    <a href="{{ url('admin/permissions/create') }}">
                        <button type="button" class="btn btn-primary">New Group</button>
                    </a>
                </div>
            </div>

            @if (session('status'))
                <div class="alert alert-success m-b-3">
                    {{ session('status') }}
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger m-b-3">
                    {{ session('error') }}
                </div>
            @endif

            <div class="panel br drop-shadow">

                <h3>Permissions</h3>

                <table id="example" class="display" style="width:100%">
                    <thead>
                        <tr>
                            <th>id</th>
                            <th>Name</th>
                            <th>Handle</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                     @foreach ($data as $row)
                        <tr>
                            <td>{{ $row->groupID }}</td>
                            <td>
                               <a href='{{ url("admin/permissions/update/$row->groupID") }}'>
                              {{ $row->groupName }}
                              </a>
                           </td>
                            <td>...</td>
                            <td>
                               <span class="right">
                                  <tooltip link="Delete">
                                  <form action="{{ url('/admin/permissions/delete', $row->groupID) }}" method="POST">
                                     @csrf
                                     <button type="submit" class="btn  rm-btn-styles">ok</button>
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

    </div>
@endsection
