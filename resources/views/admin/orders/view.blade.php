<!DOCTYPE html>
<html>
<head>
    <title>
        مشاهده سفارش
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
                مشاهده سفارش
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> خانه</a></li>
                <li>سفارشات</li>
                <li class="active">
                    مشاهده سفارش
                </li>
            </ol>
        </section>
        <form>

            <!-- Main content -->
            <section class="content">
                <div class="row">
                    <div class="col-md-3">

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
                                        @if($order->attachment_id)
                                            <img style="width: 100%" src="/files/{{$order->attachment->path}}"/>
                                        @endif

                                    </div>

                                </div>
                            </div>
                            <!-- /.box-body -->
                        </div>
                        <div class="box box-solid">
                            <div class="box-header with-border">
                                <h3 class="box-title" id="image_title">هزینه ها</h3>

                                <div class="box-tools">
                                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i
                                            class="fa fa-minus"></i>
                                    </button>
                                </div>
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body no-padding">
                                <div class="input-group" style="width: 100%;padding: 10px">

                                    <p>هزینه کل: {{number_format($order->total_price)}} ریال</p>
                                    <p>قسط اول به مبلغ {{number_format($pay1->price)}}ریال پرداخت  {{$pay1->payed==1?'شده':'نشده'}}</p>
                                    <p>قسط دوم به مبلغ {{number_format($pay2->price)}}ریال پرداخت  {{$pay2->payed==1?'شده':'نشده'}}</p>
                                    <a href="{{route('orders.payList',['order' => $order->id])}}"
                                       class="btn btn-primary btn-block margin-bottom">جزییات پرداخت</a>

                                </div>
                            </div>
                            <!-- /.box-body -->
                        </div>
                        <div class="box box-solid">
                            <div class="box-header with-border">
                                <h3 class="box-title" id="image_title">توضیحات ادمین</h3>

                                <div class="box-tools">
                                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i
                                            class="fa fa-minus"></i>
                                    </button>
                                </div>
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body no-padding">
                                <div class="input-group" style="width: 100%;padding: 10px">

                                    <p>{!! $order->admin_comment !!}</p>

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

                                    <p>{{$order->cabin_size}}</p>
                                </div>
                                <div class="form-group col-sm-6">
                                    <label for="cabin_material">متریال کابین</label>
                                    <p>{{$order->cabin_material->name}}</p>

                                </div>

                                <div class="form-group col-sm-6">
                                    <label for="bowl_material">متریال کاسه</label>
                                    <p>{{$order->bowl_material->name}}</p>

                                </div>


                                <div class="form-group col-sm-6">
                                    <label for="surface_material">متریال صفحه</label>
                                    <p>{{$order->surface_material->name}}</p>

                                </div>

                                <div class="form-group col-sm-6">
                                    <label for="mirror_size">ابعاد آینه</label>

                                    <p>{{$order->mirror_size}}</p>

                                </div>
                                <div class="form-group col-sm-6">
                                    <label for="mirror_material">متریال آینه</label>
                                    <p>{{@$order->mirror_material->name}}</p>

                                </div>
                                <div class="form-group col-sm-6">
                                    <label for="drawer_material">نوع کشو</label>
                                    <p>{{$order->drawer_material->name}}</p>

                                </div>
                                <div class="form-group col-sm-6">
                                    <label for="color">رنگ</label>
                                    <p>{{$order->color->name}}</p>

                                </div>


                                <div class="form-group col-sm-12">
                                    <label for="color">توضیحات سفارش</label>
                                    <div>
                                        {!!  $order->description !!}
                                    </div>
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


                                <div class="form-group col-sm-6">
                                    <label for="name">نام</label>
                                    <p>{{$order->address->name}}</p>
                                </div>
                                <div class="form-group col-sm-6">
                                    <label for="last_name">نام خانوادگی</label>
                                    <p>{{$order->address->last_name}}</p>

                                </div>
                                <div class="form-group col-sm-6">
                                    <label for="province">استان</label>
                                    <p>{{$order->address->province->name}}</p>

                                </div>

                                <div class="form-group col-sm-6">
                                    <label for="city">شهر</label>
                                    <p>{{$order->address->city->name}}</p>

                                </div>
                                <div class="form-group col-sm-6">
                                    <label for="phone">شماره تماس</label>
                                    <p>{{$order->address->phone}}</p>

                                </div>
                                @php
                                    $json = json_decode($order->address->meta);
                                @endphp
                                <div class="form-group col-sm-6">
                                    <label for="postalCode">کد پستی</label>
                                    <p>{{@$json->postalCode}}</p>

                                </div>

                                <div class="form-group col-sm-12">
                                    <label for="color">آدرس پستی</label>
                                    {!! $order->address->address !!}
                                </div>

                            </div>
                            <!-- /.box-body -->

                            <!-- /.box-footer -->
                        </div>
                        <div class="box box-primary">

                            <div class="box-footer">
                                <div class="pull-right">

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
