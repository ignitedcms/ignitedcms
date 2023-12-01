 <pre class="code">@{{matrix}}</pre> 
<!-- This id is needed for sortable	 -->
<div id="items">
    <div class="front-matrix-block" v-for="row in matrix">
        <div class="front-matrix-block__header">
            @{{row.title}}
            <div class="matrix-collapse" @click="row.collapsed = !row.collapsed">collapse</div>
            <div class="matrix-del" @click="deleteItem(row)"><i class="fa fa-trash-o"></i></div>
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
                        <div class="form-group">
                           <textarea class="quilljs-textarea" placeholder="Please enter text" 
                              v-model="part.content">

                           </textarea>
                        </div>
                           <pre>@{{part.content}}</pre> 
                       quill 
                    </div>
                </div>

                <div v-if="part.type == 'date'">
                    <div class="form-group">
                        <label class="date">[@{{part.title}}]<br>
                        </label>
                        <div class="small text-muted">@{{part.instructions}}</div>
                        <datepicker v-model="part.content" > </datepicker>
                    </div>
                </div>
                <div v-if="part.type == 'switch'">
                    <div class="form-group">
                        <div class="small text-muted">@{{part.instructions}}</div>
                        <switch-ios v-model="part.content" state="" ></switch-ios>
                        
                    </div>
                </div>
                <div v-if="part.type == 'file-upload'">
                    <div class="row">
                        <div class="col-sm-12">
                            <label>[@{{part.title}}]</label>
                        </div>
                        <div class="igs-small">@{{part.instructions}}</div>
                        <div class="col-sm-3">
                            <div class="btn btn-white btn-s-xs" v-on:click="part.showAssets = !part.showAssets">
                                <i class="fa fa-plus"></i>
                                <strong>Add an asset</strong>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <!-- Fix this bug on matrix -->
                            <!-- Not passing in the fieldName -->
                            <div v-on:click="hideApp = !hideApp; fieldname =part.title; is_matrix = true " class="hide-app">Upload a new </div> 
                        </div>
                        <div class="col-sm-6">
                            <div class="img-save" v-if="part.content.length > 0">
                                <img :src="part.content" alt="" class="img-save-class"/>
                                <div class="img-save-rem" v-on:click="part.content = ''">
                                    <i class="fa fa-trash-o"></i>
                                </div>
                            </div>
                        </div>

                    </div>
                    <!-- modal -->
                    <div class="modal-cms" v-if="part.showAssets">
                            <div class="modal-content-cms">
                                <div class="modal-header-cms">
                                    <button class="rm-btn-styles close" v-on:click="part.showAssets =!part.showAssets" >&times;</button>
                                    <h4>Asset Library</h4>
                                </div>
                                <div class="modal-body-cms">
                                    <div class="row">
                                        <div class="col-sm-12 mt">
                                            <div class="form-group">
                                             assets
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer-cms">
                                    <div class="row">
                                        <div class="col-sm-12 right">
                                            <div class="form-group">
                                                <div class="btn btn-purplet pull-right"><strong>Cancel</strong></div>
                                            </div>
                                        </div>
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
