@extends('ignitedcms::admin.dashboard.layout')

@section('content')
    <div id="app" >
         
       <dark-mode>
       </dark-mode>

      <sidebar theme="light">
            <ul slot="header" class="rm-list-styles">

             @include('ignitedcms::admin.sidebar')
               
               
            </ul>
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
                        <h3>Updates</h3>
                        <p>Watch here for the latest updates</p>
                     </div>
                  </div>
                  <div class="col-6">
                     <div class="panel br drop-shadow" style="min-height:400px;">
                        <h3>Help</h3>
                        <p>For all the latest help</p>
                        <a href="https://www.ignitedcms.com" target="_blank">IgnitedCMS</a>
                     </div>
                  </div>
               </div>
                

            </div>
        </div>    
            
         </sidebar>


        
    </div>
@endsection
