<!DOCTYPE html>
<html lang="en">

<head>
    <title>Thêm thể loại</title>
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
                                    <h4 class="page-title">Thêm thể loại truyện</h4>
                                </div>
                                <div class="col-sm-6">
                                    <ol class="breadcrumb float-right">
                                        <h4 class="page-title">Tất cả thể loại</h4>
                                    </ol>
                                </div>
                            </div> <!-- end row -->
                        </div>
                        <!-- end page-title -->
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="card m-b-30">
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label>Tên thể loại</label>
                                            <input type="text" class="form-control" id="name" required placeholder=""/>
                                        </div>
                                        <div class="form-group">
                                            <div>
                                                <button id="submit" class="btn btn-primary waves-effect waves-light">
                                                    Thêm
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div> <!-- end col -->

                            <div class="col-lg-6">
                                <div class="card m-b-30">
                                    <div class="card-body">
                                        <table class="table table-striped mb-0 table-editable" style="margin-top: 20px;">
                                            <thead>
                                            <tr>
                                                <th>STT</th>
                                                <th>Tên thẻ loại</th>
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
                                                @foreach($category as $result)
                                                <?php $i++; ?>
                                                <tr>
                                                    <th scope='row'><?php echo $i; ?></th>
                                                    <td>
                                                        {{$result->category_name}}
                                                    </td>
                                                    <td>
                                                        <span class="btn btn-danger" onclick="destroy('{{$result->id}}')">Xóa</span>
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tfoot>
                                        </table>
                                        <div style="margin-top: 20px;">
                                            {{ $category->links() }}
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
    

    <script>
        // Them the loai
        $(document).ready(function () {
            $('#submit').click(() => {
                var name = $("#name");
                $.ajax({
                    url: '{{URL::to("api/add-category")}}',
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        name: name.val(),
                    }
                })
                    .done(function (data) {
                        name.val('');
                        swal("Thành công", data.message, "success");
                    })
                    .fail(function (error) {
                        swal("Thất bại", error.responseJSON.message, "error");
                    })
            });
        });
        //Xoa the loai
        function destroy(id){
            $.ajax({
                url: '{{URL::to("api/destroy-category")}}',
                type: 'POST',
                dataType: 'json',
                data: {
                    id : id
                }
            })
                .done(function (data) {
                    location.reload();
                    swal("Thành công", data.message, "success");
                })
                .fail(function (error) {
                    swal("Thất bại", error.responseJSON.message, "error");
                })
        }
    </script>

</body>

</html>