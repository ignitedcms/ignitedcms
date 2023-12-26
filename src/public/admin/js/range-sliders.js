/*
|---------------------------------------------------------------
| Range slider component
|---------------------------------------------------------------
|
|
| @author: IgnitedCMS
| @license: MIT
| @version: 1.0
| @since: 1.0
|
*/

Vue.component('range-slider', {
  props: ['name','value','min', 'max'],
  template: `
    <div class="slidecontainer">
     <label :for="name">{{name}}</label>
     <div class="m-b"></div>
      <input
        class="slider2"
        :id="name"
        :name="name"
        :value="value"
        type="range"
        :min="min"
        :max="max"
        v-model="sliderValue"
        @input="updateSlider($event.target.value)"
      />
      <p class="m-t-2">Value:
        <span id="demo">
          {{sliderValue}}
        </span>
      </p>
    </div>
  `,
  data() {
    return {
      sliderValue: this.value
    };
  },
  methods:{
     updateSlider(newValue) {
        this.$emit('input', newValue);
     }
  }
});

