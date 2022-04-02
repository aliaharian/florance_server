<!DOCTYPE html>
<html>
<head>
    <title>
        پروفایل {{$user->name}} {{$user->last_name}}
    </title>

    @include('admin.includes.headerLinks')
    <style>
        .display-none {
            display: none !important;
        }

        .hidden {
            visibility: hidden;
        }

        .variableImage {
            width: 50px;
        }

        .add-gallery {
            display: block;
            background-color: #f2f2f2;
            height: 100px;
            border: dashed black 1px;
            text-align: center;
            font-size: 18px;
            line-height: 100px;
            padding: 0;
            z-index: 9999999;

        }

        .deletegaler {
            display: block;
            background-color: rgba(0, 0, 0, 0.3);
            transform: translateY(-100px);
        }

        .wronginput {
            border: red 1px solid;
        }

    </style>
    <link rel="stylesheet" href="/panel-admin/css/persian-datepicker-0.4.5.min.css"/>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <script type="text/javascript" src="/js/jquery.popupWindow.js"></script>

</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">


@include('admin.includes.header')
<!-- right side column. contains the logo and sidebar -->
@include('admin.includes.aside')

<!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                پروفایل {{$user->name}} {{$user->last_name}}

            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> خانه</a></li>
                <li>کاربران</li>
                <li class="active">
                    پروفایل {{$user->name}} {{$user->last_name}}

                </li>
            </ol>
        </section>
        <form
            action="{{route('users.update',['user' => $user->id])}}"
            method="post" enctype="multipart/form-data">
        {{csrf_field()}}
        {{method_field('put')}}
        <!-- Main content -->
            <section class="content">
                <div class="row">
                    <div class="col-md-3">
                        @if(isset($pm))
                            <a class="btn btn-success btn-block margin-bottom">
                                {{$pm}}
                            </a>


                        @endif


                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        @if(session()->has('error'))
                            <div class="alert alert-danger">
                                {{ session()->get('error') }}
                            </div>
                        @endif

                        <a href="@if($admin ?? ''){{route('user.addresses',['user'=>$user->id])}}@else{{route('profile.addresses')}}@endif" class="btn btn-primary btn-block margin-bottom">آدرس های
                            کاربر</a>


                        <!-- /. box -->

                    </div>
                    <!-- /.col -->
                    <div class="col-md-9">

                        <div class="box box-primary">
                            <div class="box-header with-border">
                                <h3 class="box-title">مشخصات کاربر</h3>
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body row">
                                <div class="form-group col-sm-6">
                                    <label for="name">نام</label>

                                    <input value="{{$user->name}}" class="form-control"
                                           name="name"
                                           id="name"
                                           placeholder="نام">
                                </div>
                                <div class="form-group col-sm-6">
                                    <label for="last_name">نام خانوادگی</label>

                                    <input value="{{$user->last_name}}" class="form-control"
                                           name="last_name"
                                           id="last_name"
                                           placeholder="نام خانوادگی">
                                </div>

                                <div class="form-group col-sm-6">
                                    <label for="email">ایمیل</label>

                                    <input value="{{$user->email}}" class="form-control"
                                           name="email"
                                           id="email"
                                           placeholder="ایمیل">
                                </div>
                                <div class="form-group col-sm-6">
                                    <label for="national_code">کد ملی</label>

                                    <input value="{{$user->national_code}}" class="form-control"
                                           name="national_code"
                                           id="national_code"
                                           placeholder="کد ملی">
                                </div>
                                <div class="form-group col-sm-6">
                                    <label for="card_number">شماره کارت</label>

                                    <input value="{{$user->card_number}}" class="form-control"
                                           name="card_number"
                                           id="card_number"
                                           placeholder="شماره کارت">
                                </div>
                                <div class="form-group col-sm-6">
                                    <label for="sheba_number">شماره شبا</label>

                                    <input value="{{$user->sheba_number}}" class="form-control"
                                           name="sheba_number"
                                           id="sheba_number"
                                           placeholder="شماره شبا">
                                </div>
                                <div class="form-group col-sm-6">
                                    <label for="sheba_number">شماره موبایل</label>

                                    <input value="{{$user->phone}}" class="form-control"
                                           name="phone"
                                           id="phone"
                                           disabled
                                           readonly
                                           placeholder="شماره موبایل">
                                </div>
                                @if($pass)
                                    <div class="form-group col-sm-6">
                                        <label for="sheba_number">تغییر کلمه عبور</label>

                                        <a href="/password/reset" class="btn btn-primary btn-block margin-bottom">تغییر
                                            کلمه عبور</a>

                                    </div>
                                @endif

                            </div>
                            <!-- /.box-body -->

                            <!-- /.box-footer -->
                        </div>

                        {{--                        address section--}}
                        <div class="box box-primary">

                            <div class="box-footer">
                                <div class="pull-right">

                                    <button type="submit" class="btn btn-primary"><i
                                            class="fa fa-share"></i>
                                        ویرایش اطلاعات

                                    </button>
                                </div>
                            </div>
                        </div>
                        <!-- /.box-footer -->
                    </div>
                    <!-- /. box -->
                </div><!-- /.col -->
                <!-- /.row -->
            </section>
            <!-- /.content -->
        </form>
    </div>
    <!-- /.content-wrapper -->

@include('admin.includes.footer')
<!-- /.control-sidebar -->
    <!-- Add the sidebar's background. This div must be placed
         immediately after the control sidebar -->
    <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->


@include('admin.includes.footerLinks')

<script src="/js/add-Product.js"></script>
<script src="/panel-admin/js/persian-date-0.1.8.min.js"></script>
<script src="/panel-admin/js/persian-datepicker-0.4.5.min.js"></script>
<!-- Page script -->

<script type="text/javascript" src="/js/jquery.popupWindow.js"></script>
<script type="text/javascript">

    $(document).ready(function () {

        $('#imageUpload').popupWindow({
            windowURL: '/arts-admin/elfinder/popup/main',
            windowName: 'Filebrowser',
            height: 490,
            width: 950,
            centerScreen: 1
        });
        window.callbackmain = function (file) {
            $('#picture').html('<a onclick="deletemainImage()"><i class="fa fa-times btn btn-danger btn-lg"></i></a><img style="width: 50%" src="' + file + '" /> ');
            $('#featured_image').val(file);
        }
        window.Dcallbackmain = function (file) {
            $('#featured_image_obj').val(file);
        }

        $('#province').on('change', function (e) {
            $.ajax({
                url: `/getCities/${e.target.value}`, success: function (result) {
                    $("#city").html(result);
                }
            });
        });
    });

    function deletemainImage() {
        $('#picture').html('');
        $('#featured_image').val('');
        $('#featured_image_obj').val('');

    }

</script>
</body>
</html>
