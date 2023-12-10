@extends('ignitedcms::admin.dashboard.layout')
@section('content')
    <div id="app" class="full-screen">
        @include('ignitedcms::admin.sidebar')
        <div class="main-content p-3" id="main-content">
            <div class="breadcrumb m-b-3">
                <div class="breadcrumb-item">
                    <a href="{{ url('admin/dashboard') }}">Dashboard</a>
                </div>
                <div class="breadcrumb-item">
                    <a href="{{ url('admin/permissions') }}">Permissions</a>
                </div>
                <div class="breadcrumb-item">Update existing group</div>
            </div>

            <!--main part for section styles -->
            <form action="{{ url("admin/permissions/update/$id") }} " method="POST">
               @csrf
               <div class="panel br drop-shadow">

                  <div class="form-group">
                     <label for="groupName">Group Name [*]</label>
                     <div class="small text-muted m-b">[Disabled]</div>
                     <input class="form-control" name="groupName" value="{{ $groupName }}" placeholder="Start typing" readonly />

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
                           class="form-check-input" {{ Helper::checkPermissions($row->permissionID, $map) }}>
                        <label for="the label">{{ $row->permission }}</label>
                     </div>
                     @endforeach


                  </div>

               </div>
               <div class="row">
                  <div class="col-12 right">
                     <button type="submit" class="m-l btn btn-primary">Update</button>
                  </div>
               </div>
            </form>

        </div>
    </div>
@endsection
