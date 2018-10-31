
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Dashboard</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="/admin/AdminLTE/node_modules/bootstrap/dist/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="/admin/AdminLTE/node_modules/font-awesome/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="/admin/AdminLTE/node_modules/ionicons/dist/css/ionicons.min.css">
    <!-- jvectormap -->
    <link rel="stylesheet" href="/admin/AdminLTE/node_modules/jvectormap/jquery-jvectormap.css">
    <link rel="stylesheet" href="/admin/AdminLTE/plugins/iCheck/all.css">

    <link rel="stylesheet" href="/admin/AdminLTE/node_modules/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="/admin/AdminLTE/dist/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="/admin/AdminLTE/dist/css/skins/_all-skins.min.css">
    <!-- jQuery 3 -->
    <script src="/admin/AdminLTE/node_modules/jquery/dist/jquery.min.js"></script>


    {{--
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    --}}

    <!-- Google Font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

    <header class="main-header">

        <a href="index2.html" class="logo">
            <span class="logo-mini"><b>I</b>C</span>
            <span class="logo-lg">iskconclub.ru</span>
        </a>

        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top">
            <!-- Sidebar toggle button-->
            <a href="javascript:void(0)" class="sidebar-toggle" data-toggle="push-menu" role="button">
                <span class="sr-only">Переключить навигацию</span>
            </a>
            <!-- Navbar Right Menu -->
            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">
                    {{--
                    --}}
                    <li class="dropdown user user-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <img src="/admin/user-160x160.jpg" class="user-image" alt="User Image">
                            <span class="hidden-xs">{{ Auth::user()->name }}</span>
                        </a>
                        <ul class="dropdown-menu">
                            <!-- User image -->
                            <li class="user-header">
                                <img src="/admin/user-160x160.jpg" class="img-circle" alt="User Image">
                                <p>
                                    {{ Auth::user()->name }} - Web Developer
                                    <small>Зарегистрирован с {{ Auth::user()->created_at->format('d.m.Y') }}</small>
                                </p>
                            </li>

                            <!-- Menu Footer-->
                            <li class="user-footer">
                                {{--
                                <div class="pull-left">
                                    <a href="#" class="btn btn-default btn-flat">Profile</a>
                                </div>
                                --}}
                                <div class="pull-right">
                                    <a href="{{ route('logout') }}" class="btn btn-default btn-flat">Выйти</a>
                                </div>
                            </li>
                        </ul>
                    </li>
                    <!-- Control Sidebar Toggle Button -->

                </ul>
            </div>

        </nav>
    </header>
    <!-- Left side column. contains the logo and sidebar -->
    <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
            <!-- Sidebar user panel -->
            <div class="user-panel">
                <div class="pull-left image">
                    <img src="/admin/user-160x160.jpg" class="img-circle" alt="User Image">
                </div>
                <div class="pull-left info">
                    <p>{{ Auth::user()->name }}</p>
                    <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                </div>
            </div>
            {{--
            <!-- search form -->
            <form action="#" method="get" class="sidebar-form">
                <div class="input-group">
                    <input type="text" name="q" class="form-control" placeholder="Search...">
                    <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat">
                  <i class="fa fa-search"></i>
                </button>
              </span>
                </div>
            </form>
            <!-- /.search form -->
            --}}
            <!-- sidebar menu: : style can be found in sidebar.less -->
            <ul class="sidebar-menu" data-widget="tree">
                <li class="header">ОСНОВЫНЕ РАЗЕДЛЫ</li>

                <li>
                    <a href="{{route('admin.settings')}}">
                        <i class="fa fa-sliders" aria-hidden="true"></i> <span>Настройки магазина</span>
                    </a>
                </li>

                <li>
                    <a href="{{route('admin.administrators')}}">
                        <i class="fa fa-users" aria-hidden="true"></i> <span>Администраторы</span>
                    </a>
                </li>
                <li class="header">ПОЖЕРТВОВАНИЯ</li>
                <li>
                    <a href="{{route('admin.formats.index')}}">
                        <i class="fa fa-th-list"></i> <span>Список опций</span>
                    </a>
                </li>
                <li>
                    <a href="{{route('admin.donators')}}">
                        <i class="fa fa-universal-access" aria-hidden="true"></i> <span>Жертвователи</span>
                    </a>
                </li>
                <li>
                    <a href="{{route('admin.payments')}}">
                        <i class="fa fa-heart" aria-hidden="true"></i> <span>Пожертвования</span>
                    </a>
                </li>
                <li>
                    <a href="{{route('admin.recurrings')}}">
                        <i class="fa fa-history" aria-hidden="true"></i> <span>Ежемесячные подписки</span>
                    </a>
                </li>
                <li>
                    <a href="{{route('admin.payments.stat')}}">
                        <i class="fa fa-calculator" aria-hidden="true"></i> <span>Статистика</span>
                    </a>
                </li>
                <li>
                    <a href="{{route('admin.bonus.applications')}}">
                        <i class="fa fa-envelope-open-o" aria-hidden="true"></i> <span>Заявки на подарки</span>
                    </a>
                </li>
                <li class="header">ОПЛАТА КУРСОВ</li>
                <li>
                    <a href="{{route('admin.courses.index')}}">
                        <i class="fa fa-file-text" aria-hidden="true"></i> <span>Список курсов</span>
                    </a>
                    <a href="{{route('admin.courses.payments')}}">
                        <i class="fa fa-rub" aria-hidden="true"></i> <span>Платежи за курсы</span>
                    </a>
                    <a href="{{route('admin.courses.passwords')}}">
                        <i class="fa fa-eye" aria-hidden="true"></i> <span>Установка паролей</span>
                    </a>
                    <a href="{{route('admin.courses.stat')}}">
                        <i class="fa fa-calculator" aria-hidden="true"></i> <span>Статистика</span>
                    </a>
                </li>
            </ul>
        </section>
        <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>@yield('title', 'Панель управления')</h1>
            <ol class="breadcrumb">
                <li><a href="/admin/dashboard"><i class="fa fa-dashboard"></i> Главная</a></li>
                @yield('crumbs', '<li class="active">Dashboard</li>')
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            @yield('content')
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <footer class="main-footer">
        <div class="pull-right hidden-xs">
            <b>Version</b> 1.0
        </div>
        <strong>Copyright &copy; 2018 <a href="http://webkonditer.ru">webkonditer.ru</a>.</strong> All rights
        reserved.
    </footer>

</div>
<!-- ./wrapper -->


<!-- Bootstrap 3.3.7 -->
<script src="/admin/AdminLTE/node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- FastClick -->
<script src="/admin/AdminLTE/node_modules/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<!-- Sparkline -->
<script src="/admin/AdminLTE/node_modules/jquery-sparkline/jquery.sparkline.min.js"></script>
<!-- jvectormap  -->
<script src="/admin/AdminLTE/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="/admin/AdminLTE/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<!-- SlimScroll -->
<script src="/admin/AdminLTE/node_modules/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- ChartJS -->
<script src="/admin/AdminLTE/node_modules/chart.js/Chart.min.js"></script>
<script src="/admin/AdminLTE/plugins/iCheck/icheck.min.js"></script>
<script src="/admin/AdminLTE/node_modules/ckeditor/ckeditor.js"></script>
<script src="/admin/AdminLTE/node_modules/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<script src="/admin/AdminLTE/node_modules/bootstrap-datepicker/dist/locales/bootstrap-datepicker.ru.min.js"></script>
<script src="/admin/AdminLTE/dist/js/adminlte.min.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
{{--<script src="/admin/AdminLTE/dist/js/pages/dashboard2.js"></script>--}}
<!-- AdminLTE for demo purposes -->
{{--<script src="/admin/AdminLTE/dist/js/demo.js"></script>--}}
<script>
    $(function() {
        $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
            checkboxClass: 'icheckbox_flat-green',
            radioClass: 'iradio_flat-green'
        });
        CKEDITOR.dtd.$removeEmpty['i'] = false;
        CKEDITOR.dtd.$removeEmpty['a'] = false;
        CKEDITOR.dtd.$removeEmpty['span'] = false;
        CKEDITOR.dtd.$removeEmpty['div'] = false;
        CKEDITOR.dtd.$removeEmpty['li'] = false;
        CKEDITOR.dtd.$removeEmpty['button'] = false;
        $('textarea.js-editor-enabled').each(function() {
            CKEDITOR.replace($(this).get(0), {
                allowedContent: true
            });
        });

        $('input.datepicker-enabled').datepicker({
            autoclose: true,
            format: 'dd.mm.yyyy',
            language: 'ru',
            todayBtn: 'linked'
        });
    });
</script>
</body>
</html>
