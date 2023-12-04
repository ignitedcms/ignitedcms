/*
|---------------------------------------------------------------
| sidebar component, for use on the dashboard
| 
| Components only data must be passed as a function
| Use slots to repeat child components
| Use props to pass in data MUST use kebab case eg postTitle => post-title 
|---------------------------------------------------------------
|
|
*/
Vue.component('sidebar',{
    props:['theme'],
    template: 
    `
    <div>
       <div id="side_nav" class="sidebar-dark" >
          <a href="https://www.ignitedcms.com/">
          </a>
          <h5 class="m-l m-t-2">Dashboard</h5>
          <slot name="header"></slot>
       </div>
       <div  class="sidebar-fixed-dark fade-in" :style={display:styles} id="sidebar-fixed" @click.stop>
          <a href="https://www.ignitedcms.com/">
          </a>
          <h5 class="m-l m-t-2">Dashboard</h5>
          <slot name="header"></slot>
       </div>
       <div class="main-content" id="main-content">
          <div class="search-container">
             <div @click="toggle_sidemenu"  v-click-outside="away" class="sidebar-toggle hand drop-shadow br">
                <i data-feather="menu"></i>
             </div>
             <div style="width:60%;" class="m-l-2">
                <input class="form-control"  name="a" placeholder="Search then hit enter" />
             </div>
          </div>
          <div class="p-3">
             <slot></slot> 
          </div>
       </div>
    </div>
    `,
    data:function() {
        return {
            show:false,
            dark:false,
            styles:'none'
        }
    },
    methods:
    {
       toggle_sidemenu()
       {
          this.show = !this.show;
          if (this.show)
          {
             this.styles = 'block'
          }
          else
          {
             this.styles = 'none'
          }
       },
       away()
       {
          this.show = false;
          this.styles = 'none'
       }
    },
    mounted()
    {
       //
    }
});

