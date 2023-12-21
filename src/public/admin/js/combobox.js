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
Vue.component('combobox',{
   props:['name'],
   template: 
   `
  <div @keyup.escape="escapePressed">
       <button @click="load"  ref="button" class="form-control hand  
       left combo-btn-container"  v-click-outside="away">
          <span>
             <i data-feather='chevron-down' class='icon-inside hand'></i>
          </span>
          {{selectedItem}}
       </button>

       <div v-if="show" class="combobox-container fade-in" @click.stop>
          <div class="pos-rel">
             <span>
                <i data-feather='search'
                 class='icon-inside hand' 
                 style="right:25px">
                 </i>
             </span>
             <input class="rm-input-styles" 
                    :name="name" 
                    @keydown.tab.prevent
                    v-model="searchQuery"
                    @keydown.enter="onEnter"
                    autocomplete="off" 
                    ref="start"
                    @keydown.down="highlightNext"
                    @keydown.up="highlightPrev"
                    placeholder="Search list" />

             <div class="b-t"></div>
             <div v-for="(item, index) in filteredItems"
                  :key="index" 
                 class="combobox-container-item"  
                 @mouseover="setHighlighted(index)"
                 @click="onClick(item.val)"
                 :class="{ 'combobox-container-item-highlighted': index === highlightedIndex }"
               >
                  {{ item.val }}
             </div>

               <div v-if="filteredItems.length === 0
                 && searchQuery.trim() !== ''"
                 class="combobox-container-item"
               >
                 No searches found. . .
               </div>

          </div>

          <slot></slot>
       </div>
   </div>


  `,
   data:function(){

      return{
         searchQuery: '',
         items: [],
         highlightedIndex:0,
         selectedItem:'Select Item',
         show: false

      }
   },
   mounted() {
      this.items = this.$children;

      this.$nextTick(() => {
         this.$refs.start.focus();
      });

   },
   computed: {

       filteredItems() {
        if (this.searchQuery.trim().length === 0) {
          return this.items;
        } else {
          return this.items.filter(item =>
            item.val.toLowerCase().includes(this.searchQuery.toLowerCase())
          );
        }
      },
   },
   methods:{
      load(){
         this.show = true;
         //Next tick needed to work
         this.$nextTick(() => {
            this.$refs.start.focus();
         });
      },
      setHighlighted(index) {
        this.highlightedIndex = index;
      },
      onClick(item) {
           this.selectedItem = item;
           this.show = false;
           this.highlightedIndex = 0;
           this.searchQuery = '';
      },
      highlightNext() {
        if (this.highlightedIndex < this.filteredItems.length - 1) {
          this.highlightedIndex++;
        }
      },
      highlightPrev() {
        if (this.highlightedIndex > 0) {
          this.highlightedIndex--;
        }
      },
      onEnter() {
        if (this.filteredItems.length > 0 && this.highlightedIndex !== -1) {
          const selectedItem = this.filteredItems[this.highlightedIndex].val;
           this.selectedItem = selectedItem;
           this.show = false;
           this.highlightedIndex = 0;
           this.searchQuery = '';
        } else {
          //console.log('Enter pressed without selection');
           this.show = false;
           this.highlightedIndex = 0;
           this.searchQuery = '';
        }
      },
      away: function () {
         this.show = false;
      },
      escapePressed(){
         this.show = false;
      },
   } 
});

Vue.component('combo-item', {
   props:['val'],
   template: 
   `
   `,
   data: function () {

      return {
         //nothing
      }
   },
   mounted()
   {
      //Must mount feather here to work
      feather.replace();
   }
});

