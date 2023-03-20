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
    <li class="nav-item {{ $active == 'donatur' || $active == 'tipe' || $active == 'create-donasi-barang' || $active == 'donasi' || $active == 'donasi-barang' || $active == 'donasi-transfer' || $active == 'data-donasi-tunai' || $active == 'data-donasi-transfer' ? 'menu-open' : '' }}">
      <a href="#" class="nav-link">
        <i class="nav-icon fas fa-hands"></i>
        <p>
          Kedonaturan
          <i class="right fas fa-angle-left"></i>
        </p>
      </a>
      <ul class="nav nav-treeview">
        <li class="nav-item ml-2">
          <a href="{{ route('donatur') }}" class="nav-link {{ $active == 'donatur' ? 'active' : '' }}">
            <i class="nav-icon far fa-circle"></i>
            <p>
              Donatur
            </p>
          </a>
        </li>
        <li class="nav-header">Donasi Tunai</li>
        <li class="nav-item ml-2">
          <a href="{{ route('donasi.tunai') }}" class="nav-link {{ $active == 'donasi' ? 'active' : '' }}">
            <i class="far fa-circle nav-icon"></i>
            <p>Donasi Tunai</p>
          </a>
        </li>
        <li class="nav-item ml-2">
          <a href="{{ route('donation.tunai') }}" class="nav-link {{ $active == 'data-donasi-tunai' ? 'active' : '' }}">
            <i class="far fa-circle nav-icon"></i>
            <p>Data Donasi Tunai</p>
          </a>
        </li>
        <li class="nav-header">Donasi Transfer</li>
        <li class="nav-item ml-2">
          <a href="{{ route('donasi.transfer') }}" class="nav-link {{ $active == 'donasi-transfer' ? 'active' : '' }}">
            <i class="far fa-circle nav-icon"></i>
            <p>Donasi Transfer</p>
          </a>
        </li>
        <li class="nav-item ml-2">
          <a href="{{ route('data.donasi.transfer') }}" class="nav-link {{ $active == 'data-donasi-transfer' ? 'active' : '' }}">
            <i class="far fa-circle nav-icon"></i>
            <p>Data Donasi Transfer</p>
          </a>
        </li>
        <li class="nav-header">Donasi Barang</li>
        <li class="nav-item ml-2">
          <a href="{{ route('create.donasi.barang') }}" class="nav-link {{ $active == 'create-donasi-barang' ? 'active' : '' }}">
            <i class="far fa-circle nav-icon"></i>
            <p>Donasi Barang</p>
          </a>
        </li>
        <li class="nav-item ml-2">
          <a href="{{ route('donation.goods') }}" class="nav-link {{ $active == 'donasi-barang' ? 'active' : '' }}">
            <i class="far fa-circle nav-icon"></i>
            <p>Data Donasi Barang</p>
          </a>
        </li>
      </ul>
    </li>
  </ul>
</nav>