@extends('ignitedcms::admin.layout')

@section('content')
<div class="full-screen v-a h-a bg-light-grey">
   <div class="container" id="app">
      <div class="panel m-t-3 br drop-shadow" style="height:200px; width:300px;">
         <div class="srow">
            <div class="col-12 h-a">
               <img class="img-responsive" width="200px;" src="{{ asset('admin/images/ignitedcms-logo.svg') }}"></img>

            </div>
            
            <div class="col-12 text-center">
               <a href="{{ url('installer/terms') }}">
                  <button type="button" class="btn btn-primary btn-block ">Install</button>
               </a>
            </div>
            
            
         </div>

      </div>
   </div>
</div>
@endsection
