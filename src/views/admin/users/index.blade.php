@extends('ignitedcms::admin.dashboard.layout')
@section('content')
    <div class="full-screen" id="app">
        @include('ignitedcms::admin.sidebar')

        <div class="main-content p-3">
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

            <div class="panel br drop-shadow">

                <h3>Users</h3>

                <table id="example" class="display" style="width:100%">
                    <thead>
                        <tr>
                            <th>id</th>
                            <th>Email</th>
                            <th>Roles</th>
                            <th>action</th>
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
                                        <tooltip link="delete">
                                            <form action="{{ url('admin/users/delete', $user->id) }}" method="POST">
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
