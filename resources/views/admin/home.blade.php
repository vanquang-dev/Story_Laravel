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
                                <h4 class="page-title">Danh sách truyện</h4>
                            </div>
                        </div>
                        <!-- end row -->
                    </div>
                    <!-- end page-title -->
                    <div class="row m-t-30">
                        @foreach($data as $result)
                        <div class="col-xl-3 col-md-6">
                            <div class="card pricing-box mt-4" style="padding: 5px;">
                                <div class="pricing-content" style="box-shadow: 2px 3px 5px 0px rgba(0, 0, 0, 0.3); border-radius: 5px;">
                                    <a href="/truyen-{{$result->id}}/full">
                                        <div class="text-center"  style="width:100%; height:320px; margin-bottom:20px; background: url('{{$result->image}}') center center / cover; border-radius: 5px 5px 0 0;"></div>
                                    </a>
                                    <div class="pricing-features mt-4" style="padding-left: 10px; height: 50px;">
                                        <a href="/truyen-{{$result->id}}/full" style="font-size: 16px;">{{$result->story_name}}</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <div style="padding-bottom: 50px; width: 154px; margin: 0 auto;">
                        {{ $data->links() }}
                    </div>
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

</body>

</html>