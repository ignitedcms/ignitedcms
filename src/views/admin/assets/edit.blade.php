@extends('ignitedcms::admin.assets.layout')
@section('content')
    <div id="app" class="full-screen">
        @include('ignitedcms::admin.sidebar')
        <div class="main-content p-3" id="main-content">
            <div class="breadcrumb m-b-3">
                <div class="breadcrumb-item">
                    <a href="{{ url('admin/dashboard') }}">Dashboard</a>
                </div>
                <div class="breadcrumb-item">
                    <a href="{{ url('admin/assets') }}">Assets</a>
                </div>

                <div class="breadcrumb-item">View asset</div>
            </div>

                <!--main part for section styles -->
                <div class="panel br drop-shadow">
                    <div class="row">
                        <div class="col">
                           @foreach ($data as $row)
                              <div class="form-group">
                                 <label for="Filename">Filename</label>
                                 <div class="small text-muted">The file name </div>
                                 {{ $row->filename }} 
                              </div>
                              @if($row->kind == 'png')
                              <div class="form-group">
                                 <img src="{{ $row->url }}" class="img-responsive"></img>
                              </div>
                              @else
                                hola
                              @endif
                           
                           @endforeach
                        </div>
                    </div>
                </div>
        </div>
    </div>
@endsection
