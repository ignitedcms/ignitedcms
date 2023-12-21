/*
|---------------------------------------------------------------
| Tabs
|
| Components only data must be passed as a function
| Use slots to repeat child components
| Use props to pass in data MUST use kebab case eg postTitle => post-title 
|---------------------------------------------------------------
| https://learnvue.co/2019/12/building-reusable-components-in-vuejs-tabs/#final-reusable-component-files
|
| v-bind:class='{"tab__selected": (index == selectedIndex)}'
*/
Vue.component('tabs', {
  template: `
        <div class="tab-container">
        <button type="button" v-for='(tab, index) in tabs'
        @click='selectTab(index)'
        :class='{"tab__selected": (index == selectedIndex)}'
        class="rm-btn-styles tab-header">
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
      this.selectedIndex = i
      // loop over all the tabs
      this.tabs.forEach((tab, index) => {
        tab.is_active = (index === i)
      })
    }
  }
});

Vue.component('tab-item', {
  props: ['title'],
  template: `
    <div class='tab-content' v-show='is_active'>
      <slot></slot>
    </div>
    `,
  data: function () {

    return {
      is_active: true
    }
  }
});
