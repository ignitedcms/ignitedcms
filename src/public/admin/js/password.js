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
Vue.component('password',{
    props:['value'],
    template: 
    `
    <div class="form-group">
         <label for="Password">Password</label>
         <div class="small text-muted m-b">password</div>
         <div class="pos-rel">
            <span @click='eyeball()'>
               <i data-feather='eye'  class='icon-inside hand'></i>
            </span>
            <input name="password" :type="foo" :value="value" placeholder="placeholder" class="form-control">
         </div>
         <div class="small text-danger"></div>
      </div>
    `,
    data:function(){
        return{
            foo:'password'
        }
    },
    methods:
    {
       eyeball()
       {
          if(this.foo == 'password')
          {
             this.foo = 'text'
          }
          else {
             this.foo = 'password'
          }

       }
    }
});

