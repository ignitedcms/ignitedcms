@extends('ignitedcms::admin.fields.layout')
@section('content')
    <div id="app" class="full-screen">
        @include('ignitedcms::admin.sidebar')
        <div class="main-content p-3" id="main-content">
            <div class="breadcrumb m-b-3">

                <div class="breadcrumb-item">
                    <a href="{{ url('admin/dashboard') }}">Dashboard</a>
                </div>
                <div class="breadcrumb-item">
                    <a href="{{ url('admin/fields') }}">Fields</a>
                </div>

                <div class="breadcrumb-item">View field</div>
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
                                    numbers or spaces.) You can NOT use the following names:<span class="text-black">
                                        [url,content,id,section,field,entryid,entrytitle]
                                    </span>
                                </div>
                                <input class="form-control" name="name" value="{{ $field->name }}"
                                    placeholder="Start typing" disabled />
                            </div>
                            <div class="form-group">
                                <label for="title">Instructions</label>
                                <div class="small text-muted">
                                    Helper text to guide the author
                                </div>
                                <input class="form-control" name="instructions" value="{{ $field->instructions }}"
                                    placeholder="Start typing" disabled/>
                            </div>
                            <div class="form-group">
                                <label for="type">Field type</label>
                                <div class="small text-muted">
                                    The field type
                                </div>
                                <div class="form-group">
                                    <input class="form-control" 
                                          value="{{ $field->type }}" 
                                          placeholder="test" disabled />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach

        </div>
    </div>
@endsection
