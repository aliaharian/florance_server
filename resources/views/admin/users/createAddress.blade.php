<!DOCTYPE html>
<html>
<head>
    <title>
        ایجاد آدرس برای {{$user->name}} {{$user->last_name}}
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
                ایجاد آدرس برای {{$user->name}} {{$user->last_name}}

            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> خانه</a></li>
                <li>کاربران</li>
                <li class="active">
                    ایجاد آدرس برای {{$user->name}} {{$user->last_name}}
                </li>
            </ol>
        </section>
        <form
            action="@if($admin){{route('userAddresses.store',['user' => $user->id])}}@else{{route('addresses.store')}} @endif"
            method="post" enctype="multipart/form-data">
        {{csrf_field()}}

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

                        <a href="{{route('profile.addresses')}}" class="btn btn-primary btn-block margin-bottom">بازگشت</a>


                        <!-- /.box -->
                    </div>
                    <!-- /.col -->
                    <div class="col-md-9">

                        {{--                        address section--}}
                        <div class="box box-primary">
                            <div class="box-header with-border">
                                <h3 class="box-title">آدرس تحویل گیرنده</h3>
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body row">

                                <div class="form-group col-sm-6">
                                    <label for="name">نام</label>
                                    <input value="{{old('name')}}" class="form-control" name="name" id="name"
                                           placeholder="نام تحویل گیرنده">
                                </div>
                                <div class="form-group col-sm-6">
                                    <label for="last_name">نام خانوادگی</label>
                                    <input value="{{old('last_name')}}" class="form-control" name="last_name"
                                           id="last_name"
                                           placeholder="نام خانوادگی تحویل گیرنده">
                                </div>
                                <div class="form-group col-sm-6">
                                    <label for="province">استان</label>
                                    <select class="form-control" name="province" id="province">
                                        <option value="province0">انتخاب کنید</option>
                                        @foreach($provinces as $province)
                                            <option @if (old('province') == $province->id) selected
                                                    @endif value="{{$province->id}}">{{$province->name}}</option>
                                        @endforEach
                                    </select>
                                </div>

                                <div class="form-group col-sm-6">
                                    <label for="city">شهر</label>
                                    <select class="form-control" name="city" id="city">
                                        <option value="city0">استان را انتخاب کنید</option>
                                    </select>
                                </div>
                                <div class="form-group col-sm-6">
                                    <label for="phone">شماره تماس</label>
                                    <input value="{{old('phone')}}" class="form-control" name="phone" id="phone"
                                           placeholder="شماره تماس">
                                </div>
                                <div class="form-group col-sm-6">
                                    <label for="postalCode">کد پستی</label>
                                    <input value="{{old('postalCode')}}" class="form-control" name="postalCode"
                                           id="postalCode"
                                           placeholder="کد پستی">
                                </div>

                                <div class="form-group col-sm-12">
                                    <label for="color">آدرس پستی</label>
                                    <textarea id="ckeditor" name="address" class="form-control"
                                              style="height: 300px">{!! old('address') !!}</textarea>
                                </div>

                            </div>
                            <!-- /.box-body -->

                            <!-- /.box-footer -->
                        </div>
                        <div class="box box-primary">

                            <div class="box-footer">
                                <div class="pull-right">

                                    <button type="submit" class="btn btn-primary"><i
                                            class="fa fa-share"></i>
                                        ثبت آدرس
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
<script>
    $('#province').on('change', function (e) {
        $.ajax({
            url: `/getCities/${e.target.value}`, success: function (result) {
                $("#city").html(result);
            }
        });
    });
</script>

</body>
</html>
