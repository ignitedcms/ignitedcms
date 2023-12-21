/*
|---------------------------------------------------------------
| Tooltip component 
| 
| Components only data must be passed as a function
| Use slots to repeat child components
| Use props to pass in data MUST use kebab case eg postTitle => post-title 
|---------------------------------------------------------------
|
|
*/
Vue.component('tooltip',{
    props:['link','width'],
    template: 
    `
    <button @keyup.escape="escapePressed()"  type="button" 
         aria-haspopup="dialog"  :aria-expanded="arr"  class="btn rm-btn-styles tooltip-rel" 
         @click="tmp" v-click-outside="away">
     <span class="tooltip-highlight"> {{link}} </span>
        <div v-if="show" class="tooltip fade-in" @click.stop  :style="{width: width}">

          <focus-trap  :active="show">
            <slot></slot> 
         </focus-trap>
        </div>
    </button>
    `,
    data:function(){

        return{
            message: 'Hello',
            show: false,
            arr: 'false',
        }
    },
    methods:{
        away: function () {
            this.show = false;
            this.arr = 'false';
        },
       tmp(){
         this.show = !this.show;
          if(this.arr == 'false')
          {
            this.arr = 'true';
          }
          else
             this.arr = 'false';
      },

       escapePressed()
       {
            this.show = false;
            this.arr = 'false';
       }
    } 
});
