@php
 /*                                                                          
 |---------------------------------------------------------------            
 | Let's build the select asset container separately
 |---------------------------------------------------------------            
 */       
@endphp
<div>
     <div class="row">
         <div class="col-3">
             <div class="btn btn-white btn-s-xs" v-on:click="isShown = !isShown" v-click-outside="away">
                 <i class="fa fa-plus"></i>
                 <strong>Add an asset</strong>
             </div>
         </div>
         <div class="col-9">
             <div  v-if="tmp.length > 0">
                 <img :src="url" alt="" class="img-save-class"/>
                 <div class="hand" v-on:click="tmp = ''">
                   Delete
                 </div>
             </div>
         </div>
     </div>
      <!-- Needed for POST input -->
      <input v-bind:name="name" v-bind:value="tmp" >
</div> 
<div class="modal" v-if="isShown" v-on:keyup.escape="escapePressed">
   <div class="modal-content fade-in-bottom" @click.stop>

      <div class="modal-header">
         <button type="button" class="rm-btn-styles close m-t" v-on:click="isShown = !isShown">&times;</button>
         <h4 class="m-t">Assets</h4>
      </div>
      <div class="modal-body">
         <div class="p-3">

            <div class="row">
               <div class="col">Preview</div>
               <div class="col">Handle</div>
               <div class="col">Type</div>
               <div class="col">Action</div>
            </div>

               @foreach ($assets as $field)
               <div class="row">
                  <div class="col">
                     <img src="{{ $field->thumb }}"></img>
                  </div>
                  <div class="col v-a">
                     {{ \Illuminate\Support\Str::limit($field->filename, 10, '...') }}
                  </div>
                  <div class="col v-a">
                     {{ $field->kind }}
                  </div>
                  <div class="col v-a">
                     <div v-on:click="tmp='{{$field->id }}'; url=' {{ $field->thumb }}'; isShown =! isShown" class="hand hover"> 
                        Add
                     </div>
                  </div>
               </div>
               @endforeach

         </div>
      </div>
      <!-- footer if needed -->
   </div>
</div>

