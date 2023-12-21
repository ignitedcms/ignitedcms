/*
|---------------------------------------------------------------
| Toast components 
| 
| Components only data must be passed as a function
| Use slots to repeat child components
| Use props to pass in data MUST use kebab case eg postTitle => post-title 
|---------------------------------------------------------------
|
|
*/
Vue.component('toast',{
    props:['time'],
    template: 
    `
    <div class="toast fade-in-bottom" role="alert" aria-atomic="true" 
          aria-live="assertive" :style="{display:foo}">
         <slot></slot>
    </div>
    `,
    data:function(){
        return{
            foo:''
        }
    },
    methods:
    {
        t()
        {
            this.foo = "none"
        }
    },
    mounted()
    {
        setTimeout(this.t,this.time);
    }
});
