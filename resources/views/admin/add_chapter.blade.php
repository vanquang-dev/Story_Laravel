<!DOCTYPE html>
<html lang="en">

<head>
    <title>Thêm truyện</title>
    <link href="{{asset('assets/css/summernote-bs4.css')}}" rel="stylesheet" type="text/css">
    @include('admin.components.head')
    <link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.3/summernote.css" rel="stylesheet">
</head>

<body>

    <!-- Begin page -->
    <div id="wrapper">

        <!-- Navbar Start -->
        @include('admin.components.navbar')
        <!-- Navbar End -->

        <!-- ========== Left Sidebar Start ========== -->
        @include('admin.components.sidebar')
        <!-- Left Sidebar End -->

        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="content-page">
            <!-- Start content -->
            <div class="content">
                    <div class="container-fluid">
                        <div class="page-title-box">
                            <div class="row align-items-center">
                                <div class="col-sm-6">
                                    <h4 class="page-title">Thêm truyện</h4>
                                </div>
                            </div> <!-- end row -->
                        </div>
                        
                        <!-- end page-title -->

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card m-b-30">
                                    <div class="card-body">
                                        <div class="col-lg-12">
                                            <div class="col-lg-6" style="float: left;">
                                                <div class="form-group">
                                                    <label>Chapter ?</label>
                                                    <input type="number" class="form-control" id="chapter"/>
                                                </div>
                                            </div>
                                            <div class="col-lg-6" style="float: right;">
                                                <div class="form-group">
                                                    <label>Tiêu đề</label>
                                                    <input type="text" class="form-control" id="title"/>
                                                </div>
                                            </div>
                                            <div class="clearfix"></div>
                                            <div class="form-group" style="width: 97.5%; margin: 0 auto;">
                                                <textarea id="summernote-editor" name="content"></textarea>
                                            </div>
                                            <div class="form-group" style="margin: 13px;">
                                                <button id="submit" class="btn btn-primary waves-effect waves-light">
                                                    Thêm
                                                </button>
                                                <span id="success"></span>
                                            </div>
                                        </div>  
                                    </div>
                                </div>
                            </div> <!-- end col -->
                        </div> <!-- end row -->      
                    </div>
                    <!-- container-fluid -->

                </div>
                <!-- content -->

            @include('admin.components.footer')

        </div>
        <!-- ============================================================== -->
        <!-- End Right content here -->
        <!-- ============================================================== -->
        

    </div>
    <!-- END wrapper -->

    <!-- jQuery  -->
    @include('admin.components.js')

    <script src="{{asset('assets/js/summernote-bs4.min.js')}}"></script> 
    <!-- summernote config -->
    <script>
        $(document).ready(function(){

            // Define function to open filemanager window
            var lfm = function(options, cb) {
            var route_prefix = (options && options.prefix) ? options.prefix : '/filemanager';
            window.open(route_prefix + '?type=' + options.type || 'file', 'FileManager', 'width=900,height=600');
            window.SetUrl = cb;
            };

            // Define LFM summernote button
            var LFMButton = function(context) {
            var ui = $.summernote.ui;
            var button = ui.button({
                contents: '<i class="note-icon-picture"></i> ',
                tooltip: 'Insert image with filemanager',
                click: function() {

                lfm({type: 'image', prefix: '/filemanager'}, function(lfmItems, path) {
                    lfmItems.forEach(function (lfmItem) {
                    context.invoke('insertImage', lfmItem.url);
                    });
                });

                }
            });
            return button.render();
            };

            // Initialize summernote with LFM button in the popover button group
            // Please note that you can add this button to any other button group you'd like
            $('#summernote-editor').summernote({
            height: 400,
            toolbar: [
                ['font', ['bold', 'underline']],
                ['fontname', ['fontname']],
                ['fontsize', ['fontsize']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['table', ['table']],
                ['insert', ['link', 'video']],
                ['popovers', ['lfm']],
                ['view', ['fullscreen', 'codeview']],
                ['height', ['height']]
            ],
            buttons: {
                lfm: LFMButton
            }
            })
        });
    </script>

    <script>
        //Them chapter
        $(document).ready(function () {
            $('#submit').click(() => {
                var story_id = '{{$story_id}}';
                var chapter = $('#chapter');
                var title = $('#title');
                var summernote = $('#summernote-editor');
                var code = summernote.summernote('code');
                $.ajax({
                    url: '{{URL::to("api/add-chapter")}}',
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        story_id: story_id,
                        title: title.val(),
                        chapter: chapter.val(),
                        code: code
                    }
                })
                    .done(function (data) {
                        title.val('');
                        chapter.val('');
                        summernote.val('');
                        swal("Thành công", data.message, "success");
                    })
                    .fail(function (error) {
                        swal("Thất bại", error.responseJSON.message, "error");
                    })
            });
        });
    </script>

</body>

</html>