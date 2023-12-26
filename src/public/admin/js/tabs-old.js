/*
|---------------------------------------------------------------
| Tabs component
|---------------------------------------------------------------
|
|
| @author: IgnitedCMS
| @license: MIT
| @version: 1.0
| @since: 1.0
|
*/

Vue.component('tabs', {
  template: `
    <div class="tab-container" role="tablist">
      <button
        type="button"
        v-for='(tab, index) in tabs'
        @click='selectTab(index)'
        role="tab"
        :class='{"tab__selected": (index == selectedIndex)}'
        :aria-selected='index === selectedIndex ? "true" : "false"'
        :aria-controls="'tabpanel-' + index"
        class="rm-btn-styles tab-header"
        :id="'tab-' + index"
      >
        {{ tab.title }}
      </button>
      <slot></slot>
    </div>
  `,
  data: function () {
    return {
      selectedIndex: 0,
      tabs: []
    }
  },
  created() {
    this.tabs = this.$children
  },
  mounted() {
    this.selectTab(0)
  },
  methods: {
    selectTab(i) {
      this.selectedIndex = i;
      // loop over all the tabs
      this.tabs.forEach((tab, index) => {
        tab.isActive = (index === i);
      });
    }
  }
});

Vue.component('tab-item', {
  props: ['title'],
  template: `
    <div 
     class='tab-content' 
     :id="'tabpanel-'+ tabIndex" 
     role="tabpanel" 
     v-show='isActive' 
     :aria-hidden="!isActive"
     tabindex="0"
     :aria-labelledby="'tab-' + tabIndex"
   >
      <slot></slot>
    </div>
  `,
  data: function () {
    return {
      isActive: true
    }
  },
  computed: {
    tabIndex() {
      // Find the index of the parent tab to associate with aria-labelledby
      return this.$parent.tabs.indexOf(this);
    }
  }
});

