<!DOCTYPE html>
<html>
<head>
    <title> تیکت ها</title>

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
                تیکت ها
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> خانه</a></li>
                <li class="active"> تیکت ها</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-md-3">
                    <a href="{{route('tickets.create')}}"
                       class="btn btn-primary btn-block margin-bottom"> ثبت تیکت
                        جدید</a>
                    <div class="box box-solid">
                        <!-- /.box-body -->
                    </div>
                    <!-- /. box -->

                    <!-- /.box -->
                </div>
                <!-- /.col -->
                <div class="col-md-9">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">تیکت ها</h3>

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
                                {{$tickets->links()}}

                                <!-- /.btn-group -->
                                </div>
                                <!-- /.pull-right -->
                            </div>
                            <div class="table-responsive mailbox-messages">
                                <table class="table table-hover table-striped">

                                    <thead>
                                    <tr>
                                        <th class="mailbox-star">کد تیکت</th>
                                        <th class="mailbox-star"> عنوان</th>
                                        @if(\Illuminate\Support\Facades\Auth::user()->role=='admin')
                                            <th class="mailbox-star"> کاربر</th>
                                        @endif
                                        <th class="mailbox-star">تاریخ</th>
                                        <th class="mailbox-star">وضعیت</th>
                                        <th class="mailbox-star">عملیات</th>
                                    </tr>
                                    </thead>

                                    <tbody>
                                    @foreach($tickets as $ticket)
                                        @php
                                            $json = json_decode($ticket->meta );
                                        @endphp
                                        <tr>
                                            <td class="mailbox-star">{{$ticket->id}}</td>
                                            <td class="mailbox-star dir-rtl">
                                                {{$ticket->title}}
                                            </td>
                                            @if(\Illuminate\Support\Facades\Auth::user()->role=='admin')
                                                <td class="mailbox-star dir-rtl">
                                                    {{$ticket->user->name}} {{$ticket->user->last_name}}
                                                </td>
                                            @endif
                                            <td>
                                                {{jDate($ticket->created_at)->format('%d %B %Y')}}
                                            </td>
                                            <td class="mailbox-star">
                                               <div style="margin: 0;padding: 5px 10px;text-align: center" class="alert alert-{{ticket_state_color($ticket->state)}}"> {{ticketStatusP($ticket->state)}}</div>
                                            </td>
                                            <td class="mailbox-star">
                                                <a
                                                    href="{{route('tickets.show',['ticket' => $ticket->id])}}"
                                                    class="btn btn-info" title="ویرایش">مشاهده تیکت</a>
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
                                {{$tickets->links()}}

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
