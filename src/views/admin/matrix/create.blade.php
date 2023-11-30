@extends('ignitedcms::admin.matrix.layout')
@section('content')
    <div class="full-screen" id="app">
        @include('ignitedcms::admin.sidebar')
        <div class="main-content p-3">

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
                <br /><br /> For more information please refer to the documentation.
            </div>

            <div class="row">
                <div class="col-12 right">
                    <button type="submit" class="btn btn-primary" @click="save">Save matrix</button>
                </div>
            </div>
            <!--main part for section styles -->
            <div class="panel br drop-shadow">
                <h3>Matrix</h3>
                <div class="row">
                   <div class="col">
                      <div class="form-group">
                         <label for="title">Matrix field name <span class="text-danger">*</span></label>
                         <div class="small text-muted m-b">What this field will be called in the control panel.This MUST be
                            unique and must
                            not contain numbers or spaces. You can NOT use the following reserved names:
                            [url,content,id,section,field,entrytitle,entryid]</div>
                         <input v-model="matrix_name" name="matrix_name" type="text" class="form-control" placeholder="Eg. HeroSlider"
                            value="">
                        <!-- vue must bind to v-html -->
                        <div class="errors pull-left" v-if="matrix_name_validation.length > 0" v-html="matrix_name_validation"></div>
                      </div>
                   </div>
                   
                </div>
                
                <div class="divider"></div>

                <div class="row m-t-2">
                    <h4>Configuration</h4> 
                    
                    <div class="small text-muted m-b-3">Define the types of blocks that can be created within this Matrix field, as well
                        as the fields each block type is made up of.
                    </div>
                    <!-- start matrix container -->
                    <div class="matrix-container">
                        <div class="matrix-left">
                            <div class="matrix-left-header">Fields</div>
                            <div v-for="todo in matrixContent">
                                <div class="matrix-item">
                                     @{{todo.title}} (@{{todo.type}})
                                    <div class="m-l-3 hand" @click="deleteItem(todo)">
                                       x 
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="matrix-right">
                            <div class="matrix-left-header">Field settings</div>
                            <div class="matrix-right-container">
                                <div class="form-group">
                                    <label>Field Name</label>
                                    <div class="small text-muted">(This cannot be empty and must be unique and contain no spaces or
                                        numbers)
                                    </div>
                                    <input v-model="fieldname" type="text" class="form-control" 
                                         value="">
                                </div>
                                <div class="form-group">
                                    <label>Instruction text</label>
                                    <div class="small text-muted">(Text instructions for user, optional)
                                    </div>
                                    <input v-model="instructions" type="text" class="form-control"
                                        placeholder="Type here"  value="">
                                </div>
                                <div class="form-group">
                                    <label>Field Type</label>
                                    <div class="small text-muted">Specify the field type</div>
                                    <select class="form-select m-b" id="type" v-model="crselect">
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
                                    <div class="errors"></div>
                                </div>
                                <div v-if="crselect=='plain-text'">
                                    <div class="form-group">
                                        <label>Character length</label>
                                        <div class="small text-muted">(Must be valid whole number)</div>
                                        <input v-model="fieldlength" type="text" class="form-control"
                                            placeholder="Type here" 
                                            value="">
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
                                        <textarea v-model="variations" class="form-control" rows="5" placeholder="Type here" ></textarea>
                                    </div>
                                </div>
                                <div v-if="crselect=='check-box'">
                                    <div class="form-group">
                                        <label>Options</label>
                                        <div class="small text-muted">Please separate with commas</div>
                                        <textarea v-model="variations" class="form-control" rows="5" 
                                            placeholder="Type here"></textarea>
                                    </div>
                                </div>
                                <div v-if="crselect=='color'">
                                </div>
                                <div v-if="crselect=='file-upload'">
                                    <div class="form-group">
                                        <label>Allowed File types</label>
                                        <div class="igs-small"></div>
                                        <input v-model="variations" type="text" class="form-control"
                                            placeholder="jpg,png,gif" value="">
                                    </div>
                                </div>
                                <div v-if="crselect=='number'">
                                </div>
                                <div v-if="crselect=='date'">
                                </div>
                                <div v-if="crselect=='switch'">
                                </div>
                                <div class="form-group p-b">
                                    <div class="btn btn-white pull-right btn-s-xs" @click="someFunc"><strong>Add</strong>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                    </div>
                    <!-- end matrix container -->
                    <div class="code">@{{ matrixContent }} </div>
                </div>

                <div >
                    <div class="form-group right">
                        <div class="btn btn-primary " @click="save">Save matrix</div>
                    </div>
                </div>



            </div>

            

            <div class="gap"></div>
            <!--end main part-->

        </div>
    </div>
@endsection

