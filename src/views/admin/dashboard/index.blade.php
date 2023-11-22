@extends('ignitedcms::admin.dashboard.layout')

@section('content')
    <div id="app" class="full-screen">

        @include('ignitedcms::admin.sidebar')

        <div class="main-content " id="main-content">
            <!--dashboard underneath-->
            <div class="p-3">
                <div class="panel br drop-shadow">
                    <h3>Dashboard</h3>
                    <p>This is where updates and important news related
                     to IgnitedCMS will be shown.
                  </p>
                </div>

            </div>
        </div>
    </div>
@endsection
