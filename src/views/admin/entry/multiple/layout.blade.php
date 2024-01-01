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

    <script src="{{ asset('admin/datatables/jquery.min.js') }}"></script>

    <!-- feather icons -->
    <script src="{{ asset('admin/js/feather.js') }}"></script>



    <!-- datatables -->
    <script>
        var app = new Vue({
            el: '#app',
            data: {
                show: false,
                dark: false, //dark or light mode
                styles: 'none',
                items: @php  echo json_encode($data,true) @endphp,
                entrytitle: '',
                sectionid: {{ $sectionid }},
                errs: '', //entrytitle error feedback


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
                save_title() {
                    $.ajax({
                        type: 'POST',
                        url: "{{ url("admin/multiple/create/$sectionid") }}",
                        async: true,
                        context: this,
                        data: {
                            "_token": "{{ csrf_token() }}",
                            "entrytitle": this.entrytitle,
                            "sectionid": this.sectionid
                        },
                        dataType: 'text', // Specify the data type you expect back from the server
                        success: function(response) {
                            // Handle the successful response from the server
                            //alert(response);
                            if (response == 'success') {
                                window.location.href = '{{ url("admin/multiple/$sectionid") }}'
                            } else {
                                this.errs = response;
                            }
                        },
                        error: function(xhr, status, error) {
                            // Handle errors here
                            alert(error);
                            console.error(error);
                        }
                    });
                }

            },
            mounted() {
                // Initialize SortableJS on the list
                new Sortable(document.getElementById('sortable-list'), {
                    animation: 150,
                    onEnd: evt => {
                        // Update the data array after sorting
                        const movedItem = this.items.splice(evt.oldIndex, 1)[0];
                        this.items.splice(evt.newIndex, 0, movedItem);


                        $.ajax({
                            type: 'POST',
                            url: "{{ url('admin/multiple/order_multiples') }}",
                            async: true,
                            context: this,

                            data: {
                                "_token": "{{ csrf_token() }}",
                                "items": this.items
                            },
                            dataType: 'json', // Specify the data type you expect back from the server
                            success: function(response) {
                                // Handle the successful response from the server
                                // alert(response.message);
                                this.$refs.toast.showToast(2000);

                            },
                            error: function(xhr, status, error) {
                                // Handle errors here
                                console.error(error);
                            }
                        });

                    }
                });
            }
        });
    </script>

    <script>
        feather.replace({
            class: "font-primary",
        });
    </script>


</body>

</html>

