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

            <li>
                <a href="{{route('orders.index')}}">
                    <i class="fa fa-first-order"></i> <span>سفارشات</span>
                </a>
            </li>
            <li>
                <a href="{{route('payments.index')}}">
                    <i class="fa fa-money"></i> <span>تراکنش ها</span>
                </a>
            </li>
            <li>
                <a href="{{route('tickets.index')}}">
                    <i class="fa fa-ticket"></i> <span>تیکت ها</span>
                </a>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-users"></i>
                    <span> کاربران</span>
                    <span class="pull-left-container">
              <i class="fa fa-angle-right pull-left"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    @if(\Illuminate\Support\Facades\Auth::user()->role=='admin')
                        <li><a href="{{route('users.list')}}"><i class="fa fa-circle-o"></i> لیست کاربران</a></li>
                    @endif
                    <li><a href="{{route('users.profile')}}"><i class="fa fa-circle-o"></i> پروفایل</a></li>

                </ul>
            </li>


            @if(\Illuminate\Support\Facades\Auth::user()->role=='admin')
                <li class="treeview">
                    <a href="#">
                        <i class="fa fa-archive"></i>
                        <span>متغیر ها</span>
                        <span class="pull-left-container">
              <i class="fa fa-angle-right pull-left"></i>
            </span>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="{{route('colors.index')}}"><i class="fa fa-circle-o"></i> رنگ ها</a></li>
                        <li><a href="{{route('materials.index')}}"><i class="fa fa-circle-o"></i> متریال ها</a></li>

                    </ul>
                </li>
            @endif


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
