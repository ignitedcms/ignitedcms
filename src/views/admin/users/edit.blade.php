@extends('ignitedcms::admin.dashboard.layout')
@section('content')
    <div id="app" class="full-screen" v-cloak>
            <sidebar theme="light">
            <ul slot="header" class="rm-list-styles">

             @include('ignitedcms::admin.sidebar')
               
            </ul>

        <div class="main-content" id="main-content">

            <breadcrumb class="mt-4 mb-4">
               <breadcrumb-item title="Dashboard" url="{{ url('admin/dashboard') }}"></breadcrumb-item>
               <breadcrumb-item title="User" url="{{ url('admin/users') }}"></breadcrumb-item>
               <breadcrumb-item title="Update user" url=""></breadcrumb-item>
            </breadcrumb>


            <!--main part for section styles -->
            
            <alert variant="success">
               <alert-title>Information</alert-title>
                  <alert-content>
                    You are only allowed to update this users
                     permission role.
                  </alert-content>
            </alert>
            <div class="mb-4"></div>

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
                           <button-component variant="primary">
                              Save
                           </button-component>
                    </div>
                </form>
            </div>

        </div>
      </sidebar>
    </div>
@endsection
