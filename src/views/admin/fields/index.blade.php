@extends('ignitedcms::admin.fields.layout')
@section('content')
    <div id="app" class="full-screen">
      <sidebar theme="light">
            <ul slot="header" class="rm-list-styles">

             @include('ignitedcms::admin.sidebar')
               
            </ul>

        <div class="main-content p-3" id="main-content">

          <drawer title="Help">
              <div class="p-3">
                 <h4>Fields</h4>
                 <p class="text-muted">For more help please see</p>
                 <a href="https://www.ignitedcms.com/documentation/fields" target="_blank">Fields</a>
              </div>
           </drawer>

            <breadcrumb class="mt-4 mb-4">
               <breadcrumb-item title="Dashboard" url="{{ url('admin/dashboard') }}"></breadcrumb-item>
               <breadcrumb-item title="Fields" url=""></breadcrumb-item>
            </breadcrumb>

            
            
            <alert variant="success">
               <alert-title>Information</alert-title>
                  <alert-content>
                  Add new fields here
                  </alert-content>
            </alert>
            

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
                     @foreach ($errors->all() as $error)
                        {{ $error }}<br/>
                     @endforeach
                  </div>
               </div>
               </toast>

            </div>
                
            @endif


            <div class="row">
                <div class="col-12 right">
                    <a href="{{ url('admin/fields/create') }}">
                      <button-component variant="primary">
                         New field
                      </button-component>
                    </a>

                    <a href="{{ url('admin/matrix/create') }}">
                        <button-component variant="outline" class="ml-3">
                           New matrix
                        </button-component>
                    </a>
                </div>
            </div>
            <!--main part for section styles -->
            <div class="panel br drop-shadow p-b-5">

                <h3>Fields</h3>

                <table id="example" class="display" style="width:100%">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Handle</th>
                            <th>Type</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($data as $field)
                            <tr>
                                <td>{{ $field->id }}</td>
                                <td><a href="{{ url('admin/fields/update', $field->id) }}" class="underline">{{ $field->name }}</a></td>
                                <td>{{ $field->type }}</td>
                                <td>
                                    <span class="right">
                                        <popover link="Delete">
                                            <form action="{{ url('/admin/fields/delete', $field->id) }}" method="POST">
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
            <div class="gap"></div>
        </div>
      </sidebar>
    </div>
@endsection
