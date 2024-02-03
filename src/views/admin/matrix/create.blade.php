@extends('ignitedcms::admin.matrix.layout')
@section('content')
    <div class="full-screen" id="app">
        <sidebar theme="light">
            <ul slot="header" class="rm-list-styles">

             @include('ignitedcms::admin.sidebar')
               
            </ul>

        <div class="main-content p-3">

           <drawer title="Help">
              <div class="p-8">
                 <h4>Matrix</h4>
                 <p class="text-muted">For more help please see</p>
                 <a class="underline" href="https://www.ignitedcms.com/documentation/matrix-fields" target="_blank">Matrix</a>
              </div>
           </drawer>

            <breadcrumb class="mt-4 mb-4">
               <breadcrumb-item title="Dashboard" url="{{ url('admin/dashboard') }}"></breadcrumb-item>
               <breadcrumb-item title="Fields" url="{{ url('admin/fields') }}"></breadcrumb-item>
               <breadcrumb-item title="Create matrix" url=""></breadcrumb-item>
            </breadcrumb>

            

            <div class="toasts">
               <toast ref="toast">
                  <div class="p-4">
                     <div class="text-danger">Error</div>
                     <div class="text-danger small">
                        There are one or more items on the form that need addressing
                     </div>
                  </div>
               </toast>

            </div>
             
            <alert variant="success">
               <alert-title>Information</alert-title>
                  <alert-content>
                The matrix is a special field where you can
                create repeatable content in your section types.
                <br /> For more information please refer to the 
                <a class="underline" href="https://www.ignitedcms.com/documentation/matrix-fields" target="_blank">Documentation</a>.

                  </alert-content>
            </alert>
            

            <div class="row">
                <div class="col-12 right">
                     <button-component variant="primary" @click.native="save">
                        Save matrix
                     </button-component>
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
                           <span class="text-black"> [url,content,id,section,field,entrytitle,entryid]</span></div>
                         <input v-model="matrix_name" name="matrix_name" type="text" class="form-control" placeholder="Eg. HeroSlider"
                            value="">
                        <!-- vue must bind to v-html -->
                        <div class="small text-danger" v-if="matrix_name_validation.length > 0" v-html="matrix_name_validation"></div>
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
                                <div class="matrix-item no-select">
                                     @{{todo.title}} (@{{todo.type}})
                                    
                                   <badge variant="outline" class="cursor-pointer" @click.native="deleteItem(todo)">Delete</badge>
                                    
                                </div>
                            </div>
                        </div>
                        <div class="matrix-right">
                            <div class="matrix-left-header">Field settings</div>
                            <div class="matrix-right-container">
                                <div class="form-group">
                                    <label>Field Name <span class="text-danger">*</span></label>
                                    <div class="small text-muted">(This cannot be empty and must be unique and contain no spaces or
                                        numbers) You can NOT use the following reserved names:<span class="text-black">
                                        [url,content,id,section,field,entrytitle,entryid]</span>
                                    </div>
                                    <input v-model="fieldname" type="text" class="form-control" 
                                         value="">
                                    
                                    <div class="small text-danger">@{{ fielderrors }}</div>
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
                                
                                <div v-if="crselect=='multi-line'">
                                </div>
                                <div v-if="crselect=='rich-text'">
                                </div>
                                <div v-if="crselect=='drop-down'">
                                    <div class="form-group">
                                        <label>Options</label>
                                        <div class="small text-muted">Please separate with commas</div>
                                        <textarea v-model="variations" class="form-control" rows="5" placeholder="E.g Dog,Cat"></textarea>
                                        <div class="small text-danger">@{{csverrors}}</div>
                                    </div>
                                </div>
                                <div v-if="crselect=='check-box'">
                                    <div class="form-group">
                                        <label>Options</label>
                                        <div class="small text-muted">Please separate with commas</div>
                                        <textarea v-model="variations" class="form-control" rows="5" 
                                            placeholder="E.g Dog,Cat"></textarea>

                                        <div class="small text-danger">@{{csverrors}}</div>

                                    </div>
                                </div>
                                <div v-if="crselect=='color'">
                                </div>
                                <div v-if="crselect=='file-upload'">
                                    <div class="form-group">
                                        <label>Allowed File types</label>
                                        <div class="small text-muted">Please separate with commas</div>
                                        <input v-model="variations" type="text" class="form-control"
                                            placeholder="E.g jpg,png,gif" value="">

                                        <div class="small text-danger">@{{csverrors}}</div>

                                    </div>
                                </div>
                                <div v-if="crselect=='number'">
                                </div>
                                <div v-if="crselect=='date'">
                                </div>
                                <div v-if="crselect=='switch'">
                                </div>
                                <div class="form-group p-b">
                                    <button class="btn-white pull-right btn-s-xs" @click="someFunc"><strong>Add</strong>
                                    </button>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                    </div>
                    <!-- end matrix container -->
                    <!-- <div class="code">@{{ matrixContent }} </div> -->
                </div>

                <div>
                    <div class="form-group">
                        <button-component variant="primary" @click.native="save">
                           Save matrix
                        </button-component>
                    </div>
                </div>
            </div>

            <div class="gap"></div>
            <!--end main part-->

        </div>
       </sidebar>
    </div>
@endsection

