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
                    <a href="{{ url('admin/fields') }}">Assets</a>
                </div>

                <div class="breadcrumb-item">View asset</div>
            </div>

            @foreach ($data as $field)
                <!--main part for section styles -->
                <div class="panel br drop-shadow">
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <h3>View field</h3>
                            </div>
                            <div class="form-group">
                                <label for="title">Name</label>
                                <div class="small text-muted">What this field will
                                    be called in the control panel. (This MUST be unique and must not contain
                                    numbers or spaces.)You can NOT use the following names:<span class="text-danger">
                                        [url,content,id,section,field,entryid,entrytitle]
                                    </span>
                                </div>
                                <input class="form-control" name="name" value="{{ $field->name }}"
                                    placeholder="Start typing" readonly />
                            </div>
                            <div class="form-group">
                                <label for="title">Instructions</label>
                                <div class="small text-muted">
                                    Helper text to guide the author
                                </div>
                                <input class="form-control" name="instructions" value="{{ $field->instructions }}"
                                    placeholder="Start typing" readonly/>
                            </div>
                            <div class="form-group">
                                <label for="type">Field type</label>
                                <div class="small text-muted">
                                    The field type
                                </div>
                                <div class="form-group">
                                    <input class="form-control" 
                                          name="a" 
                                          value="{{ $field->type }}" 
                                          placeholder="test" readonly />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach

        </div>
    </div>
@endsection
