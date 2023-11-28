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
         <h4 class="m-t">fds</h4>
      </div>
      <div class="modal-body">
         <div class="p-3">
            list the pictures 
         </div>
      </div>
      <!-- footer if needed -->
   </div>
</div>

