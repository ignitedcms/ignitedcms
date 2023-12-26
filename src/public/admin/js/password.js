/*
|---------------------------------------------------------------
| Password component
|---------------------------------------------------------------
|
|
| @author: IgnitedCMS
| @license: MIT
| @version: 1.0
| @since: 1.0
|
*/

Vue.component('password', {
  props: ['value'],
  template: `
    <div class="form-group">
      <label for="Password">Password</label>
      <div class="small text-muted m-b">password</div>
      <div class="pos-rel">
        <span @click="eyeball">
          <i
            data-feather="eye"
            class="icon-inside hand"
          ></i>
        </span>
        <input
          name="password"
          :type="textType"
          :value="value"
          placeholder="placeholder"
          class="form-control"
        >
      </div>
      <div class="small text-danger"></div>
    </div>
  `,
  data() {
    return {
      textType: 'password'
    };
  },
  methods: {
    eyeball() {
      if (this.textType === 'password') {
        this.textType = 'text';
      } else {
        this.textType = 'password';
      }
    }
  }
});

