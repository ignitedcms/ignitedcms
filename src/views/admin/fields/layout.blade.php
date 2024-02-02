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

    </head>

    <body class="v-screen h-screen bg-light-gray">

        @yield('content')

        <!-- vue 2 -->
        <script src="{{ asset('admin/js/vue2.js') }}"></script>

        <!-- Click out must go before all other scripts -->
        <script src="{{ asset('admin/js/click-outside.js') }}"></script>
        <script src="{{ asset('admin/js/tabs.js') }}"></script>
        <script src="{{ asset('admin/js/alerts.js') }}"></script>
        <script src="{{ asset('admin/js/buttons.js') }}"></script>
        <script src="{{ asset('admin/js/sidebar.js') }}"></script>
        <script src="{{ asset('admin/js/popover.js') }}"></script>
        <script src="{{ asset('admin/js/modals.js') }}"></script>
        <script src="{{ asset('admin/js/dropdown.js') }}"></script>
        <script src="{{ asset('admin/js/datepicker.js') }}"></script>
        <script src="{{ asset('admin/js/accordions.js') }}"></script>
        <script src="{{ asset('admin/js/switch.js') }}"></script>
        <script src="{{ asset('admin/js/range-sliders.js') }}"></script>
        <script src="{{ asset('admin/js/toasts.js') }}"></script>
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
                    crselect: 'plain-text',
                    fieldname: '',
                    fieldnameError: '',
                    instructions: '',
                    fieldlength: '100',
                    fieldtypeError: '',
                    filetype: 'jpg|png|gif',
                    variations: '',
                    matrixContent: [],
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
                    save() {
                       $.ajax({
                         url: "{{ url('admin/fields/create') }}",
                         type: 'post',
                         async: true,
                         context: this,
                         data: {
                           "name": this.fieldname,
                           "instructions": this.instructions,
                           "type": this.crselect,
                           "length": "100",
                           "variations":this.variations, 
                           "_token": "{{ csrf_token() }}"
                         },
                         dataType: 'json',
                         success: function(data){
                           if(data == 'success')
                           {
                             window.location.href = '{{ url('admin/fields') }}'
                           }
                           else if(data == 'Invalid csv string')
                           {
                              this.fieldtypeError = data;
                              this.$refs.toast.showToast(4000);
                           }
                           else {
                              this.fieldnameError = data.name;
                              this.$refs.toast.showToast(4000);
                           }
                         }

                      });
                    }
                },
                mounted() {
                     //this.$refs.toast.showToast(4000);
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
