@extends('ignitedcms::admin.sections.layout')
@section('content')
<div id="app" class="full-screen">
        @include('ignitedcms::admin.sidebar')
        <div class="main-content p-3" id="main-content">

           <drawer title="Help">
              <div class="p-3">
                 <h4>Sections</h4>
                 <p class="text-muted">For more help please see</p>
                 <a href="https://www.ignitedcms.com/documentation/section-types" target="_blank">Sections</a>
              </div>
           </drawer>

            <div class="breadcrumb m-b-3">
                <div class="breadcrumb-item">
                    <a href="{{ url('admin/dashboard') }}">Dashboard</a>
                </div>
                <div class="breadcrumb-item">Site settings</div>
            </div>

            @if (session('status'))
                <div class="alert alert-success m-b-2">
                    {{ session('status') }}
                </div>
            @endif

            <div class="alert alert-success m-b-3">
               <div class="text-black">Information</div>
               <div class="text-muted">
                  Restrict what type of files
                  your end users can upload globally to your CMS for security
               </div>
            </div>
        
            <form action="{{ url('admin/settings/update') }} " method="POST">
               @csrf    
               <div class="panel br drop-shadow p-b-5">
                  Restrict allowed file types to (these settings are applied globally)


                  <div class="form-group">
                     @foreach ($data as $row)
                     <div>
                        <input type="checkbox" name="fileTypes[]" value="{{ $row->name }}" 
                           class="form-check-input" @if ($row->enabled) checked @endif>
                        <label for="the label">{{ $row->name }}</label> 
                        <span class="small tet-muted">[ {{ $row->extensions }} ] </span>
                     </div>
                     @endforeach
                  </div>   


                  <div class="form-group right">
                     <button type="submit" class="btn btn-primary">Save</button>
                  </div>

               </div>
            </form>
        </div>
    </div>
@endsection
