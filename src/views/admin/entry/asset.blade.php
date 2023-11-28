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

            @foreach ($assets as $asset)
                <img src="{{ $asset->url }}"></img>
             <div v-on:click="change_asset( {{ $asset->id }} )"> click </div>
            @endforeach

         </div>
      </div>
      <!-- footer if needed -->
   </div>
</div>

