<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-right image">
                <img src="/images/avatar.webp" class="img-circle" alt="User Image">
            </div>
            <div class="pull-right info">
                <p>{{\Illuminate\Support\Facades\Auth::user()->name}} {{\Illuminate\Support\Facades\Auth::user()->last_name}}</p>
                <a href="#"><i class="fa fa-circle text-success"></i> آنلاین</a>
            </div>
        </div>

        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu" data-widget="tree">
            <li class="header">منو</li>

{{--            <li>--}}
{{--                <a href="{{route('template.index')}}">--}}
{{--                    <i class="fa fa-paint-brush"></i> <span>تنظیمات قالب</span>--}}
{{--                </a>--}}
{{--            </li>--}}

            <li class="treeview">
                <a href="#">
                    <i class="fa fa-archive"></i>
                    <span>متغیر ها</span>
                    <span class="pull-left-container">
              <i class="fa fa-angle-right pull-left"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{route('colors.index')}}"><i class="fa fa-circle-o"></i>  رنگ ها</a></li>
                    <li><a href="{{route('materials.index')}}"><i class="fa fa-circle-o"></i> متریال ها</a></li>

                </ul>
            </li>


{{--            <li class="treeview">--}}
{{--                <a href="#">--}}
{{--                    <i class="fa fa-shopping-cart"></i>--}}
{{--                    <span>آثار</span>--}}
{{--                    <span class="pull-left-container">--}}
{{--              <i class="fa fa-angle-right pull-left"></i>--}}
{{--            </span>--}}
{{--                </a>--}}
{{--                <ul class="treeview-menu">--}}
{{--                    <li><a href="{{route('products.index')}}"><i class="fa fa-circle-o"></i>  آثار</a></li>--}}
{{--                    <li><a href="{{route('products.create')}}"><i class="fa fa-circle-o"></i> افزودن اثر</a></li>--}}

{{--                </ul>--}}
{{--            </li>--}}
{{--            <li class="treeview">--}}
{{--                <a href="#">--}}
{{--                    <i class="fa fa-shopping-cart"></i>--}}
{{--                    <span>رویداد ها</span>--}}
{{--                    <span class="pull-left-container">--}}
{{--              <i class="fa fa-angle-right pull-left"></i>--}}
{{--            </span>--}}
{{--                </a>--}}
{{--                <ul class="treeview-menu">--}}
{{--                    <li><a href="{{route('events.index')}}"><i class="fa fa-circle-o"></i>  رویداد ها</a></li>--}}
{{--                    <li><a href="{{route('events.create')}}"><i class="fa fa-circle-o"></i> افزودن رویداد</a></li>--}}

{{--                </ul>--}}
{{--            </li>--}}



            <li>
                <a href="{{route('index')}}">
                    <i class="fa fa-backward"></i> <span>بازگشت به سایت</span>
                </a>
            </li>
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>
