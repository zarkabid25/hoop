<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title') | Project Name</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet"
          href="{{ asset('plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
    <!-- iCheck -->
    <link rel="stylesheet" href="{{ asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <!-- JQVMap -->
    <link rel="stylesheet" href="{{ asset('plugins/jqvmap/jqvmap.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{ asset('plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="{{ asset('plugins/daterangepicker/daterangepicker.css') }}">
    <!-- summernote -->
    <link rel="stylesheet" href="{{ asset('plugins/summernote/summernote-bs4.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">

    <style>
        .fa-circle {
            font-size: 10px !important;
        }

        .form-control{
            font-size: 0.8rem !important;
        }

        label{
            font-size: 12px !important;
        }
        .btn{
            font-size: 12px;
        }
        .dropdown-toggle::after{
            content: unset;
        }
        .notification-view{
            padding: 10px;
        }
        .notification-user{
            font-size: unset;
        }
        .media-body p{
            font-size: 0.8em;
        }
    </style>

    @yield('css')
</head>
<body class="hold-transition sidebar-mini layout-fixed" style="font-size: 12px">
<div class="wrapper">

    <!-- Preloader -->
    <div class="preloader flex-column justify-content-center align-items-center">

        <img class="animation__shake" src="{{ asset('dist/img/AdminLTELogo.png') }}" alt="No Image" height="60"
             width="60">
    </div>

{{--    @include('portal.components.navbar')--}}

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        {{--        <a href="index3.html" class="brand-link">--}}
        {{--            <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">--}}
        {{--            <span class="brand-text font-weight-light">AdminLTE 3</span>--}}
        {{--        </a>--}}

        @include('portal.components.leftbar')
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        @php
                            $img = (!empty(auth()->user()->image)) ? auth()->user()->image : 'user-avatar.png';
                        @endphp

                        <div style="display: inline-flex;">
                            <div class="image">
                                <img src="{{ asset('images'. "/". $img) }}" class="img-circle elevation-2" width="40" alt="User Image">
                            </div>

                            <div style="padding-top: 12px; padding-left: 10px; margin-right: 20px">
                                <h6 class="m-0">Hi {{ ucwords(auth()->user()->name) }}! </h6>
                            </div>

                            @if(@auth()->user()->role == 'sales')
                                @php
                                    $orders = \App\Models\Notification::with('order')->where('status', '0')->where('refered_by', auth()->user()->email)
                                                ->get();
                                @endphp

                                <ul>
                                    <li class="header-notification">
                                        <div class="dropdown-primary dropdown">
                                            <div class="dropdown-toggle" data-toggle="dropdown">
                                                <i class="fas fa-bell"></i>
                                                <span class="badge badge-danger">{{ count($orders) }}</span>
                                            </div>
                                            <ul class="show-notification notification-view dropdown-menu"
                                                data-dropdown-in="fadeIn" data-dropdown-out="fadeOut" style="overflow: auto; max-height: 250px; width: 250px">
                                                <li>
                                                    <h6>Notifications</h6>
                                                <li style="padding: 0 25px;">
                                                    <a href="#" style="background-color: transparent;">
                                                        <div class="media">
                                                            <div class="media-body" style="color: black;">
                                                                @forelse($orders as $order)
                                                                    <h5 class="notification-user">
                                                                        <a href="{{ route('reward.notification.order', ['id' => $order->order_id]) }}">{{ ucwords($order->order->design_name) }}</a><br />
                                                                    </h5>
                                                                    <p>{{ date('Y-m-d', strtotime($order->created_at)) }}</p>
                                                                @empty
                                                                @endforelse
                                                            </div>
                                                        </div>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </li>
                                </ul>
                            @endif
                        </div>

                        @php
                            $routeName = request()->route()->getName();
                            $pageName = str_replace(['_', '.'], ' ', explode('.', $routeName));
                        @endphp
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard.admin') }}">Home</a></li>
                            <li class="breadcrumb-item active">{{ ucwords($pageName[0]) }}</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Alerts -->
        @include('portal.components.alerts')

        <!-- Main content -->
        <section class="content">
            @yield('content')
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

{{--    @include('portal.components.footer')--}}

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{ asset('plugins/jquery-ui/jquery-ui.min.js') }}"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
    $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- ChartJS -->
<script src="{{ asset('plugins/chart.js/Chart.min.js') }}"></script>
<!-- Sparkline -->
<script src="{{ asset('plugins/sparklines/sparkline.js') }}"></script>
<!-- JQVMap -->
<script src="{{ asset('plugins/jqvmap/jquery.vmap.min.js') }}"></script>
<script src="{{ asset('plugins/jqvmap/maps/jquery.vmap.usa.js') }}"></script>
<!-- jQuery Knob Chart -->
<script src="{{ asset('plugins/jquery-knob/jquery.knob.min.js') }}"></script>
<!-- daterangepicker -->
<script src="{{ asset('plugins/moment/moment.min.js') }}"></script>
<script src="{{ asset('plugins/daterangepicker/daterangepicker.js') }}"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="{{ asset('plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
<!-- Summernote -->
<script src="{{ asset('plugins/summernote/summernote-bs4.min.js') }}"></script>
<!-- overlayScrollbars -->
<script src="{{ asset('plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('dist/js/adminlte.js') }}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{ asset('dist/js/demo.js') }}"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="{{ asset('dist/js/pages/dashboard.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/js/all.min.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@yield('JS')
</body>
</html>
