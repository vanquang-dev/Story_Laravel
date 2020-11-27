<!DOCTYPE html>
<html lang="en">

<head>
    <title>Home</title>
    @include('admin.components.head')
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
                                <h4 class="page-title">Hello bạn trẻ</h4>
                            </div>
                        </div> 
                    </div>
                    

                    <div class="row">
                        <div class="col-lg-1">
                        </div>
                        <div class="col-lg-10" id="show">
                            
                        </div>
                        <div class="col-lg-11">
                        </div>
                    </div>
                </div>
            </div>
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

    <script>
        function get_chapter(){
            var show = $('#show');
            var id = '{{$id}}';
            $.ajax({
                url: '{{URL::to("/api/chapter")}}',
                type: 'GET',
                dataType: 'json',
                data: {
                    id: id
                }
            })
                .done(function (data) {
                    show.html('');
                    show.html(data.detail_story);
                })
                .fail(function (error) {
                    swal("Thất bại", error.responseJSON.message, "error");
                })
        }
        get_chapter();
    </script>
</body>

</html>