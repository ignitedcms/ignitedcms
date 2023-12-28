@extends('ignitedcms::admin.dashboard.layout')
@section('content')
    <div class="full-screen" id="app">
        @include('ignitedcms::admin.sidebar')

        <div class="main-content p-3">
            
           <drawer title="Help">
              <div class="p-3">
                 <h4>Profile</h4>
                 <p class="text-muted">For more help please see</p>
                 <a href="https://www.ignitedcms.com/documentation/profile" target="_blank">Profile</a>
              </div>
           </drawer>

            <div class="breadcrumb m-b-3">
                <div class="breadcrumb-item">
                    <a href="{{ url('admin/dashboard') }}">Dashboard</a>
                </div>
                <div class="breadcrumb-item">
                    <a href="{{ url('admin/profile') }}">Profile</a>
                </div>
                <div class="breadcrumb-item">Password reset</div>
            </div>

            @if (session('status'))
                <div class="alert alert-success m-b-3">
                    {{ session('status') }}
                </div>
            @endif

            @if (session('errors'))
                <div class="alert alert-danger m-b-3">
                    Error
                   <div class="small">Failed</div>
                </div>
            @endif
            <div class="panel br drop-shadow">
                <form action="{{ url('admin/profile/password') }} " method="POST">
                    @csrf
                    <h3>Password</h3>
                    <div class="form-group">
                        <label for="title">Password</label>
                        <div class="small text-muted">Please enter a new password</div>
                        <input class="form-control m-t" type="password" name="password" value=""
                            placeholder="Start typing" />
                    
                         @error('password')
                            <div class="small text-danger"> {{ $message }} </div>
                         @enderror
                                             

                    </div>
                    
                    
                    <div class="form-group right">
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>

        </div>

    </div>
@endsection

