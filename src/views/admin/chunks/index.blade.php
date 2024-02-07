@extends('ignitedcms::admin.chunks.layout')

@section('content')
    <div id="app" class="full-screen">

      <sidebar theme="light">
            <ul slot="header" class="rm-list-styles">

             @include('ignitedcms::admin.sidebar')
               
            </ul>


        <div class="main-content" id="main-content">

           

           <div>

            <breadcrumb class="mt-4 mb-4">
               <breadcrumb-item title="Dashboard" url="{{ url('admin/dashboard') }}"></breadcrumb-item>
               <breadcrumb-item title="Large file uploader" url=""></breadcrumb-item>
            </breadcrumb>
               
               <alert variant="success">
                  <alert-title>Information</alert-title>
                     <alert-content>
                      Upload large files here
                     </alert-content>
               </alert>

               <div class="mb-4"></div>              
              <div class="row panel br drop-shadow">
                 <div class="col">
                    <div class="form-group">
                       <h4>Large file uploader</h4>
                    </div>

                    <div class="form-group" id="file-input">
                       <input type="file" id="pickfiles" class="form-control">
                       <div id="filelist" class="m-t-2 m-b-2"></div>
                    </div>
                    <div class="progress mt-8">
                       <div id="progress" class="progress-bar-primary" role="progressbar" 
                           aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <div class="form-group">
                       <a id="upload" href="javascript:;" class="button btn-white">Upload file</a>
                    </div>

                 </div>
              </div>
           </div>
      </div>
      </sidebar>
   </div>
@endsection


        

