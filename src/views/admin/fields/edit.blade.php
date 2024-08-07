@extends('ignitedcms::admin.fields.layout')
@section('content')
    <div id="app" class="full-screen" v-cloak>
      <sidebar theme="light">
            <ul slot="header" class="rm-list-styles">

             @include('ignitedcms::admin.sidebar')
               
            </ul>

        <div class="main-content" id="main-content">

            <breadcrumb class="mt-4 mb-4">
               <breadcrumb-item title="Dashboard" url="{{ url('admin/dashboard') }}"></breadcrumb-item>
               <breadcrumb-item title="Fields" url="{{ url('admin/fields') }}"></breadcrumb-item>
               <breadcrumb-item title="View field" url=""></breadcrumb-item>
            </breadcrumb>

            

            @foreach ($data as $field)
                <!--main part for section styles -->
                <div class="panel">
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
      </sidebar>
    </div>
@endsection
