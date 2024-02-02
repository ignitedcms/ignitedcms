@extends('ignitedcms::admin.dashboard.layout')
@section('content')
<div id="app" class="full-screen">
      <sidebar theme="light">
            <ul slot="header" class="rm-list-styles">

             @include('ignitedcms::admin.sidebar')
               
            </ul>

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
            <div class="p-4">
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
            <div class="p-4">
               <div class="text-danger">Error</div>
               <div class="text-danger small">
                  You much check at least ONE
                  field type.
               </div>
            </div>
         </toast>
      </div>
      @endif
   
      <alert variant="success">
         <alert-title>Information</alert-title>
            <alert-content>
            Restrict what type of files
            your end users can upload globally to your CMS for security

            </alert-content>
      </alert>
     
       <div class="mb-8"></div>

      <tabs class="panel">
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
                     <div class="form-group">
                        <button-component variant="primary">
                           Save
                        </button-component>
                     </div>
                  </div>
               </form>
            </div>
         </tab-item>
         <tab-item title="Site url settings">
             <form action="{{ url('admin/settings/saveSiteUrl') }} " method="POST">
                @csrf
            <div class="p-2">
               <div class="form-group">
                  <label for="title">Default site url</label>
                  <div class="small text-muted m-b">When you first load your site
                     it will point to this section as default
                  </div>
                  <select class="form-select" name="site_url" aria-label="Default select example">
                     @foreach ($data2 as $row)
                     <option value="{{ $row->name }}" @if ($row->name == $data3) selected @endif>{{ $row->name }}</option>
                     @endforeach
                  </select>
               </div>
               <div class="form-group right">
                  <button-component variant="primary">
                     Save
                  </button-component>
               </div>
            </div>
            </form>
         </tab-item>
      </tabs>
      <div class="gap"></div>
   </div>
 </sidebar>
</div>
@endsection
