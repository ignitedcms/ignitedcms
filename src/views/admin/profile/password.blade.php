@extends('ignitedcms::admin.dashboard.layout')
@section('content')
    <div class="full-screen" id="app">
      
      <sidebar theme="light">
            <ul slot="header" class="rm-list-styles">

             @include('ignitedcms::admin.sidebar')
               
            </ul>


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
                <form action="{{ url('admin/profile/password') }} " method="POST">
                    @csrf
                    <h3>Reset password</h3>
                    <div class="form-group">
                        <label for="title">Password</label>
                        <div class="small text-muted">Please enter a new password, make sure it is fairly strong</div>
                        <input class="form-control m-t" type="password" name="password" value=""
                            placeholder="Start typing" />
                    
                         @error('password')
                            <div class="small text-danger"> {{ $message }} </div>
                         @enderror
                                             

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

