/*
|---------------------------------------------------------------
| Fileupload  component
|---------------------------------------------------------------
|
|
| @author: IgnitedCMS
| @license: MIT
| @version: 1.0
| @since: 1.0
|
*/

Vue.component('file-upload', {
  props: ['name'],
  template: `
  <div>
      <input 
       type="file" 
       :name="name" 
       :id="name" 
       @change="handleFileInputChange" 
       tabindex="0"
       class="upload-hide"
      />
      <label :for="name" class="form-upload" >Choose File</label>
      <span >{{ fileName }}</span>
   </div>

  `,
  data() {
    return {
      fileName: '',
    };
  },
  methods: {
    handleFileInputChange(event) {
       this.fileName = event.target.files[0].name;
    },
  }
});


