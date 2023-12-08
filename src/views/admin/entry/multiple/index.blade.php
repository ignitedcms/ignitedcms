@extends('ignitedcms::admin.entry.multiple.layout')
@section('content')
    <div id="app" class="full-screen">
        @include('ignitedcms::admin.sidebar')
        <div class="main-content p-3" id="main-content">

            <drawer title="Help"></drawer>

            @if (session('status'))
                <div class="alert alert-success m-b-3">
                    {{ session('status') }}
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger m-b-3">
                    {{ session('error') }}
                </div>
            @endif
            <div class="breadcrumb m-b-3">
                <div class="breadcrumb-item">
                    <a href="{{ url('admin/dashboard') }}">Dashboard</a>
                </div>
                <div class="breadcrumb-item">
                    <a href="{{ url('admin/entry') }}">Entry</a>
                </div>
                <div class="breadcrumb-item">{{ $sectionname }}</div>
            </div>

            <div class="row">
                <div class="col-3 v-a">
                    <modal button-title="Create Template" modal-header="Create multiple template">
                        <p class="p-2">
                        <div class="rows">
                            <div class="col p-b-2">

                                <div class="form-group">

                                    Warning this will overwrite any previous templates you have created
                                    in the resources > views > custom folder. Are you sure?
                                </div>
                                <div class="form-group right">

                                    <a href="{{ url("admin/entry/build_multiple/$sectionid") }}"
                                        class="btn btn-white m-r-2 rm-link-styles">Create template</a>
                                </div>
                            </div>
                        </div>

                        </p>
                    </modal>

                </div>
                <div class="col-9 right">

                    <a href="{{ url(Helper::get_section_name($sectionid)) }}" target="_blank"
                        class="btn btn-white m-r-2 rm-link-styles">Preview</a>


                    <modal button-title="Create Template" modal-header="Create multiple template">
                        <p class="p-2">
                        <div class="rows">
                            <div class="col p-b-2">
                               <form action="{{ url("admin/multiple/create/$sectionid") }} " method="POST">
                                  @csrf
                                <div class="form-group">

                                </div>
                                <div class="form-group right">

                                    <button type="submit"class="btn btn-primary">Add another</button>
                                </div>
                              </form>
                            </div>
                        </div>

                        </p>
                    </modal>

                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="alert alert-info ">
                        Drag and drop to re-order the position, this can be used to
                        display multiples in a specific order.
                    </div>
                </div>
            </div>

            <!--main part for section styles -->
            <div class="panel br drop-shadow p-b-5">

                <form action="{{ url("admin/multiple/delete/$sectionid") }}" method="POST">
                    @csrf

                    <div class="row pull-right">
                        <div class="col-12 no-margin">
                            <tooltip link="Delete selected items?">

                                <button type="submit" class="rm-btn-styles ">OK</button>

                            </tooltip>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <h3>{{ $sectionname }}</h3>

                    <div id="sortable-list">
                        @foreach ($data as $row)
                            <!-- tidy this up later   -->

                            <a href="{{ url("admin/entry/update/$sectionid/$row->id") }}" class="rm-link-styles">
                                <div class="panel border-fix no-padding p-t p-l-2 p-b">

                                    <input type="checkbox" class="form-check-input" name="id[]"
                                        value="{{ $row->id }}">
                                    <span class="m-l">
                                        {{ Helper::get_entrytitle($row->id) }}
                                    </span>

                                </div>

                            </a>
                        @endforeach

                    </div>

                    <!--<h5 class="m-t-2">Debug bar</h5>-->
                    <!--<div class="code m-t no-select">-->
                    <!--@{{ items }} -->
                    <!--</div>-->
                </form>
            </div>
        </div>
        <div class="gap"></div>
    </div>
@endsection
