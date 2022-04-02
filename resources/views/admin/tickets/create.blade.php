<!DOCTYPE html>
<html>
<head>
    <title>
        ثبت تیکت
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
                ثبت تیکت

            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> خانه</a></li>
                <li>تیکت</li>
                <li class="active">
                    ثبت تیکت
                </li>
            </ol>
        </section>
        <form
            action="{{route('tickets.store')}}"
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

                        <a href="{{route('tickets.index')}}" class="btn btn-primary btn-block margin-bottom">بازگشت</a>


                        <!-- /.box -->
                    </div>
                    <!-- /.col -->
                    <div class="col-md-9">

                        {{--                        address section--}}
                        <div class="box box-primary">
                            <div class="box-header with-border">
                                <h3 class="box-title">ثبت تیکت پشتیبانی</h3>
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body row">

                                <div class="form-group col-sm-12">
                                    <label for="title">عنوان</label>
                                    <input value="{{old('title')}}" class="form-control" name="title" id="title"
                                           placeholder="عنوان">
                                </div>

                                <div class="form-group col-sm-12">
                                    <label for="color">متن پیام</label>
                                    <textarea id="ckeditor" name="text" class="form-control"
                                              style="height: 300px">{!! old('text') !!}</textarea>
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
                                        ثبت تیکت
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


</body>
</html>
