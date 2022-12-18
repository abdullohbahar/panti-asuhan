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

<body class="hold-transition sidebar-mini">
  <!-- Site wrapper -->
  <div class="wrapper">
    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
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
            <a href="#" class="dropdown-item">
              <i class="fas fa-user mr-2"></i> Profil
            </a>
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
        <span class="text-center font-weight-bold">AL-DZIKRO</span>
      </a>

      <!-- Sidebar -->
      <div class="sidebar">

        <!-- Sidebar Menu -->
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
            <li class="nav-item">
              <a href="{{ route('dashboard') }}" class="nav-link {{ $active == 'dashboard' ? 'active' : '' }}">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>
                  Dashboard
                </p>
              </a>
            </li>
            <li class="nav-item {{ $active == 'anak-asuh' || $active == 'tabungan' ? 'menu-open' : '' }}">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-users"></i>
                <p>
                  Anak Asuh
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="{{ route('anak.asuh') }}" class="nav-link {{ $active == 'anak-asuh' ? 'active' : '' }}">
                    <i class="nav-icon far fa-circle"></i>
                    <p>
                      Data Anak Asuh
                    </p>
                  </a>
                </li>
                {{-- <li class="nav-item">
                  <a href="{{ route('donation.type') }}" class="nav-link {{ $active == 'tipe' ? 'active' : '' }}">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Tipe Donasi</p>
                  </a>
                </li> --}}
                {{-- <li class="nav-item">
                  <a href="{{ route('tabungan.anak.asuh') }}" class="nav-link {{ $active == 'tabungan' ? 'active' : '' }}">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Tabungan Anak Asuh</p>
                  </a>
                </li> --}}
              </ul>
            </li>
            <li class="nav-item {{ $active == 'donatur' || $active == 'tipe' || $active == 'donasi' || $active == 'donasi-barang' || $active == 'penggunaan-dana' ? 'menu-open' : '' }}">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-hands"></i>
                <p>
                  Kedonaturan
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="{{ route('donatur') }}" class="nav-link {{ $active == 'donatur' ? 'active' : '' }}">
                    <i class="nav-icon far fa-circle"></i>
                    <p>
                      Donatur
                    </p>
                  </a>
                </li>
                {{-- <li class="nav-item">
                  <a href="{{ route('donation.type') }}" class="nav-link {{ $active == 'tipe' ? 'active' : '' }}">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Tipe Donasi</p>
                  </a>
                </li> --}}
                <li class="nav-item">
                  <a href="{{ route('donation') }}" class="nav-link {{ $active == 'donasi' ? 'active' : '' }}">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Donasi Dana</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{ route('donation.goods') }}" class="nav-link {{ $active == 'donasi-barang' ? 'active' : '' }}">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Donasi Barang</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{ route('laporan.penggunaan.dana') }}" class="nav-link {{ $active == 'penggunaan-dana' ? 'active' : '' }}">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Penggunaan Donasi</p>
                  </a>
                </li>
              </ul>
            </li>
            <li class="nav-item {{ $active == 'satuan' ? 'menu-open' : '' }}">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-cog"></i>
                <p>
                  Pengaturan
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="{{ route('satuan') }}" class="nav-link {{ $active == 'satuan' ? 'active' : '' }}">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Satuan Barang</p>
                  </a>
                </li>
              </ul>
            </li>
          </ul>
        </nav>
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
      <strong>Panti Asuhan Al-Dzikro</strong>
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

  @stack('addons-js')
  @stack('component-scripts')
  @livewireScripts
  {{-- <script>
      $('.select2').select2();
  </script> --}}
</body>

</html>