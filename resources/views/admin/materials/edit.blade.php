<!DOCTYPE html>
<html>
<head>
    <title> متریال ها | فلورانس</title>

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
                متریال ها
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> خانه</a></li>
                <li class="active"> متریال ها</li>
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
                            <h3 class="box-title">ویرایش متریال</h3>

                            <div class="box-tools">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i
                                        class="fa fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="box-body no-padding">
                            <form role="form" action="{{route('materials.update',['material'=>$selectedMaterial->id])}}" method="POST">
                                @csrf
                                @method('put')
                                <div class="box-body">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">نام متریال</label>
                                        <input value="{{$selectedMaterial->name}}" type="text" class="form-control" required id="material_name"
                                               name="material_name" placeholder="نام متریال">
                                    </div>
                                </div>

                                <div class="box-body">
                                    <div class="form-group">
                                        <label for="materialType">نوع متریال</label>
                                        <select id="materialType" name="materialType" class="form-control">
                                            <option @if($selectedMaterial->type=='cabin') selected @endif value="cabin">کابین</option>
                                            <option @if($selectedMaterial->type=='surface') selected @endif value="surface">صفحه</option>
                                            <option @if($selectedMaterial->type=='bowl') selected @endif value="bowl">کاسه</option>
                                            <option @if($selectedMaterial->type=='mirror') selected @endif value="mirror">آینه</option>
                                            <option @if($selectedMaterial->type=='drawer') selected @endif value="drawer">کشو</option>
                                        </select>
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
                            <h3 class="box-title">متریال ها</h3>

                            <div class="box-tools pull-right">
                                <div class="has-feedback">
                                    <form action="{{route('materials.search')}}" method="get">
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
                                {{--                <button type="button" class="btn btn-default btn-sm"></button>--}}

                                <div class="pull-left">

                                    <!-- /.btn-group -->
                                </div>
                                <!-- /.pull-right -->
                            </div>
                            <div class="table-responsive mailbox-messages">
                                <div class="nav-tabs-custom">
                                    <ul class="nav nav-tabs">
                                        @foreach($types as $type)
                                            <li class="@if($type->name=='cabin') active @endif">
                                                <a href="#tab_{{$type->name}}" id="{{$type->name}}tab"
                                                   data-toggle="tab">{{$type->label}}</a>
                                            </li>
                                            @php
                                                ${'material' . $type->name}=\App\Models\Material::orderBy('id','desc')->where('type',$type->name)->get();
                                            @endphp
                                        @endforeach
                                    </ul>
                                    <div class="tab-content">
                                        @foreach($types as $type)

                                            <div class="tab-pane @if($type->name=='cabin') active @endif"
                                                 id="tab_{{$type->name}}">
                                                <table class="table table-hover table-striped">

                                                    <thead>
                                                    <tr>
                                                        <th class="mailbox-star">کد متریال</th>
                                                        <th class="mailbox-star">نام متریال</th>
                                                        <th class="mailbox-star">نوع متریال</th>
                                                        <th class="mailbox-subject">ویرایش</th>
                                                        <th class="mailbox-subject">حذف</th>
                                                    </tr>
                                                    </thead>

                                                    <tbody>

                                                    @foreach(${'material' . $type->name} as $material)
                                                        <tr>
                                                            <td class="mailbox-star">{{$material->id}}</td>
                                                            <td class="mailbox-star"> {{$material->name}}</td>
                                                            <td class="mailbox-star"> {{$material->pType()}}</td>
                                                            <td class="mailbox-subject"><a
                                                                    href="{{route('materials.edit',['material' => $material->id])}}"
                                                                    class="btn btn-warning fa fa-edit"></a></td>
                                                            <td class="mailbox-subject">
                                                                <form
                                                                    action="{{route('materials.destroy',['material'=>$material->id])}}"
                                                                    method="post">
                                                                    {{method_field('delete')}}
                                                                    {{csrf_field()}}
                                                                    <button type="submit"
                                                                            class="btn btn-danger fa fa-trash"></button>
                                                                </form>
                                                            </td>

                                                        </tr>
                                                    @endforeach
                                                    </tbody>
                                                </table>
                                            </div>

                                        @endforeach
                                    </div>


                                </div>
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
                                {{--                <button type="button" class="btn btn-default btn-sm"><i class="fa fa-refresh"></i></button>--}}
                                <div class="pull-left">
                                {{--                                    <div class="d-flex justify-content-center">--}}
                                {{--                                        {!! $materials->links("pagination::bootstrap-4") !!}--}}
                                {{--                                    </div>--}}
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
