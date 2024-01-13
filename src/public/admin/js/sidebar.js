/*
|---------------------------------------------------------------
| Sidebar component
|---------------------------------------------------------------
|
|
| @author: IgnitedCMS
| @license: MIT
| @version: 1.0
| @since: 1.0
|
*/

Vue.component('sidebar', {
  props: ['theme'],
  template: `
    <div>
      <div 
       class="sidebar p-3 bg-dark scroll-y full-screen hide-desktop"
       style="position:fixed; top:0; left:0; width:270px; float:left;"
      >
        <a href="https://www.ignitedcms.com/"></a>
        <h5 class="text-white">Dashboard</h5>
        <slot name="header"></slot>
      </div>
      <div 
        class="sidebar-fixed bg-dark overflow-y full-screen fade-in" 
        style="position:fixed; top:0; left:0; width:270px; float:left; z-index:2; padding:30px;"
        :style="{ display: styles }" 
        id="sidebar-fixed" 
        @click.stop
      >
        <a href="https://www.ignitedcms.com/"></a>
        <h5 class="text-white">Dashboard</h5>
        <slot name="header"></slot>
      </div>
      <div 
        class="main-content p-t-4  pos-rel m-b-2" 
      >
        <div class="p-l-3 show-desktop">
          <button 
           class=" bg-white v-a h-a icon hand b br"
           @click="toggle" 
           v-click-outside="away" 
          >
            <i data-feather="menu" class="v-a h-a"></i>
          </button>
          
        </div>
        <div class="p-3">
          <slot></slot>
        </div>
      </div>
    </div>
  `,
  data() {
    return {
      show: false,
      dark: false,
      styles: 'none'
    };
  },
  methods: {
    toggle() {
      this.show = !this.show;
      if (this.show) {
        this.styles = 'block';
      } else {
        this.styles = 'none';
      }
    },
    away() {
      this.show = false;
      this.styles = 'none';
    }
  },
  mounted() {
    // ...
  }
});

