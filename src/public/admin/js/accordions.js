/*                                                                          
|---------------------------------------------------------------            
| Accordion component
|---------------------------------------------------------------            
|
| 
| @author: IgnitedCMS
| @license: MIT
| @version: 1.0
| @since: 1.0
|
*/       
Vue.component('accordion', {
  template: `
    <div>
      <slot></slot>
    </div>
  `,
  data() {
    return {
      // Nothing here
    };
  },
});

Vue.component('accordion-item', {
  props: ['title'],
  template: `
    <div class="row">
      <div class="col no-margin">
        <button
          type="button"
          :aria-expanded="isActive.toString()" 
          :aria-controls="'accordion-' + uniqueId" 
          :id="'accordion-title-' + uniqueId" 
          class="accordion-title rm-btn-styles"
          @click="toggle"
        >
          <div class="text-black">
            {{ title }}
          </div>
          <span>
            <i data-feather="chevron-down"></i>
          </span>
        </button>
        <div
          v-if="isActive"
          :id="'accordion-' + uniqueId" 
          role="region"
          class="accordion-content fade-in"
          :aria-labelledby="'accordion-title-' + uniqueId"
        >
          <slot></slot>
        </div>
      </div>
    </div>
  `,
  data() {
    return {
      isActive: false,
      uniqueId: Math.random().toString(36).substring(2) // Generate a unique ID
    };
  },
  methods: {
    toggle() {
      this.isActive = !this.isActive;
    },
  },
});

