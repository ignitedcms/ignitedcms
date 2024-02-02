@extends('ignitedcms::admin.entry.multiple.layout')
@section('content')
    <div id="app" class="full-screen">
      <sidebar theme="light">
            <ul slot="header" class="rm-list-styles">

             @include('ignitedcms::admin.sidebar')
               
            </ul>

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
                  <div class="p-4">
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
                
                <div class="col">

                    <a href="{{ url(getSectionName($sectionid)) }}" target="_blank"
                        class="btn btn-white m-r-2 rm-link-styles">Preview</a>
                  

                    <modal button-title="Add another" modal-header="Add another">
                    <div class="p-2">
                       <div class="rows">

                          <div class="col p-b-2">

                              <div class="alert alert-success">
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
                   <div class="alert alert-success ">
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
            <div class="panel">

                <form action="{{ url("admin/multiple/search/$sectionid") }} " method="POST">
                   @csrf
               <div class="row">
                  <div class="col">
                     <div class="relative">

                        <button 
                          type="submit"
                          class="rm-btn-styles absolute"
                          style="top:0px; right:-5px;"
                        >
                           <i 
                          data-feather="x"
                          class="icon-inside hand"
                          ></i>
                        </button>

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

                    

                    <div class="row h-e">
                       <div>
                          <h3>{{ $sectionname }}</h3>
                       </div>
                       <div>
                          <popover link="Delete selected items?">
                             <button type="submit">ok</button> 
                          </popover>
                       </div>
                    </div>
                    
                    <div id="sortable-list">
                        @foreach ($data as $row)
                            <!-- tidy this up later   -->

                            <a href="{{ url("admin/entry/update/$sectionid/$row->id") }}" class="rm-link-styles">
                                <div class="bg-white border border-[--gray] border-fix p-2 h-e">

                                    <input type="checkbox" class="form-check-input" name="id[]"
                                        value="{{ $row->id }}">
                                    <span class="m-l">
                                       {{ $row->entrytitle }}   
                                    </span>
                                    <span class="">
                                       <i data-feather="more-vertical"></i>    
                                    </span>

                                </div>

                            </a>
                        @endforeach

                    </div>

                </form>
            </div>
            <div class="gap"></div>
        </div>
      </sidebar>
    </div>
@endsection
