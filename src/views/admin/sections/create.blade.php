@extends('ignitedcms::admin.sections.layout')
@section('content')
    <div class="full-screen" id="app">
        @include('ignitedcms::admin.sidebar')
        <div class="main-content p-3">

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
         

            <form action="{{ url('admin/section/create') }}" method="POST">
                @csrf

                <div class="breadcrumb m-b-3">
                    <div class="breadcrumb-item">
                        <a href="{{ url('admin/dashboard') }}">Dashboard</a>
                    </div>
                    <div class="breadcrumb-item">
                        <a href="{{ url('admin/section') }}">Sections</a>
                    </div>
                    <div class="breadcrumb-item">Create section</div>
                </div>



            


                <!--main part for section styles -->
                <div class="panel br drop-shadow">
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
                            <div id='list1' class='scroll-y bg-white cross-grid p-2 b br' style="height:500px;">
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
                            <div id='list2' class='scroll-y bg-grey b br p-2' 
                              style="min-height:200px;">

                                @foreach ($data as $field)
                                    <div class="pill" id="{{ $field->id }}">
                                        <div>{{ $field->name }}</div>
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
                                 <div class="m-b"></div>
                                 <switch-ios value="" name="template"></switch-ios>
                              </div>
                           </div>
                        </div>
                     </div>
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
