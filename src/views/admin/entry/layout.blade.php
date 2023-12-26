<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Dashboard</title>
        <link rel="stylesheet" href="{{ asset('admin/css/main.css') }}">

        <!-- datatables -->
        <link rel="stylesheet" href="{{ asset('admin/datatables/datatables.css') }}">

        <!-- Include Quill stylesheet -->
        <link href="{{ asset('admin/css/quill.css') }}" rel="stylesheet">

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans&display=swap" rel="stylesheet">

    </head>

    <body class="full-screen bg-light-grey">

        @yield('content')

        <!-- vue 2 -->
        <script src="{{ asset('admin/js/vue2.js') }}"></script>
        <!-- Include SortableJS from CDN -->
        <script src="{{ asset('admin/js/sortable.js') }}"></script>

        <!-- Click out must go before all other scripts -->
        <script src="{{ asset('admin/js/click-outside.js') }}"></script>
        <script src="{{ asset('admin/js/focus-trap.js') }}"></script>
        <script src="{{ asset('admin/js/tabs.js') }}"></script>
        <script src="{{ asset('admin/js/tooltips.js') }}"></script>
        <script src="{{ asset('admin/js/modals.js') }}"></script>
        <script src="{{ asset('admin/js/dropdown.js') }}"></script>
        <script src="{{ asset('admin/js/datepicker.js') }}"></script>
        <script src="{{ asset('admin/js/accordions.js') }}"></script>
        <script src="{{ asset('admin/js/switch.js') }}"></script>
        <script src="{{ asset('admin/js/range-sliders.js') }}"></script>
        <script src="{{ asset('admin/js/toasts.js') }}"></script>
        <script src="{{ asset('admin/js/menu.js') }}"></script>
        <script src="{{ asset('admin/js/mobile-menu.js') }}"></script>
        <script src="{{ asset('admin/js/trees.js') }}"></script>
        <script src="{{ asset('admin/js/drawer.js') }}"></script>

        <!-- Include the Quill library -->
        <script src="{{ asset('admin/js/quill.js') }}"></script>
        <script src="{{ asset('admin/js/quill-vue.js') }}"></script>

        <!-- feather icons -->
        <script src="{{ asset('admin/js/feather.js') }}"></script>

        <script src="{{ asset('admin/datatables/jquery.min.js') }}"></script>

        <!-- datatables -->
        <script src="{{ asset('admin/datatables/jquery.dataTables.min.js') }}"></script>

        <script>
           feather.replace({
              class: "font-primary",
           });
        </script>

        <script>
       Vue.use(window.VueQuillEditor);

         Vue.component('asset-container',{
                 template: 
                 `<div>
                   @include('ignitedcms::admin.entry.asset')
                 </div>`,
                 props:['fieldname2','assetid','url'],
                 data:function(){
                     return{
                         isShown: false,
                         tmp: this.assetid,
                         name: this.fieldname2,
                         url: this.url
                     }
                 },
                 methods: {
                     away: function () {
                       this.isShown = false;
                     },
                     
                     escapePressed()
                     {
                       this.isShown = false;
                     },
                   }
             });

            var app = new Vue({
                el: '#app',
                data: {
                    show: false,
                    dark: false, //dark or light mode
                    styles: 'none',
                     
                    //Matrix tests
                    hideApp: false,
                    count: 0,
                    assetId: '',
                    fieldname: '',
                    is_matrix: false,                    
                    matrix:[
                      <?= $matrix ?>
                    ],
                   singleRichtext : @php echo $singleRichtext @endphp,
                   editorOption: {
                        modules: {
                        toolbar: [
                          [{ font: ['sans-serif','monospace'] }],
                          ['bold', 'italic', 'underline' ],
                          ['blockquote'],
                          [{ 'header': 1 }, { 'header': 2 }],
                          [{ 'list': 'ordered' }, { 'list': 'bullet' }],
                          [{ 'align': [] }],
                          ['clean'],
                          ['link']
                        ]
                      },
                  }
                },
               computed: {
                   editor() {
                       return this.$refs.quillEditor.quill
                   }
                },
                methods: {
                   onEditorBlur(quill) {
                       console.log('editor blur!', quill)
                   },
                   onEditorFocus(quill) {
                       console.log('editor focus!', quill)
                   },
                   onEditorReady(quill) {
                       console.log('editor ready!', quill)
                   },
                    toggle_sidemenu() {
                        this.show = !this.show;
                        if (this.show) {
                            this.styles = 'block'
                        } else {
                            this.styles = 'none'
                        }
                    },
                    away() {
                        this.show = false;
                        this.styles = 'none'
                    },

                     //Matrix
                    goNow:function(idx)
                    {
                        var d = "";

                        $.ajax({
                        url: "{{ url('admin/matrix/add_matrix_block2') }}",
                        type: 'post',
                        async:false,
                        data: {"idx":idx,"_token": "{{ csrf_token() }}"},
                        dataType: 'json',
                        success: function (data) {
                              d = data
                            }
                        });
                        
                        //use async to pass back to DOM
                        this.matrix.push(d);
                    },
                    deleteItem:function(ind)
                    {
                        this.matrix.splice(this.matrix.indexOf(ind),1)
                    },
                  
                },
                mounted() {
                var self = this;
                 self.$nextTick(function(){
                   var sortable = Sortable.create(document.getElementById('items'), {
                     animation: 250,  // ms, animation speed moving items when sorting, `0` — without animation
                      easing: "cubic-bezier(1, 0, 0, 1)", // Easing for animation. Defaults to null. See https://easings.net/ for examples.
                      handle: ".front-matrix-block__header",  // Drag handle selector within list items
                     onEnd: function(e) {
                       var clonedItems = self.matrix.filter(function(item){
                        return item;
                       });
                       clonedItems.splice(e.newIndex, 0, clonedItems.splice(e.oldIndex, 1)[0]);
                       self.matrix = [];
                       self.$nextTick(function(){
                         self.matrix = clonedItems;
                       });
                     }
                   }); 
                 });
               },
            });
        </script>

        

        <script>
            $('#example').dataTable({
                "iDisplayLength": 10
            });
        </script>

    </body>

</html>
