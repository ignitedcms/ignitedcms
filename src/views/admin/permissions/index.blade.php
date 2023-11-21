@extends('admin.dashboard.layout')
@section('content')
    <div class="full-screen" id="app">
        @include('admin.sidebar')

        <div class="main-content p-3">
            <div class="breadcrumb m-b-3">
                <div class="breadcrumb-item">
                    <a href="">Dashboard</a>
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
                        <tr>
                            <td>1</td>
                            <td>Administrators</td>
                            <td>...</td>
                            <td><a href="#">delete</a></td>
                        </tr>
                        <tr>
                            <td>fds</td>
                            <td>fds</td>
                            <td>fds</td>
                            <td>fds</td>
                        </tr>
                        <tr>
                            <td>fds</td>
                            <td>fds</td>
                            <td>fds</td>
                            <td>fds</td>
                        </tr>
                        <tr>
                            <td>fds</td>
                            <td>fds</td>
                            <td>fds</td>
                            <td>fds</td>
                        </tr>
                        <tr>
                            <td>fds</td>
                            <td>fds</td>
                            <td>fds</td>
                            <td>fds</td>
                        </tr>
                    </tbody>

                </table>
            </div>

        </div>

    </div>
@endsection
