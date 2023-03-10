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
    <li class="nav-item {{ $active == 'santri-dalam' || $active == 'santri-luar' || $active == 'create-santri' ? 'menu-open' : '' }}">
      <a href="#" class="nav-link">
        <i class="nav-icon fas fa-users"></i>
        <p>
          Santri
          <i class="right fas fa-angle-left"></i>
        </p>
      </a>
      <ul class="nav nav-treeview">
        <li class="nav-item ml-2">
          <a href="{{ route('create.santri') }}" class="nav-link {{ $active == 'create-santri' ? 'active' : '' }}">
            <i class="nav-icon far fa-circle"></i>
            <p>
              Tambah Santri
            </p>
          </a>
        </li>
        <li class="nav-item ml-2">
          <a href="{{ route('santri.dalam') }}" class="nav-link {{ $active == 'santri-dalam' ? 'active' : '' }}">
            <i class="nav-icon far fa-circle"></i>
            <p>
              Data Santri Dalam
            </p>
          </a>
        </li>
        <li class="nav-item ml-2">
          <a href="{{ route('santri.luar') }}" class="nav-link {{ $active == 'santri-luar' ? 'active' : '' }}">
            <i class="nav-icon far fa-circle"></i>
            <p>
              Data Santri Luar
            </p>
          </a>
        </li>
      </ul>
    </li>
    <li class="nav-item {{ $active == 'citizens' || $active == 'create-citizen' || $active == 'data-warga-meninggal' || $active == 'data-warga-dhuafa' || $active == 'data-warga-jamaah' || $active == 'data-warga-fakir-miskin' || $active == 'data-warga-jompo' || $active == 'create-citizen' ? 'menu-open' : '' }}">
      <a href="#" class="nav-link">
        <i class="nav-icon fas fa-users"></i>
        <p>
          Warga
          <i class="right fas fa-angle-left"></i>
        </p>
      </a>
      <ul class="nav nav-treeview">
        <li class="nav-item ml-2">
          <a href="{{ route('create.citizen') }}" class="nav-link {{ $active == 'create-citizen' ? 'active' : '' }}">
            <i class="nav-icon far fa-circle"></i>
            <p>
              Tambah Warga
            </p>
          </a>
        </li>
        <li class="nav-item ml-2">
          <a href="{{ route('data.warga.dhuafa') }}" class="nav-link {{ $active == 'data-warga-dhuafa' ? 'active' : '' }}">
            <i class="nav-icon far fa-circle"></i>
            <p>
              Dhuafa
            </p>
          </a>
        </li>
        <li class="nav-item ml-2">
          <a href="{{ route('data.warga.fakir.miskin') }}" class="nav-link {{ $active == 'data-warga-fakir-miskin' ? 'active' : '' }}">
            <i class="nav-icon far fa-circle"></i>
            <p>
              Fakir Miskin
            </p>
          </a>
        </li>
        <li class="nav-item ml-2">
          <a href="{{ route('data.warga.jompo') }}" class="nav-link {{ $active == 'data-warga-jompo' ? 'active' : '' }}">
            <i class="nav-icon far fa-circle"></i>
            <p>
              Jompo
            </p>
          </a>
        </li>
        <li class="nav-item ml-2">
          <a href="{{ route('data.warga.jamaah') }}" class="nav-link {{ $active == 'data-warga-jamaah' ? 'active' : '' }}">
            <i class="nav-icon far fa-circle"></i>
            <p>
              Jamaah
            </p>
          </a>
        </li>
        <li class="nav-item ml-2">
          <a href="{{ route('data.warga.meninggal') }}" class="nav-link {{ $active == 'data-warga-meninggal' ? 'active' : '' }}">
            <i class="nav-icon far fa-circle"></i>
            <p>
              Meninggal
            </p>
          </a>
        </li>
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
        <li class="nav-item ml-2">
          <a href="{{ route('donatur') }}" class="nav-link {{ $active == 'donatur' ? 'active' : '' }}">
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
    <li class="nav-item {{ $active == 'pengeluaran' || $active == 'data-pengeluaran' ? 'menu-open' : '' }}">
      <a href="#" class="nav-link">
        <i class="nav-icon fas fa-file"></i>
        <p>
          Pengeluaran
          <i class="right fas fa-angle-left"></i>
        </p>
      </a>
      <ul class="nav nav-treeview">
        <li class="nav-item ml-2">
          <a href="{{ route('pengeluaran') }}" class="nav-link {{ $active == 'pengeluaran' ? 'active' : '' }}">
            <i class="far fa-circle nav-icon"></i>
            <p>Input Pengeluaran</p>
          </a>
        </li>
      </ul>
      <ul class="nav nav-treeview">
        <li class="nav-item ml-2">
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
    <li class="nav-item {{ $active == 'lksa-document' || $active == 'yayasan-document' ? 'menu-open' : '' }}">
      <a href="#" class="nav-link">
        <i class="nav-icon fas fa-file"></i>
        <p>
          Dokumen
          <i class="right fas fa-angle-left"></i>
        </p>
      </a>
      <ul class="nav nav-treeview">
        <li class="nav-item ml-2">
          <a href="{{ route('lksa.document') }}" class="nav-link {{ $active == 'lksa-document' ? 'active' : '' }}">
            <i class="far fa-circle nav-icon"></i>
            <p>Dokumen LKSA</p>
          </a>
        </li>
      </ul>
      <ul class="nav nav-treeview">
        <li class="nav-item ml-2">
          <a href="{{ route('yayasan.document') }}" class="nav-link {{ $active == 'yayasan-document' ? 'active' : '' }}">
            <i class="far fa-circle nav-icon"></i>
            <p>Dokumen Yayasan</p>
          </a>
        </li>
      </ul>
    </li>
    <li class="nav-item {{ $active == 'create-user' || $active == 'data-user' ? 'menu-open' : '' }}">
      <a href="#" class="nav-link">
        <i class="nav-icon fas fa-user"></i>
        <p>
          Pengguna
          <i class="right fas fa-angle-left"></i>
        </p>
      </a>
      <ul class="nav nav-treeview">
        <li class="nav-item ml-2">
          <a href="{{ route('tambah.pengguna') }}" class="nav-link {{ $active == 'create-user' ? 'active' : '' }}">
            <i class="far fa-circle nav-icon"></i>
            <p>Tambah Pengguna</p>
          </a>
        </li>
      </ul>
      <ul class="nav nav-treeview">
        <li class="nav-item ml-2">
          <a href="{{ route('data.pengguna') }}" class="nav-link {{ $active == 'data-user' ? 'active' : '' }}">
            <i class="far fa-circle nav-icon"></i>
            <p>Data Pengguna</p>
          </a>
        </li>
      </ul>
    </li>
  </ul>
</nav>