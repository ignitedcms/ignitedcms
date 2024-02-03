@extends('ignitedcms::admin.assets.layout')
@section('content')
    <div id="app" class="full-screen">
      <sidebar theme="light">
            <ul slot="header" class="rm-list-styles">

             @include('ignitedcms::admin.sidebar')
               
            </ul>

        <div class="main-content p-3" id="main-content">


         <drawer title="Help">
              <div class="p-3">
                 <h4>Assets</h4>
                 <p class="text-muted">For more help please see</p>
                 <a href="https://www.ignitedcms.com/documentation/asset-library" target="_blank">Assets</a>
                 <br>
                 <a href="https://www.ignitedcms.com/documentation/file-uploads" target="_blank">File uploads</a>
              </div>
           </drawer>


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

            <breadcrumb class="mt-4 mb-4">
               <breadcrumb-item title="Dashboard" url="{{ url('admin/dashboard') }}"></breadcrumb-item>
               <breadcrumb-item title="Assets" url=""></breadcrumb-item>
            </breadcrumb>            
            

            

            <alert variant="success">
               <alert-title>Information</alert-title>
                  <alert-content>
                 Upload all your media here. 
                 Struggling to upload files greater than 10mb? Try
                 our large file <a href="{{ url('admin/chunking') }}" class="underline">uploader</a>
               
                  </alert-content>
            </alert>

            

            <div class="row">
                <div class="col-12">
                   <a href="{{ url('admin/assets/create') }}">
                        <button-component variant="outline">
                           New asset
                        </button-component>
                    </a>
                </div>
            </div>
            <!--main part for section styles -->
            <div class="panel br drop-shadow p-b-5">

                <h3>Assets</h3>

                <table id="example" class="display" style="width:100%">
                    <thead>
                        <tr>
                            <th>Preview</th>
                            <th>Handle</th>
                            <th>Type</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($data as $field)
                            <tr>
                            <td> 
                              @if($field->kind !="jpg" and $field->kind != "png" and $field->kind != "bmp" and $field->kind != "jpeg")
                                 <img src="{{ asset('admin/images/file.jpg') }}"></img>
                              @else
                              <img src="{{ $field->thumb }}"></img>
                              @endif
                            </td>
                                <td ><a href="{{ url('admin/assets/update', $field->id) }}" class="underline">{{ \Illuminate\Support\Str::limit($field->filename, 19, '...') }}</a></td>
                                <td>{{ $field->kind }}</td>
                                <td>
                                    <span class="right">
                                        <popover link="Delete">
                                            <form action="{{ url('/admin/assets/delete', $field->id) }}" method="POST">
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
        <div class="gap"></div>
    </div>
@endsection
