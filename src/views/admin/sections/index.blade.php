@extends('ignitedcms::admin.sections.layout')
@section('content')
    <div id="app" class="full-screen">
        @include('ignitedcms::admin.sidebar')
        <div class="main-content p-3" id="main-content">

         <drawer title="Help">
              <div class="p-3">
                 <h4>Sections</h4>
                 <p class="text-muted">For more help please see</p>
                 <a href="https://www.ignitedcms.com/documentation/section-types" target="_blank">Sections</a>
              </div>
           </drawer>

            <div class="breadcrumb m-b-3">
                <div class="breadcrumb-item">
                    <a href="{{ url('admin/dashboard') }}">Dashboard</a>
                </div>
                <div class="breadcrumb-item">Sections</div>
            </div>

            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif

            @if(count($data)>0)

            <div class="row">
                <div class="col-12 right">
                    <a href="{{ url('admin/section/create') }}">
                        <button type="button" class="btn btn-primary">New section</button>
                    </a>
                </div>
            </div>
            @else
            <div class="row">
               <div class="col m-b-3">
                  <a href="{{ url('admin/fields') }}">You need to create a field first!</a>
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
                                <td><a href="{{ url('admin/section/update', $section->id) }}">{{ $section->name }}</a></td>

                                <td>{{ $section->sectiontype }}</td>
                                <td>
                                    <span class="right">
                                        <tooltip link="Delete">

                                            <form action="{{ url('/admin/section/delete', $section->id) }}" method="POST">
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
    </div>
@endsection
