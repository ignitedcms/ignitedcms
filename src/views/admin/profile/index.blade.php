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
                <div class="breadcrumb-item">Profile</div>
            </div>

            @if (session('status'))
            <div class="toasts">
               <toast ref="toast">
               <div class="p-2">
                  <div class="text-black">Success</div>
                  <div class="text-muted small">
                     {{ session('status') }}
                  </div>
               </div>
               </toast>

            </div>
                
            @endif

            @if (session('errors'))
            <div class="toasts">
               <toast ref="toast">
               <div class="p-2">
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

            <div class="panel br drop-shadow">
                <form action="{{ url('admin/profile/update') }} " method="POST">
                    @csrf
                    <h3>Profile</h3>
                    <div class="form-group">
                        <label for="title">Full name</label>
                        <div class="small text-muted">Please enter your full name</div>
                        <input class="form-control" name="fullname" value="{{ old('fullname', $data->fullname) }}"
                            placeholder="Start typing" />
                        @error('fullname')
                            <div class="small text-danger">{{ $message }}</div>
                        @enderror

                    </div>
                    <div class="form-group">
                        <label for="title">Email</label>
                        <div class="small text-muted">Current email address, [you cannot change this]</div>
                        <input class="form-control" name="email" value="{{ old('email', $data->email) }}"
                            placeholder="Start typing" disabled />
                    </div>
                    <div class="form-group">
                      <a href="{{ url('admin/profile/password') }}">Reset my password?</a>
                    </div>
                    <div class="form-group right">
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>

        </div>

    </div>
@endsection
