@extends('ignitedcms::admin.dashboard.layout')
@section('content')
    <div id="app" class="full-screen">
        @include('ignitedcms::admin.sidebar')
        <div class="main-content p-3" id="main-content">
            <div class="breadcrumb m-b-3">

                <div class="breadcrumb-item">
                    <a href="{{ url('admin/dashboard') }}">Dashboard</a>
                </div>
                <div class="breadcrumb-item">
                    <a href="{{ url('admin/users') }}">Users</a>
                </div>

                <div class="breadcrumb-item">Update user</div>
            </div>

            <!--main part for section styles -->

            <div class="alert alert-info m-b-3">
               <div class="text-black">Information</div>
                <p class="text-muted small">
                    You are only allowed to update this users
                     permission role.
                </p>
            </div>

            <div class="panel br drop-shadow">
                <form action="{{ url("admin/users/update/$id") }} " method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="Email">Email</label>
                        <div class="small text-muted">[Disabled]</div>
                        <input class="form-control" name="email" value="{{ $email }}" placeholder="Start typing"
                            disabled />
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <div class="small text-muted">[Disabled]</div>
                        <input class="form-control" name="password" type="password" value="hidden" placeholder=""
                            disabled />
                    </div>
                    <div class="form-group">
                        <label for="role">Roles</label>
                        <div class="small text-muted">Select a role</div>
                        <select class="form-select" name="permissiongroup" aria-label="Default select example">
                            @foreach ($data as $row)
                                <option value="{{ $row->groupID }}" @if($permissionid == $row->groupID ) selected @endif>
                                 {{ $row->groupName }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group right">
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
@endsection
