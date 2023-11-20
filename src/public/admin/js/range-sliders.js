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
Vue.component('rangeSlider',{
    props:['name','min','max'],
    template: 
    `
    <div class="slidecontainer">
        <input :name="name" type="range" v-model="message" v-bind:min="min" v-bind:max="max" class="slider2" />
        <p class="m-t-2">Value: <span id="demo">
            {{message}}
        </span></p>
    </div>
    `,
    data:function(){

        return{
            message: this.min
        }
    }
});


