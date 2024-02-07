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
                 <h4>Database</h4>
                 <p class="text-muted">For more help please see</p>
                 <a class="underline"  href="https://www.ignitedcms.com/documentation/database" target="_blank">Database</a>
              </div>
           </drawer>

          <form action="{{ url('admin/database/backup') }} " method="POST">
             @csrf
            
            <breadcrumb class="mt-4 mb-4">
               <breadcrumb-item title="Dashboard" url="{{ url('admin/dashboard') }}"></breadcrumb-item>
               <breadcrumb-item title="Database" url=""></breadcrumb-item>
            </breadcrumb>

            
            
            <alert variant="success">
               <alert-title>Information</alert-title>
                  <alert-content>
                  This handy function will export your
                  MySQL database. Please note this only
                  supports MySQL with limited functionality!

                  </alert-content>
            </alert>
            <div class="mb-4"></div>
            <div class="panel">
                <h3>Database utility</h3>

                <div class="form-group">
                    <a href="#">
                        <button-component variant="primary">
                           Backup
                        </button-component>
                    </a>
                </div>
            </div>
            </form>
        </div>
      </sidebar>
    </div>
@endsection
