@extends('ignitedcms::admin.chunks.layout')

@section('content')
    <div id="app" class="full-screen">

      <sidebar theme="light">
            <ul slot="header" class="rm-list-styles">

             @include('ignitedcms::admin.sidebar')
               
            </ul>


        <div class="main-content " id="main-content">

           

           <div class="p-3">

              <div class="breadcrumb m-b-3">
                 <div class="breadcrumb-item">
                    <a href="{{ url('admin/dashboard') }}">Dashboard</a>
                 </div>
                 <div class="breadcrumb-item">Large file uploader</div>
              </div>             

              <div class="alert alert-success">
                 <div class="text-black">Information</div>
                 <div class="small text-muted">
                    Upload large files here
                 </div>
              </div>
              <div class="m-b-3"></div>
              <div class="row panel br drop-shadow">
                 <div class="col">
                    <div class="form-group">
                       <h4>Large file uploader</h4>
                    </div>

                    <div class="form-group" id="file-input">
                       <input type="file" id="pickfiles" class="form-control">
                       <div id="filelist" class="m-t-2 m-b-2"></div>
                    </div>
                    <div class="progress">
                       <div id="progress" class="progress-bar-primary" role="progressbar" 
                           aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <div class="form-group">
                       <a id="upload" href="javascript:;" class="button">Upload file</a>
                    </div>

                 </div>
              </div>
           </div>
      </div>
      </sidebar>
   </div>
@endsection


        

