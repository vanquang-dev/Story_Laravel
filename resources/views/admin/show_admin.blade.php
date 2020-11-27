<!DOCTYPE html>
<html lang="en">

<head>
    <title>Thêm quản trị</title>
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
                                <h4 class="page-title">Thêm tài khoản</h4>
                            </div>
                        </div> <!-- end row -->
                    </div>
                    <!-- end page-title -->

                    <div class="row">
                        <div class="col-12">
                            <div class="card m-b-30">
                                <div class="card-body">
                                    <div class="form-group row">
                                        <label for="username" class="col-sm-2 col-form-label">Tài khoản</label>
                                        <div class="col-sm-10">
                                            <input class="form-control" type="text" id="username">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="password" class="col-sm-2 col-form-label">Mật khẩu</label>
                                        <div class="col-sm-10">
                                            <input class="form-control" type="password" id="password">
                                        </div>
                                    </div>
                                    
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label"></label>
                                        <input type="button" class="btn btn-primary waves-effect waves-light" id="submit" value="Thêm" style="margin-left: 13px; width: 100px;">
                                        <span id="success" style="margin-left: 10px;"></span>
                                    </div>
                                    
                                </div>
                            </div>
                        </div> <!-- end col -->
                    </div> <!-- end row -->      

                    
                </div>
                <!-- container-fluid -->

            </div>
            <!-- content -->
            <!-- Start content -->
            <div class="content">
                <div class="container-fluid">
                    <div class="page-title-box">
                        <div class="row align-items-center">
                            <div class="col-sm-6">
                                <h4 class="page-title">Tài khoản quản trị</h4>
                            </div>
                        </div> <!-- end row -->
                    </div>
                    <!-- end page-title -->

                    <div class="row">
                        <div class="col-12">
                            <div class="card m-b-30">
                                <div class="card-body">
    
                                    <table id="mainTable" class="table table-striped mb-0 table-editable">
                                        <thead>
                                        <tr>
                                            <th>STT</th>
                                            <th>Tài khoản</th>
                                            <th>Khóa</th>
                                            <th>Tùy chọn</th>
                                            <th>Xóa</th>
                                        </tr>
                                        </thead>
                                        <tbody id="show">
                                        
                                        </tfoot>
                                    </table>
    
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
    <script>
        var success = $('#success');
        function get_admin(){
            var show = $('#show');
            $.ajax({
                url: '{{URL::to("/api/nhan-vien")}}',
                type: 'GET',
                dataType: 'json'
            })
                .done(function (data) {
                    var i = 0;
                show.html('');
                for (a of data) {
                    i++;
                    var b = "Quản lý";
                    var lock = "<span class='btn btn-danger' onclick='lock("+a.id+")'>Khoá</span>"
                    if (a.kind == 1) {
                        var b = "Nhân viên";
                    } else if (a.kind == 2) {
                        var b = "Bị khoá";
                        var lock = "<span class='btn btn-danger' onclick='unlock("+a.id+")'>Mở khoá</span>";
                    }
                    show.append("<tr><th scope='row'>" + i + "</th><td>" + a.username + "</td><td>" + b + "</td><td><a href='sua-nhan-vien/"+a.id+"' class='btn btn-primary'>Chỉnh sửa</a> "+lock+"</td><td><span class='btn btn-danger' onclick='del("+a.id+")'>Xóa</span></td></tr>")
                }
                })
                .fail(function (error) {
                    swal("Thất bại", error.responseJSON.message, "error");
                })
        }
        get_admin();

        $(document).ready(function () {
            $('#submit').click(() => {
                var username = $("#username");
                var password = $("#password");
                $.ajax({
                    url: '{{URL::to("api/add-admin")}}',
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        username: username.val(),
                        password: password.val(),
                    }
                })
                    .done(function (data) {
                        username.val('');
                        password.val('');
                        get_admin();
                        success.html(data.message);
                        swal("Thành công", data.message, "success");
                    })
                    .fail(function (error) {
                        success.html(error.responseJSON.message);
                        swal("Thất bại", error.responseJSON.message, "error");
                    })
            });
        });

        function del(id){
            $.ajax({
                url: '{{URL::to("api/delete-admin")}}',
                type: 'POST',
                dataType: 'json',
                data: {
                    id : id
                }
            })
                .done(function (data) {
                    get_admin();
                    swal("Thành công", data.message, "success");
                })
                .fail(function (error) {
                    swal("Thất bại", error.responseJSON.message, "error");
                })
        }

        function lock(id) {
            $.ajax({
                url: '{{URL::to("api/lock-admin")}}',
                type: 'POST',
                dataType: 'json',
                data: {
                    id: id
                }
            })
            .done(function (data) {
                get_admin();
                swal("Thành công", data.message, "success");
            }) 
            .fail(function (error) {
                swal("That bai", error.responseJSON.message, "error");
            })
        }

        function unlock(id) {
            $.ajax({
                url: '{{URL::to("api/unlock-admin")}}',
                type: 'POST',
                dataType: 'json',
                data: {
                    id: id
                }
            })
            .done(function (data) {
                get_admin();
                swal("Thành công", data.message, "success");
            }) 
            .fail(function (error) {
                swal("That bai", error.responseJSON.message, "error");
            })
        }
    </script>

</body>

</html>