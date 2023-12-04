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
Vue.component('emitpicker',{
    props:['value'],
    template: 
    `
    <div class="date-picker">
     <input type="text" :value="value" @input="updateDate($event.target.value)" />
     <div @click="test('1999-08-06')"> click </div>
    </div>
    `,
    data:function(){

        return {
            // content: 'bar'
        }
    },
    methods: {
        updateDate(newValue) {
            this.$emit('input', newValue); // Emit the updated value using v-model
        },
        test(idx)
        {
            this.updateDate(idx)
        }
    }
});
