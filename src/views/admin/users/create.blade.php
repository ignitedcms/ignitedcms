@extends('ignitedcms::admin.dashboard.layout')
@section('content')
    <div id="app" class="full-screen">
      <sidebar theme="light">
            <ul slot="header" class="rm-list-styles">

             @include('ignitedcms::admin.sidebar')
               
            </ul>

        <div class="main-content p-3" id="main-content">

           <breadcrumb class="mt-4 mb-4">
               <breadcrumb-item title="Dashboard" url="{{ url('admin/dashboard') }}"></breadcrumb-item>
               <breadcrumb-item title="Users" url="{{ url('admin/users') }}"></breadcrumb-item>
               <breadcrumb-item title="create new user" url=""></breadcrumb-item>
            </breadcrumb>


            

            @if (session('status'))
                <div class="alert alert-danger m-b-3">
                    {{ session('status') }}
                </div>
            @endif
   
            @if (session('errors'))
            <div class="toasts">
               <toast ref="toast">
               <div class="p-4">
                  <div class="text-danger">Error</div>
                  <div class="text-danger small">
                     @foreach ($errors->all() as $error)
                        {{ $error }}<br/>
                     @endforeach
                  </div>
               </div>
               </toast>

            </div>
                
            @endif


            <!--main part for section styles -->
            <div class="panel br drop-shadow">
                <form action="{{ url('admin/users/create') }} " method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="Email">Email</label>
                        <div class="small text-muted">Enter a valid email address they have access to</div>
                        <input class="form-control" name="email" value="{{ old('email') }}" placeholder="Start typing" />
                        @error('email')
                            <div class="small text-danger">{{ $message }}</div>
                        @enderror

                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <div class="small text-muted">Make sure it is a strong</div>
                        <input class="form-control" name="password" type="password" value=""
                            placeholder="Start typing" />
                        @error('password')
                            <div class="small text-danger">{{ $message }}</div>
                        @enderror

                    </div>
                    <div class="form-group">
                        <label for="role">Roles</label>
                        <div class="small text-muted">Select a role</div>
                        <select class="form-select" name="permissiongroup" aria-label="Default select example">
                            @foreach ($data as $row)
                                <option value="{{ $row->groupID }}">{{ $row->groupName }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group right">
                        <button-component variant="primary">
                           Create new user
                        </button-component>
                    </div>
                </form>
            </div>

        </div>
      </sidebar>
    </div>
@endsection
