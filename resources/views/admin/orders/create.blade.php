<!DOCTYPE html>
<html>
<head>
    <title>
        @if($order)
            ویرایش سفارش
        @else
            ثبت سفارش
        @endif
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
                @if($order)
                    ویرایش سفارش
                @else
                    ثبت سفارش
                @endif
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> خانه</a></li>
                <li>سفارشات</li>
                <li class="active">
                    @if($order)
                        ویرایش سفارش
                    @else
                        ثبت سفارش
                    @endif
                </li>
            </ol>
        </section>
        <form
            action="@if($order){{route('orders.update',['order' => $order->id])}}@else{{route('orders.store')}} @endif"
            method="post" enctype="multipart/form-data">
        {{csrf_field()}}
        @if($order)
            {{method_field('put')}}
        @endif
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

                        <a href="{{route('orders.index')}}" class="btn btn-primary btn-block margin-bottom">بازگشت</a>


                        <!-- /. box -->
                        <div class="box box-solid">
                            <div class="box-header with-border">
                                <h3 class="box-title" id="image_title">تصویر سفارش</h3>

                                <div class="box-tools">
                                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i
                                            class="fa fa-minus"></i>
                                    </button>
                                </div>
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body no-padding">
                                <div class="input-group" style="width: 100%;padding: 10px">
                                    <div id="picture" style="width: 100%;margin: 5px auto;">
                                        @if($order && $order->attachment_id)
                                            <img style="width: 100%" src="/files/{{$order->attachment->path}}"/>
                                        @endif

                                    </div>
                                    @if(!$order)
                                        <button type="button" class="browse btn btn-primary" id="imageUpload"
                                                style="width: 100%;padding: 10px;margin: auto"> انتخاب تصویر
                                        </button>
                                    @endif
                                    <input type="text" hidden name="mainImage" style="width: 100%;height: 100%"
                                           id="featured_image" placeholder="آدرس تصویر" readonly/>
                                    <input type="hidden" name="featured_image_obj" id="featured_image_obj">


                                </div>
                            </div>
                            <!-- /.box-body -->
                        </div>
                        <!-- /.box -->
                    </div>
                    <!-- /.col -->
                    <div class="col-md-9">

                        <div class="box box-primary">
                            <div class="box-header with-border">
                                <h3 class="box-title">مشخصات سفارش</h3>
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body row">
                                <div class="form-group col-sm-6">
                                    <label for="cabin_size">ابعاد کابین</label>

                                    <input value="{{$order?$order->cabin_size:old('cabin_size')}}" class="form-control"
                                           name="cabin_size"
                                           id="cabin_size"
                                           placeholder="طول و عرض و ارتفاع کابین">
                                </div>
                                <div class="form-group col-sm-6">
                                    <label for="cabin_material">متریال کابین</label>
                                    <select class="form-control" name="cabin_material" id="cabin_material">
                                        @foreach($cabinMaterials as $material)
                                            <option
                                                @if ($order?$order->cabin_material_id==$material->id : old('cabin_material') == $material->id) selected
                                                @endif value="{{$material->id}}">{{$material->name}}</option>
                                        @endforEach
                                    </select>
                                </div>

                                <div class="form-group col-sm-6">
                                    <label for="bowl_material">متریال کاسه</label>
                                    <select class="form-control" name="bowl_material" id="bowl_material">
                                        @foreach($bowlMaterials as $material)
                                            <option
                                                @if ($order?$order->bowl_material_id==$material->id : old('bowl_material') == $material->id) selected
                                                @endif value="{{$material->id}}">{{$material->name}}</option>
                                        @endforEach
                                    </select>
                                </div>


                                <div class="form-group col-sm-6">
                                    <label for="surface_material">متریال صفحه</label>
                                    <select class="form-control" name="surface_material" id="surface_material">
                                        @foreach($surfaceMaterials as $material)
                                            <option
                                                @if ($order?$order->surface_material_id==$material->id : old('surface_material') == $material->id) selected
                                                @endif  value="{{$material->id}}">{{$material->name}}</option>
                                        @endforEach
                                    </select>
                                </div>
                                <div class="col-sm-12">
                                    <p class="alert alert-warning "> در صورتی که به آینه نیاز ندارید قسمت ابعاد آینه را
                                        خالی رها کنید.
                                    </p>
                                </div>
                                <div class="form-group col-sm-6">
                                    <label for="mirror_size">ابعاد آینه</label>

                                    <input value="{{$order?$order->mirror_size:old('mirror_size')}}"
                                           class="form-control" name="mirror_size"
                                           id="mirror_size"
                                           placeholder="طول و عرض آینه">
                                </div>
                                <div class="form-group col-sm-6">
                                    <label for="mirror_material">متریال آینه</label>
                                    <select class="form-control" name="mirror_material" id="mirror_material">
                                        <option value="mirror0">بدون آینه</option>

                                        @foreach($mirrorMaterials as $material)
                                            <option
                                                @if ($order?$order->mirror_material_id==$material->id : old('mirror_material') == $material->id) selected
                                                @endif value="{{$material->id}}">{{$material->name}}</option>
                                        @endforEach
                                    </select>
                                </div>
                                <div class="form-group col-sm-6">
                                    <label for="drawer_material">نوع کشو</label>
                                    <select class="form-control" name="drawer_material" id="drawer_material">
                                        <option value="drawer0">بدون کشو</option>

                                        @foreach($drawerMaterials as $material)
                                            <option
                                                @if ($order?$order->drawer_material_id==$material->id : old('drawer_material') == $material->id) selected
                                                @endif value="{{$material->id}}">{{$material->name}}</option>
                                        @endforEach
                                    </select>
                                </div>
                                <div class="form-group col-sm-6">
                                    <label for="color">رنگ</label>
                                    <select class="form-control" name="color" id="color">
                                        @foreach($colors as $color)
                                            <option
                                                @if ($order ? $order->color_id == $color->id : old('color') == $color->id) selected
                                                @endif value="{{$color->id}}">{{$color->name}}</option>
                                        @endforEach
                                    </select>
                                </div>


                                <div class="form-group col-sm-12">
                                    <label for="color">توضیحات سفارش</label>
                                    <textarea id="ckeditor" name="description" class="form-control"
                                              style="height: 300px">{!!  $order?$order->description:old('description') !!}</textarea>
                                </div>

                            </div>
                            <!-- /.box-body -->

                            <!-- /.box-footer -->
                        </div>

                        {{--                        address section--}}
                        <div class="box box-primary">
                            <div class="box-header with-border">
                                <h3 class="box-title">آدرس تحویل گیرنده</h3>
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body row">

                                {{--                               select from addresses list--}}
                                @if($addresses->count()>0)
                                    <div class="form-group col-sm-12">
                                        <label for="address_id">انتخاب از لیست آدرس ها: </label>
                                        <select class="form-control" name="address_id" id="address_id">
                                            <option value="address0">انتخاب کنید</option>
                                            @foreach($addresses as $address)
                                                @php
                                                    $json = json_decode($address->meta);
                                                @endphp
                                                <option
                                                    @if ($order?$order->address_id == $address->id :old('address_id') == $address->id) selected
                                                    @endif value="{{$address->id}}">{{$address->name}} {{$address->last_name}}
                                                    - کد پستی: {{$json->postalCode}}</option>
                                            @endforEach
                                        </select>
                                    </div>
                                @endif

                                {{--                                    add address--}}

                                <div class="form-group col-sm-12">
                                    @if($addresses->count()>0)
                                        <label for="cabin_material">یا آدرس جدید ثبت کنید:</label>
                                    @else
                                        <label for="cabin_material"> آدرس جدید ثبت کنید:</label>
                                    @endif
                                </div>
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
                                    <textarea id="ckeditorAddress" name="address" class="form-control"
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
                                        @if($order)
                                            ویرایش سفارش
                                        @else
                                            ثبت سفارش
                                        @endif

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
