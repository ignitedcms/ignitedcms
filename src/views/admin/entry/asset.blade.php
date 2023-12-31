@php
 /*                                                                          
 |---------------------------------------------------------------            
 | Let's build the select asset container separately
 |---------------------------------------------------------------            
 */       
@endphp
<div>
     <div class="row">
         <div class="col-4">
             <div class="btn btn-white " v-on:click="isShown = !isShown" v-click-outside="away">
                  <span>
                     <i data-feather="plus"></i>    
                  </span>
                 Add an asset
             </div>
         </div>
         <div class="col-8">
             <div  v-if="tmp.length > 0">
                 <img :src="url" class="m-l" />
                 <div class="hand" style="max-width:80px;" v-on:click="tmp = ''">
                  <span class="small bg-light p-l p-r  b br ">
                    Delete
                  </span>
                 </div>
             </div>
         </div>
     </div>
      <!-- Needed for POST input -->
      <input v-bind:name="name" v-bind:value="tmp" style="display:none;" >
</div> 
<div class="modal" v-if="isShown" v-on:keyup.escape="escapePressed">
   <div class="modal-content fade-in-bottom" @click.stop>

      <div class="modal-header">
         <button type="button" class="rm-btn-styles close m-t" v-on:click="isShown = !isShown">&times;</button>
         <h4 class="m-t">Assets</h4>
      </div>
      <div class="modal-body">
         <div class="p-3">

            @php $amount = count($assets); @endphp

            @if($amount > 0)
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
                
                     <div v-on:click="tmp='{{$field->id }}'; url=' {{ $field->thumb }}'; isShown =! isShown" class="hand hover"> 
                        <div type="submit" class=" p-l p-r b br bg-white">Add</div>
                     </div>
                     
                  </div>
               </div>
               @endforeach

            
            @else
               <div  style="min-height:300px;">You need to add an <a href="{{ url('admin/assets') }}"> asset </a> first!</div>
            @endif


         </div>
      </div>
      <!-- footer if needed -->
   </div>
</div>

