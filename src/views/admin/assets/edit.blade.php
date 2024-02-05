@extends('ignitedcms::admin.assets.layout')
@section('content')
    <div id="app" class="full-screen">
      <sidebar theme="light">
            <ul slot="header" class="rm-list-styles">

             @include('ignitedcms::admin.sidebar')
               
            </ul>

        <div class="main-content p-3" id="main-content">

            <breadcrumb class="mt-4 mb-4">
               <breadcrumb-item title="Dashboard" url="{{ url('admin/dashboard') }}"></breadcrumb-item>
               <breadcrumb-item title="Assets" url="{{ url('admin/assets') }}"></breadcrumb-item>
               <breadcrumb-item title="View asset" url=""></breadcrumb-item>
            </breadcrumb>

            

            <!--main part for section styles -->
            <div class="panel">
                <div class="row">
                    <div class="col">
                       <form action='{{ url("admin/assets/update/$assetId") }} ' method="POST">
                          @csrf
                           <div class="form-group">
                               @foreach ($data as $row)
                                   <label for="title">Alt Title</label>
                                   <div class="small text-muted m-b">If you have an
                                       image you can add an Alt title
                                   </div>
                                   <input class="form-control" type="text" name="alt_title" value="{{ $row->alt_title }}"
                                       placeholder="Start typing" />
                           </div>

                           <div class="form-group">
                               <label for="Filename">Filename</label>
                               <div class="small text-muted">The file name </div>
                               {{ $row->filename }}
                           </div>
                           @if (in_array($row->kind, ['jpeg', 'jpg', 'png', 'gif', 'bmp', 'svg']))
                               <div class="form-group">
                                   <img src="{{ $row->url }}" class="img-responsive"></img>
                               </div>
                           @else
                               <a href="{{ $row->url }}">Download</a>
                           @endif
                           @endforeach
                           <div class="row">
                              <div class="col right">
                                 <button-component variant="primary">
                                    Save
                                 </button-component>

                              </div>
                           </div>
                        </form>
                    </div>
                </div>
            </div>
            
            <div class="gap"></div>
        </div>
         </sidebar>
    </div>
@endsection

