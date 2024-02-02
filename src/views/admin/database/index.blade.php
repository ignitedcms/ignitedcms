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
                 <h4>Database</h4>
                 <p class="text-muted">For more help please see</p>
                 <a href="https://www.ignitedcms.com/documentation/database" target="_blank">Database</a>
              </div>
           </drawer>

          <form action="{{ url('admin/database/backup') }} " method="POST">
             @csrf
            <div class="breadcrumb m-b-3">
                <div class="breadcrumb-item">
                    <a href="{{ url('admin/dashboard') }}">Dashboard</a>
                </div>
                <div class="breadcrumb-item">Database</div>
            </div>
            
            <alert variant="success">
               <alert-title>Information</alert-title>
                  <alert-content>
                  This handy function will export your
                  MySQL database. Please note this only
                  supports MySQL with limited functionality!

                  </alert-content>
            </alert>
            <div class="mb-8"></div>
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
