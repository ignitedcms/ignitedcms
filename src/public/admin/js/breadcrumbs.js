/*
|---------------------------------------------------------------
| Breadcrumb component
|---------------------------------------------------------------
|
|
| @author: IgnitedCMS
| @license: MIT
| @version: 1.0
| @since: 1.0
|
*/

Vue.component('breadcrumb', {
  props: [],
  template: `
  <ol 
    class="
    rm-list-styles
    flex
    flex-start
    px-4
    py-3
    bg-white
    border
    border-[--gray]
    rounded-[--big-radius]
    shadow-sm
    dark:bg-darkest
    dark:border-slate-600
    dark:text-white
    dark:shadow-none
    "
  >
  <slot></slot> 
     
  </ol>
  `,
  data() {
    return {}
  },
});


Vue.component('breadcrumb-item', {
  props: ['title','url'],
  template: `
  <li 
    class="
    ml-3
    cursor-pointer
    text-black
    text-dark
    "
  > 
  <a :href="url">
   {{ title }}
  </a>
  </li>
  `,
  data() {
    return {}
  },
});





