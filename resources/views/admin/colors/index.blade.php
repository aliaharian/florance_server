<!DOCTYPE html>
<html>
<head>
    <title> رنگ ها | فلورانس</title>

    @include('admin.includes.headerLinks')

    <style>
        .display-block {
            display: block !important;
            margin: 0 !important;
        }
    </style>


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
                رنگ ها
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> خانه</a></li>
                <li class="active"> رنگ ها</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-md-4">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    @if(isset($pm))
                        <div class="alert alert-success">
                            {{$pm}}
                        </div>

                    @endif
                    <div class="box box-solid">
                        <div class="box-header with-border">
                            <h3 class="box-title">افزودن رنگ</h3>

                            <div class="box-tools">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i
                                        class="fa fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="box-body no-padding">
                            <form role="form" action="{{route('colors.store')}}" method="POST">
                                @csrf
                                <div class="box-body">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">نام رنگ</label>
                                        <input type="text" class="form-control" required id="color_name"
                                               name="color_name" placeholder="نام رنگ">
                                    </div>
                                </div>
                                <!-- /.box-body -->

                                <div class="box-footer">
                                    <button type="submit" class="btn btn-success" style="width: 100%">ثبت</button>
                                </div>
                            </form>
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /. box -->

                    <!-- /.box -->
                </div>
                <!-- /.col -->
                <div class="col-md-8">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">رنگ ها</h3>

                            <div class="box-tools pull-right">
                                <div class="has-feedback">
                                    <form action="{{route('colors.search')}}" method="get">
                                        <input type="text" name="search" class="form-control input-sm"
                                               placeholder="جستجو">
                                        <button type="submit" class="fa fa-search form-control-feedback"
                                                value="search"></button>
                                    </form>
                                </div>
                            </div>
                            <!-- /.box-tools -->
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body no-padding">
                            <div class="mailbox-controls">
                                <!-- Check all button -->
                                <div class="pull-right">


                                </div>
                                <!-- /.btn-group -->

                                <!-- /.pull-right -->
                            </div>
                            <div class="table-responsive mailbox-messages">
                                <table class="table table-hover table-striped">

                                    <thead>
                                    <tr>
                                        <th class="mailbox-star">کد رنگ</th>
                                        <th class="mailbox-star">نام رنگ</th>
                                        <th class="mailbox-subject">ویرایش</th>
                                        <th class="mailbox-subject">حذف</th>
                                    </tr>
                                    </thead>

                                    <tbody>
                                    @foreach($colors as $color)
                                        <tr>
                                            <td class="mailbox-star">{{$color->id}}</td>
                                            <td class="mailbox-star"><a> {{$color->name}}</a></td>
                                            <td class="mailbox-subject"><a
                                                    href="{{route('colors.edit',['color' => $color->id])}}"
                                                    class="btn btn-warning fa fa-edit"></a></td>
                                            <td class="mailbox-subject">
                                                <form action="{{route('colors.destroy',['color'=>$color->id])}}"
                                                      method="post">
                                                    {{method_field('delete')}}
                                                    {{csrf_field()}}
                                                    <button type="submit" class="btn btn-danger fa fa-trash"></button>
                                                </form>
                                            </td>

                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                <!-- /.table -->
                            </div>
                            <!-- /.mail-box-messages -->
                        </div>
                        <!-- /.box-body -->
                        <div class="box-footer no-padding">
                            <div class="mailbox-controls">
                                <!-- Check all button -->
                                <div class="pull-right">


                                </div>
                                <!-- /.btn-group -->
                                <button type="button" class="btn btn-default btn-sm"><i class="fa fa-refresh"></i>
                                </button>
                                <div class="pull-left">
                                    <div class="d-flex justify-content-center">
                                        {!! $colors->links("pagination::bootstrap-4") !!}
                                    </div>
                                    <!-- /.btn-group -->
                                </div>
                                <!-- /.pull-right -->
                            </div>
                        </div>
                    </div>
                    <!-- /. box -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </section>
        <!-- /.content -->
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
<!-- iCheck -->
<!-- Page Script -->
</body>
</html>
