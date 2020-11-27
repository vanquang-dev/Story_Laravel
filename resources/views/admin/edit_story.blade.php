<!DOCTYPE html>
<html lang="en">

<head>
    <title>Sửa</title>
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
                                    <h4 class="page-title">Thêm truyện</h4>
                                </div>
                            </div> <!-- end row -->
                        </div>
                        
                        <!-- end page-title -->
                        @foreach ($data as $story)
                        @endforeach   
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card m-b-30">
                                    <div class="card-body">
                                        <div class="col-lg-6" style="float: left;">
                                            <div class="form-group">
                                                <label>Tên truyện</label>
                                                <input type="text" class="form-control" id="story_name" required value="{{$story->story_name}}"/>
                                            </div>
                                            <div class="form-group">
                                                <label>Nội dung</label>
                                                <textarea rows="8" class="form-control" id="description">{{$story->description}}</textarea>
                                            </div>
                                            <div class="form-group">
                                                <div>
                                                    <button id="submit" class="btn btn-primary waves-effect waves-light">
                                                        Lưu
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6" style="float: right;">
                                            <div class="form-group">
                                                <label>Ảnh truyện</label>
                                                <div class="input-group">
                                                <span class="input-group-btn" style="color: #ffffff; ">
                                                    <a id="lfm" data-input="image" data-preview="holder" class="btn btn-primary">
                                                    <i class="fa fa-picture-o"></i> Choose
                                                    </a>
                                                </span>
                                                <input id="image" class="form-control" type="text" name="filepath" value="{{$story->image}}">
                                                </div>
                                                <div id="holder" style="margin-top:15px;max-height:100px;">
                                                    <img src="{{$story->image}}" style="height: 5rem;">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="status">Status</label>
                                                <select id="status" class="form-control">
                                                    <option value="1" selected="">Đang phát triển</option>
                                                    <option value="0">Đã xong</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label>Thể loại</label>
                                                <div>
                                                <?php $i = 0; ?>
                                                @foreach($data2 as $data)
                                                <?php $i++; $check = "false";?>
                                                    <div class="custom-control custom-checkbox" style="float: left; width: 136px;">
                                                        @foreach($data3 as $leuleu)
                                                            @if ($data->id == $leuleu->category_id) 
                                                            <input type="checkbox" class="custom-control-input" id="customCheck{{$i}}" value="{{$data->id}}" checked>
                                                            <?php $check = "true"; ?>
                                                            @endif
                                                        @endforeach
                                                        @if($check == "false")
                                                        <input type="checkbox" class="custom-control-input" id="customCheck{{$i}}" value="{{$data->id}}">
                                                        @endif
                                                        <label class="custom-control-label" for="customCheck{{$i}}" style="line-height: 25px;">{{$data->category_name}}</label>
                                                    </div>
                                                @endforeach
                                                </div>
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
    <script src="{{asset('/vendor/laravel-filemanager/js/stand-alone-button.js')}}"></script>
    <script>$('#lfm').filemanager('image');</script>
    <script>
        //Sua truyen
        $(document).ready(function () {
            $('#submit').click(() => {
                var data = new Array();
                var checkbox = $('.custom-control-input');
                for (var i = 0; i<checkbox.length; i++) {
                    if (checkbox[i].checked){
                        data[i] = checkbox[i].value;
                    }
                }
                var id = "{{$story->id}}";
                var story_name = $("#story_name");
                var description = $("#description");
                var image = $("#image");
                var status = $("#status").find('option:selected').val();
                $.ajax({
                    url: '{{URL::to("api/edit-story")}}',
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        id: id,
                        data: data,
                        story_name: story_name.val(),
                        description: description.val(),
                        image: image.val(),
                        status: status,
                    }
                })
                    .done(function (data) {
                        location.replace("{{URL::to('/truyen')}}");
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