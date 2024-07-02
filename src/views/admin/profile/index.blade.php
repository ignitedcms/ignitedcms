@extends('ignitedcms::admin.dashboard.layout')
@section('content')
    <div class="full-screen" id="app" v-cloak>

      <sidebar theme="light">
            <ul slot="header" class="rm-list-styles">

             @include('ignitedcms::admin.sidebar')
               
            </ul>

        <div class="main-content">
            
           <drawer title="Help">
              <div class="p-8">
                 <h4>Profile</h4>
                 <p class="text-muted">For more help please see</p>
                 <a class="underline" href="https://www.ignitedcms.com/documentation/profile" target="_blank">Profile</a>
              </div>
           </drawer>

            <breadcrumb class="mt-4 mb-4">
               <breadcrumb-item title="Dashboard" url="{{ url('admin/dashboard') }}"></breadcrumb-item>
               <breadcrumb-item title="Profile" url=""></breadcrumb-item>
            </breadcrumb>

            

            <alert variant="success">
               <alert-title>Information</alert-title>
                  <alert-content>
                  Save your full name or change your password here
                  </alert-content>
            </alert>

            <div class="mb-4"></div>
            

            @if (session('status'))
            <div class="toasts">
               <toast ref="toast">
               <div class="p-4">
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

            <div class="panel br drop-shadow">
                <form action="{{ url('admin/profile/update') }} " method="POST">
                    @csrf
                    <h3 class="text-dark">Profile</h3>
                    <div class="form-group">
                        <label for="title" class="text-dark">Full name</label>
                        <div class="small text-muted text-dark">Please enter your full name</div>
                        <input class="form-control form-dark" name="fullname" value="{{ old('fullname', $data->fullname) }}"
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
                      <a href="{{ url('admin/profile/password') }}" class="underline">Reset my password?</a>
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
