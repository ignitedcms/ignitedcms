@extends('ignitedcms::admin.layout')

@section('content')
<div class="v-a h-a v-screen h-screen bg-light-gray">
   <div class="default-container" id="app" v-cloak>
      
       <img src="{{ asset('admin/images/ignitedcms-logo.svg') }}" class="img-center " style="max-width:170px;"></img>
        <div class="panel mt-3 br drop-shadow text-center h-a v-a" style="height:150px; width:200px;">
            <a href="{{ url('installer/terms') }}">
                <button-component variant="primary">
                    Install
                </button-component>
            </a>
        </div>
    
   </div>
</div>
@endsection
