/*                                                                          
|---------------------------------------------------------------            
| Carousel component
|---------------------------------------------------------------            
|
| 
| @author: IgnitedCMS
| @license: MIT
| @version: 1.0
| @since: 1.0
|
*/       
Vue.component('carousel', {
  template: `
    <div>
       <div :id="uniqueId" class="splide" aria-labelledby="carousel-heading">

          <div class="splide__track">
             <ul class="splide__list">
                <slot></slot> 
                
             </ul>
          </div>
       </div>
    </div>
  `,
  data() {
    return {
      uniqueId: 'splide-' + Math.random().toString(36).substring(2) // Generate a unique ID
    }
  },
  mounted() {
    var t = this.uniqueId;
    t = '#'+t.toString();

    new Splide(t, {
       arrows: true,
       pagination:true
    }).mount();
  }
});

Vue.component('carousel-item', {
  props: ['title'],
  template: `
  <li class="splide__slide">
     <div class="panel m-5 br drop-shadow v-a h-a"
          style="min-height:380px;">
        <h4>
           <slot></slot>
        </h4>
     </div>
  </li>
  `,
  data() {
    return {

    };
  },
});


