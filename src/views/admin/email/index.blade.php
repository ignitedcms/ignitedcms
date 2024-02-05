@extends('ignitedcms::admin.dashboard.layout')
@section('content')
    <div class="full-screen" id="app">
      <sidebar theme="light">
            <ul slot="header" class="rm-list-styles">

             @include('ignitedcms::admin.sidebar')
               
            </ul>


        <div class="main-content p-3">
            
           <drawer title="Help">
              <div class="p-8">
                 <h4>Email</h4>
                 <p class="text-muted">For more help please see</p>
                 <a class="underline" href="https://www.ignitedcms.com/documentation/email" target="_blank">Email</a>
              </div>
           </drawer>


            <breadcrumb class="mt-4 mb-4">
               <breadcrumb-item title="Dashboard" url="{{ url('admin/dashboard') }}"></breadcrumb-item>
               <breadcrumb-item title="Email" url=""></breadcrumb-item>
            </breadcrumb>
            

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

            <alert variant="success">
               <alert-title>Information</alert-title>
                  <alert-content>
                  Test if your email configuration is setup correctly
                  with your preferred email service provider.

                  You will need to edit your email setting in the
                  .env file. If you don't receive an email in your
                  inbox you need to tweak your settings.

                  </alert-content>
            </alert>
            
            <div class="mb-8"></div>

            <div class="panel ">

               <div class="row">
                  <div class="col no-margin">
                     <h4>Email</h4>
                  </div>
               </div>
                <form action="{{ url('admin/email/send') }} " method="POST">
                   @csrf
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
                  <div class="col">
                      <button-component variant="primary">
                         Send
                      </button-component>
                  </div>
               </div>
               </form>

            </div>

        </div>
      </sidebar>
    </div>
@endsection

