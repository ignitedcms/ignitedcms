<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Dashboard</title>
        <link rel="stylesheet" href="{{ asset('admin/css/output.css') }}">

        <!-- datatables -->
        <link rel="stylesheet" href="{{ asset('admin/datatables/datatables.css') }}">

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans&display=swap" rel="stylesheet">

        <!-- sortables -->
        <script src="{{ asset('admin/js/sortable.js') }}"></script>
    </head>

    <body class="full-screen bg-light-grey">

        @yield('content')

        <!-- vue 2 -->
        <script src="{{ asset('admin/js/vue2.js') }}"></script>

        <!-- Click out must go before all other scripts -->
        <script src="{{ asset('admin/js/click-outside.js') }}"></script>
        <script src="{{ asset('admin/js/tabs.js') }}"></script>
        <script src="{{ asset('admin/js/popover.js') }}"></script>
        <script src="{{ asset('admin/js/sidebar.js') }}"></script>
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
                    hiddenOrder: '',
                    items: []
                },
                methods: {
                    onClicking() {
                        var ids = [];
                        this.items = [];
                        //get container element children.
                        var children = document.getElementById("list1").children;
                        for (var i = 0, len = children.length; i < len; i++) {

                            this.items.push(children[i].id);
                        }
                        this.hiddenOrder = this.items.toString();
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
                    }
                },
                mounted() {
                   
                    var list1 = document.getElementById('list1');
                    var list2 = document.getElementById('list2');


                    new Sortable(list1, {
                        group: 'shared', // set both lists to same group
                        animation: 150
                    });

                    new Sortable(list2, {
                        group: 'shared',
                        animation: 150
                    });
                  
                    this.$refs.toast.showToast(4000);
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
                "iDisplayLength": 20
            });
        </script>

    </body>

</html>
