@extends('ignitedcms::admin.dashboard.layout')
@section('content')
    <div class="full-screen" id="app">
        @include('ignitedcms::admin.sidebar')

        <div class="main-content p-3">

           <drawer title="Help">
              <div class="p-3">
                 <h4>Users</h4>
                 <p class="text-muted">For more help please see</p>
                 <a href="https://www.ignitedcms.com/documentation/users" target="_blank">Users</a>
              </div>
           </drawer>

            <div class="breadcrumb m-b-3">
                <div class="breadcrumb-item">
                    <a href="{{ url('admin/dashboard') }}">Dashboard</a>
                </div>
                <div class="breadcrumb-item">Users</div>
            </div>

            <div class="row">
                <div class="col-12 right">
                    <a href="{{ url('admin/users/create') }}">
                        <button type="button" class="btn btn-primary">New User</button>
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

                <h3>Users</h3>

                <table id="example" class="display" style="width:100%">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Email</th>
                            <th>Roles</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $user)
                            <tr>
                                <td>{{ $user->id }}</td>
                                <td>
                                    <a href="{{ url("admin/users/update/$user->id") }}">
                                        {{ $user->email }}
                                    </a>

                                </td>
                                <td> {{ $user->groupName }}</td>
                                <td>
                                    <span class="right">
                                        <tooltip link="Delete">
                                            <form action="{{ url('admin/users/delete', $user->id) }}" method="POST">
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

    </div>
@endsection
