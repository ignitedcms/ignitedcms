@extends('ignitedcms::admin.dashboard.layout')

@section('content')
    <div id="app" class="full-screen">

        @include('ignitedcms::admin.sidebar')

        <div class="main-content " id="main-content">
            <!--dashboard underneath-->
            <div class="p-3">
               <div class="row">
                  <div class="col">
                     <h3>Dashboard</h3>
                  </div>
               </div>
               <div class="row">
                  <div class="col-6">
                     <div class="panel br drop-shadow" style="min-height:400px;">
                        <h3>Update</h3>
                        <p>Watch here for the latest updates</p>
                     </div>
                  </div>
                  <div class="col-6">
                     <div class="panel br drop-shadow" style="min-height:300px;">
                        <h3>Help</h3>
                        <p>For all the latest help</p>
                     </div>
                  </div>
               </div>
                

            </div>
        </div>
    </div>
@endsection
