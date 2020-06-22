<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>{{ config('app.name', 'Laravel') }}</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{asset('/../plugins/fontawesome-free/css/all.min.css')}}">
  <!-- Tempusdominus Bbootstrap 4 -->
  <link rel="stylesheet" href="{{asset('/../plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('/../dist/css/adminlte.min.css')}}">
  <!-- DataTables -->
  <link rel="stylesheet" href="{{asset('/../plugins/datatables-bs4/css/dataTables.bootstrap4.css')}}">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition sidebar-mini sidebar-collapse">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-info navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="/"><i class="fas fa-bars"></i></a>
      </li>
    </ul> 

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Messages Dropdown Menu -->
      <li class="nav-item dropdown">
            @guest
            @else
            <a class="nav-link dropdown-toggle text-white" id="UserDropdown" href="#" data-toggle="dropdown" aria-expanded="false">
              <span class="profile-text text-white">Hai, {{Auth::user()->name}} !</span>

            </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="UserDropdown">

              <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                 Keluar

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
              </a>
            </div>
            @endguest
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
    @section('sidebar')
          @include('layouts.sidebar_admin')
    @show

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <div class="container-fluid">
        @yield('content')
    </div>
  </div>
  <!-- /.content-wrapper -->
    @section('footer')
        @include('layouts.footer_admin')
    @show


</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="{{asset('/../plugins/jquery/jquery.min.js')}}"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{asset('/../plugins/jquery-ui/jquery-ui.min.js')}}"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- SweetAlert -->
<script src="{{asset('/../js/sweetalert2.all.js')}}"></script>
<!-- DataTables -->
<script src="{{asset('/../plugins/datatables/jquery.dataTables.js')}}"></script>
<script src="{{asset('/../plugins/datatables-bs4/js/dataTables.bootstrap4.js')}}"></script>
<!-- Bootstrap 4 -->
<script src="{{asset('/../plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('/../dist/js/adminlte.js')}}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{asset('/../dist/js/demo.js')}}"></script>
@include('sweetalert::alert')
</body>
</html>
