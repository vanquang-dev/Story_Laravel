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
                                    <h4 class="page-title">Tất cả truyện</h4>
                                </div>
                            </div> <!-- end row -->
                        </div>
                        
                        <!-- end page-title -->

                        <div class="row">

                            <div class="col-lg-12">
                                <div class="card m-b-30">
                                    <div class="card-body">
                                    <table class="table table-striped mb-0 table-editable" style="margin-top: 20px;">
                                        <thead>
                                        <tr>
                                            <th>STT</th>
                                            <th>Tên truyện</th>
                                            <th>Nội dung</th>
                                            <th>Ảnh</th>
                                            <th>Thêm chương</th>
                                            <th>Xem</th>
                                            <th>Sửa</th>
                                            <th>Xóa</th>
                                        </tr>
                                        </thead>
                                        <tbody id="show">   
                                            <?php 
                                                if(!isset($_GET['page'])){
                                                    $i = 0;
                                                } else if($_GET['page'] == 1) {
                                                    $i = 0;
                                                } else {
                                                    $i=$_GET['page'] + 3; 
                                                }
                                            ?>
                                            @foreach($story as $result)
                                                <?php  
                                                    $description = substr($result->description,0,300).'...';
                                                    $i++;
                                                ?>
                                            <tr>
                                                <th scope='row' style="width: 50px;"> {{$i}} </th>
                                                <td style="width: 200px;"> {{$result->story_name}} </td>
                                                <td style="width: 450px;"> {{$description}} </td>
                                                <td style="width: 120px;">
                                                    <div class="box-image" style="background: url('{{$result->image}}') center center / cover; width: 90px; height:120px;"></div>
                                                </td>
                                                <td style="width: 146px;">
                                                    <a href="/truyen-{{$result->id}}/add-chapter" class="btn btn-success" style="background: #4b2399;border: 1px solid #4b2399;">Thêm chương</a>
                                                </td>
                                                <td style="width: 66px;">
                                                    <a href="/truyen-{{$result->id}}/full" class="btn btn-success" style="background: #028fc5; border: 1px solid #028fc5;">Xem</a>
                                                </td>
                                                <td style="width: 66px;">
                                                    <a href="truyen/edit/{{$result->id}}" class="btn btn-success">Sửa</a>
                                                </td>
                                                <td style="width: 66px;">
                                                    <span class="btn btn-danger" onclick="destroy('{{$result->id}}')">Xóa</span>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tfoot>
                                    </table>
                                    <div style="margin-top: 20px;" id="page">
                                        {{ $story->links() }}
                                    </div>
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