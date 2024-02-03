@extends('ignitedcms::admin.dashboard.layout')
@section('content')
    <div id="app" class="full-screen">
       <sidebar theme="light">
            <ul slot="header" class="rm-list-styles">

             @include('ignitedcms::admin.sidebar')
               
            </ul>

        <div class="main-content p-3" id="main-content">

         <drawer title="Help">
              <div class="p-3">
                 <h4>Sections</h4>
                 <p class="text-muted">For more help please see</p>
                 <a href="https://www.ignitedcms.com/documentation/section-types" target="_blank">Sections</a>
              </div>
           </drawer>

            <breadcrumb class="mt-4 mb-4">
               <breadcrumb-item title="Dashboard" url="{{ url('admin/dashboard') }}"></breadcrumb-item>
               <breadcrumb-item title="Sections" url=""></breadcrumb-item>
            </breadcrumb>

            

            <alert variant="success">
               <alert-title>Information</alert-title>
                  <alert-content>
                  Add new section types, (single, multiple,global)
                  here
                  </alert-content>
            </alert>
             <div class="mb-4"></div>

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

            @if(count($fields) > 0)

            <div class="row">
                <div class="col-12 right">
                    <a href="{{ url('admin/section/create') }}">
                        <button-component variant="primary">
                           New section
                        </button-component>
                    </a>
                </div>
            </div>
            @else
            <div class="row">
               <div class="col m-b-3">
                  <a href="{{ url('admin/fields') }}" class="underline">You need to create a field first!</a>
               </div>
            </div>
            @endif

            <!--main part for section styles -->
            <div class="panel br drop-shadow p-b-5">

                <h3>Sections</h3>

                <table id="example" class="display" style="width:100%">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Title</th>
                            <th>Type</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $section)
                            <tr>
                                <td>{{ $section->id }}</td>
                                <td><a href="{{ url('admin/section/update', $section->id) }}" class="underline">{{ $section->name }}</a></td>

                                <td>{{ $section->sectiontype }}</td>
                                <td>
                                    <span class="right">
                                        <popover link="Delete">

                                            <form action="{{ url('/admin/section/delete', $section->id) }}" method="POST">
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
