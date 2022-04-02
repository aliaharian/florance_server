<!DOCTYPE html>
<html>
<head>
    <title> لیست آدرس های {{$name}}</title>

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
                لیست آدرس های {{$name}}
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> خانه</a></li>
                <li class="active"> لیست آدرس های {{$name}}</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-md-3">
                    <a href="@if($admin){{route('userAddresses.create',['user'=>$user->id])}}@else{{route('addresses.create')}}@endif"
                       class="btn btn-primary btn-block margin-bottom"> ثبت آدرس
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
                            <h3 class="box-title">لیست آدرس های {{$name}}</h3>

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
                                {{$addresses->links()}}

                                <!-- /.btn-group -->
                                </div>
                                <!-- /.pull-right -->
                            </div>
                            <div class="table-responsive mailbox-messages">
                                <table class="table table-hover table-striped">

                                    <thead>
                                    <tr>
                                        <th class="mailbox-star">کد آدرس</th>
                                        <th class="mailbox-star"> نام و نام خانوادگی</th>
                                        <th class="mailbox-star">شهر</th>
                                        <th class="mailbox-star">کد پستی</th>
                                        <th class="mailbox-star">تلفن</th>
                                        <th class="mailbox-star">عملیات</th>
                                    </tr>
                                    </thead>

                                    <tbody>
                                    @foreach($addresses as $address)
                                        @php
                                            $json = json_decode($address->meta);
                                        @endphp
                                        <tr>
                                            <td class="mailbox-star">{{$address->id}}</td>
                                            <td class="mailbox-star dir-rtl">
                                                {{$address->name}} {{$address->last_name}}
                                            </td>
                                            <td>
                                                {{$address->city->name}}
                                            </td>
                                            <td>
                                                {{$json->postalCode}}
                                            </td>
                                            <td>
                                                {{$address->phone}}
                                            </td>
                                            <td class="mailbox-subject d-flex align-items-center justify-content-between items-m-5px">

                                                <a
                                                    href="@if($admin){{route('userAddresses.edit',['user' => $user->id,'address' => $address->id])}}@else{{route('addresses.edit',['address' => $address->id])}}@endif"
                                                    class="btn btn-warning fa fa-edit" title="ویرایش"></a>

                                                <form
                                                    action="@if($admin){{route('userAddresses.destroy',['user' => $user->id,'address' => $address->id])}}@else{{route('addresses.destroy',['address'=>$address->id])}}@endif"
                                                    method="post" title="حذف">
                                                    {{method_field('delete')}}
                                                    {{csrf_field()}}
                                                    <button
                                                        class=" btn-delete-submit btn btn-danger fa fa-trash"></button>
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
                                {{$addresses->links()}}

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
            title: 'مایل به حذف این آدرس هستید؟',
            showDenyButton: true,
            showCancelButton: false,
            confirmButtonText: 'حذف آدرس',
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
