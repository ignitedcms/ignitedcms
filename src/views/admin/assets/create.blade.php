@extends('ignitedcms::admin.assets.layout')
@section('content')
    <div id="app" class="full-screen">
         <sidebar theme="light">
            <ul slot="header" class="rm-list-styles">

             @include('ignitedcms::admin.sidebar')
               
            </ul>


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


        <div class="main-content p-3" id="main-content">

            <form action="{{ url('admin/assets/create') }} " method="POST" 
               enctype="multipart/form-data">
                @csrf
               
               <breadcrumb class="mt-4 mb-4">
                  <breadcrumb-item title="Dashboard" url="{{ url('admin/dashboard') }}"></breadcrumb-item>
                  <breadcrumb-item title="Assets" url="{{ url('admin/assets') }}"></breadcrumb-item>
                  <breadcrumb-item title="Add new asset" url=""></breadcrumb-item>
               </breadcrumb>

                

                <!--main part for section styles -->
                <div class="panel">
                    <div class="row">
                        <div class="col">
                           <div>
                              <h3>Upload asset</h3>
                           </div>
                           <div class="form-group">
                              <label  for="upload">Upload</label>
                              <div class="small text-muted m-b">Make sure it is a suitable file</div>
                              
                              <file-upload name="file"> </file-upload>
                              @error('file')
                                 <div class="small text-danger m-t"> {{ $message }} </div>
                              @enderror
                           </div>
                        </div>
                    </div>
                    <div class="row">
                       <div class="col-12">
                           <button-component variant="primary">
                              Upload
                           </button-component>
                       </div>
                    </div>
                </div>
                

            </form>
        </div>
       </sidebar>
    </div>
@endsection
