@extends('ignitedcms::admin.entry.layout')
@section('content')
    <div id="app" class="full-screen">
      <sidebar theme="light">
            <ul slot="header" class="rm-list-styles">

             @include('ignitedcms::admin.sidebar')
               
            </ul>

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
               <div class="p-4">
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

            <alert variant="success">
               <alert-title>Information</alert-title>
                  <alert-content>
                  Create and edit the content for your
                  section types here
                  </alert-content>
            </alert>
            
            <div class="mb-8"></div>
            <!--main part for section styles -->
            <div class="panel  pb-5">

                <h3>Entries</h3>
                <div class="row">
                    <div class="col-4">
                        <h5>Single</h5>
                        @foreach ($data as $row)
                            <a href='{{ url("admin/entry/update/$row->sid/$row->eid") }}' class="underline">
                                {{ $row->name }}
                            </a>
                            <br>
                        @endforeach

                    </div>
                    <div class="col-4">
                        <h5>Multiple</h5>

                        @foreach ($data2 as $row)
                            <a href='{{ url("admin/multiple/$row->sid") }}' class="underline">
                                {{ $row->name }}
                            </a>
                            <br>
                        @endforeach
                    </div>
                    <div class="col-4">
                        <h5>Global</h5>

                        @foreach ($data3 as $row)
                            <a href='{{ url("admin/entry/update/$row->sid/$row->eid") }}' class="underline">
                                {{ $row->name }}
                            </a>
                            <br>
                        @endforeach
                    </div>
                </div>

            </div>

        </div>
      </sidebar>
    </div>
@endsection
