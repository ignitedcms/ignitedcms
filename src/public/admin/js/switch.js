/*
|---------------------------------------------------------------
| Switches 
| 
| Components only data must be passed as a function
| Use slots to repeat child components
| Use props to pass in data MUST use kebab case eg postTitle => post-title 
|---------------------------------------------------------------
|
|
*/
Vue.component('switchIos',{
    props:['name', 'value'],
    template: 
    `
    <label class="form-switch">

    <input :name="name" type="checkbox"  :checked="value" @change="handleChange" />
    <i></i> <div class="switch-text no-select">{{message}}</div>
    </label>
    `,
    data:function(){

        return{
            message: 'Yes/no',
            show: false,
        }
    },
    methods: {
    handleChange(event) {
      this.$emit('input', event.target.checked);
    }
  }
});


