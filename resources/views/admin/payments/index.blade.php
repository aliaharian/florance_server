<!DOCTYPE html>
<html>
<head>
    <title> تراکنش ها</title>

    @include('admin.includes.headerLinks')

    <link rel="stylesheet" href="https://arastowel.com/panel-admin/css/persian-datepicker-0.4.5.min.css"/>
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
                تراکنش ها
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> خانه</a></li>
                <li class="active"> تراکنش ها</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">

                <!-- /.col -->
                <div class="col-md-12">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">تراکنش ها</h3>

                            <div class="box-tools pull-right">
                                <div class="has-feedback">
                                    {{--                  <form action="{{route('orders.search')}}" method="get">--}}
                                    {{--                  <input type="text" name="search" class="form-control input-sm" placeholder="جستجو">--}}
                                    {{--                    <button type="submit" class="fa fa-search form-control-feedback" value="search"></button>--}}
                                    {{--                  </form>--}}
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
                                <button type="button" class="btn btn-default btn-sm"><i class="fa fa-refresh"></i>
                                </button>

                                <div class="pull-left">
                                {{$payments->links()}}

                                <!-- /.btn-group -->
                                </div>
                                <!-- /.pull-right -->
                            </div>
                            <div class="table-responsive mailbox-messages">
                                <table class="table table-hover table-striped">

                                    <thead>
                                    <tr>
                                        <th class="mailbox-star">کد تراکنش</th>
                                        <th class="mailbox-star"> مبلغ</th>
                                        @if(\Illuminate\Support\Facades\Auth::user()->role=='admin')
                                            <th class="mailbox-star">نام کاربر</th>
                                        @endif
                                        <th class="mailbox-star">بابت</th>
                                        <th class="mailbox-star">تاریخ</th>
                                        <th class="mailbox-star">کد پیگیری زرین پال</th>
                                        <th class="mailbox-star">وضعیت</th>
                                    </tr>
                                    </thead>

                                    <tbody>
                                    @foreach($payments as $pay)
                                        @php
                                            $json = json_decode($pay->meta );

                                        @endphp
                                        <tr>
                                            <td class="mailbox-star">{{$pay->id}}</td>
                                            <td class="mailbox-star dir-rtl">
                                                {{number_format($pay->price)}} ریال
                                            </td>
                                            @if(\Illuminate\Support\Facades\Auth::user()->role=='admin')
                                                <td class="mailbox-star dir-rtl">
                                                    {{$pay->payment->order->user->name}} {{$pay->payment->order->user->last_name}}
                                                </td>
                                            @endif
                                            <td>
                                                <a href="/orders/{{$pay->payment->order->id}}">سفارش
                                                    شماره {{$pay->payment->order->id}}</a>
                                            </td>
                                            <td>
                                                {{jDate($pay->created_at)->format('%d %B %Y')}}
                                            </td>
                                            <td class="mailbox-star">
                                                {{substr($pay->transaction_token,23,400)}}
                                            </td>
                                            <td class="mailbox-star">
                                                @if(@$json)
                                                    @if(@$json->data->code==100 || @$json->data->code==101)
                                                        <div
                                                            class="label label-success"> موفق
                                                        </div>
                                                    @else
                                                        <div
                                                            class="label label-danger"> ناموفق
                                                        </div>
                                                    @endif

                                                @else
                                                    <div
                                                        class="label label-danger"> ناموفق
                                                    </div>
                                                @endif

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
                                {{$payments->links()}}

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

<!-- AdminLTE for demo purposes -->
<script>
    $(document).ready(function () {
        $('.page-link').addClass('btn btn-default btn-sm');
        $('.pagination').addClass('display-block');

    });

    $('.btn-delete-submit').on('click', function (e) {
        e.preventDefault();
        var form = $(this).parents('form');
        Swal.fire({
            title: 'مایل به حذف این سفارش هستید؟',
            showDenyButton: true,
            showCancelButton: false,
            confirmButtonText: 'حذف سفارش',
            denyButtonText: `انصراف`,
            confirmButtonColor: "#DD6B55",

        }).then((result) => {
            /* Read more about isConfirmed, isDenied below */
            if (result.isConfirmed) {
                form.submit();
            }
        })
    });

</script>
</body>
</html>
