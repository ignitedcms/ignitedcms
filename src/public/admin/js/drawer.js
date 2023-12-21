/*
|---------------------------------------------------------------
| Drawer component 
| 
| Components only data must be passed as a function
| Use slots to repeat child components
| Use props to pass in data MUST use kebab case eg postTitle => post-title 
|---------------------------------------------------------------
|
|
*/
Vue.component('drawer',{
    props:['title'],
    template: 
    `
    <div>
       <button  @click="drawer = !drawer"
          v-click-outside="away"
          @keyup.escape="escapePressed()"
          type="submit"
          class="btn btn-white m-b-2">{{title}}</button>
       <div v-if="drawer" @click.stop class="drawer fade-in b-l">
          <focus-trap :active="drawer">
            <slot></slot>
          </focus-trap>
       </div>
    </div>
    `,
    data:function(){
        return{
            drawer: false
        }
    },
    methods:{
        away: function () {
            this.drawer = false;
        },

       escapePressed()
       {
            this.drawer = false;
       }
    } 
});

