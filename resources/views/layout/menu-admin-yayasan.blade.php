<nav class="mt-2">
  <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
    <!-- Add icons to the links using the .nav-icon class
       with font-awesome or any other icon font library -->
    <li class="nav-item">
      <a href="{{ route('dashboard.admin.yayasan') }}" class="nav-link {{ $active == 'dashboard' ? 'active' : '' }}">
        <i class="nav-icon fas fa-tachometer-alt"></i>
        <p>
          Dashboard
        </p>
      </a>
    </li>
    <li class="nav-item {{ $active == 'santri-dalam' || $active == 'santri-luar' || $active == 'create-santri' ? 'menu-open' : '' }}">
      <a href="#" class="nav-link">
        <i class="nav-icon fas fa-users"></i>
        <p>
          Santri
          <i class="right fas fa-angle-left"></i>
        </p>
      </a>
      <ul class="nav nav-treeview">
        <li class="nav-item">
          <a href="{{ route('create.santri.admin.yayasan') }}" class="nav-link {{ $active == 'create-santri' ? 'active' : '' }}">
            <i class="nav-icon far fa-circle"></i>
            <p>
              Tambah Santri
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ route('santri.dalam.admin.yayasan') }}" class="nav-link {{ $active == 'santri-dalam' ? 'active' : '' }}">
            <i class="nav-icon far fa-circle"></i>
            <p>
              Data Santri Dalam
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ route('santri.luar.admin.yayasan') }}" class="nav-link {{ $active == 'santri-luar' ? 'active' : '' }}">
            <i class="nav-icon far fa-circle"></i>
            <p>
              Data Santri Luar
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
    <li class="nav-item {{ $active == 'donatur' || $active == 'tipe' || $active == 'create-donasi-barang' || $active == 'donasi' || $active == 'donasi-barang' || $active == 'donasi-transfer' || $active == 'data-donasi-tunai' || $active == 'data-donasi-transfer' ? 'menu-open' : '' }}">
      <a href="#" class="nav-link">
        <i class="nav-icon fas fa-hands"></i>
        <p>
          Kedonaturan
          <i class="right fas fa-angle-left"></i>
        </p>
      </a>
      <ul class="nav nav-treeview">
        <li class="nav-item">
          <a href="{{ route('donatur.admin.yayasan') }}" class="nav-link {{ $active == 'donatur' ? 'active' : '' }}">
            <i class="nav-icon far fa-circle"></i>
            <p>
              Donatur
            </p>
          </a>
        </li>
        <li class="nav-header">Donasi Tunai</li>
        {{-- <li class="nav-item">
          <a href="{{ route('donation.type') }}" class="nav-link {{ $active == 'tipe' ? 'active' : '' }}">
            <i class="far fa-circle nav-icon"></i>
            <p>Tipe Donasi</p>
          </a>
        </li> --}}
        <li class="nav-item">
          <a href="{{ route('donasi.tunai.admin.yayasan') }}" class="nav-link {{ $active == 'donasi' ? 'active' : '' }}">
            <i class="far fa-circle nav-icon"></i>
            <p>Donasi Tunai</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ route('donation.tunai.admin.yayasan') }}" class="nav-link {{ $active == 'data-donasi-tunai' ? 'active' : '' }}">
            <i class="far fa-circle nav-icon"></i>
            <p>Data Donasi Tunai</p>
          </a>
        </li>
        <li class="nav-header">Donasi Transfer</li>
        <li class="nav-item">
          <a href="{{ route('donasi.transfer.admin.yayasan') }}" class="nav-link {{ $active == 'donasi-transfer' ? 'active' : '' }}">
            <i class="far fa-circle nav-icon"></i>
            <p>Donasi Transfer</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ route('data.donasi.transfer.admin.yayasan') }}" class="nav-link {{ $active == 'data-donasi-transfer' ? 'active' : '' }}">
            <i class="far fa-circle nav-icon"></i>
            <p>Data Donasi Transfer</p>
          </a>
        </li>
        <li class="nav-header">Donasi Barang</li>
        <li class="nav-item">
          <a href="{{ route('create.donasi.barang.admin.yayasan') }}" class="nav-link {{ $active == 'create-donasi-barang' ? 'active' : '' }}">
            <i class="far fa-circle nav-icon"></i>
            <p>Donasi Barang</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ route('donation.goods.admin.yayasan') }}" class="nav-link {{ $active == 'donasi-barang' ? 'active' : '' }}">
            <i class="far fa-circle nav-icon"></i>
            <p>Data Donasi Barang</p>
          </a>
        </li>
        {{-- <li class="nav-item">
          <a href="{{ route('laporan.penggunaan.dana') }}" class="nav-link {{ $active == 'penggunaan-dana' ? 'active' : '' }}">
            <i class="far fa-circle nav-icon"></i>
            <p>Penggunaan Donasi</p>
          </a>
        </li> --}}
      </ul>
    </li>
    <li class="nav-item {{ $active == 'pengeluaran' || $active == 'data-pengeluaran' ? 'menu-open' : '' }}">
      <a href="#" class="nav-link">
        <i class="nav-icon fas fa-file"></i>
        <p>
          Pengeluaran
          <i class="right fas fa-angle-left"></i>
        </p>
      </a>
      <ul class="nav nav-treeview">
        <li class="nav-item">
          <a href="{{ route('pengeluaran') }}" class="nav-link {{ $active == 'pengeluaran' ? 'active' : '' }}">
            <i class="far fa-circle nav-icon"></i>
            <p>Input Pengeluaran</p>
          </a>
        </li>
      </ul>
      <ul class="nav nav-treeview">
        <li class="nav-item">
          <a href="{{ route('data.pengeluaran') }}" class="nav-link {{ $active == 'data-pengeluaran' ? 'active' : '' }}">
            <i class="far fa-circle nav-icon"></i>
            <p>Data Pengeluaran</p>
          </a>
        </li>
      </ul>
    </li>
    <li class="nav-item">
      <a href="{{ route('laporan.pemasukan.pengeluaran') }}" class="nav-link {{ $active == 'laporan' ? 'active' : '' }}">
        <i class="nav-icon fas fa-file"></i>
        <p>
            <p>Laporan Pemasukan & Pengeluaran</p>
        </p>
      </a>
    </li>
    <li class="nav-item">
      <a href="{{ route('pengurus') }}" class="nav-link {{ $active == 'pengurus' ? 'active' : '' }}">
        <i class="nav-icon fas fa-users"></i>
        <p>
          Data Pengurus
        </p>
      </a>
    </li>
    <li class="nav-item {{ $active == 'create-user' ? 'menu-open' : '' }}">
      <a href="#" class="nav-link">
        <i class="nav-icon fas fa-user"></i>
        <p>
          Pengguna
          <i class="right fas fa-angle-left"></i>
        </p>
      </a>
      <ul class="nav nav-treeview">
        <li class="nav-item">
          <a href="{{ route('tambah.pengguna.admin.yayasan') }}" class="nav-link {{ $active == 'create-user' ? 'active' : '' }}">
            <i class="far fa-circle nav-icon"></i>
            <p>Tambah Pengguna</p>
          </a>
        </li>
      </ul>
      <ul class="nav nav-treeview">
        <li class="nav-item">
          <a href="{{ route('data.pengeluaran') }}" class="nav-link {{ $active == 'data-pengeluaran' ? 'active' : '' }}">
            <i class="far fa-circle nav-icon"></i>
            <p>Data Pengeluaran</p>
          </a>
        </li>
      </ul>
    </li>
    {{-- <li class="nav-item {{ $active == 'satuan' ? 'menu-open' : '' }}">
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
    </li> --}}
  </ul>
</nav>