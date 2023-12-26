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

Vue.component('switchIos', {
  props: ['name', 'value'],
  template: `
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
  `,
  data() {
    return {
      message: 'Yes/no',
      show: false,
    };
  },
  methods: {
    handleChange(event) {
      this.$emit('input', event.target.checked);
    }
  }
});

