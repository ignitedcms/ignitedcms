@extends('ignitedcms::admin.assets.layout')
@section('content')
    <div id="app" class="full-screen">
        @include('ignitedcms::admin.sidebar')
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
                <div class="alert alert-success m-b-3">
                    {{ session('status') }}
                </div>
            @endif

            

            <div class="breadcrumb m-b-3">
                <div class="breadcrumb-item">
                    <a href="{{ url('admin/dashboard') }}">Dashboard</a>
                </div>
                <div class="breadcrumb-item">Assets</div>
            </div>

            <div class="alert alert-info">
               <p>Struggling to upload a large file greater than 5mb? Use 
               our large asset file <a href="#">uploader</a></p>
            </div>

            <div class="row">
                <div class="col-12 right">
                   <a href="{{ url('admin/assets/create') }}">
                        <button type="button" class="btn btn-primary">New asset</button>
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
                                <td ><a href="{{ url('admin/assets/update', $field->id) }}">{{ $field->filename }}</a></td>
                                <td>{{ $field->kind }}</td>
                                <td>
                                    <span class="right">
                                        <tooltip link="Delete">
                                            <form action="{{ url('/admin/assets/delete', $field->id) }}" method="POST">
                                                @csrf
                                                <button type="submit" class="btn  rm-btn-styles">Ok</button>
                                            </form>
                                        </tooltip>
                                    </span>
                                </td>
                            </tr>
                        @endforeach

                    </tbody>

                </table>

            </div>

        </div>
        <div class="gap"></div>
    </div>
@endsection
