<!DOCTYPE html>
<html>
<head>
    <title>داشبورد ادمین | فلورانس</title>
    @include('admin.includes.headerLinks')
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
                داشبورد ادمین
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> خانه</a></li>
                <li class="active">داشبورد ادمین</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <!-- Info boxes -->
            <div class="row">
                <div class="col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box">
                        <span class="info-box-icon bg-aqua"><i class="fa fa-dashboard"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">تعداد کل سفارشات</span>
                            <span class="info-box-number">{{$totalOrder}}</span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->
                <div class="col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box">
                        <span class="info-box-icon bg-red"><i class="fa fa-product-hunt"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">سفارش منتظر تایید ادمین</span>
                            <span class="info-box-number">{{$pendingOrders}}</span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>

                <div class="clearfix visible-sm-block"></div>

                <div class="col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box">
                        <span class="info-box-icon bg-green"><i class="ion ion-ios-cart-outline"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">تعداد سفارشات در انتظار پرداخت </span>
                            <span class="info-box-number">{{$moneyOrders}}</span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <div class="col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box">
                        <span class="info-box-icon bg-green"><i class="ion ion-ios-cart-outline"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">تعداد سفارشات لغو شده </span>
                            <span class="info-box-number">{{$failedOrders}}</span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <div class="col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box">
                        <span class="info-box-icon bg-green"><i class="ion ion-ios-cart-outline"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">تعداد سفارشات پایان یافته </span>
                            <span class="info-box-number">{{$doneOrders}}</span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->
                <div class="col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box">
                        <span class="info-box-icon bg-yellow"><i class="ion ion-ios-people-outline"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">درآمد تا کنون</span>
                            <span class="info-box-number">  {{number_format($incomeTotal)}} ریال</span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
{{--            <div class="row">--}}
{{--                <section class="col-lg-12 connectedSortable">--}}
{{--                    <div class="box box-solid bg-gray">--}}
{{--                        <div class="box-header">--}}
{{--                            <!-- tools box -->--}}
{{--                            <div class="pull-left box-tools">--}}
{{--                                <button type="button" class="btn btn-primary btn-sm pull-left" data-widget="collapse"--}}
{{--                                        data-toggle="tooltip" title="Collapse" style="margin-left: 5px;">--}}
{{--                                    <i class="fa fa-minus"></i></button>--}}
{{--                            </div>--}}
{{--                            <!-- /. tools -->--}}

{{--                            <i class="fa fa-map-marker"></i>--}}

{{--                            <h3 class="box-title">--}}
{{--                                بازدید 30 روز اخیر--}}
{{--                            </h3>--}}
{{--                        </div>--}}


{{--                        <div class="box-body">--}}
{{--                            <canvas id="myChart" width="400" height="auto"></canvas>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </section>--}}
{{--            </div>--}}


            <div class="row">
                {{--<section class="col-lg-4 connectedSortable">--}}
                    {{--<div class="box box-solid bg-gray">--}}
                        {{--<div class="box-header">--}}
                            {{--<!-- tools box -->--}}
                            {{--<div class="pull-left box-tools">--}}
                                {{--<button type="button" class="btn btn-primary btn-sm pull-left" data-widget="collapse"--}}
                                        {{--data-toggle="tooltip" title="Collapse" style="margin-left: 5px;">--}}
                                    {{--<i class="fa fa-minus"></i></button>--}}
                            {{--</div>--}}
                            {{--<!-- /. tools -->--}}

                            {{--<i class="fa fa-map-marker"></i>--}}

                            {{--<h3 class="box-title">--}}
                                 {{--بازدید بر حسب سیستم عامل--}}
                            {{--</h3>--}}
                        {{--</div>--}}


                        {{--<div class="box-body">--}}
                            {{--<canvas id="osChart" width="400" height="auto"></canvas>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--</section>--}}


                {{--<section class="col-lg-8 connectedSortable">--}}
                    {{--<div class="box box-solid bg-gray">--}}
                        {{--<div class="box-header">--}}
                            {{--<!-- tools box -->--}}
                            {{--<div class="pull-left box-tools">--}}
                                {{--<button type="button" class="btn btn-primary btn-sm pull-left" data-widget="collapse"--}}
                                        {{--data-toggle="tooltip" title="Collapse" style="margin-left: 5px;">--}}
                                    {{--<i class="fa fa-minus"></i></button>--}}
                            {{--</div>--}}
                            {{--<!-- /. tools -->--}}

                            {{--<i class="fa fa-map-marker"></i>--}}

                            {{--<h3 class="box-title">--}}
                                {{--پر بازدید ترین صفحات--}}
                            {{--</h3>--}}
                        {{--</div>--}}


                        {{--<div class="box-body">--}}
                            {{--@php $ip_array=array('127.0.0.2');--}}
                               {{--$arr=array(''=>0);--}}

                            {{--@endphp--}}
                            {{--@foreach($view_trackers as $view)--}}
                                {{--@if($view->is_robot==0 && !in_array($view->user_ip,$ip_array))--}}
                                    {{--@php array_push($ip_array,$view->user_ip.$view->user_platform); @endphp--}}
                                    {{--@if(!array_key_exists($view->route,$arr))--}}
                                        {{--@php $arr[$view->route]  = 1 ;@endphp--}}
                                    {{--@else--}}
                                        {{--@php $arr[$view->route]=$arr[$view->route]+1 @endphp--}}
                                    {{--@endif--}}
                                {{--@endif--}}
                            {{--@endforeach--}}

                            {{--@php--}}
                                {{--arsort($arr);--}}
                            {{--@endphp--}}


                            {{--<table class="table table-bordered">--}}
                                {{--<tr>--}}
                                    {{--<th style="width: 10px">#</th>--}}
                                    {{--<th>آدرس</th>--}}
                                    {{--<th>تعداد بازدید</th>--}}
                                {{--</tr>--}}
                                {{--<tr>--}}
                                    {{--<td>1.</td>--}}
                                    {{--<td><a target="_blank" href="{{key(array_slice($arr, 0, 1))}}"> {{key(array_slice($arr, 0, 1))}}</a></td>--}}
                                    {{--<td>{!! current(array_slice($arr, 0, 1))!!}</td>--}}
                                {{--</tr>--}}
                                {{--<tr>--}}
                                    {{--<td>2.</td>--}}
                                    {{--<td><a target="_blank" href="{{key(array_slice($arr, 1, 1))}}"> {{key(array_slice($arr, 1, 1))}}</a></td>--}}
                                    {{--<td>{!! current(array_slice($arr, 1, 1))!!}</td>--}}
                                {{--</tr>--}}
                                {{--<tr>--}}
                                    {{--<td>3.</td>--}}
                                    {{--<td><a  target="_blank" href="{{key(array_slice($arr, 2, 1))}}"> {{key(array_slice($arr, 2, 1))}}</a></td>--}}
                                    {{--<td>{!! current(array_slice($arr, 2, 1))!!}</td>--}}
                                {{--</tr>--}}
                                {{--<tr>--}}
                                    {{--<td>4.</td>--}}
                                    {{--<td><a  target="_blank" href="{{key(array_slice($arr, 3, 1))}}"> {{key(array_slice($arr, 3, 1))}}</a></td>--}}
                                    {{--<td>{!! current(array_slice($arr, 3, 1))!!}</td>--}}
                                {{--</tr>--}}
                                {{--<tr>--}}
                                    {{--<td>5.</td>--}}
                                    {{--<td><a  target="_blank" href="{{key(array_slice($arr, 4, 1))}}"> {{key(array_slice($arr, 4, 1))}}</a></td>--}}
                                    {{--<td>{!! current(array_slice($arr, 4, 1))!!}</td>--}}
                                {{--</tr>--}}
                            {{--</table>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--</section>--}}
            </div>


            <!-- /.box -->

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
{{--<script src="/panel-admin/Chart.js/Chart.js"></script>--}}
{{--<script>--}}
{{--    $(function () {--}}
{{--        var lineChartCanvas = $('#myChart').get(0).getContext('2d')--}}
{{--        // This will get the first returned node in the jQuery collection.--}}
{{--        var lineChart       = new Chart(lineChartCanvas)--}}

{{--        var areaChartData = {--}}
{{--            labels: [--}}
{{--                "{{\Morilog\Jalali\Jalalian::fromDateTime('30 days ago')->format('y/m/d')}}", "{{\Morilog\Jalali\Jalalian::fromDateTime('29 days ago')->format('y/m/d')}}", "{{\Morilog\Jalali\Jalalian::fromDateTime('28 days ago')->format('y/m/d')}}", "{{\Morilog\Jalali\Jalalian::fromDateTime('27 days ago')->format('y/m/d')}}",--}}
{{--                "{{\Morilog\Jalali\Jalalian::fromDateTime('26 days ago')->format('y/m/d')}}", "{{\Morilog\Jalali\Jalalian::fromDateTime('25 days ago')->format('y/m/d')}}", "{{\Morilog\Jalali\Jalalian::fromDateTime('24 days ago')->format('y/m/d')}}", "{{\Morilog\Jalali\Jalalian::fromDateTime('23 days ago')->format('y/m/d')}}", "{{\Morilog\Jalali\Jalalian::fromDateTime('22 days ago')->format('y/m/d')}}", "{{\Morilog\Jalali\Jalalian::fromDateTime('21 days ago')->format('y/m/d')}}",--}}
{{--                "{{\Morilog\Jalali\Jalalian::fromDateTime('20 days ago')->format('y/m/d')}}", "{{\Morilog\Jalali\Jalalian::fromDateTime('19 days ago')->format('y/m/d')}}", "{{\Morilog\Jalali\Jalalian::fromDateTime('18 days ago')->format('y/m/d')}}", "{{\Morilog\Jalali\Jalalian::fromDateTime('17 days ago')->format('y/m/d')}}", "{{\Morilog\Jalali\Jalalian::fromDateTime('16 days ago')->format('y/m/d')}}", "{{\Morilog\Jalali\Jalalian::fromDateTime('15 days ago')->format('y/m/d')}}",--}}
{{--                "{{\Morilog\Jalali\Jalalian::fromDateTime('14 days ago')->format('y/m/d')}}", "{{\Morilog\Jalali\Jalalian::fromDateTime('13 days ago')->format('y/m/d')}}", "{{\Morilog\Jalali\Jalalian::fromDateTime('12 days ago')->format('y/m/d')}}", "{{\Morilog\Jalali\Jalalian::fromDateTime('11 days ago')->format('y/m/d')}}", "{{\Morilog\Jalali\Jalalian::fromDateTime('10 days ago')->format('y/m/d')}}", "{{\Morilog\Jalali\Jalalian::fromDateTime('9 days ago')->format('y/m/d')}}",--}}
{{--                "{{\Morilog\Jalali\Jalalian::fromDateTime('8 days ago')->format('y/m/d')}}", "{{\Morilog\Jalali\Jalalian::fromDateTime('7 days ago')->format('y/m/d')}}", "{{\Morilog\Jalali\Jalalian::fromDateTime('6 days ago')->format('y/m/d')}}", "{{\Morilog\Jalali\Jalalian::fromDateTime('5 days ago')->format('y/m/d')}}", "{{\Morilog\Jalali\Jalalian::fromDateTime('4 days ago')->format('y/m/d')}}", "{{\Morilog\Jalali\Jalalian::fromDateTime('3 days ago')->format('y/m/d')}}",--}}
{{--                "{{\Morilog\Jalali\Jalalian::fromDateTime('2 days ago')->format('y/m/d')}}", "{{\Morilog\Jalali\Jalalian::fromDateTime('yesterday')->format('y/m/d')}}", "{{\Morilog\Jalali\Jalalian::fromDateTime('today')->format('y/m/d')}}"--}}
{{--            ],--}}
{{--            datasets: [{--}}
{{--                label: 'تعداد بازدید',--}}
{{--                fillColor           : 'rgba(60,141,188,0.9)',--}}
{{--                strokeColor         : 'rgba(60,141,188,0.8)',--}}
{{--                pointColor          : '#3b8bba',--}}
{{--                pointStrokeColor    : 'rgba(60,141,188,1)',--}}
{{--                pointHighlightFill  : '#fff',--}}
{{--                pointHighlightStroke: 'rgba(60,141,188,1)',--}}
{{--                data: [--}}
{{--                    @php $count=0; $begin = new DateTime('30 days ago'); $end = new DateTime('tomorrow'); $interval = DateInterval::createFromDateString('1 day'); $period = new DatePeriod($begin, $interval, $end); @endphp @foreach ($period as $date)  @foreach($view_trackers as $view) @if($view->created_at==$date->format('Y-m-d 00:00:00')) @php $count=$view->count; @endphp @endif @endforeach{{$count}},@endforeach--}}
{{--                ],--}}
{{--                borderColor: [--}}
{{--                    'purple'--}}
{{--                ],--}}
{{--                borderWidth: 3--}}
{{--            }]--}}
{{--        }--}}

{{--        var lineChartOptions = {--}}
{{--            //Boolean - If we should show the scale at all--}}
{{--            showScale               : true,--}}
{{--            //Boolean - Whether grid lines are shown across the chart--}}
{{--            scaleShowGridLines      : true,--}}
{{--            //String - Colour of the grid lines--}}
{{--            scaleGridLineColor      : 'rgba(0,0,0,1)',--}}
{{--            //Number - Width of the grid lines--}}
{{--            scaleGridLineWidth      : 1,--}}
{{--            //Boolean - Whether to show horizontal lines (except X axis)--}}
{{--            scaleShowHorizontalLines: true,--}}
{{--            //Boolean - Whether to show vertical lines (except Y axis)--}}
{{--            scaleShowVerticalLines  : true,--}}
{{--            //Boolean - Whether the line is curved between points--}}
{{--            bezierCurve             : true,--}}
{{--            //Number - Tension of the bezier curve between points--}}
{{--            bezierCurveTension      : 0.3,--}}
{{--            //Boolean - Whether to show a dot for each point--}}
{{--            pointDot                : true,--}}
{{--            //Number - Radius of each point dot in pixels--}}
{{--            pointDotRadius          : 4,--}}
{{--            //Number - Pixel width of point dot stroke--}}
{{--            pointDotStrokeWidth     : 1,--}}
{{--            //Number - amount extra to add to the radius to cater for hit detection outside the drawn point--}}
{{--            pointHitDetectionRadius : 20,--}}
{{--            //Boolean - Whether to show a stroke for datasets--}}
{{--            datasetStroke           : true,--}}
{{--            //Number - Pixel width of dataset stroke--}}
{{--            datasetStrokeWidth      : 2,--}}
{{--            //Boolean - Whether to fill the dataset with a color--}}
{{--            datasetFill             : false,--}}
{{--            //String - A legend template--}}
{{--      //Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container--}}
{{--      maintainAspectRatio     : true,--}}
{{--      //Boolean - whether to make the chart responsive to window resizing--}}
{{--      responsive              : true--}}
{{--    }--}}

{{--        lineChart.Line(areaChartData, lineChartOptions)--}}
{{--        @php $AndroidOS=0; $OSX=0; $Windows=0; $iOS=0; $WindowsMobileOS=0; $etc=0; @endphp @php $ip_array=array('127.0.0.2'); $count=0;  @endphp @foreach($view_trackers as $view) @if(!in_array($view->user_ip.$view->user_platform,$ip_array) && $view->is_robot==0 ) @if($view->user_platform=='AndroidOS') @php $AndroidOS=$AndroidOS+1;  @endphp @elseif($view->user_platform=='OS X') @php $OSX=$OSX+1;  @endphp @elseif($view->user_platform=='Windows') @php $Windows=$Windows+1;  @endphp @elseif($view->user_platform=='iOS') @php $iOS=$iOS+1;  @endphp @elseif($view->user_platform=='WindowsMobileOS') @php $WindowsMobileOS=$WindowsMobileOS+1;  @endphp @else @php $etc=$etc+1;  @endphp @endif @php  array_push($ip_array,$view->user_ip.$view->user_platform);  @endphp @endif @endforeach--}}
{{--        // Get context with jQuery - using jQuery's .get() method.--}}
{{--        var pieChartCanvas = $('#osChart').get(0).getContext('2d')--}}
{{--        var pieChart = new Chart(pieChartCanvas)--}}
{{--        var PieData = [--}}
{{--            {--}}
{{--                value: '{{$OSX}}',--}}
{{--                color: '#f56954',--}}
{{--                highlight: '#f56954',--}}
{{--                label: 'OS X'--}}
{{--            },--}}
{{--            {--}}
{{--                value: '{{$Windows}}',--}}
{{--                color: '#00a65a',--}}
{{--                highlight: '#00a65a',--}}
{{--                label: 'Windows'--}}
{{--            },--}}
{{--            {--}}
{{--                value: '{{$AndroidOS}}',--}}
{{--                color: '#f39c12',--}}
{{--                highlight: '#f39c12',--}}
{{--                label: 'Android'--}}
{{--            },--}}
{{--            {--}}
{{--                value: '{{$iOS}}',--}}
{{--                color: '#00c0ef',--}}
{{--                highlight: '#00c0ef',--}}
{{--                label: 'iOS'--}}
{{--            },--}}
{{--            {--}}
{{--                value: '{{$WindowsMobileOS}}',--}}
{{--                color: '#3c8dbc',--}}
{{--                highlight: '#3c8dbc',--}}
{{--                label: 'Windows Phone'--}}
{{--            },--}}
{{--            {--}}
{{--                value: '{{$etc}}',--}}
{{--                color: '#d2d6de',--}}
{{--                highlight: '#d2d6de',--}}
{{--                label: 'etc'--}}
{{--            }--}}
{{--        ]--}}
{{--        var pieOptions = {--}}
{{--            //Boolean - Whether we should show a stroke on each segment--}}
{{--            segmentShowStroke: true,--}}
{{--            //String - The colour of each segment stroke--}}
{{--            segmentStrokeColor: '#fff',--}}
{{--            //Number - The width of each segment stroke--}}
{{--            segmentStrokeWidth: 2,--}}
{{--            //Number - The percentage of the chart that we cut out of the middle--}}
{{--            percentageInnerCutout: 50, // This is 0 for Pie charts--}}
{{--            //Number - Amount of animation steps--}}
{{--            animationSteps: 100,--}}
{{--            //String - Animation easing effect--}}
{{--            animationEasing: 'easeOutBounce',--}}
{{--            //Boolean - Whether we animate the rotation of the Doughnut--}}
{{--            animateRotate: true,--}}
{{--            //Boolean - Whether we animate scaling the Doughnut from the centre--}}
{{--            animateScale: false,--}}
{{--            //Boolean - whether to make the chart responsive to window resizing--}}
{{--            responsive: true,--}}
{{--            // Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container--}}
{{--            maintainAspectRatio: true,--}}
{{--            //String - A legend template--}}
{{--        }--}}

{{--        pieChart.Doughnut(PieData, pieOptions)--}}

{{--    });--}}
{{--</script>--}}
</body>
</html>
