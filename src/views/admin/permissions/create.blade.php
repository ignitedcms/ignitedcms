@extends('ignitedcms::admin.dashboard.layout')
@section('content')
    <div id="app" class="full-screen" v-cloak>
        <sidebar theme="light">
            <ul slot="header" class="rm-list-styles">

             @include('ignitedcms::admin.sidebar')
               
            </ul>

        <div class="main-content" id="main-content">
            
            <breadcrumb class="mt-4 mb-4">
               <breadcrumb-item title="Dashboard" url="{{ url('admin/dashboard') }}"></breadcrumb-item>
               <breadcrumb-item title="Permissions" url="{{ url('admin/permissions') }}"></breadcrumb-item>
               <breadcrumb-item title="Add new group" url=""></breadcrumb-item>
            </breadcrumb>

            

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
                     @foreach ($errors->all() as $error)
                        {{ $error }}<br/>
                     @endforeach
                  </div>
               </div>
               </toast>

            </div>
                
            @endif




            <!--main part for section styles -->
            <form action="{{ url('admin/permissions/create') }} " method="POST">
               @csrf
               <div class="panel br drop-shadow">

                  <div class="form-group">
                     <label for="groupName">Group Name [*]</label>
                     <div class="small text-muted m-b">Suitable name, no spaces or special characters allowed, eg bloggers
                     </div>
                     <input class="form-control" name="groupName" value="{{ old('groupName') }}" placeholder="Start typing" />
                     @error('groupName')
                        <div class="small text-danger"> {{ $message }} </div>
                     @enderror

                  </div>

                  <div class="divider"></div>
                  <div class="form-group">
            
                     <label for="permissions">Permissions</label>
                     <div class="small text-muted">Pick what things they will see in their dashboard
                        please make sure you have at least one box checked!</div>
                     
                     @error('boxes')
                        <div class="small text-danger"> {{ $message }} </div>
                     @enderror


                     @foreach ($data as $row)
                     <div> 
                        <input type="checkbox" name="boxes[]"   value="{{ $row->permissionID }}" class="form-check-input">
                        <label for="the label" class="ml-2">{{ $row->permission }}</label>
                     </div>
                     @endforeach


                  </div>
                  <div class="row">
                     <div class="col-12">
                           <button-component variant="primary">
                              Save
                           </button-component>
                     </div>
                  </div>
               </div>
               
            </form>

        <div class="gap"></div>
        </div>
        </sidebar>
    </div>
@endsection
