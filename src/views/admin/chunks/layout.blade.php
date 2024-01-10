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
        <script src="{{ asset('admin/js/popover.js') }}"></script>
        <script src="{{ asset('admin/js/modals.js') }}"></script>
        <script src="{{ asset('admin/js/dropdown.js') }}"></script>
        <script src="{{ asset('admin/js/password.js') }}"></script>
        <script src="{{ asset('admin/js/datepicker.js') }}"></script>
        <script src="{{ asset('admin/js/accordions.js') }}"></script>
        <script src="{{ asset('admin/js/switch.js') }}"></script>
        <script src="{{ asset('admin/js/range-sliders.js') }}"></script>
        <script src="{{ asset('admin/js/toasts.js') }}"></script>
        <script src="{{ asset('admin/js/menu.js') }}"></script>
        <script src="{{ asset('admin/js/mobile-menu.js') }}"></script>
        <script src="{{ asset('admin/js/trees.js') }}"></script>
        <script src="{{ asset('admin/js/tabs.js') }}"></script>
        <script src="{{ asset('admin/js/drawer.js') }}"></script>

        <!-- feather icons -->
        <script src="{{ asset('admin/js/feather.js') }}"></script>

        <script src="{{ asset('admin/datatables/jquery.min.js') }}"></script>

        <!-- datatables -->
        <script src="{{ asset('admin/datatables/jquery.dataTables.min.js') }}"></script>


        <script src="{{ asset('admin/plupload/js/plupload.full.min.js') }}"></script>
        <script type="text/javascript">
            $(document).ready(function() {
                var path = "{{ asset('admin/plupload/js/') }}";

                var uploader = new plupload.Uploader({
                    browse_button: 'pickfiles',
                    container: document.getElementById('file-input'),
                    url: '{{ url('admin/chunking/chunkStore') }}',
                    chunk_size: '2mb', // 2 MB
                    max_retries: 2,
                    multi_selection: false,
                    filters: {
                        mime_types: [{
                                title: "file",
                                extensions: "{{ $data }}"
                            }
                        ],
                      //  max_file_size: '10mb'
                    },
                    multipart_params: {
                        // Extra Parameter Needed!
                        "_token": "{{ csrf_token() }}"
                    },
                    init: {
                        PostInit: function() {
                            document.getElementById('filelist').innerHTML = '';
                            document.getElementById('upload').onclick = function() {
                                uploader.start();
                                return false;
                            };
                        },

                        FilesAdded: function(up, files) {
                            plupload.each(files, function(file) {
                                //console.log('FilesAdded');
                                //console.log(file);
                                document.getElementById('filelist').innerHTML += '<div id="' + file
                                    .id + '">' + file.name + ' (' + plupload.formatSize(file.size) +
                                    ') <b></b></div>';
                            });
                        },
                        UploadProgress: function(up, file) {
                            //console.log('UploadProgress');
                            //console.log(file);
                            document.getElementById(file.id).getElementsByTagName('b')[0].innerHTML =
                                '<span>' + file.percent + "%</span>";
                           
                            document.getElementById("progress").style.width = file.percent + "%";

                        },
                        FileUploaded: function(up, file, result) {

                            //console.log('FileUploaded');
                            //console.log(file);
                            //console.log(JSON.parse(result.response));
                            responseResult = JSON.parse(result.response);

                            if (responseResult.ok == 0) {
                             //   toastr.error(responseResult.info, 'Error Alert', {
                             //       timeOut: 5000
                             //   });
                            }
                            if (result.status != 200) {
                                //toastr.error('Your File Uploaded Not Successfully!!', 'Error Alert', {timeOut: 5000});
                            }
                            if (responseResult.ok == 1 && result.status == 200) {
                                //toastr.success('Your File Uploaded Successfully!!', 'Success Alert', {timeOut: 5000});
                            }
                        },
                        UploadComplete: function(up, file) {
                            window.location.href = '{{ url('admin/assets') }}'
                            //alert('File uploaded');
                            // toastr.success('Your File Uploaded Successfully!!', 'Success Alert', {timeOut: 5000});
                        },
                        Error: function(up, err) {
                            // DO YOUR ERROR HANDLING!
                            //toastr.error('Your File Uploaded Not Successfully!!', 'Error Alert', {timeOut: 5000});
                            //console.log(err);
                        }
                    }
                });
                uploader.init();
            });
        </script>

        <script>
            var app = new Vue({
                el: '#app',
                data: {
                    show: false,
                    dark: false, //dark or light mode
                    styles: 'none'
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
                    }
                },
                mounted() {
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
                "iDisplayLength": 10
            });
        </script>
    </body>

</html>

