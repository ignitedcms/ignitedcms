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
                    <div class="breadcrumb-item">Add new field</div>
                </div>
   
                <div class="toasts">
                   <toast ref="toast">
                      <div class="p-2">
                         <div class="text-danger">Error</div>
                         <div class="text-danger small">
                            Please check the entire form
                            for possible errors
                         </div>
                      </div>
                   </toast>

                </div>               

                <!--main part for section styles -->
                <div class="panel br drop-shadow">
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <h3>Fields</h3>
                            </div>
                            <div class="form-group">
                                <label for="title">Name <span class="text-danger">*</span></label>
                                <div class="small text-muted">What this field will
                                    be called in the control panel. (This MUST be unique and must not contain
                                    numbers or spaces.) You can NOT use the following names:<span class="text-black">
                                        [url,content,id,section,field,entryid,entrytitle]
                                    </span>
                                </div>
                                <input class="form-control" v-model="fieldname" value=""
                                    placeholder="Start typing" />
                                    <div class="small text-danger">
                                      @{{ fieldnameError }}
                                    </div>
                            </div>
                            <div class="form-group">
                                <label for="title">Instructions</label>
                                <div class="small text-muted">
                                    Helper text to guide the author
                                </div>
                                <input class="form-control" v-model="instructions" value=""
                                    placeholder="Start typing" />
                                    <div class="small text-danger"></div>
                            </div>

                            <div class="form-group">
                                <label>Field Type <span class="text-danger">* </span></label>
                                <div class="small text-muted">Specify the field type</div>
                                <select class="form-select" id="type" v-model="crselect" name="type">
                                    <option value="plain-text" selected>Plain Text</option>
                                    <option value="multi-line">Multi-line Box</option>
                                    <option value="rich-text">Rich Text Box</option>
                                    <option value="drop-down">Drop Down</option>
                                    <option value="check-box">Check Boxes</option>
                                    <option value="color">Color</option>
                                    <option value="file-upload">File Upload</option>
                                    <option value="number">Number</option>
                                    <option value="date">Date</option>
                                    <option value="switch">Switch</option>
                                </select>
                                
                            </div>
                            <div v-if="crselect=='plain-text'">
                                <div class="form-group">
                                    <label>Character length</label>
                                    <div class="small text-muted">(Must be valid whole number)</div>
                                    <input v-model="fieldlength" type="text" class="form-control"  name="length" value="">

                                    <div class="small text-danger"></div>

                                </div>
                            </div>
                            <div v-if="crselect=='multi-line'">
                            </div>
                            <div v-if="crselect=='rich-text'">
                            </div>
                            <div v-if="crselect=='drop-down'">
                                <div class="form-group">
                                    <label>Options</label>
                                    <div class="small text-muted">Please separate with commas</div>
                                    <textarea v-model="variations" name="variations" class="form-control" rows="5" 
                                         placeholder="E.g Dog,Cat" ></textarea>
                                    <div class="small text-danger">
                                       @{{ fieldtypeError }}
                                    </div>
                                </div>
                            </div>
                            <div v-if="crselect=='check-box'">
                                <div class="form-group">
                                    <label>Options</label>
                                    <div class="small text-muted">Please separate with commas</div>
                                    <textarea v-model="variations" name="variations" class="form-control" rows="5" 
                                        placeholder="E.g Dog,Cat"></textarea>
                                    <div class="small text-danger">
                                       @{{ fieldtypeError }}
                                    </div>
                                </div>
                            </div>
                            <div v-if="crselect=='color'">
                            </div>
                            <div v-if="crselect=='file-upload'">
                                <div class="form-group">
                                    <label>Allowed File types</label>
                                    <div class="small text-muted">Please separate with commas</div>
                                    <input v-model="variations" name="variations" type="text" class="form-control"
                                        placeholder="E.g jpg,png,gif" value="">

                                    <div class="small text-danger">
                                       @{{ fieldtypeError }}
                                    </div>
                                </div>
                            </div>
                            <div v-if="crselect=='number'">
                            </div>
                            <div v-if="crselect=='date'">
                            </div>
                            <div v-if="crselect=='switch'">
                            </div>

                        </div>
                    </div>
                    <div class="row">
                       <div class="col-12 right">
                          <button type="submit" @click="save" class="m-l btn btn-primary">Save</button>
                       </div>
                    </div>
                </div>

        </div>
    </div>
@endsection
