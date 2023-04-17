<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>@yield('title')</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset("./template/plugins/fontawesome-free/css/all.min.css") }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset("./template/dist/css/adminlte.min.css") }}">
  <link rel="stylesheet" href="{{ asset('./template/plugins/select2/css/select2.min.css') }}">

  <style>
    .select2-container--default .select2-selection--single{
      height: 37px;
    }
    
    .select2-container--default .select2-selection--single .select2-selection__arrow {
      height: 35px !important;
    }
  </style>

  @stack('addons-css')
  @livewireStyles
</head>

<body class="hold-transition sidebar-mini layout-fixed">
  <!-- Site wrapper -->
  <div class="wrapper">
    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li>
          <a href="#" class="nav-link"><b>PANTI ASUHAN AL DZIKRO WUKIRSARI IMOGIRI BANTUL</b></a>
        </li>
      </ul>

      <!-- Right navbar links -->
      <ul class="navbar-nav ml-auto">
        <!-- Notifications Dropdown Menu -->
        <li class="nav-item dropdown">
          <a class="nav-link" data-toggle="dropdown" href="#">
            <i class="fas fa-user"></i>
          </a>
          <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
            <div class="dropdown-divider"></div>
            @if (auth()->user()->role != 'penerima-donasi')
              <a href="{{ route('profile.user') }}" class="dropdown-item">
                <i class="fas fa-user mr-2"></i> Profil
              </a>
            @endif
            <div class="dropdown-divider"></div>
            <a href="{{ route('logout') }}" class="dropdown-item">
              <i class="fas fa-sign-out-alt mr-2"></i> Logout
            </a>
          </div>
        </li>
      </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
      <a href="{{ route('dashboard') }}" class="brand-link text-center">
        @php
            if(strpos(auth()->user()->role, 'yayasan')){
              $logo = '/logo-yayasan.png';
            }else{
              $logo = '/logo-lksa.jpg';
            }
        @endphp
        <img src="{{ asset('./logo'.$logo) }}" class="img-circle elevation-3" style="opacity: .8; width: 60%; margin-top: -10px; margin-bottom: -10px;">
        {{-- <span class="brand-text font-weight-bold">AL DZIKRO</span> --}}
      </a>

      <!-- Sidebar -->
      <div class="sidebar">

        <!-- Sidebar Menu -->
        @if (Auth()->user()->role == 'admin-yayasan' || Auth()->user()->role == 'ketua-yayasan')
          @include('layout.menu-admin-yayasan')
        @elseif(Auth()->user()->role == 'pembina-yayasan')
          @include('layout.menu-pembina-yayasan')
        @elseif(Auth()->user()->role == 'bendahara-yayasan')
          @include('layout.menu-bendahara-yayasan')
        @elseif(Auth()->user()->role == 'admin-donasi')
          @include('layout.menu-admin-donasi')
        @elseif(Auth()->user()->role == 'sekertariat-yayasan')
          @include('layout.menu-sekertariat-yayasan')
        @elseif(Auth()->user()->role == 'ketua-lksa')
          @include('layout.menu-ketua-lksa')
        @elseif(Auth()->user()->role == 'bendahara-lksa')
          @include('layout.menu-bendahara-lksa')
        @elseif(Auth()->user()->role == 'sekertariat-lksa')
          @include('layout.menu-sekertariat-lksa')
        @elseif(Auth()->user()->role == 'penerima-donasi')
          @include('layout.menu-penerima-donasi')
        @endif
        <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        @yield('content')
    </div>
    <!-- /.content-wrapper -->

    <footer class="main-footer">
      <!-- To the right -->
      {{-- <div class="float-right d-none d-sm-inline">
        Panti Asuhan AL-Dzikro
      </div> --}}
      <!-- Default to the left -->
      {{-- <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved. --}}
      <strong>Panti Asuhan Al Dzikro</strong>
    </footer>

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
      <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
  </div>
  <!-- ./wrapper -->

  <!-- jQuery -->
  <script src="{{ asset("./template/plugins/jquery/jquery.min.js") }}"></script>
  <!-- Bootstrap 4 -->
  <script src="{{ asset("./template/plugins/bootstrap/js/bootstrap.bundle.min.js") }}"></script>
  <!-- AdminLTE App -->
  <script src="{{ asset("./template/dist/js/adminlte.min.js") }}"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="{{ asset("./template/dist/js/demo.js") }}"></script>
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="{{ asset('./template/plugins/select2/js/select2.full.min.js') }}"></script>

  {{-- format idr --}}
  <script src="{{ asset('./js/rupiah.js') }}"></script>

  <script>
    function openWindowPopup(url, lebar, tinggi) {
      var left = (screen.width / 2) - (lebar / 2);
      var top = (screen.height / 2) - (tinggi / 2);

      console.log(screen.width);
      console.log(screen.height);
      
      window.open(url, '', 'toolbar=0,location=0,directories=0,status=0,menubar=0,scrollbars=1,resizable=1,width=' + lebar + ',height=' + tinggi + ',top=' + top + ',left=' + left);
    }

    window.addEventListener('success-import', event => {
      // close modal
      $('#importPengurus').modal('hide')
      $('#importSantri').modal('hide')
      $('#importWarga').modal('hide')
      $('#import').modal('hide')

      // sweetalert success
      const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        didOpen: (toast) => {
          toast.addEventListener('mouseenter', Swal.stopTimer)
          toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
      })

      Toast.fire({
        icon: 'success',
        title: event.detail.message
      })
    })

    const reader = new FileReader();
    reader.readAsDataURL(blob);
    reader.onloadend = function () {
        const dataUrl = reader.result;
        alert(dataUrl);
    };
  </script>

  @stack('addons-js')
  @stack('component-scripts')
  @livewireScripts
  @stack('sortable-scripts')
  {{-- <script>
      $('.select2').select2();
  </script> --}}
</body>

</html>