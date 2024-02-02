@extends('ignitedcms::admin.dashboard.layout')
@section('content')
    <div class="full-screen" id="app">
         <sidebar theme="light">
            <ul slot="header" class="rm-list-styles">

             @include('ignitedcms::admin.sidebar')
               
            </ul>

        <div class="main-content p-3">

            <drawer title="Help">
              <div class="p-3">
                 <h4>Permissions</h4>
                 <p class="text-muted">For more help please see</p>
                 <a href="https://www.ignitedcms.com/documentation/permissions" target="_blank">Permissions</a>
              </div>
           </drawer>

            <div class="breadcrumb m-b-3">
                <div class="breadcrumb-item">
                    <a href="{{ url('admin/dashboard') }}">Dashboard</a>
                </div>
                <div class="breadcrumb-item">Permissions</div>
            </div>

            <div class="alert alert-success m-b-3">
               <div class="text-black">Information</div>
               <div class="text-muted small">
                  Add new permission groups, so you can
                  control what your users have visibility to 
                  on their dashboard

               </div>
            </div>

            <div class="row">
                <div class="col-12 right">
                    <a href="{{ url('admin/permissions/create') }}">
                        <button type="button" class="btn btn-primary">New Group</button>
                    </a>
                </div>
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

            @if (session('error'))
            <div class="toasts">
               <toast ref="toast">
               <div class="p-2">
                  <div class="text-danger">Error</div>
                  <div class="text-danger small">
                        {{ session('error') }}
                  </div>
               </div>
               </toast>

            </div>
                
            @endif

            <div class="panel br drop-shadow">

                <h3>Permissions</h3>

                <table id="example" class="display" style="width:100%">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Name</th>
                            <th>Handle</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                     @foreach ($data as $row)
                        <tr>
                            <td>{{ $row->groupID }}</td>
                            <td>
                               <a href='{{ url("admin/permissions/update/$row->groupID") }}'>
                              {{ $row->groupName }}
                              </a>
                           </td>
                            <td>...</td>
                            <td>
                               <span class="right">
                                  <popover link="Delete">
                                  <form action="{{ url('/admin/permissions/delete', $row->groupID) }}" method="POST">
                                     @csrf
                                     <button type="submit" class="btn  rm-btn-styles">Ok</button>
                                  </form>
                                  </popover>
                               </span>

                            </td>
                        </tr>
                     @endforeach
                        
                        
                    </tbody>

                </table>
            </div>

        </div>
       </sidebar>
    </div>
@endsection
