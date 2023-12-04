/*
|---------------------------------------------------------------
| Accordion components 
| 
| Components only data must be passed as a function
| Use slots to repeat child components
| Use props to pass in data MUST use kebab case eg postTitle => post-title 
|---------------------------------------------------------------
|
|
*/
Vue.component('accordion',{
    template: 
    `
        <div>
            <slot></slot> 
        </div>
    `,
    data:function(){
        return{
            /*nothing to see*/
        }
    }
});

Vue.component('accordion-item',{
    props: ['title'],
    template: 
    `
    <div class="row">
        <div class="col no-margin">
            <button type="button" class="accordion-title rm-btn-styles" @click="toggle">
               <div>
                {{title}}
               </div>

                  <span >
                     <i data-feather="chevron-down"></i>    
                  </span>
            </button>
            <div class="accordion-content fade-in" v-if="is_active">
                <slot></slot>
            </div>
        </div>
    </div>
    `,
    data:function(){

        return{
            is_active:false
        }
    },
    methods:
    {
        toggle()
        {
            this.is_active = !this.is_active
        }
    }
});
