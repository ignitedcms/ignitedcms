<!-- <pre class="code">@{{matrix}}</pre> -->
<!-- This id is needed for sortable	 -->
<div id="items">
    <div class="front-matrix-block p-b-3" v-for="row in matrix">
        <div class="front-matrix-block__header">
            @{{row.title}}
            <div class="h-a" @click="row.collapsed = !row.collapsed">Collapse</div>
            <div class="matrix-del"  @click="deleteItem(row)">
               <span>
                  <i data-feather="trash" style="height:18px; width:18px;"></i>    
               </span>
            </div>
        </div>

        <div v-for="part in row.content" v-if="row.collapsed == false">
            <div class="front-matrix-block__content">
                <div v-if="part.type == 'plain-text'">
                    <div class="form-group">
                        <label>[@{{part.title}}]</label>
                        <div class="small text-muted">@{{part.instructions}}</div>
                        <input v-model="part.content" type="text" class="form-control" placeholder="Type here">
                            
                    </div>
                </div>
                <div v-if="part.type == 'number'">
                    <div class="form-group">
                        <label>[@{{part.title}}]</label>
                        <div class="small text-muted">@{{part.instructions}}</div>
                        <input v-model="part.content" type="text" class="form-control" placeholder="Type here">
                        
                    </div>
                </div>
                <div v-if="part.type == 'color'">
                    <div class="form-group">
                        <label>[@{{part.title}}]</label>
                        <div class="small text-muted">@{{part.instructions}}</div>
                        <input v-model="part.content" type="color" class="form-control" placeholder="Type here">
                    </div>
                </div>
                
                <div v-if="part.type=='multi-line'">
                    <div class="form-group">
                        <label>[@{{part.title}}]</label>
                        <div class="small text-muted">@{{part.instructions}}</div>
                        <textarea v-model="part.content" class="form-control" rows="5" 
                       placeholder="Type here"></textarea>
                    </div>
                </div>

                <div v-if="part.type=='drop-down'">
                    <div class="form-group">
                        <label>[@{{part.title}}]</label>
                        <div class="igs-small">@{{part.instructions}}</div>
                        <select class="form-select" v-model="part.content">
                            <option v-for="y in part.variations" :value="y">
                                @{{y}}
                            </option>
                        </select>
                    </div>
                </div>
                <div v-if="part.type=='check-box'">
                    <div class="form-group">
                        <label>[@{{part.title}}]</label>
                        <div class="small text-muted">@{{part.instructions}}</div>
                        <div v-for="y in part.variations">
                            <input v-model="part.checkedValues" class="form-check-input" type="checkbox" :value="y" /> @{{y}}
                        </div>
                    </div>
                </div>
                <div v-if="part.type=='rich-text'">
                    <div class="form-group">
                        <label>[@{{part.title}}]</label>
                        <div class="small text-muted">@{{part.instructions}}</div>
                          <quill-editor  
                           ref="quillEditor"
                           class="editor"
                           v-model="part.content"
                           :options="editorOption"
                           @blur="onEditorBlur($event)"
                           @focus="onEditorFocus($event)"
                           @ready="onEditorReady($event)"
                           />
                    </div>
                </div>

                <div v-if="part.type == 'date'">
                    <div class="form-group">
                        <label class="date">[@{{part.title}}]<br>
                        </label>
                        <div class="small text-muted">@{{part.instructions}}</div>
                        <datepicker v-model="part.content"></datepicker>
                    </div>
                </div>
                <div v-if="part.type == 'switch'">
                    <div class="form-group">
                        <div class="small text-muted">@{{part.instructions}}</div>
                        <switch-ios v-model="part.content" ></switch-ios>                        

                    </div>
                </div>
                <div v-if="part.type == 'file-upload'">
                    <div class="row">
                        <div class="col-12">
                            <label>[@{{part.title}}]</label>
                           <div class="small text-muted">@{{part.instructions}}</div>
                        </div>
                     </div>
                     <div class="row">
                        <div class="col-3">
                            <div class="btn btn-white" v-on:click="part.showAssets = !part.showAssets">
                                <span class="v-a">
                                   Add asset
                                </span>
                            </div>
                        </div>
                        <div class="col-9">
                            <div class="img-save" v-if="part.content.length > 0">
                                <img :src="part.thumb" alt="" class="m-l"/>
                                <div class="hand" style="max-width:80px;" v-on:click="part.content = ''">
                                   <span class="small bg-light p-l p-r b br">
                                       Delete
                                   </span>
                                </div>
                            </div>
                        </div>

                    </div>
                    <!-- modal -->
                    <div class="modal" v-if="part.showAssets">
                            <div class="modal-content fade-in-bottom">
                                <div class="modal-header">
                                    <button class="rm-btn-styles close m-t" v-on:click="part.showAssets =!part.showAssets" >&times;</button>
                                    <h4 class="m-t">Asset Library</h4>
                                </div>
                                <div class="modal-body">
                                    
                                   <div class="p-3">

                                     @if(count($assets) == 0)
                                       You need to upload an <a href="{{ url('admin/assets') }}">asset</a> first!
                                     @else

                                      <div class="row b-b">
                                         <div class="col"><h5>Preview </h5></div>
                                         <div class="col"><h5>Handle </h5></div>
                                         <div class="col"><h5>Type </h5></div>
                                         <div class="col"><h5>Action </h5></div>
                                      </div>

                                      @foreach ($assets as $field)
                                      <div class="row b-b">
                                         <div class="col">
                                            @if($field->kind !="jpg" and $field->kind != "png" and $field->kind != "bmp" and $field->kind != "jpeg")
                                            <img src="{{ asset('admin/images/file.jpg') }}"></img>
                                            @else
                                            <img src="{{ $field->thumb }}"></img>
                                            @endif
                                         </div>
                                         <div class="col v-a">
                                            {{ \Illuminate\Support\Str::limit($field->filename, 10, '...') }}
                                         </div>
                                         <div class="col v-a">
                                            {{ $field->kind }}
                                         </div>
                                         <div class="col v-a">
                                            <div v-on:click="part.content = '{{$field->url}}'; part.thumb = '{{ $field->thumb }}'; part.showAssets = false"> 
                                               <div type="submit" class="hand p-l p-r b br bg-white">Add</div>
                                            </div>
                                         </div>
                                      </div>
                                      @endforeach

                                   @endif

                                   </div>
                                </div>
                                
                            </div>
                        </div>
                        <!-- end modal -->
                </div>

            </div>
        </div>
    </div>
</div>
<!-- end items -->
