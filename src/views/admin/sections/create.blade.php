@extends('ignitedcms::admin.sections.layout')
@section('content')
    <div class="full-screen" id="app" v-cloak>
      <sidebar theme="light">
            <ul slot="header" class="rm-list-styles">

             @include('ignitedcms::admin.sidebar')
               
            </ul>

        <div class="main-content p-3">

            @if (session('status'))
            <div class="toasts">
               <toast ref="toast">
               <div class="p-4">
                  <div class="text-black">Success</div>
                  <div class="text-muted small">
                     {{ session('status') }}
                  </div>
               </div>
               </toast>

            </div>
                
            @endif

            @if (session('errors'))
            <div class="toasts">
               <toast ref="toast">
               <div class="p-4">
                  <div class="text-danger">Error</div>
                  <div class="text-danger small">
                     @foreach ($errors->all() as $error)
                        {{ $error }}<br/>
                     @endforeach
                  </div>
               </div>
               </toast>

            </div>
                
            @endif
         

            <form action="{{ url('admin/section/create') }}" method="POST">
                @csrf


             <breadcrumb class="mt-4 mb-4">
               <breadcrumb-item title="Dashboard" url="{{ url('admin/dashboard') }}"></breadcrumb-item>
               <breadcrumb-item title="Sections" url="{{ url('admin/section') }}"></breadcrumb-item>
               <breadcrumb-item title="Create section" url=""></breadcrumb-item>
             </breadcrumb>


                <!--main part for section styles -->
                <div class="panel ">
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <h3>Sections</h3>
                            </div>
                            <div class="form-group">
                                <label for="title">Title <span class="text-danger">*</span></label>
                                <div class="small text-muted">Section title,
                                    must be unique and contain no
                                    spaces or special characters
                                </div>
                                <input class="form-control" name="name" value="{{ old('name') }}" placeholder="test" />
                                @error('name')
                                    <div class="small text-danger">{{ $message }}</div>
                                @enderror

                            </div>
                            <div class="form-group">
                                <label for="sectiontype">Section type <span class="text-danger">*</span></label>
                                <div class="small text-muted">Choose section type</div>
                                <select name="sectiontype" class="form-select" aria-label="Default select example">
                                    <option value="single" selected>Single</option>
                                    <option value="multiple">Multiple</option>
                                    <option value="global">Global</option>
                                </select>
                                @error('sectiontype')
                                    <div class="small text-danger">{{ $message }}</div>
                                @enderror

                            </div>
                            <div class="divider"></div>
                        </div>
                    </div>

                    <!--drag and drop content-->
                     <alert variant="success">
                        <alert-title>Information</alert-title>
                           <alert-content>
                              Drag and drop the fields you need, reorder and click save
                           </alert-content>
                     </alert>
                    

                    <!--create hidden input and sent to controller-->
                    <div class="row">
                        <input style="display:none;" class="form-control" name="order" value="" placeholder="order"
                            v-model="hiddenOrder" />
                        @error('order')
                            <div class="small text-danger">You need to drag in at least one field from below into the page</div>
                        @enderror

                    </div>

                    <div class="row">
                        <div class="col-8">

                            <div class="nothing">
                                <h4>Page</h4>
                                <div class="small text-muted m-b-2">
                                 You need to drag at least one field into
                                 here.
                                </div>
                            </div>
                            <div id='list1' class='scroll-y bg-white cross-grid p-4 rounded-[--small-radius] border border-[--gray]' style="height:500px;">
                                <!--add pills here-->

                            </div>
                        </div>

                        <div class="col-4">
                            <div class="nothing">
                                <h4>Fields</h4>
                                <div class="small text-muted m-b-2">
                                    Drag and drop from RHS 
                                </div>
                            </div>
                            <div id='list2' class='scroll-y bg-[--light-gray] border  border-[--gray]  rounded-[--big-radius]  p-4' 
                              style="min-height:400px;">

                                @foreach ($data as $field)
                                    <div class="pill cursor-pointer overflow-hidden p-3 mt-2 shadow-sm border border-[--gray] rounded-lg  bg-white h-e v-a" id="{{ $field->id }}">
                                       
                                       <div class="v-a text-black">
                                          <span>
                                             <i data-feather="more-vertical" class="v-a"></i>    
                                          </span>
                                          {{ $field->name }}
                                       </div>
                                        <div>
                                            <span class="small text-muted">
                                                {{ $field->type }}
                                            </span>
                                        </div>
                                    </div>
                                @endforeach

                            </div>
                        </div>
                    </div>
                    <!--end-->

                  <div class="form-group">
                       <div class="p-4 shadow bg-white border border-[--gray] rounded-[--big-radius]">
                          <div class="row h-e">
                             <div>
                                      <div class="text-black">Template builder</div>
                                   
                                      <div class="small text-muted">
                                         Enabling this will automatically create and
                                         overwrite the template in the 
                                         resources > views > custom directory.
                                      </div>
                             </div>
                             <div class=" h-a v-a">
                                <div>
                                   <label for="title"></label> 
                                   <div class="m-b"></div>
                                    <switch-ios value="" name="template"></switch-ios>

                                </div>
                             </div>
                          </div>
                       </div>
                    </div>
                  
                  <div class="form-group bg-white border border-[--gray] rounded-[--small-radius] p-4 shadow">
                     <h5>User access</h5>
                     <div class="text-black">Information</div>
                     <div class="small text-muted m-b">
                        Select who has access to add and edit content in this section
                     </div>
                     @foreach($data2 as $row)
                     <div>
                        <input type="checkbox" name="user_access[]" value="{{ $row->groupID }}" class="form-check-input">
                        <label for="the label" class="ml-2">{{ $row->groupName }}</label>
                     </div>
                     @endforeach
                     
                  </div>


                    <div class="row">
                       <div class="col-12 right">
                           <button-component variant="primary" @click.native="onClicking">
                              Save
                           </button-component>
                       </div>
                    </div>
                </div>

                

                <div class="gap"></div>
                <!--end main part-->

            </form>
        </div>
      </sidebar>
    </div>
@endsection
