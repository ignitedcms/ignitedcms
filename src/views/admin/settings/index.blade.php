@extends('ignitedcms::admin.dashboard.layout')
@section('content')
<div id="app" class="full-screen">
   @include('ignitedcms::admin.sidebar')
   <div class="main-content p-3" id="main-content">
      <drawer title="Help">
         <div class="p-3">
            <h4>Sections</h4>
            <p class="text-muted">For more help please see</p>
            <a href="https://www.ignitedcms.com/documentation/site-settings" target="_blank">Settings</a>
         </div>
      </drawer>
      <div class="breadcrumb m-b-3">
         <div class="breadcrumb-item">
            <a href="{{ url('admin/dashboard') }}">Dashboard</a>
         </div>
         <div class="breadcrumb-item">Site settings</div>
      </div>
      @if (session('status'))
      <div class="toasts">
         <toast ref="toast">
            <div class="p-2">
               <div class="text-black">Success</div>
               <div class="text-muted small">
                  {{ session('status') }}
               </div>
            </div>
         </toast>
      </div>
      @endif
      @if (session('errors'))
      <div class="toasts">
         <toast ref="toast">
            <div class="p-2">
               <div class="text-danger">Error</div>
               <div class="text-danger small">
                  You much check at least ONE
                  field type.
               </div>
            </div>
         </toast>
      </div>
      @endif
      <div class="alert alert-success m-b-3">
         <div class="text-black">Information</div>
         <div class="text-muted small">
            Restrict what type of files
            your end users can upload globally to your CMS for security
         </div>
      </div>
      <tabs class="panel br">
         <tab-item title="Asset settings">
            <div class="p-2">
               <form action="{{ url('admin/settings/update') }} " method="POST">
                  @csrf
                  <div class="">
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
         </tab-item>
         <tab-item title="Site url settings">
            <div class="p-2">
               <div class="form-group">
                  <label for="title">Default site url</label>
                  <div class="small text-muted m-b">When you first load your site
                     it will point to this section as default
                  </div>
                  <select class="form-select" name="site_url" aria-label="Default select example">
                     @foreach ($data2 as $row)
                     <option value="{{ $row->id }}">{{ $row->name }}</option>
                     @endforeach
                  </select>
               </div>
               <div class="form-group right">
                  <button type="submit" class="btn btn-primary">Save</button>
               </div>
            </div>
         </tab-item>
      </tabs>
      <div class="gap"></div>
   </div>
</div>
@endsection
