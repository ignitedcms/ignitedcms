/*
|---------------------------------------------------------------
| Mobile Menu 
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
Vue.component('mobile-menu',{
    props:['title','logo','url'],
    template: 
    `
    <div style="top:0; position:sticky; z-index:2;">
       <div class="menu-bar ">
          <div class="menu-logo">
             <a :href="url">
                <img :src="logo"></img>
             </a>
          </div> 
          <div >
             <span @click="isShown =!isShown">
                <i data-feather="menu" class="icon hand" ></i>
             </span>
          </div>
       </div>

       <div class="menu-overlay fade-in-bottom" v-if="isShown">
          <slot></slot>
          
          <a href="#" style="width:100%;" class="rm-link-styles">
            <div class="menu-item">
             {{title}}
            </div>
          </a>
          
       </div>
    </div>
    
    `,
    data:function(){
        return {
            message: 'Hello',
            isShown: false, /*for mobile menu*/
        }
    },
    methods: {

    }
});


Vue.component('mobile-menu-items',{
    props:['title','url','children'],
    template: 
    `
    <div style="width:100%;"> 

       <a v-if="children !== 'yes'" :href="url"  class="rm-link-styles">
          <div class="menu-item ">
             {{title}}
          </div>
       </a>
       
       <div @click="show = !show" v-if="children === 'yes'" class="menu-item no-select">
         <div>{{title}}</div>
         <div>
               +
             <i data-feather="menu" class=" hand"></i>
         </div>
       </div>
       <div v-if="show" class="item-content no-select">
             <slot></slot>
          </div>
    </div> 
    `,
     data:function(){

         return{
           show:false
         }
     },
     methods: {
      away: function () {
        this.show = false;
      },
    }
  
});


