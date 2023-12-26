/*
|---------------------------------------------------------------
| Dropdown component
|---------------------------------------------------------------
|
|
| @author: IgnitedCMS
| @license: MIT
| @version: 1.0
| @since: 1.0
|
*/

Vue.component('drop-down', {
  props: [
    'button-title'
  ],
  template: `
    <button
      :id="'dropdown-' + uniqueId"  
      type="button"
      aria-haspopup="menu"
      :aria-expanded="arr"
      class="btn btn-white  pos-rel"
      @keyup.escape="escapePressed()"
      @click="toggle"
      v-click-outside="away"
    >
      {{buttonTitle}}
      <div 
         v-if="show"
         role="menu"
         :aria-labelledby="'dropdown-' + uniqueId"

         class="dropdown br drop-shadow fade-in"
         @click.stop
      >
        <focus-trap :active="show">
          <slot></slot>
        </focus-trap>
      </div>
    </button>
  `,
  data() {
    return {
      show: false,
      arr: 'false',
      uniqueId: Math.random().toString(36).substring(2) // Generate a unique ID
    };
  },
  methods: {
    toggle() {
      this.show = !this.show;
      if (this.arr === 'true') {
        this.arr = 'false';
      } else {
        this.arr = 'true';
      }
    },
    away() {
      this.show = false;
      this.arr = 'false';
    },
    escapePressed() {
      this.show = false;
      this.arr = 'false';
    },
  },
});

Vue.component('item', {
  props: [
    'title',
    'url'
  ],
  template: `
    <div class="row">
      <div class="col no-margin">
        <div class="dropdown-item">
          <a :href="url" class="left">{{title}}</a>
        </div>
      </div>
    </div>
  `,
});

