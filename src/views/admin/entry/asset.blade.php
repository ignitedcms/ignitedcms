@php
 /*                                                                          
 |---------------------------------------------------------------            
 | Let's build the select asset container separately
 |---------------------------------------------------------------            
 */       
@endphp

     <div class="row">
         <div class="col-3">
             <div class="btn btn-white btn-s-xs" v-on:click="isShown = !isShown">
                 <i class="fa fa-plus"></i>
                 <strong>Add an asset</strong>
             </div>
         </div>
         <div class="col-9">
             <div class="img-save" v-if="tmp.length > 0">
                 <img :src="url" alt="" class="img-save-class"/>
                 <div class="img-save-rem" v-on:click="tmp = ''">
                 delete
                 </div>
             </div>
         </div>
     </div>
      <!-- Needed for POST input -->
      <input v-bind:name="name" v-bind:value="tmp" >
  
<div class="modal" v-if="isShown" v-on:keyup.escape="escapePressed">
   <div class="modal-content fade-in-bottom" @click.stop>

      <div class="modal-header">
         <button type="button" class="rm-btn-styles close m-t" v-on:click="isShown = !isShown">&times;</button>
         <h4 class="m-t">Assets</h4>
      </div>
      <div class="modal-body">
         <div class="p-3">

            <table id="example" class="display" style="width:100%">
               <thead>
                  <tr>
                     <th>Preview</th>
                     <th>handle</th>
                     <th>type</th>
                     <th>action</th>
                  </tr>
               </thead>
               <tbody>

                  @foreach ($assets as $field)
                  <tr>
                     <td> <img src="{{ $field->thumb }}"></img></td>
                     <td>{{ \Illuminate\Support\Str::limit($field->filename, 10, '...') }}</td>
                     <td>{{ $field->kind }}</td>
                     <td>
                        <div v-on:click="tmp='{{$field->id }}'; url=' {{ $field->thumb }}'; isShown =! isShown" class="hand hover"> 
                              Add
                        </div>
                     </td>
                  </tr>
                  @endforeach

               </tbody>

            </table>

         </div>
      </div>
      <!-- footer if needed -->
   </div>
</div>

