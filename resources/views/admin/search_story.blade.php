<!DOCTYPE html>
<html lang="en">

<head>
    <title>Tìm kiếm truyện</title>
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
                                    <h4 class="page-title">Tìm kiếm truyện</h4>
                                </div>
                            </div> <!-- end row -->
                        </div>
                        
                        <!-- end page-title -->

                        <div class="row">

                            <div class="col-lg-12">
                                <div class="card m-b-30">
                                    <div class="card-body">
                                    @if(isset($searchResults))

                                    @if ($searchResults-> isEmpty())
                                    <h2>Không tim thấy kết quả cho:  <b>"{{ $searchterm }}"</b>.</h2>
                                    @else
                                    <h3>Có {{ $searchResults->count() }} kết quả cho:  <b>"{{ $searchterm }}"</b></h3>
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
                                        <?php $i = 0; ?>
                                        @foreach($searchResults as $data)
                                            <?php  
                                                $i++;
                                                $description = substr($data->searchable->description,0,300).'...';
                                            ?>
                                            <tr>
                                                <th scope='row' style="width: 50px;"> {{$i}} </th>
                                                <td style="width: 200px;"> {{$data->searchable->story_name}} </td>
                                                <td style="width: 450px;"> {{$description}} </td>
                                                <td style="width: 120px;">
                                                    <div class="box-image" style="background: url('{{$data->searchable->image}}') center center / cover; width: 90px; height:120px;"></div>
                                                </td>
                                                <td style="width: 146px;">
                                                    <a href="/truyen-{{$data->searchable->id}}/add-chapter" class="btn btn-success" style="background: #4b2399;border: 1px solid #4b2399;">Thêm chương</a>
                                                </td>
                                                <td style="width: 66px;">
                                                    <a href="/truyen-{{$data->searchable->id}}/full" class="btn btn-success" style="background: #028fc5; border: 1px solid #028fc5">Xem</a>
                                                </td>
                                                <td style="width: 66px;">
                                                    <a href="truyen/edit/{{$data->searchable->id}}" class="btn btn-success">Sửa</a>
                                                </td>
                                                <td style="width: 66px;">
                                                    <span class="btn btn-danger" onclick="destroy('{{$data->searchable->id}}')">Xóa</span>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tfoot>
                                    </div>
                                    @endif
                                    @endif
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