/*
|---------------------------------------------------------------
| Toasts component
|---------------------------------------------------------------
|
|
| @author: IgnitedCMS
| @license: MIT
| @version: 1.0
| @since: 1.0
|
*/

Vue.component('toast', {
  props: ['time'],
  template: `
    <div
      class="toast fade-in-bottom"
      role="alert"
      aria-atomic="true"
      aria-live="assertive"
      :style="{ display: displayStyle }"
    >
      <slot></slot>
    </div>
  `,
  data() {
    return {
      displayStyle: ''
    };
  },
  methods: {
    t() {
      this.displayStyle = "none";
    }
  },
  mounted() {
    setTimeout(this.t, this.time);
  }
});

