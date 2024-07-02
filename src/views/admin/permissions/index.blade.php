@extends('ignitedcms::admin.dashboard.layout')
@section('content')
    <div class="full-screen" id="app" v-cloak>
         <sidebar theme="light">
            <ul slot="header" class="rm-list-styles">

             @include('ignitedcms::admin.sidebar')
               
            </ul>

        <div class="main-content">

            <drawer title="Help">
              <div class="p-8">
                 <h4>Permissions</h4>
                 <p class="text-muted">For more help please see</p>
                 <a class="underline" href="https://www.ignitedcms.com/documentation/permissions" target="_blank">Permissions</a>
              </div>
           </drawer>

            <breadcrumb class="mt-4 mb-4">
               <breadcrumb-item title="Dashboard" url="{{ url('admin/dashboard') }}"></breadcrumb-item>
               <breadcrumb-item title="Permissions" url=""></breadcrumb-item>
            </breadcrumb>

            

            <alert variant="success">
               <alert-title>Information</alert-title>
                  <alert-content>
                  Add new permission groups, so you can
                  control what your users have visibility to 
                  on their dashboard
                  </alert-content>
            </alert>

            <div class="mb"></div>

            
                <div class="mt-4 mb-4">
                    <a href="{{ url('admin/permissions/create') }}">
                       <button-component variant="primary">
                           New Group
                       </button-component>
                    </a>
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

            @if (session('error'))
            <div class="toasts">
               <toast ref="toast">
               <div class="p-4">
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
                               <a href='{{ url("admin/permissions/update/$row->groupID") }}' class="underline">
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
