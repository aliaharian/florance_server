<!DOCTYPE html>
<html>
<head>
    <title> لیست کاربران</title>

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
                لیست کاربران
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> خانه</a></li>
                <li class="active"> لیست کاربران</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">

                <!-- /.col -->
                <div class="col-md-12">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">لیست کاربران</h3>

                            <div class="box-tools pull-right">
                                <div class="has-feedback">

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
                                {{$users->links()}}

                                <!-- /.btn-group -->
                                </div>
                                <!-- /.pull-right -->
                            </div>
                            <div class="table-responsive mailbox-messages">
                                <table class="table table-hover table-striped">

                                    <thead>
                                    <tr>
                                        <th class="mailbox-star">کد کاربر</th>
                                        <th class="mailbox-star"> نام و نام خانوادگی</th>
                                        <th class="mailbox-star"> شماره موبایل</th>
                                        <th class="mailbox-star">عملیات</th>
                                    </tr>
                                    </thead>

                                    <tbody>
                                    @foreach($users as $user)
                                        @php
                                            $json = json_decode($user->meta);
                                        @endphp
                                        <tr>
                                            <td class="mailbox-star">{{$user->id}}</td>
                                            <td class="mailbox-star dir-rtl">
                                                {{$user->name}} {{$user->last_name}}
                                            </td>
                                            <td>
                                                {{$user->phone}}
                                            </td>
                                                <td class="mailbox-subject d-flex align-items-center justify-content-between items-m-5px">

                                                    <a
                                                        href="{{route('users.edit',['user' => $user->id])}}"
                                                        class="btn btn-warning fa fa-edit" title="ویرایش"></a>
                                                    @if($user->role !='admin')

                                                    <form action="{{route('users.destroy',['user'=>$user->id])}}"
                                                          method="post" title="حذف">
                                                        {{method_field('delete')}}
                                                        {{csrf_field()}}
                                                        <button
                                                            class=" btn-delete-submit btn btn-danger fa fa-trash"></button>
                                                    </form>
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
                                {{$users->links()}}

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
            title: 'مایل به حذف این کاربر هستید؟',
            showDenyButton: true,
            showCancelButton: false,
            confirmButtonText: 'حذف کاربر',
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
