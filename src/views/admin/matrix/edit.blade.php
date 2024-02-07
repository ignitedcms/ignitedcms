@extends('ignitedcms::admin.matrix.layout')
@section('content')
    <div class="full-screen" id="app">
      <sidebar theme="light">
            <ul slot="header" class="rm-list-styles">

             @include('ignitedcms::admin.sidebar')
               
            </ul>

        <div class="main-content">
            <form action='{{ url("admin/matrix/update/$id") }}' method="POST">
                @csrf

             <breadcrumb class="mt-4 mb-4">
               <breadcrumb-item title="Dashboard" url="{{ url('admin/dashboard') }}"></breadcrumb-item>
               <breadcrumb-item title="Fields" url="{{ url('admin/fields') }}"></breadcrumb-item>
               <breadcrumb-item title="Edit matrix" url=""></breadcrumb-item>
            </breadcrumb>

                
                <!--main part for section styles -->
                <div class="panel br drop-shadow">
                   to be completed...
                </div>

                <div class="row">
                    <div class="col-12 right">
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </div>

                <div class="gap"></div>
                <!--end main part-->

            </form>
        </div>
       </sidebar>
    </div>
@endsection
