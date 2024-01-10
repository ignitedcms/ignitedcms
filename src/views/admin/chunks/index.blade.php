@extends('ignitedcms::admin.dashboard.layout')

@section('content')
    <div id="app" class="full-screen">

        @include('ignitedcms::admin.sidebar')

        <div class="main-content " id="main-content">

           

           <div class="p-3">

              <div class="breadcrumb m-b-3">
                 <div class="breadcrumb-item">
                    <a href="{{ url('admin/dashboard') }}">Dashboard</a>
                 </div>
                 <div class="breadcrumb-item">Large file uploader</div>
              </div>             

              <div class="alert alert-success">
                 <div class="text-black">Information</div>
                 <div class="small text-muted">
                    Upload large files here
                 </div>
              </div>
              <div class="m-b-3"></div>
              <div class="row panel br drop-shadow">
                 <div class="col">
                    <div class="form-group">
                       <h4>Large file uploader</h4>
                    </div>

                    <div class="form-group" id="file-input">
                       <input type="file" id="pickfiles" class="form-control">
                       <div id="filelist" class="m-t-2 m-b-2"></div>
                    </div>
                    <div class="form-group">
                       <a id="upload" href="javascript:;" class="button">Upload file</a>
                    </div>

                 </div>
              </div>
           </div>
      </div>
   </div>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

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
                       // mime_types: [{
                       //         title: "Image files",
                       //         extensions: "jpg,gif,png"
                       //     },
                       //     {
                       //         title: "Zip files",
                       //         extensions: "zip"
                       //     }
                       // ],
                       // max_file_size: '10mb'
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
                        },
                        FileUploaded: function(up, file, result) {

                            //console.log('FileUploaded');
                            //console.log(file);
                            //console.log(JSON.parse(result.response));
                            responseResult = JSON.parse(result.response);

                            if (responseResult.ok == 0) {
                               // toastr.error(responseResult.info, 'Error Alert', {
                               //     timeOut: 5000
                               // });
                            }
                            if (result.status != 200) {
                                //toastr.error('Your File Uploaded Not Successfully!!', 'Error Alert', {timeOut: 5000});
                            }
                            if (responseResult.ok == 1 && result.status == 200) {
                                //toastr.success('Your File Uploaded Successfully!!', 'Success Alert', {timeOut: 5000});
                            }
                        },
                        UploadComplete: function(up, file) {
                            alert('done');
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
    </body>

</html>
