/*
|---------------------------------------------------------------
| Dropdowns 
| 
| Components only data must be passed as a function
| Use slots to repeat child components
| Use props to pass in data MUST use kebab case eg postTitle => post-title 
|---------------------------------------------------------------
|
|
*/
Vue.component('drop-down',{
    props:['button-title'],
    template: 
    `
    <button @keyup.escape="escapePressed()" aria-haspopup="dialog" :aria-expanded="arr" type="button" 
      class="btn btn-white  pos-rel" @click="tmp" v-click-outside="away">
        {{buttonTitle}}
        <div v-if="show" class="dropdown br drop-shadow fade-in" @click.stop>
          <focus-trap :active="show">
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
       tmp()
       {
         this.show = ! this.show;
          if(this.arr == 'true')
          {
             this.arr = 'false';
          }
          else
          {
             this.arr = 'true';
          }

       },

        away: function () {
            this.show = false;
           this.arr = 'false';
        },
       escapePressed()
       {
         this.show = false;
          this.arr = 'false';
       }
    } 
});


Vue.component('item',{
    props: ['title','url'],
    template: 
    `
    <div class="row">
        <div class="col no-margin">
            <div class="dropdown-item">
                <a :href="url" class="left">{{title}}</a>
            </div>
        </div>
    </div>
    `,
    // data:function(){

    //     return{

    //     }
    // }
});

