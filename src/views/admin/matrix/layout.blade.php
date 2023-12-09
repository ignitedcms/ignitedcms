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

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans&display=swap" rel="stylesheet">

    </head>

    <body class="full-screen bg-light-grey">

        @yield('content')

        <!-- vue 2 -->
        <script src="{{ asset('admin/js/vue2.js') }}"></script>

        <!-- Click out must go before all other scripts -->
        <script src="{{ asset('admin/js/click-outside.js') }}"></script>
        <script src="{{ asset('admin/js/tabs.js') }}"></script>
        <script src="{{ asset('admin/js/tooltips.js') }}"></script>
        <script src="{{ asset('admin/js/modals.js') }}"></script>
        <script src="{{ asset('admin/js/search.js') }}"></script>
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

        <!-- feather icons -->
        <script src="{{ asset('admin/js/feather.js') }}"></script>

        <script src="{{ asset('admin/datatables/jquery.min.js') }}"></script>

        <!-- datatables -->
        <script src="{{ asset('admin/datatables/jquery.dataTables.min.js') }}"></script>

        <script>
            var app = new Vue({
                el: '#app',
                data: {
                    show: false,
                    dark: false, //dark or light mode
                    styles: 'none',

                    matrix_name: '',
                    matrix_name_validation: '', //validation errors
                    crselect: 'plain-text',
                    fieldname: '',
                    instructions: '',
                    fieldlength: '100',
                    filetype: 'jpg|png|gif',
                    variations: 'option1,option2,option3',
                    matrixContent: [],
                    fielderrors: '',
                    csverrors: '',

                },
                methods: {
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
                     save: function () {
   
                     $.ajax({
                       url: "{{ url('admin/matrix/create') }}",
                       type: 'post',
                       async: true, //must use async false to get data back
                       context:this, //IMPORTANT to update vue dom
                       data: {
                         items: JSON.stringify(
                           {
                             'title':this.matrix_name,
                             'collapsed':false,
                             'content':this.matrixContent
                           }
                         ), /*/MUST use stringify for true false bug*/
                         matrix_name: this.matrix_name,
                         "_token": "{{ csrf_token() }}"
                       },
                       dataType: 'json', /*must use text*/
                       success: function (data) {
                         if (data == "success")
                         {
                             window.location.href = '{{ url('admin/fields') }}'
                         }
                         else{
                             this.matrix_name_validation = data.matrix_name;
                         }
                       }
                     }); /*End ajax*/
                   },
                  someFunc: function () {

                   @include('ignitedcms::admin.matrix.vue-ajax');

                   },
                   deleteItem: function (todo) {
                     this.matrixContent.splice(this.matrixContent.indexOf(todo), 1)
                   },

                },
                mounted() {
                    //
                }
            });
        </script>

        <script>
            feather.replace({
                class: "font-primary",
            });
        </script>

        <script>
            $('#example').dataTable({
                "iDisplayLength": 10
            });
        </script>
    </body>

</html>

