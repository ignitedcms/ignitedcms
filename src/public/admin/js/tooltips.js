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
    props:['link'],
    template: 
    `
    <button v-on:keyup.escape="escapePressed()"  type="button" class="btn rm-btn-styles tooltip-rel" v-on:click="show =!show" v-click-outside="away">
     <span class="tooltip-highlight"> {{link}} </span>
        <div v-if="show" class="tooltip  fade-in" @click.stop>
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
