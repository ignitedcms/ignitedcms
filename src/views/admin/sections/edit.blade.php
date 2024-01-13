@extends('ignitedcms::admin.sections.layout')
@section('content')
    <div class="full-screen" id="app">
        @include('ignitedcms::admin.sidebar')
      
         @if (session('errors'))
            <div class="toasts">
               <toast ref="toast">
               <div class="p-2">
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
                <div class="panel br drop-shadow">
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
                    <div class="nothing">
                       <div class="alert alert-success m-t-2 m-b-2">
                          <div class="text-black">Information</div>
                          <div class="small text-muted">
                             Drag and drop the fields you need, reorder and click save
                          </div>
                       </div>
                    </div>

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

                            <div class="nothing">
                                <h4>Page</h4>
                            </div>
                            <div id='list1' class='scroll-y bg-white cross-grid p-2 b br' style="height:500px;">
                                @foreach ($data3 as $field)
                                    <div class="pill m-t bg-white h-e b br p drop-shadow hand v-a" id="{{ $field->id }}">
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
                            <div id='list2' class='scroll-y bg-grey b br p-2'
                               style="min-height:200px;"  >

                                @foreach ($data as $field)
                                    <?php if(isFieldInSection($field->id, $id)) : ?>
                                    <div class="pill m-t bg-white h-e b br p drop-shadow hand v-a" id="{{ $field->id }}">
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
                       <div class="p-2 bg-white  b br">
                          <div class="row">
                             <div class="col no-margin">
                                <div class="row">
                                   <div class="col no-margin">
                                      <div class="text-black">Template builder</div>
                                   </div>
                                </div>
                                <div class="row">
                                   <div class="col no-margin">
                                      <div class="small text-muted">
                                         Enabling this will automatically create and
                                         overwrite the template in the 
                                         resources > views > custom directory.
                                      </div>
                                   </div>
                                </div>
                             </div>
                             <div class="col no-margin right">
                                <div>
                                   <label for="title"></label> 
                                   <div class="m-b"></div>
                                    <switch-ios value="" name="template"></switch-ios>

                                </div>
                             </div>
                          </div>
                       </div>
                    </div>

                    <div class="form-group bg-white p-2 br b">
                     <h5>User access</h5>
                     <div class="text-black">Information</div>
                     <div class="small text-muted m-b">
                        Select who has access to add and edit content in this section
                     </div>
                     @foreach($data5 as $row)
                     <div>
                        <input type="checkbox" name="user_access[]" 
                           value="{{ $row->groupID }}" class="form-check-input"
                           @if (in_array($row->groupID,$data6)) checked @endif
                        >
                        <label for="the label">{{ $row->groupName }}</label>
                     </div>
                     @endforeach
                     
                  </div>


                    <div class="row">
                       <div class="col-12 right">
                          <button @click="onClicking" type="submit" class="m-l btn btn-primary">Save</button>
                       </div>
                    </div>
                </div>

                

                <div class="gap"></div>
                <!--end main part-->

            </form>
        </div>
    </div>
@endsection
