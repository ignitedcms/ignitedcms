@extends('ignitedcms::admin.entry.multiple.layout')
@section('content')
    <div id="app" class="full-screen">
        @include('ignitedcms::admin.sidebar')
        <div class="main-content p-3" id="main-content">



            @if (session('error'))
                <div class="alert alert-danger m-b-3">
                    <div>Error</div>
                       <div class="small">
                       {{ session('error') }}
                       </div>
                </div>
            @endif


            <div class="toasts">
               <toast ref="toast">
                  <div class="p-2">
                     <div class="text-black">Success</div>
                     <div class="text-muted small">Order saved to db!</div>
                  </div>
               </toast>

            </div>            

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

                    <a href="{{ url(getSectionName($sectionid)) }}" target="_blank"
                        class="btn btn-white m-r-2 rm-link-styles">Preview</a>
                  

                    <modal button-title="Add another" modal-header="Add another">
                    <div class="p-2">
                       <div class="rows">

                          <div class="col p-b-2">

                              <div class="alert alert-info">
                                 To add another item to the multiple, you must first create
                                 an entry title, this must be unique and contain only lowercase
                                 letters with dashes e.g 'hello-world'
                              </div>
                             
                                <div class="form-group">
                                   <label for="title">Entry title</label>
                                   <div class="small text-muted">Entry title</div>
                                   <input class="form-control" 
                                          v-model="entrytitle"
                                          value="" 
                                          placeholder="Start typing" />

                                    <div class="small text-danger">@{{ errs }}</div>
                                </div>
                                <div class="form-group right">

                                   <button  class="btn btn-primary" @click="save_title">Add another</button>
                                </div>
                             
                          </div>
                       </div>

                    </div>
                    </modal>

                </div>
            </div>

            <div class="row">
                <div class="col-12">
                   <div class="alert alert-info ">
                      <div class="text-black">Did you know?</div>
                      <div class="small text-muted">
                         You can drag and drop to re-order the position, this can be used to
                         display multiples in a specific order.
                      </div>
                   </div>
                </div>
            </div>

            <div class="m-b-3"></div>

            <!--main part for section styles -->
            <div class="panel br drop-shadow p-b-3">

                <form action="{{ url("admin/multiple/search/$sectionid") }} " method="POST">
                   @csrf
               <div class="row">
                  <div class="col">
                     <div class="pos-rel">

                        <span>
                           <i 
                          data-feather="search"
                          class="icon-inside hand"
                          ></i>
                        </span>

                        <input class="form-control" 
                               name="searchQuery"
                               value="" 
                               placeholder="Start typing to search then hit enter" />
                     </div>    
                  </div>

               </div>
               </form>
                <form action="{{ url("admin/multiple/delete/$sectionid") }}" method="POST">
                    @csrf

                    

                    <div class="row">
                       <div class="col-6">
                          <h3>{{ $sectionname }}</h3>
                       </div>
                       <div class="col-6 right">
                          <popover link="Delete selected items?"  class="pull-right">

                          <button type="submit" class="rm-btn-styles ">Ok</button>

                          </popover>
                       </div>
                    </div>
                    <div class="clearfix"></div>
                    
                    <div id="sortable-list">
                        @foreach ($data as $row)
                            <!-- tidy this up later   -->

                            <a href="{{ url("admin/entry/update/$sectionid/$row->id") }}" class="rm-link-styles">
                                <div class="panel border-fix no-padding p-t p-l-2 p-b">

                                    <input type="checkbox" class="form-check-input" name="id[]"
                                        value="{{ $row->id }}">
                                    <span class="m-l">
                                       {{ $row->entrytitle }}   
                                    </span>
                                    <span class="pull-right m-r-2">
                                       <i data-feather="more-vertical"></i>    
                                    </span>

                                </div>

                            </a>
                        @endforeach

                    </div>

                </form>
            </div>
        </div>
        <div class="gap"></div>
    </div>
@endsection
