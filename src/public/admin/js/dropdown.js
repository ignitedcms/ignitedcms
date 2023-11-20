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
    <button v-on:keyup.escape="escapePressed()" type="button" class="btn btn-white drop-shadow pos-rel" v-on:click="show =!show" v-click-outside="away">
        {{buttonTitle}}
        <div v-if="show" class="dropdown br drop-shadow fade-in" @click.stop>
            <slot></slot> 
        </div>
    </button>
    `,
    data:function(){

        return{
            message: 'Hello',
            show: false,
        }
    },
    methods:{
        away: function () {
            this.show = false;
        },
       escapePressed()
       {
         this.show = false;
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

