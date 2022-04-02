<!DOCTYPE html>
<html>
<head>
    <title>
        تغییر وضعیت سفارش
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
                تغییر وضعیت سفارش
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> خانه</a></li>
                <li>سفارشات</li>
                <li class="active">
                    تغییر وضعیت سفارش
                </li>
            </ol>
        </section>
        <form
            action="{{route('orders.submitChangeState',['order' => $order->id])}}"
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

                        <a href="{{route('orders.index')}}" class="btn btn-primary btn-block margin-bottom">بازگشت</a>

                        <!-- /. box -->
                        <div class="box box-solid">

                            <!-- /.box-header -->
                            <!-- /.box-body -->
                        </div>
                        <!-- /.box -->
                    </div>
                    <!-- /.col -->
                    <div class="col-md-9">

                        <!-- for admin to change state -->
                        <div class="box box-primary">
                            <div class="box-header with-border">
                                <h3 class="box-title"> تغییر وضعیت
                                    سفارش {{$order->user->name}} {{$order->user->last_name}}</h3>
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body row">
                                <div class="form-group col-sm-6">
                                    <label for="cabin_material">وضعیت سفارش</label>
                                    <select class="form-control" name="order_state" id="order_state">
                                        @if($changePrice==0)
                                            @php $states = states() @endphp
                                            @foreach($states as $state)
                                                <option
                                                    @if ($order->state==$state) selected
                                                    @endif value="{{$state}}">{{state_p($state)}}</option>
                                            @endforEach
                                        @elseif($changePrice==1)
                                            @php $states = states1() @endphp
                                            @foreach($states as $state)
                                                <option
                                                    @if ($order->state==$state) selected
                                                    @endif value="{{$state}}">{{state_p($state)}}</option>
                                            @endforEach
                                        @else
                                            @php $states = states2() @endphp
                                            @foreach($states as $state)
                                                <option
                                                    @if ($order->state==$state) selected
                                                    @endif value="{{$state}}">{{state_p($state)}}</option>
                                            @endforEach
                                        @endif
                                    </select>
                                </div>
                                @if($changePrice==0)
                                    <div class="form-group col-sm-6">
                                        <label for="cabin_size">هزینه سفارش</label>

                                        <input value="{{$order->total_price}}"
                                               class="form-control"
                                               name="total_price"
                                               id="total_price"
                                               placeholder="هزینه کل سفارش به ریال">
                                    </div>

                                    <div class="form-group col-sm-6">
                                        <label for="cabin_size">سررسید پرداخت</label>

                                        <input type="text" class="expire_date"/>


                                        <input type="hidden" class="observer" name="expire_date" id="expire_date"/>
                                    </div>
                                @endif
                                <div class="form-group col-sm-12">
                                    <label for="color">توضیحات ادمین</label>
                                    <textarea id="ckeditor" name="admin_comment" class="form-control"
                                              style="height: 300px">{!!  $order->admin_comment !!}</textarea>
                                </div>

                            </div>
                        </div>
                        <div class="box box-primary">

                            <div class="box-footer">
                                <div class="pull-right">

                                    <button type="submit" class="btn btn-primary"><i
                                            class="fa fa-share"></i>
                                        تغییر وضعیت

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
<!-- Page script -->
<script src="https://unpkg.com/persian-date@1.1.0/dist/persian-date.min.js" type="text/javascript"></script>
<script src="https://unpkg.com/persian-datepicker@1.2.0/dist/js/persian-datepicker.min.js"></script>
<script type="text/javascript">

    $('.expire_date').persianDatepicker({
        observer: true,
        format: 'YYYY/MM/DD',
        altField: '.observer'
    });
</script>

</body>
</html>
