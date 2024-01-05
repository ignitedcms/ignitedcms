@extends('ignitedcms::admin.dashboard.layout')
@section('content')
    <div class="full-screen" id="app">
        @include('ignitedcms::admin.sidebar')

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
            <div class="alert alert-success">
               <div class="text-black">Information</div>
               <div class="small text-muted">

                  This handy function will export your
                  MySQL database. Please note this only
                  supports MySQL with limited functionality!
               </div>
            </div>
            <div class="panel br drop-shadow m-t-3">
                <h3>Database utility</h3>

                <div class="form-group right">
                    <a href="#">
                        <button type="submit" class="btn btn-primary">Backup</button>
                    </a>
                </div>
            </div>
            </form>
        </div>

    </div>
@endsection
