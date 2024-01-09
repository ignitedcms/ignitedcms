/*
|---------------------------------------------------------------
| Modals component
|---------------------------------------------------------------
|
|
| @author: IgnitedCMS
| @license: MIT
| @version: 1.0
| @since: 1.0
|
*/

Vue.component('modal', {
  props: [
    'button-title',
    'modal-header'
  ],
  template: `
    <div @keyup.escape="escapePressed()">
      <button
        type="button"
        aria-haspopup="dialog"
        :aria-expanded="arr"
        :aria-controls="'modal-' + uniqueId"
        class="btn btn-white "
        @click="show=true; arr='true'"
        v-click-outside="away"
      >
        {{buttonTitle}}
      </button>

      <div
        class="modal"
        v-show="show"
        @keyup.escape="escapePressed"
      >
        <div 
          class="modal-content fade-in-bottom" 
          :id="'modal-' + uniqueId"
          role="dialog"
          @click.stop
        >

          <focus-trap :active="show">
            <div class="modal-header">
              <button
                type="button"
                aria-label="Close"
                class="rm-btn-styles close m-t"
                @click="show = false; arr='false'"
              >
                &times;
              </button>
              <h5 class="m-t">{{modalHeader}}</h5>
            </div>
            <div class="modal-body">
              <slot></slot>
            </div>
          </focus-trap>

        </div>
      </div>
    </div>
  `,
  data() {
    return {
      message: 'Hello',
      show: false,
      arr: 'false',
      uniqueId: Math.random().toString(36).substring(2) // Generate a unique ID

    };
  },
  methods: {
    away() {
      this.show = false;
      this.arr = 'false';
    },
    escapePressed() {
      this.show = false;
      this.arr = 'false';
    }
  }
});

