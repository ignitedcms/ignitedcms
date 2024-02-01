@extends('ignitedcms::admin.layout')

@section('content')
<div class="v-a h-a v-screen h-screen bg-light-gray">
   <div class="container" id="app">
      
       <img src="{{ asset('admin/images/ignitedcms-logo.svg') }}" class="img-center " style="max-width:170px;"></img>
        <div class="panel m-t-3 br drop-shadow text-center h-a v-a" style="height:150px; width:200px;">
            <a href="{{ url('installer/terms') }}">
                <button type="button" class="btn btn-primary">Install</button>
            </a>
        </div>
    
   </div>
</div>
@endsection
