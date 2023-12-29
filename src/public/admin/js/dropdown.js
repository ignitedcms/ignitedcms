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
  props: ['buttonTitle'],
  template: `
    <button
      :id="'dropdown-' + uniqueId"
      type="button"
      aria-haspopup="menu"
      :aria-expanded="arr"
      class="btn btn-white pos-rel"
      @keyup.esc="escapePressed"
      @click="toggle"
      v-click-outside="away"
      @keydown.down.prevent="navigate('down')"
      @keydown.up.prevent="navigate('up')"
      @keydown.enter.prevent="selectItem"
    >
      {{ buttonTitle }}
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
      uniqueId: Math.random().toString(36).substring(2), // Generate a unique ID
      selectedIndex: -1, // Track the selected index for keyboard navigation
    };
  },
  methods: {
    toggle() {
      this.show = !this.show;
      this.arr = this.show ? 'true' : 'false';
    },
    away() {
      this.show = false;
      this.arr = 'false';
      this.selectedIndex = -1; // Reset selected index when closing dropdown
    },
    escapePressed() {
      this.show = false;
      this.arr = 'false';
      this.selectedIndex = -1; // Reset selected index on escape
    },
    navigate(direction) {
      if (this.show) {
        const items = this.$el.querySelectorAll('.dropdown-item');
        if (direction === 'down') {
          this.selectedIndex = (this.selectedIndex + 1) % items.length;
        } else if (direction === 'up') {
          this.selectedIndex = this.selectedIndex <= 0 ? items.length - 1 : this.selectedIndex - 1;
        }
        items[this.selectedIndex].focus(); // Set focus on the selected item
      }
    },
    selectItem() {
      if (this.show && this.selectedIndex !== -1) {
        const items = this.$el.querySelectorAll('.dropdown-item');
        const selectedItem = items[this.selectedIndex];
        // Perform action based on the selected item (e.g., emit an event)
        this.$emit('item-selected', selectedItem.textContent);
        this.toggle(); // Close dropdown after selection
      }
       else{
          this.toggle();
       }
    },
  },
});

Vue.component('item', {
  props: ['title', 'url'],
  template: `
    <div
      class="row"
      tabindex="-1"
      role="menuitem"
      class="dropdown-item"
      @click="$emit('item-selected', title)"
    >
      <div :href="url" class="left">{{ title }}</div>
    </div>
  `,
});

