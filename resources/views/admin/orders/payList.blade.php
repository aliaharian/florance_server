<!DOCTYPE html>
<html>
<head>
    <title> سفارشات</title>

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
                پرداخت سفارش شماره {{$id}}
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> خانه</a></li>
                <li class="active"> پرداخت سفارش شماره {{$id}}</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-md-3">
                    <a href="{{route('orders.index')}}" class="btn btn-primary btn-block margin-bottom"> بازگشت
                    </a>

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
                            <h3 class="box-title">سفارشات</h3>

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

                                    <!-- /.btn-group -->
                                </div>
                                <!-- /.pull-right -->
                            </div>
                            <div class="table-responsive mailbox-messages">
                                <table class="table table-hover table-striped">

                                    <thead>
                                    <tr>
                                        <th class="mailbox-star">کد پرداخت</th>
                                        <th class="mailbox-star">وضعیت</th>
                                        <th class="mailbox-star">قیمت</th>
                                        <th class="mailbox-star"> سررسید</th>
                                        <th class="mailbox-star">عملیات</th>
                                    </tr>
                                    </thead>

                                    <tbody>
                                    @php
                                        $i=0;
                                        $secondPay = false;
                                    @endphp
                                    @foreach($payments as $pay)
                                        @php
                                            $i++;
                                            $json = json_decode($pay->meta);
                                        @endphp
                                        <tr>
                                            <td class="mailbox-star">{{$pay->id}}</td>
                                            <td class="mailbox-star dir-rtl">
                                                @if($pay->payed)پرداخت شده@elseپرداخت نشده@endif
                                            </td>
                                            <td class="mailbox-star dir-rtl">
                                                {{number_format($pay->price)}} ریال
                                            </td>
                                            <td>
                                                @if($pay->expired_at) {{jDate($pay->expired_at)->format('%d %B %Y')}} @endif
                                            </td>

                                            <td class="mailbox-subject d-flex align-items-center justify-content-between items-m-5px">
                                                @if($pay->payed == 0 )
                                                    @php
                                                        if($i==1 && $pay->payed == 1) $secondPay = true;
                                                    @endphp
                                                    @if($i==1 || $secondPay==true)
                                                        <button
                                                            onclick="doPay({{$pay->price}},{{$pay->order_id}},{{$pay->id}})"
                                                            class="btn btn-info" title="پرداخت">پرداخت
                                                        </button>
                                                    @endif
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
        @if($request->Status)

        @if($request->Status=='OK' && $parameter==true)
        Swal.fire(
            'تبریک',
            'پرداخت با موفقیت انجام شد',
            'success'
        )
        @else
        Swal.fire(
            'متاسفیم',
            'پرداخت با خطا مواجه شد',
            'error'
        )
        @endif
        @endif
    });

    const doPay = async (price, id, pay_id) => {
        $.ajax({
            url: 'https://api.zarinpal.com/pg/v4/payment/request.json',
            type: 'POST',
            data: {
                "merchant_id": "1344b5d4-0048-11e8-94db-005056a205be",
                "amount": price,
                "callback_url": "http://localhost:8000/orders/pay/" + id + '?pay_id=' + pay_id,
                "description": "پرداخت قسط سفارش شماره " + id,
            },
            dataType: 'json',
            success: function (data) {
                console.log(data.data)
                $.ajax({
                    url: "{{route('user.setTransaction')}}",
                    type: 'POST',
                    data: {
                        "user_id":{{\Illuminate\Support\Facades\Auth::user()->id}},
                        "price": price,
                        "pay_terminal": 'zarrinPal',
                        "transaction_token": data.data.authority,
                        "transaction_code": pay_id
                    },
                    dataType: 'json',
                    success: function (data2) {
                        console.log(data2.data)
                        window.location.href = 'https://www.zarinpal.com/pg/StartPay/' + data.data.authority
                    },
                    error: function (request, error) {
                        alert("Request: " + JSON.stringify(request));
                    }
                });

            },
            error: function (request, error) {
                alert("Request: " + JSON.stringify(request));
            }
        });
    }

</script>
</body>
</html>
