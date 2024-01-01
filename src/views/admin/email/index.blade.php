@extends('ignitedcms::admin.dashboard.layout')
@section('content')
    <div class="full-screen" id="app">
        @include('ignitedcms::admin.sidebar')

        <div class="main-content p-3">
            
           <drawer title="Help">
              <div class="p-3">
                 <h4>Profile</h4>
                 <p class="text-muted">For more help please see</p>
                 <a href="https://www.ignitedcms.com/documentation/email" target="_blank">Email</a>
              </div>
           </drawer>

            <div class="breadcrumb m-b-3">
                <div class="breadcrumb-item">
                    <a href="{{ url('admin/dashboard') }}">Dashboard</a>
                </div>
                <div class="breadcrumb-item">Email</div>
            </div>

            @if (session('status'))
                <div class="alert alert-success m-b-3">
                    {{ session('status') }}
                </div>
            @endif

            <div class="alert alert-success">
               <div class="text-black">Information</div>
               <div class="small text-muted">
                  Test if your email configuration is setup correctly.

                  You will need to edit your email setting in the
                  .env file. If you don't receive an email in your
                  inbox you need to tweak your settings.
               </div>
            </div>
            <div class="m-b-3"></div>

            <div class="panel br drop-shadow">

               <div class="row">
                  <div class="col">
                     <h4>Email</h4>
                  </div>
               </div>
               <div class="row">
                  <div class="col">
                     <label for="email">Email</label>
                     <div class="small text-muted">Send a test email</div>
                     <input class="form-control" 
                           name="email" 
                           value="" 
                           placeholder="A valid email address" />
                  </div>
               </div>
               <div class="row">
                  <div class="col right">
                     <button type="submit" class="btn btn-primary">Send</button>
                  </div>
               </div>

            </div>

        </div>

    </div>
@endsection

