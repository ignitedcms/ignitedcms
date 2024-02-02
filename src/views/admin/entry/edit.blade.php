@extends('ignitedcms::admin.entry.layout')
@section('content')
    <div id="app" class="full-screen">
      <sidebar theme="light">
            <ul slot="header" class="rm-list-styles">

             @include('ignitedcms::admin.sidebar')
               
            </ul>


        <div class="main-content p-3" id="main-content">

            <drawer title="Help">
                <div class="p-3">
                    <h4>Templating</h4>
                    <p class="text-muted">For more help please see</p>
                    <a href="https://www.ignitedcms.com/documentation/section-types" target="_blank">Templating</a>
                    <br>
                    <a href="https://www.ignitedcms.com/documentation/magic-routing">Enable magic routing</a>
                </div>
            </drawer>

            @if (isMultiple($sectionid) == true)
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
            <div class="toasts">
               <toast ref="toast">
               <div class="p-2">
                  <div class="text-black">Success</div>
                  <div class="text-muted small">
                     {{ session('status') }}
                  </div>
               </div>
               </toast>

            </div>
                
            @endif

            <!--main part for section styles -->
            <form action='{{ url("admin/entry/save/$sectionid/$entryid") }}' method="POST">
                @csrf

                <div class="row">
                    <div class="col-3 v-a">


                    </div>
                    <div class="col-9 right">

                        @if (isSingle($sectionid) == true)
                           

                            <a href="{{ url(getSectionName($sectionid)) }}" target="_blank"
                                class="btn btn-white m-r-2 rm-link-styles">Preview</a>
                        @endif

                        @if (isMultiple($sectionid) == true)

                        @php
                           $sectName = getSectionName($sectionid);
                           $entTitle = getContent($entryid, 'entrytitle');
                        @endphp

                            <a href="{{ url($sectName . '/' . $entTitle) }}" target="_blank"
                                class="btn btn-white m-r-2 rm-link-styles">Preview</a>
                        @endif
                        <button type="submit"class="btn btn-primary">Save</button>

                    </div>
                </div>
                <div class="panel br drop-shadow">

                    @include('ignitedcms::admin.entry.vue')

                    @if (isMultiple($sectionid) == true)
                        <label for="entry title">Entry title</label>
                        <div class="small text-muted">This is a required field*</div>
                        <input class="form-control" name="entrytitle"
                            value="{{ getContent($entryid, 'entrytitle') }}" disabled />

                        @error('entrytitle')
                            <div class="small text-danger">{{ $message }}</div>
                        @enderror

                        <div class="divider m-b-2"></div>
                    @endif

                    @foreach ($data as $row)
                        <div>
                            @if ($row->type == 'plain-text')
                                <div class="clearfix m-b-2"></div>
                                <label for="title">[{{ $row->name }}]</label>
                                <div class="small text-muted">{{ $row->instructions }}</div>
                                <input class="form-control" name="{{ $row->name }}"
                                    value="{{ getContent($entryid, $row->name) }}" placeholder="Start typing" />

                                <div class="divider m-b-2"></div>
                            @elseif ($row->type == 'matrix')
                                <div @click="goNow({{ $row->id }})" class="m-r-2 m-t btn btn-white ">
                                    <span class="v-a">
                                        <i data-feather="plus"></i>
                                        Add {{ $row->name }}
                                    </span>
                                </div>
                                <input style='display:none;' type='text' name='{{ $row->name }}'
                                    id='{{ $row->name }}' v-model='JSON.stringify(matrix)' />
                            @elseif ($row->type == 'multi-line')
                                <div class="clearfix m-b-2"></div>
                                <label for="title">[{{ $row->name }}]</label>
                                <div class="small text-muted">{{ $row->instructions }}</div>
                                <textarea class="form-control" name="{{ $row->name }}" placeholder="Start typing" rows="4">{{ getContent($entryid, $row->name) }}</textarea>
                                <div class="divider m-b-2"></div>
                            @elseif ($row->type == 'rich-text')
                                <div class="clearfix m-b-2"></div>

                                <div v-for='part in singleRichtext'>
                                    <div class='form-group' v-if='part.name == "{{ $row->name }}"'>
                                        <label>[{{ $row->name }}]</label>
                                        <div class='igs-small'>{{ $row->instructions }}</div>
                                        <input name="{{ $row->name }}" v-bind:value='part.content'
                                            style='display:none;'></input>

                                        <quill-editor v-model='part.content' :options='editorOption'
                                            @blur='onEditorBlur($event)' @focus='onEditorFocus($event)'
                                            @ready='onEditorReady($event)'>
                                        </quill-editor>
                                    </div>
                                </div>

                                <div class="form-group">

                                </div>
                                <div class="divider m-b-2"></div>
                            @elseif ($row->type == 'check-box')
                                <div class="clearfix m-b-2"></div>
                                <label for="title">[{{ $row->name }}]</label>
                                <div class="small text-muted">{{ $row->instructions }}</div>
                                <div>
                                    <div class="form-group">

                                        {{ buildCheckboxes($entryid, $row->name) }}
                                    </div>
                                </div>
                                <div class="divider m-b-2"></div>
                            @elseif ($row->type == 'color')
                                <div class="clearfix m-b-2"></div>
                                <label for="title">[{{ $row->name }}]</label>
                                <div class="small text-muted">{{ $row->instructions }}</div>
                                <input class="form-control" type="color" name="{{ $row->name }}"
                                    value="{{ getContent($entryid, $row->name) }}" placeholder="" />
                                <div class="divider m-b-2"></div>
                            @elseif ($row->type == 'drop-down')
                                <div class="clearfix m-b-2"></div>
                                <label for="title">[{{ $row->name }}]</label>
                                <div class="small text-muted">{{ $row->instructions }}</div>

                                <select class="form-select" name="{{ $row->name }}"
                                    aria-label="Default select example">
                                    {{ buildDropdown($entryid, $row->name) }}
                                </select>
                                <div class="divider m-b-2"></div>
                            @elseif ($row->type == 'file-upload')
                                <div class="clearfix m-b-2"></div>
                                <label for="title">[{{ $row->name }}]</label>
                                <div class="small text-muted">{{ $row->instructions }}</div>

                                <asset-container fieldname2='{{ $row->name }}'
                                    assetid='{{ getContent($entryid, $row->name) }}'
                                    url='{{ getThumb($entryid, $row->name) }}'>
                                </asset-container>


                                <div class="divider m-b-2"></div>
                            @elseif ($row->type == 'number')
                                <div class="clearfix m-b-2"></div>
                                <label for="title">[{{ $row->name }}]</label>
                                <div class="small text-muted">{{ $row->instructions }}</div>
                                <input class="form-control" name="{{ $row->name }}"
                                    value="{{ getContent($entryid, $row->name) }}" placeholder="test" />
                                <div class="divider m-b-2"></div>
                            @elseif ($row->type == 'date')
                                <div class="clearfix m-b-2"></div>
                                <label for="title">[{{ $row->name }}]</label>
                                <div class="small text-muted">{{ $row->instructions }}</div>
                                <div class="form-group">
                                    <datepicker name="{{ $row->name }}"
                                        value="{{ getContent($entryid, $row->name) }}">
                                    </datepicker>
                                </div>
                                <div class="divider m-b-2"></div>
                            @elseif ($row->type == 'switch')
                                <div class="clearfix m-b-2"></div>
                                <label for="title">[{{ $row->name }}]</label>
                                <div class="small text-muted">{{ $row->instructions }}</div>
                                <switch-ios name="{{ $row->name }}"
                                    value="{{ getContent($entryid, $row->name) }}"></switch-ios>
                                <div class="divider m-b-2"></div>
                            @else
                            @endif
                        </div>
                    @endforeach
                </div>
            </form>
            <div class="gap"></div>
        </div>
      </sidebar>
    </div>
@endsection

