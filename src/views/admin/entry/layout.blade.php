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
        <link href="https://cdn.quilljs.com/1.0.0/quill.snow.css" rel="stylesheet">

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans&display=swap" rel="stylesheet">

    </head>

    <body class="full-screen bg-grey">

        @yield('content')

        <!-- vue 2 -->
        <script src="{{ asset('admin/js/vue2.js') }}"></script>
        <!-- Include SortableJS from CDN -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Sortable/1.14.0/Sortable.min.js"></script>

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

        <!-- Include the Quill library -->
        <script src="https://cdn.quilljs.com/1.3.4/quill.js"></script>
        <script src="{{ asset('admin/js/quill-textarea.js') }}"></script>

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
                    open: false,
                    tmpid:'' ,
                    
                    items: @php  echo json_encode($data,true) @endphp
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
                    asset_picker(name) {
                       this.open = true;
                       this.tmpid = name;
                   },

                   change_asset(idx){

                       var inputElement = document.getElementById(this.tmpid);
                       if (inputElement) {
                         inputElement.value = idx;
                       }
                   }
                },
                mounted() {
                    //nothing
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
        <script>
            (function() {
                quilljs_textarea('.quilljs-textarea', {
                    modules: {
                        toolbar: [
                            ['bold', 'italic', 'underline'], // toggled buttons
                            [{
                                'list': 'ordered'
                            }, {
                                'list': 'bullet'
                            }],
                            [{
                                'header': [1, 2, 3, 4, 5, 6, false]
                            }],
                            [{
                                'color': []
                            }], // dropdown with defaults from theme
                            [{
                                'align': []
                            }],
                            ['clean'],
                            ['link']
                        ]
                    },
                    theme: 'snow',
                });
            })();
        </script>

    </body>

</html>
