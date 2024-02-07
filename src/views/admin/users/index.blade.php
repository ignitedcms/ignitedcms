@extends('ignitedcms::admin.dashboard.layout')
@section('content')
    <div class="full-screen" id="app">

      <sidebar theme="light">
            <ul slot="header" class="rm-list-styles">

             @include('ignitedcms::admin.sidebar')
               
            </ul>

        <div class="p-3">

           <drawer title="Help">
           <div class="p-8">
              <h4>Users</h4>
              <p class="text-muted">For more help please see</p>
              <a class="underline" href="https://www.ignitedcms.com/documentation/users" target="_blank">Users</a>
           </div>
           </drawer>

            <breadcrumb class="mt-4 mb-4">
               <breadcrumb-item title="Dashboard" url="{{ url('admin/dashboard') }}"></breadcrumb-item>
               <breadcrumb-item title="Users" url=""></breadcrumb-item>
            </breadcrumb>

           

            <alert variant="success">
               <alert-title>Information</alert-title>
                  <alert-content>
                   Create new users and assign their roles
                  </alert-content>
            </alert>
           

           
              <div class="mt-4 mb-4">
                 <a href="{{ url('admin/users/create') }}">
                     <button-component variant="primary">
                        New user
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

           <div class="panel ">

              <h3>Users</h3>

              <table id="example" class="display" style="width:100%">
                 <thead>
                    <tr>
                       <th>Id</th>
                       <th>Email</th>
                       <th>Roles</th>
                       <th>Action</th>
                    </tr>
                 </thead>
                 <tbody>
                    @foreach ($data as $user)
                    <tr>
                       <td>{{ $user->id }}</td>
                       <td>
                          <a href="{{ url("admin/users/update/$user->id") }}" class="underline">
                             {{ $user->email }}
                          </a>

                       </td>
                       <td> {{ $user->groupName }}</td>
                       <td>
                          <span class="right">
                             <popover link="Delete">
                             <form action="{{ url('admin/users/delete', $user->id) }}" method="POST">
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
