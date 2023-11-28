@extends('ignitedcms::admin.entry.layout')
@section('content')
    <div id="app" class="full-screen">
        @include('ignitedcms::admin.sidebar')
        @include('ignitedcms::admin.entry.asset')

        <div class="main-content p-3" id="main-content">

            @if (Helper::is_multiple($sectionid) == true)
                <div class="breadcrumb m-b-3">
                    <div class="breadcrumb-item">
                        <a href="{{ url('admin/dashboard') }}">Dashboard</a>
                    </div>
                    <div class="breadcrumb-item">
                        <a href="{{ url('admin/entry') }}">Entry</a>
                    </div>
                    <div class="breadcrumb-item">Edit entry</div>
                </div>
            @else
                <div class="breadcrumb m-b-3">
                    <div class="breadcrumb-item">
                        <a href="{{ url('admin/dashboard') }}">Dashboard</a>
                    </div>
                    <div class="breadcrumb-item">
                        <a href="{{ url('admin/entry') }}">Entry</a>
                    </div>
                    <div class="breadcrumb-item">Edit section</div>
                </div>
            @endif

            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif

            <!--main part for section styles -->
            <form action='{{ url("admin/entry/save/$sectionid/$entryid") }}' method="POST">
                @csrf

                <div class="row">
                    <div class="col-3 v-a">
                     

                        @if (Helper::is_single($sectionid) == true)
                            <modal button-title="Create Template" modal-header="Create single template">
                                <p class="p-2">
                                <div class="rows">
                                    <div class="col p-b-2">

                                        <div class="form-group">

                                            Warning this will overwrite any previous templates you have created
                                            in the resources > views > custom folder. Are you sure?
                                        </div>
                                        <div class="form-group right">

                                            <a href="{{ url("admin/entry/build_single/$sectionid/$entryid") }}"
                                                class="btn btn-white m-r-2 rm-link-styles">Create template
                                            </a>
                                        </div>
                                    </div>
                                </div>

                                </p>
                            </modal>
                        @endif

                    </div>
                    <div class="col-9 right">

                        @if (Helper::is_single($sectionid) == true)
                            <a href="{{ url(Helper::get_section_name($sectionid)) }}" target="_blank"
                                class="btn btn-white m-r-2 rm-link-styles">Preview</a>
                        @endif

                        <button type="submit"class="btn btn-primary">Save</button>

                    </div>
                </div>
                <div class="panel br drop-shadow">

                    @if (Helper::is_multiple($sectionid) == true)
                        <label for="entry title">Entry title</label>
                        <div class="small text-muted">This is a required field*</div>
                        <input class="form-control" name="entrytitle" value="{{ Helper::get_content($entryid, 'entrytitle') }}"
                            placeholder="Start typing" />

                        @error('entrytitle')
                            <div class="small text-danger">{{ $message }}</div>
                        @enderror

                        <div class="divider m-b-2"></div>
                    @endif

                    @foreach ($data as $row)
                        <div>
                            @if ($row->type == 'plain-text')
                                <label for="title">[{{ $row->name }}]</label>
                                <div class="small text-muted">{{ $row->instructions }}</div>
                                <input class="form-control" name="{{ $row->name }}"
                                    value="{{ Helper::get_content($entryid, $row->name) }}" placeholder="Start typing" />
                                {{ $row->formvalidation }}

                                <div class="divider m-b-2"></div>
                            @elseif ($row->type == 'multi-line')
                                <label for="title">[{{ $row->name }}]</label>
                                <div class="small text-muted">{{ $row->instructions }}</div>
                                <textarea class="form-control" name="{{ $row->name }}" placeholder="Start typing" rows="4">{{ Helper::get_content($entryid, $row->name) }}</textarea>
                                {{ $row->formvalidation }}
                                <div class="divider m-b-2"></div>
                            @elseif ($row->type == 'rich-text')
                                <label for="title">[{{ $row->name }}]</label>
                                <div class="small text-muted">{{ $row->instructions }}</div>

                                <div class="form-group">
                                    <textarea class="quilljs-textarea" placeholder="Please enter text" name="{{ $row->name }}">{{ Helper::get_content($entryid, $row->name) }}</textarea>
                                </div>
                                {{ $row->formvalidation }}
                                <div class="divider m-b-2"></div>
                            @elseif ($row->type == 'check-box')
                                <label for="title">[{{ $row->name }}]</label>
                                <div class="small text-muted">{{ $row->instructions }}</div>
                                <div>
                                    <div class="form-group">

                                        {{ Helper::build_checkboxes($entryid, $row->name) }}
                                    </div>
                                </div>
                                {{ $row->formvalidation }}
                                <div class="divider m-b-2"></div>
                            @elseif ($row->type == 'color')
                                <label for="title">[{{ $row->name }}]</label>
                                <div class="small text-muted">{{ $row->instructions }}</div>
                                <input class="form-control" type="color" name="{{ $row->name }}"
                                    value="{{ Helper::get_content($entryid, $row->name) }}" placeholder="" />
                                {{ $row->formvalidation }}
                                <div class="divider m-b-2"></div>
                            @elseif ($row->type == 'drop-down')
                                <label for="title">[{{ $row->name }}]</label>
                                <div class="small text-muted">{{ $row->instructions }}</div>

                                <select class="form-select" name="{{ $row->name }}" aria-label="Default select example">
                                    {{ Helper::build_dropdown($entryid, $row->name) }}
                                </select>
                                {{ $row->formvalidation }}
                                <div class="divider m-b-2"></div>
                            @elseif ($row->type == 'file-upload')
                                <label for="title">[{{ $row->name }}]</label>
                                <div class="small text-muted">{{ $row->instructions }}</div>
                                upload
                                <div class="form-group">
                                    <div  class="btn btn-white" v-on:click="asset_picker( '{{ $row->name  }}' )">
                                       <span class="v-a">
                                          <i data-feather="plus"></i>    
                                          add
                                       </span>
                                    </div>
                                </div>                                 

                                <input id="{{ $row->name }}"  class="form-control" name="{{ $row->name }}"
                                    value="{{ Helper::get_content($entryid, $row->name) }}" placeholder="test" />

                                <img src="{{ Helper::get_asset(Helper::get_content($entryid, $row->name)) }} "></img>
                                {{ $row->formvalidation }}
                                <div class="divider m-b-2"></div>
                            @elseif ($row->type == 'number')
                                <label for="title">[{{ $row->name }}]</label>
                                <div class="small text-muted">{{ $row->instructions }}</div>
                                <input class="form-control" name="{{ $row->name }}"
                                    value="{{ Helper::get_content($entryid, $row->name) }}" placeholder="test" />
                                {{ $row->formvalidation }}
                                <div class="divider m-b-2"></div>
                            @elseif ($row->type == 'date')
                                <label for="title">[{{ $row->name }}]</label>
                                <div class="small text-muted">{{ $row->instructions }}</div>
                                <div class="form-group">
                                    <datepicker name="{{ $row->name }}"
                                        value="{{ Helper::get_content($entryid, $row->name) }}">
                                    </datepicker>
                                </div>
                                {{ $row->formvalidation }}
                                <div class="divider m-b-2"></div>
                            @elseif ($row->type == 'switch')
                                <label for="title">[{{ $row->name }}]</label>
                                <div class="small text-muted">{{ $row->instructions }}</div>
                                <switch-ios name="{{ $row->name }}"
                                    state="{{ Helper::get_switch_state($entryid, $row->name) }}"></switch-ios>
                                {{ $row->formvalidation }}
                                <div class="divider m-b-2"></div>
                            @else
                            @endif
                        </div>
                    @endforeach
                </div>
            </form>
        </div>
    </div>
@endsection
