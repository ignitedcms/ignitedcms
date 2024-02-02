@extends('ignitedcms::admin.sections.layout')
@section('content')
    <div class="full-screen" id="app">
       <sidebar theme="light">
            <ul slot="header" class="rm-list-styles">

             @include('ignitedcms::admin.sidebar')
               
            </ul>

      
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


        <div class="main-content p-3">
            <form action='{{ url("admin/section/update/$id") }}' method="POST">
                @csrf

                <div class="breadcrumb m-b-3">
                    <div class="breadcrumb-item">
                        <a href="{{ url('admin/dashboard') }}">Dashboard</a>
                    </div>
                    <div class="breadcrumb-item">
                        <a href="{{ url('admin/section') }}">Sections</a>
                    </div>
                    <div class="breadcrumb-item">Edit section</div>
                </div>
                <!--main part for section styles -->
                <div class="panel">
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <h3>Sections</h3>
                            </div>
                            <div class="form-group">
                                <label for="title">Title</label>
                                <div class="small text-muted">Disabled</div>
                                <input class="form-control" name="name" value="{{ $data2->name }}" placeholder="test"
                                    disabled />
                                @error('name')
                                    <div class="small text-danger">{{ $message }}</div>
                                @enderror

                            </div>
                            <div class="form-group">
                                <label for="sectiontype">Section type</label>
                                <div class="small text-muted">Disabled</div>
                                <select name="sectiontype" class="form-select" aria-label="Default select example" disabled>
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
                     <alert variant="success" class="mt-4">
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
                            <div class="small text-danger">{{ $message }}</div>
                        @enderror

                    </div>

                    <div class="row">
                        <div class="col-8">

                            <div>
                                <h4>Page</h4>
                            </div>
                            <div id='list1' class='scroll-y bg-white cross-grid p-4 rounded-[--small-radius] border border-[--gray]' style="height:500px;">
                                @foreach ($data3 as $field)
                                    <div class="pill overflow-hidden p-3 shadow-md border border-[--gray] rounded-lg  bg-white h-e v-a" id="{{ $field->id }}">
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
                                <!--add pills here-->

                            </div>
                        </div>
                        <div class="col-4">
                            <div class="nothing">
                                <h4>Fields</h4>
                            </div>
                            <div id='list2' class='scroll-y bg-[--light-gray] border  border-[--gray]  rounded-[--big-radius]  p-4'
                               style="min-height:400px;"  >

                                @foreach ($data as $field)
                                    <?php if(isFieldInSection($field->id, $id)) : ?>
                                    <div class="pill mt bg-white h-e  v-a" id="{{ $field->id }}">
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
                                    <?php endif; ?>
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

                    <div class="form-group bg-white p-4 border border-[--gray] shadow rounded-[--big-radius]">
                     <h5>User access</h5>
                     <div class="text-black">Information</div>
                     <div class="small text-muted mb-2">
                        Select who has access to add and edit content in this section
                     </div>
                     @foreach($data5 as $row)
                     <div>
                        <input type="checkbox" name="user_access[]" 
                           value="{{ $row->groupID }}" class="form-check-input"
                           @if (in_array($row->groupID,$data6)) checked @endif
                        >
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
