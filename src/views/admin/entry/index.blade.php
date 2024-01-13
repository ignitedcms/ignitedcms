@extends('ignitedcms::admin.entry.layout')
@section('content')
    <div id="app" class="full-screen">
        @include('ignitedcms::admin.sidebar')
        <div class="main-content p-3" id="main-content">

         <drawer title="Help">
              <div class="p-3">
                 <h4>Entries</h4>
                 <p class="text-muted">For more help please see</p>
                 <a href="https://www.ignitedcms.com/documentation/entries" target="_blank">Entries</a>
              </div>
           </drawer>

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

            <div class="breadcrumb m-b-3">
                <div class="breadcrumb-item">
                    <a href="{{ url('admin/dashboard') }}">Dashboard</a>
                </div>
                <div class="breadcrumb-item">Entry</div>
            </div>

            <div class="alert alert-success m-b-3">
               <div class="text-black">Information</div>
               <div class="text-muted small">
                  Create and edit the content for your
                  section types here
               </div>
            </div>

            <!--main part for section styles -->
            <div class="panel br drop-shadow p-b-5">

                <h3>Entries</h3>
                <div class="row">
                    <div class="col-4">
                        <h5>Single</h5>
                        @foreach ($data as $row)
                            <a href='{{ url("admin/entry/update/$row->sid/$row->eid") }}'>
                                {{ $row->name }}
                            </a>
                            <br>
                        @endforeach

                    </div>
                    <div class="col-4">
                        <h5>Multiple</h5>

                        @foreach ($data2 as $row)
                            <a href='{{ url("admin/multiple/$row->sid") }}'>
                                {{ $row->name }}
                            </a>
                            <br>
                        @endforeach
                    </div>
                    <div class="col-4">
                        <h5>Global</h5>

                        @foreach ($data3 as $row)
                            <a href='{{ url("admin/entry/update/$row->sid/$row->eid") }}'>
                                {{ $row->name }}
                            </a>
                            <br>
                        @endforeach
                    </div>
                </div>

            </div>

        </div>
    </div>
@endsection
