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
    props:['name','state'],
    template: 
    `
    <label class="form-switch">

    <input :name="name" type="hidden"  value="0" />
    <input :name="name" type="checkbox"  value="1" :checked="state" />
    <i></i> <div class="switch-text">{{message}}</div>
    </label>
    `,
    data:function(){

        return{
            message: 'Yes/no',
            show: false,
        }
    }
});


