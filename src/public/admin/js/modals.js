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
    <div v-on:keyup.escape="escapePressed()">
    <button type="button" class="btn btn-white " v-on:click="open=true" v-click-outside="away">
      {{buttonTitle}} 
    </button>
    <div class="modal" v-show="open" v-on:keyup.escape="escapePressed">
      <div class="modal-content fade-in-bottom" @click.stop>

        <div class="modal-header">
          <button type="button" class="rm-btn-styles close m-t" v-on:click="open = false">&times;</button>
          <h4 class="m-t">{{modalHeader}}</h4>
        </div>
        <div class="modal-body">
          <slot></slot>
        </div>
       <!-- footer if needed -->
        </div>
      </div>
    </div>
  </div>
    `,
    data:function(){

        return{
            message: 'Hello',
            open: false,
        }
    },
    methods: {
      away: function () {
        this.open = false;
      },
      
      escapePressed()
      {
         //alert('escape pressed');
        this.open = false;
      },
    }
});
