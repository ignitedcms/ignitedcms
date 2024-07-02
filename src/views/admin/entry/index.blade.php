@extends('ignitedcms::admin.dashboard.layout')
@section('content')
    <div id="app" class="full-screen" v-cloak>
      <sidebar theme="light">
            <ul slot="header" class="rm-list-styles">

             @include('ignitedcms::admin.sidebar')
               
            </ul>

        <div class="main-content" id="main-content">

         <drawer title="Help">
              <div class="p-8">
                 <h4>Entries</h4>
                 <p class="text-muted">For more help please see</p>
                 <a class="underline" href="https://www.ignitedcms.com/documentation/entries" target="_blank">Entries</a>
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

            <breadcrumb class="mt-4 mb-4">
               <breadcrumb-item title="Dashboard" url="{{ url('admin/dashboard') }}"></breadcrumb-item>
               <breadcrumb-item title="Entry" url=""></breadcrumb-item>
            </breadcrumb>


            <alert variant="success">
               <alert-title>Information</alert-title>
                  <alert-content>
                  Create and edit the content for your
                  section types here
                  </alert-content>
            </alert>
            
            <div class="mb-4"></div>
            <!--main part for section styles -->
            <div class="panel">

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
