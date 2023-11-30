@extends('ignitedcms::admin.matrix.layout')
@section('content')
    <div class="full-screen" id="app">
        @include('ignitedcms::admin.sidebar')
        <div class="main-content p-3">
            <form action="{{ url('admin/matrix/create') }}" method="POST">
                @csrf

                <div class="breadcrumb m-b-3">
                    <div class="breadcrumb-item">
                        <a href="{{ url('admin/dashboard') }}">Dashboard</a>
                    </div>
                    <div class="breadcrumb-item">
                        <a href="{{ url('admin/fields') }}">Fields</a>
                    </div>
                    <div class="breadcrumb-item">Create matrix</div>
                </div>

                

                <div class="alert alert-info m-b-3">
                  The matrix is a special field where you can
                  create repeatable content in your section types.
                  <br/><br/> For more information please refer to the documentation.
                </div>

                <div class="row">
                   <div class="col-12 right">
                      <button type="submit" class="btn btn-primary">Save matrix</button>
                   </div>
                </div>
                <!--main part for section styles -->
                <div class="panel br drop-shadow">
                  <h3>Matrix</h3>
                  <div class="form-group">
                   <label for="title">Matrix field name</label>
                   <div class="small text-muted m-b">What this field will be called in the control panel.This MUST be unique and must
not contain numbers or spaces. You can NOT use the following reserved names: [url,content,id,section,field,entrytitle,entryid]</div>
                  <input class="form-control" 
                        name="matrix_name" 
                        value="" 
                        placeholder="Start typing" />
                  </div>
                  <div class="divider"></div>
                </div>

                <div class="row">
                    <div class="col-12 right">
                        <button type="submit" class="btn btn-primary">Save matrix</button>
                    </div>
                </div>

                <div class="gap"></div>
                <!--end main part-->

            </form>
        </div>
    </div>
@endsection
