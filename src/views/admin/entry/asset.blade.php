<div>
     <div class="row">
         <div class="col v-a">
             <button class="btn btn-white" @click.prevent v-on:click="isShown = !isShown" v-click-outside="away">
                 Add asset
             </button>
             <div  v-if="tmp.length > 0" class="ml-2 inline-block" >
                <img :src="url" class="ml-4 border border-[--gray]" />
                <div class="hand" style="max-width:80px;" v-on:click="tmp = ''">
                   <span class="ml small bg-white px-2 rounded-[--small-radius] cursor-pointer border border-[--gray]" style="margin-left:12px;">
                      Delete
                   </span>
                </div>
             </div>
         </div>
         
     </div>
      <!-- Needed for POST input -->
      <input v-bind:name="name" v-bind:value="tmp" style="display:none;" >
</div> 
<div class="modal" v-show="isShown" v-on:keyup.escape="escapePressed">
   <div 
     class="
      modal-content
      bg-light-gray
      p-4
      rounded-[--big-radius]
      border
      border-[--gray]
      fade-in-bottom
      " @click.stop>

      <div class="modal-header relative">
         <button 
           type="button" 
           style="width:30px; height:30px; "
           class="absolute 
            right-0
            bg-dark
            m-t" 
            v-on:click="isShown = !isShown">
          <span class="v-a h-a">
             <i data-feather="x" class="text-white"></i>    
          </span>
         </button>
      </div>
      <div class="modal-body">
         <div class="p-3">

            @php $amount = count($assets); @endphp

            @if($amount > 0)
            <div class="row ">
               <div class="col"><h5>Preview </h5></div>
               <div class="col"><h5>Handle </h5></div>
               <div class="col"><h5>Type </h5></div>
               <div class="col"><h5>Action </h5></div>
            </div>

               @foreach ($assets as $field)
               <div class="row ">
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
                        <div type="submit" class="relative cursor-pointer bg-white px-2 rounded-md border border-[--gray]">Add</div>
                     </div>
                     
                  </div>
               </div>
               @endforeach

            
            @else
               <div style="min-height:300px;">You need to add an <a href="{{ url('admin/assets') }}"> asset </a> first!</div>
            @endif


         </div>
      </div>
      <!-- footer if needed -->
   </div>
</div>

