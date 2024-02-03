@extends('ignitedcms::admin.dashboard.layout')
@section('content')
    <div id="app" class="full-screen">
      <sidebar theme="light">
            <ul slot="header" class="rm-list-styles">

             @include('ignitedcms::admin.sidebar')
               
            </ul>

        <div class="main-content p-3" id="main-content">
           
             <breadcrumb class="mb-3 mt-3">
                <breadcrumb-item title="Dashboard" url="{{ url('admin/dashboard') }}"></breadcrumb-item>
                <breadcrumb-item title="Permissions" url="{{ url('admin/permissions') }}"></breadcrumb-item>
                <breadcrumb-item title="Update existing group" url=""></breadcrumb-item>
             </breadcrumb>

            

            <!--main part for section styles -->
            <form action="{{ url("admin/permissions/update/$id") }} " method="POST">
               @csrf
               <div class="panel br drop-shadow">

                  <div class="form-group">
                     <label for="groupName">Group Name [*]</label>
                     <div class="small text-muted m-b">[Disabled]</div>
                     <input class="form-control" name="groupName" value="{{ $groupName }}" 
                        placeholder="Start typing" disabled />

                  </div>

                  <div class="divider"></div>
                  <div class="form-group">

                     <label for="permissions">Permissions</label>
                     <div class="small text-muted">Pick what things they will 
                        see in their dashboard you must have at least one box checked!</div>
                     @error('boxes')
                        <div class="small text-danger"> {{ $message }} </div>
                     @enderror                     
                     
                     @foreach ($data as $row)
                     <div> 
                        <input type="checkbox" name="boxes[]"   value="{{ $row->permissionID }}" 
                           class="form-check-input" {{ checkPermissions($row->permissionID, $map) }}>
                        <label for="the label">{{ $row->permission }}</label>
                     </div>
                     @endforeach


                  </div>
                  <div class="row">
                     <div class="col-12 ">
                        <button-component variant="primary">
                           Update
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
