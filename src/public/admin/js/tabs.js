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
  <div>
    <div class="tab-container" role="tablist">
      <button
        type="button"
        v-for='(tab, index) in tabs'
        :id="'tab-' + index"
        role="tab"
        :class='{"tab__selected": (index == currentIndex)}'
        :aria-selected='index === currentIndex ? "true" : "false"'
        :aria-controls="'tabpanel-' + index"
        :tabindex="currentIndex === index ? 0 : -1"
        class="rm-btn-styles tab-header"
        @click='selectTab(index)'
        @keydown="onTabKeyDown($event, index)"
        ref="tabButtons"
      >
        {{ tab.title }}
      </button>
   </div>
   <div>
      <slot></slot>
    </div>
  </div>
  `,
  data: function () {
    return {
      currentIndex: 0,
      tabs: [],
      tabIds: []
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
      this.currentIndex = i;
      // loop over all the tabs
      this.tabs.forEach((tab, index) => {
        tab.isActive = (index === i);
      });
    },
     onTabKeyDown(event, index) {
        const tabsCount = this.tabs.length;

        switch (event.key) {
           case 'ArrowRight':
              event.preventDefault();
              this.currentIndex = (index + 1) % tabsCount;
              this.$refs.tabButtons[this.currentIndex].focus();
               
              this.selectTab(this.currentIndex);

              break;
           case 'ArrowLeft':
              event.preventDefault();
              this.currentIndex = (index - 1 + tabsCount) % tabsCount;
              this.$refs.tabButtons[this.currentIndex].focus();

              this.selectTab(this.currentIndex);

              break;
           case 'Home':
              event.preventDefault();
              this.currentIndex = 0;
              this.$refs.tabButtons[this.currentIndex].focus();
              break;
           case 'End':
              event.preventDefault();
              this.currentIndex = tabsCount - 1;
              this.$refs.tabButtons[this.currentIndex].focus();
              break;
           case 'Enter':
           case 'Space':
              event.preventDefault();
              this.changeTab(index);
              break;
           default:
              break;
        }
     },

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
     :aria-labelledby="'tab-' + tabIndex"
     :aria-hidden="isActive === true ? 'false' : 'true'"
     :tabindex="isActive === true ? 0 : -1"
     ref="tabPanels"
   >
      <slot></slot>
    </div>
  `,
  data: function () {
    return {
      isActive: true,
    }
  },
  computed: {
    tabIndex() {
      // Find the index of the parent tab to associate with aria-labelledby
      return this.$parent.tabs.indexOf(this);
    }
  }
});


