<!DOCTYPE html>
<html lang="en">

<head>
    <title>Danh sách truyện</title>
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
                                    <h4 class="page-title">Đọc truyện</h4>
                                </div>
                            </div> <!-- end row -->
                        </div>
                        
                        <!-- end page-title -->

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card-body" style="text-align: center;">
                                    <div style="text-align: center; margin-top: 20px;">
                                        <h4 class="page-title">{{$data2->story_name}}</h4>
                                    </div>
                                    <div class="col-lg-3" style=" float: left;">
                                        <div class="image-story" style=" background: url('{{$data2->image}}') center center / cover; width:250px; height: 320px;"></div>
                                    </div>
                                    <div class="col-lg-6" style="float: left;">
                                        <table class="table">
                                            <tr>
                                                <td>Tác giả</td>
                                                <td>Đang cập nhật</td>
                                            </tr>
                                            <tr>
                                                <td>Tình trạng</td>
                                                <td>Đang phát triển</td>
                                            </tr>
                                            <tr>
                                                <td>Thể loại</td>
                                                <td>
                                                    @foreach($data3 as $data3)
                                                    {{$data3->category_id}}
                                                    @endforeach
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Lượt xem</td>
                                                <td>???</td>
                                            </tr>
                                        </table>
                                    </div>
                                    <div class="clearfix"></div>

                                </div>
                                
                            </div>
                            <div class="col-lg-12">
                                <div class="card m-b-30">
                                    <div class="card-body">
                                    <table class="table table-striped mb-0 table-editable" style="margin-top: 20px;">
                                        <thead>
                                        <tr>
                                            <th>Danh sách chương</th>
                                            <th>Cập nhật</th>
                                            <th>Lượt xem</th>
                                        </tr>
                                        </thead>
                                        <tbody id="show">   
                                            @foreach($data as $data)
                                            <tr>
                                                <td scope='row'> <a href="/truyen-{{$data->story_id}}/{{$data->id}}-chapter-{{$data->chapter}}.html"> Chapter {{$data->chapter}} - {{$data->title}} </a> </td>
                                                <td> {{$data->created}} </td>
                                                <td> ??? </td>
                                            </tr>
                                            @endforeach
                                        </tfoot>
                                    </table>
                                    </div>
                                </div>
                            </div>
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

</body>

</html>