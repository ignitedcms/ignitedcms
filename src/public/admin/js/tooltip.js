/*
|---------------------------------------------------------------
| Tooltip  component
|---------------------------------------------------------------
|
|
| @author: IgnitedCMS
| @license: MIT
| @version: 1.0
| @since: 1.0
|
*/

Vue.component('tooltip', {
  props: ['text'],
  template: `
  <div class="tooltip hand" @mouseover="showTooltip" @mouseleave="hideTooltip">
    <slot></slot>
    <div v-if="displayTooltip" class="tooltiptext fade-in-bottom">
      {{ text }}
    </div>
  </div>
  `,
  data() {
    return {
       displayTooltip: false

    };
  },
   methods: {
    showTooltip() {
      this.displayTooltip = true;
    },
    hideTooltip() {
      this.displayTooltip = false;
    }
  }
});


