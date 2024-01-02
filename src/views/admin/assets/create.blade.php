@extends('ignitedcms::admin.assets.layout')
@section('content')
    <div id="app" class="full-screen">
        @include('ignitedcms::admin.sidebar')
        <div class="main-content p-3" id="main-content">

            <form action="{{ url('admin/assets/create') }} " method="POST" 
               enctype="multipart/form-data">
                @csrf
                <div class="breadcrumb m-b-3">
                    <div class="breadcrumb-item">
                        <a href="{{ url('admin/dashboard') }}">Dashboard</a>
                    </div>
                    <div class="breadcrumb-item">
                        <a href="{{ url('admin/assets') }}">Asset</a>
                    </div>
                    <div class="breadcrumb-item">Add new asset</div>
                </div>

                <!--main part for section styles -->
                <div class="panel br drop-shadow">
                    <div class="row">
                        <div class="col">
                           <div class="form-group">
                              <h3>Upload asset</h3>
                           </div>
                           <div class="form-group">
                              <label  for="upload">Upload</label>
                              <div class="small text-muted m-b">Make sure it is a suitable file</div>
                              
                              <file-upload name="file"> </file-upload>
                              @error('file')
                                 <div class="small text-danger"> {{ $message }} </div>
                              @enderror
                           </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 right">
                        <button type="submit" 
                           class="m-l btn btn-primary">Upload</button>
                    </div>
                </div>

            </form>
        </div>
    </div>
@endsection
