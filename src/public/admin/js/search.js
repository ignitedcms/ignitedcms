/*
|---------------------------------------------------------------
| Search dropdowns 
| 
| Components only data must be passed as a function
| Use slots to repeat child components
| Use props to pass in data MUST use kebab case eg postTitle => post-title 
|---------------------------------------------------------------
|
|
*/
Vue.component('search',{
  props:['name'],
  template: 
  `
  <div>
    <label for="title">{{name}}</label>
    <div class="small text-muted">Instructions</div>
    <input  type="text" :name="name" v-model="message" class="form-control" placeholder="type here" v-on:click="show =!show" v-click-outside="away">
    <div v-if="show" class="search br drop-shadow fade-in">
      <div v-for='(search, index) in searches' @click="my_select(search.val)">

        <div v-show="searchFunc(search.val)" class="search-item">
          {{search.val}}
        </div>

      </div>
    </div>
    <slot/>
  </div>
  `,
  data:function(){

      return{
          message: '',
          show: false,
          searches: []
      }
  },
  mounted() {
    this.searches = this.$children
  },
  methods:{
      away: function () {
          this.show = false;
      },
      my_select(str)
      {
        this.message = str;
      },
      searchFunc(param) {
        if (param.toLowerCase().includes(this.message.toLowerCase())) {
          return true;
        } else {
          return false;
        }
      },
  } 
});

Vue.component('search-item', {
  props:['val'],
  template: 
    `
    `,
  data: function () {

    return {
    //nothing
    }
  }
});
