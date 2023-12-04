/*
|---------------------------------------------------------------
| Emit component, demo how components can use v-model binding
| 
| Components only data must be passed as a function
| Use slots to repeat child components
| Use props to pass in data MUST use kebab case eg postTitle => post-title 
|---------------------------------------------------------------
|
|
*/
Vue.component('emitter',{
    props:['value'],
    template: 
    `
    <input
     class="form-control"
    :value="value"
    @input="$emit('input', $event.target.value)"
    /> 
    `,
    data:function(){

        return{
            // content: this.value
        }
    },
});
