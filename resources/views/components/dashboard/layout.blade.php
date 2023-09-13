<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet"
        href="{{ asset('assets/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
    <!-- iCheck -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <!-- JQVMap -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/jqvmap/jqvmap.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('assets/dist/css/adminlte.min.css') }}">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/daterangepicker/daterangepicker.css') }}">
    <!-- summernote -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/summernote/summernote-bs4.min.css') }}">
    <link href="
    https://cdn.jsdelivr.net/npm/sweetalert2@11.7.16/dist/sweetalert2.min.css
    " rel="stylesheet">
    <style>
        a.style {
            text-transform: capitalize;
            font-size: 22px;
            border-bottom: 2px solid #2878EB;
            padding: 12px 20px;
            margin-left: -50px;
            /* padding-top: 12px; */
            display: inline-block;
            width: calc(100% + 60px);
            transition: 0.3s;
            color: #2878EB !important;
            text-wrap: nowrap;
            /* border-radius: 8px; */
            /* word-wrap: none; */
        }

        a.style span {
            margin-right: 15px;
            width: 55px;
            display: inline-block;
        }

        a.style:hover {
            opacity: .6;
        }

        a.style:hover,
        a.style.active {
            background-color: #2878EB;
            color: #fff !important;
        }
    </style>
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        <!-- Preloader -->
        <div class="preloader flex-column justify-content-center align-items-center">
            {{-- <img class="animation__shake" src="{{ asset('assets/dist/img/AdminLTELogo.png') }}" alt="AdminLTELogo"
                height="60" width="60"> --}}
            <i class="fas fa-book-reader ml-3" style="color: #2878EB ; font-size:80px;"></i>
        </div>

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i
                            class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    @if (Auth::guard()->name == 'instructor')
                        <a href="/instructor/dashboard"
                            class="nav-link text-uppercase font-weight-semi-bold">Instructor</a>
                    @elseif (Auth::guard()->name == 'admin')
                        <a href="/admin/dashboard" class="nav-link text-uppercase font-weight-semi-bold">Admin</a>
                    @else
                        <a href="/dashboard" class="nav-link text-uppercase font-weight-semi-bold">Student</a>
                    @endif
                </li>

            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <form action="{{ route('logout') }}" method='post' style="display: inline-block">
                    @csrf
                    <button type="submit"
                        style="background:transparent;border:none;color:#666;margin-top:6px;margin-right:5px;font-size:16px; text-transform:uppercase;">logout</button>
                </form>
                <li class="nav-item">
                    <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                        <i class="fas fa-expand-arrows-alt"></i>

                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="/" class="brand-link">
                <i class="fas fa-book-reader ml-3" style="color: #2878EB ; font-size:30px;"></i>
                <span class="brand-text font-weight-bold ml-2" style="font-size:25px;color:#2878EB;">EDUKATE</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user panel (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        @if ($avatar = Auth::user()->avatar)
                            <img src="{{ asset('storage/' . $avatar) }}"
                                style="margin-right:7px;margin-top:3px;height: 35px; width:35px; border-radius:50%;"
                                alt="User Image">
                            {{-- {{Auth::user()->image}} --}}
                        @else
                            <i class="fas fa-user ml-2 mt-2 mr-2" style="color: #2878EB;font-size:20px;"></i>
                        @endif
                    </div>
                    <div class="info">
                        @auth
                            <a href="#" class="d-block text-capitalize">{{ Auth::user()->name }}</a>
                            {{-- <form action="{{ route('logout') }}" method='post'>
                                @csrf
                                <button type="submit"
                                    style=" color: #2878EB;border:2px solid #2878EB; border-radius:10px; background-color:transparent;padding:5px 30px;margin-top:15px;margin-left:-10px; ">logout</button>
                            </form> --}}
                        @endauth
                    </div>
                </div>
                <div>
                    <x-dashboard.partials.links type="dashboard" />
                </div>

                <!-- SidebarSearch Form -->


            </div>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">{{ $title }}</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <x-dashboard.partials.breadcrumb :items="$items ?? []" />
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    {{ $slot }}
                </div>
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->
        <footer class="main-footer">
            <strong>Copyright &copy; {{ (new \Carbon\Carbon())->format('Y') }} <a href="/">EDUKATE</a>.</strong>
            All rights reserved.
            {{-- <div class="float-right d-none d-sm-inline-block">
                <b>Version</b> 3.2.0
            </div> --}}
        </footer>

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <!-- jQuery -->
    <script src="{{ asset('assets/plugins/jquery/jquery.min.js') }}"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="{{ asset('assets/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
        $.widget.bridge('uibutton', $.ui.button)
    </script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('assets/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- ChartJS -->
    <script src="{{ asset('assets/plugins/chart.js/Chart.min.js') }}"></script>
    <!-- Sparkline -->
    <script src="{{ asset('assets/plugins/sparklines/sparkline.js') }}"></script>
    <!-- JQVMap -->
    <script src="{{ asset('assets/plugins/jqvmap/jquery.vmap.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/jqvmap/maps/jquery.vmap.usa.js') }}"></script>
    <!-- jQuery Knob Chart -->
    <script src="{{ asset('assets/plugins/jquery-knob/jquery.knob.min.js') }}"></script>
    <!-- daterangepicker -->
    <script src="{{ asset('assets/plugins/moment/moment.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/daterangepicker/daterangepicker.js') }}"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="{{ asset('assets/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
    <!-- Summernote -->
    <script src="{{ asset('assets/plugins/summernote/summernote-bs4.min.js') }}"></script>
    <!-- overlayScrollbars -->
    <script src="{{ asset('assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('assets/dist/js/adminlte.js') }}"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="{{ asset('assets/dist/js/demo.js') }}"></script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="{{ asset('assets/dist/js/pages/dashboard.js') }}"></script>
    <script src="
                https://cdn.jsdelivr.net/npm/sweetalert2@11.7.16/dist/sweetalert2.all.min.js
                "></script>

    <script>
        if ("{{ Session::has('success') }}") {
            Swal.fire(
                'Success',
                "{{ Session::get('success') }}",
                'success'
            )
        }
        if ("{{ Session::has('info') }}") {
            Swal.fire(
                'Change Status  Success',
                "{{ Session::get('info') }}",
                'info'
            )
        }
        if ("{{ Session::has('delete') }}") {
            Swal.fire({
                icon: 'warning',
                iconColor: 'red',
                // color: 'red',
                // confirmButtonColor: 'red',
                title: 'Deleted Success',
                text: "{{ Session::get('delete') }}",
                // footer: '<a href="">Why do I have this issue?</a>'
            })
        }
    </script>
</body>

</html>
