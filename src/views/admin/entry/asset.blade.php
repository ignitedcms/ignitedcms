@php
 /*                                                                          
 |---------------------------------------------------------------            
 | Let's build the select asset container separately
 |---------------------------------------------------------------            
 */       
@endphp

<div class="modal" v-show="open" v-on:keyup.escape="escapePressed">
   <div class="modal-content fade-in-bottom" @click.stop>

      <div class="modal-header">
         <button type="button" class="rm-btn-styles close m-t" v-on:click="open = false">&times;</button>
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
                     <td>{{ $field->filename }}</td>
                     <td>{{ $field->kind }}</td>
                     <td>
                        <div v-on:click="change_asset( {{ $field->id }} )" class="hand"> 
                           <strong>
                           Add
                         </strong> 
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

