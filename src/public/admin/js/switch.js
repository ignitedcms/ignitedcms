/*
|---------------------------------------------------------------
| Switch component
|---------------------------------------------------------------
|
|
| @author: IgnitedCMS
| @license: MIT
| @version: 1.0
| @since: 1.0
|
*/

Vue.component('switch-ios', {
  props: ['name', 'value'],
  template: `
  <div>
     <label for="title">{{name}}</label>
     <div class="m-b"></div>
     <label class="form-switch">
        <input
         :name="name"
         type="checkbox"
         role="switch"
         :checked="value"
         @change="handleChange"
        />
        <i></i>
        <div class="switch-text no-select">{{message}}</div>
     </label>
  </div>
  `,
  data() {
    return {
      message: 'Yes/No',
      show: false,
    };
  },
  methods: {
    handleChange(event) {
      this.$emit('input', event.target.checked);
    }
  }
});

