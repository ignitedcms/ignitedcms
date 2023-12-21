/*
|---------------------------------------------------------------
| Modals 
| 
| Components only data must be passed as a function
| Use slots to repeat child components
| Use props to pass in data MUST use kebab case eg postTitle => post-title 
| Add a footer
| 
|
|     <div class="modal-footer">
|        <div class="row">
|           <div class="col-12 right">
|             <button type="button" class="btn btn-primary pull-right">Save</button>
|           </div>
|        </div>
|     </div>
|        
|---------------------------------------------------------------
|
|
*/
Vue.component('modal',{
    props:['button-title','modal-header'],
    template: 
    `
  <div @keyup.escape="escapePressed()">
    <button type="button" class="btn btn-white " @click="open=true; arr='false'" v-click-outside="away">
      {{buttonTitle}} 
    </button>
    
    <div class="modal" role="dialog" aria-modal="true" :aria-hidden="arr" v-show="open" @keyup.escape="escapePressed">
       <div class="modal-content fade-in" @click.stop>

          <focus-trap  :active="open">
             <div class="modal-header">
                <button type="button" aria-label="Close" class="rm-btn-styles close m-t" @click="open = false; arr='true'">&times;</button>
                <h5 class="m-t">{{modalHeader}}</h5>
             </div>
             <div class="modal-body">
                <slot></slot>
             </div>
          </focus-trap>        

       </div>
    </div>
  </div>
    `,
    data:function(){

        return{
            message: 'Hello',
            open: false,
            arr: 'true'
        }
    },
    methods: {
      away: function () {
        this.open = false;
         this.arr = 'true';
      },
      
      escapePressed()
      {
        this.open = false;
         this.arr = 'true';
      },
    }
});
