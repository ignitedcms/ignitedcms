/*
|---------------------------------------------------------------
| Trees
| 
| Components only data must be passed as a function
| Use slots to repeat child components
| Use props to pass in data MUST use kebab case eg postTitle => post-title 
| 
| IMPORTANT not fully complete at the moment 
|---------------------------------------------------------------
| @author: IgnitedCMS
| @license: MIT
| @version: 1.0
| @since: 1.0
*/


Vue.component('tree',{
    //props:['title','logo','url'],
    template: 
    `
    <div>
      <slot> 
      </slot> 
    </div>
    
    `,
    data:function(){
        return {
            //message: 'Hello',
        }
    },
    mounted(){
       var toggler = document.getElementsByClassName("caret");
       var i;

       for (i = 0; i < toggler.length; i++) {
         toggler[i].addEventListener("click", function() {
           this.parentElement.querySelector(".nested").classList.toggle("active");
           this.classList.toggle("caret-down");
         });
       }

    },
    methods: {
         //methods go here
    }
});



