@extends('ignitedcms::admin.entry.layout')
@section('content')
    <div id="app" class="full-screen">
        @include('ignitedcms::admin.sidebar')
        <div class="main-content p-3" id="main-content">

            <drawer title="Help"></drawer>


            <div class="breadcrumb m-b-3">
                <div class="breadcrumb-item">
                    <a href="{{ url('admin/dashboard') }}">Dashboard</a>
                </div>
                <div class="breadcrumb-item">Entry</div>
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
