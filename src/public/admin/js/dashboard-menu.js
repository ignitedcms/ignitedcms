/*
|---------------------------------------------------------------
| Mega Menus 
| 
| Components only data must be passed as a function
| Use slots to repeat child components
| Use props to pass in data MUST use kebab case eg postTitle => post-title 
| 
|---------------------------------------------------------------
| @author: IgnitedCMS
| @license: MIT
| @version: 1.0
| @since: 1.0
*/


Vue.component('dashboard-menu',{
    props:['logo','url'],
    template: 
    `
    <div class="col-2 no-margin bg-primary  pos-rel">
       <div class="row p-2 dashboard">
          <div class="col no-margin">
             <div class="no-margin bg-primary m-b-2">
                <img :src="logo" style="width:100px;"></img>
             </div>
             <slot>
             </slot>
          </div>
       </div>
         <div class="row bg-grey b-b" style="min-height:60px;">
                  <div class="col no-margin ">
                        <div class="m-l m-t sidebar-toggle hand drop-shadow br">
                        <span class="m-t text-muted">
                        <i data-feather="menu"></i>
                        </span>
                     </div>
                  </div>
               </div>

      
    </div>
    `,
    data:function(){
        return {
            message: 'Hello',
        }
    },
    methods: {

    }
});


Vue.component('dashboard-items',{
    props:['title','url'],
    template: 
    `
    <div class="bg-primary p-t p-b hand hover-left">
       {{title}}
    </div>
    `,
     data:function(){

         return{
           show:false
         }
     },
     methods: {

    }
  
});

