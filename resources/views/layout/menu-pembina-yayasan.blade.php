<nav class="mt-2">
  <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
    <!-- Add icons to the links using the .nav-icon class
       with font-awesome or any other icon font library -->
    <li class="nav-item">
      <a href="{{ route('dashboard.pembina.yayasan') }}" class="nav-link {{ $active == 'dashboard' ? 'active' : '' }}">
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
          <a href="{{ route('santri.dalam.pembina.yayasan') }}" class="nav-link {{ $active == 'santri-dalam' ? 'active' : '' }}">
            <i class="nav-icon far fa-circle"></i>
            <p>
              Data Santri Dalam
            </p>
          </a>
        </li>
        <li class="nav-item ml-2">
          <a href="{{ route('santri.luar.pembina.yayasan') }}" class="nav-link {{ $active == 'santri-luar' ? 'active' : '' }}">
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
        <li class="nav-item ml-2">
          <a href="{{ route('donation.tunai') }}" class="nav-link {{ $active == 'data-donasi-tunai' ? 'active' : '' }}">
            <i class="far fa-circle nav-icon"></i>
            <p>Data Donasi Tunai</p>
          </a>
        </li>
        <li class="nav-header">Donasi Transfer</li>
        <li class="nav-item ml-2">
          <a href="{{ route('data.donasi.transfer') }}" class="nav-link {{ $active == 'data-donasi-transfer' ? 'active' : '' }}">
            <i class="far fa-circle nav-icon"></i>
            <p>Data Donasi Transfer</p>
          </a>
        </li>
        <li class="nav-header">Donasi Barang</li>
        <li class="nav-item ml-2">
          <a href="{{ route('donation.goods') }}" class="nav-link {{ $active == 'donasi-barang' ? 'active' : '' }}">
            <i class="far fa-circle nav-icon"></i>
            <p>Data Donasi Barang</p>
          </a>
        </li>
      </ul>
    </li>
    <li class="nav-item {{ $active == 'pengeluaran' || $active == 'data-pengeluaran' || $active == 'laporan' ? 'menu-open' : '' }}">
      <a href="#" class="nav-link">
        <i class="nav-icon fas fa-hand-holding-usd"></i>
        <p>
          Keuangan Yayasan
          <i class="right fas fa-angle-left"></i>
        </p>
      </a>
      <ul class="nav nav-treeview">
        <li class="nav-item ml-2">
          <a href="{{ route('data.pengeluaran') }}" class="nav-link {{ $active == 'data-pengeluaran' ? 'active' : '' }}">
            <i class="far fa-circle nav-icon"></i>
            <p>Data Pengeluaran</p>
          </a>
        </li>
      </ul>
      <ul class="nav nav-treeview">
        <li class="nav-header">Laporan</li>
        <li class="nav-item ml-2">
          <a href="{{ route('laporan.pemasukan.pengeluaran') }}" class="nav-link {{ $active == 'laporan' ? 'active' : '' }}">
            <i class="far fa-circle nav-icon"></i>
            <p>Laporan Pemasukan & Pengeluaran</p>
          </a>
        </li>
      </ul>
    </li>
    <li class="nav-item {{ $active == 'outcome-lksa' || $active == 'income-and-expense-report' || $active == 'income-lksa' || $active == 'data-income-lksa' || $active == 'data-outcome-lksa' ? 'menu-open' : '' }}">
      <a href="#" class="nav-link">
        <i class="nav-icon fas fa-hand-holding-usd"></i>
        <p>
          Keuangan LKSA
          <i class="right fas fa-angle-left"></i>
        </p>
      </a>
      <ul class="nav nav-treeview">
        <li class="nav-header">Pemasukan</li>
      </ul>
      <ul class="nav nav-treeview">
        <li class="nav-item ml-2">
          <a href="{{ route('data.income.lksa') }}" class="nav-link {{ $active == 'data-income-lksa' ? 'active' : '' }}">
            <i class="far fa-circle nav-icon"></i>
            <p>Data Pemasukan</p>
          </a>
        </li>
      </ul>
      <ul class="nav nav-treeview">
        <li class="nav-item ml-2">
          <a href="{{ route('data.outcome.lksa') }}" class="nav-link {{ $active == 'data-outcome-lksa' ? 'active' : '' }}">
            <i class="far fa-circle nav-icon"></i>
            <p>Data Pengeluaran</p>
          </a>
        </li>
      </ul>
      <ul class="nav nav-treeview">
        <li class="nav-header">Laporan</li>
        <li class="nav-item ml-2">
          <a href="{{ route('data.income.outcome.lksa') }}" class="nav-link {{ $active == 'income-and-expense-report' ? 'active' : '' }}">
            <i class="far fa-circle nav-icon"></i>
            <p>Laporan Pemasukan & Pengeluaran</p>
          </a>
        </li>
      </ul>
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
    <li class="nav-item {{ $active == 'create-letter-yayasan' || $active == 'data-letter-yayasan' || $active == 'data-outcome-letter-yayasan' ? 'menu-open' : '' }}">
      <a href="#" class="nav-link">
        <i class="nav-icon fas fa-envelope"></i>
        <p>
          Surat Masuk & Keluar Yayasan
          <i class="right fas fa-angle-left"></i>
        </p>
      </a>
      <ul class="nav nav-treeview">
        <li class="nav-item ml-2">
          <a href="{{ route('data.incoming.letter.yayasan') }}" class="nav-link {{ $active == 'data-letter-yayasan' ? 'active' : '' }}">
            <i class="far fa-circle nav-icon"></i>
            <p>Surat Masuk</p>
          </a>
        </li>
      </ul>
      <ul class="nav nav-treeview">
        <li class="nav-item ml-2">
          <a href="{{ route('data.outcome.letter.yayasan') }}" class="nav-link {{ $active == 'data-outcome-letter-yayasan' ? 'active' : '' }}">
            <i class="far fa-circle nav-icon"></i>
            <p>Surat Keluar</p>
          </a>
        </li>
      </ul>
    </li>
    <li class="nav-item {{ $active == 'create-letter-lksa' || $active == 'data-letter-lksa' || $active == 'data-outcome-letter-lksa' ? 'menu-open' : '' }}">
      <a href="#" class="nav-link">
        <i class="nav-icon fas fa-envelope"></i>
        <p>
          Surat Masuk & Keluar LKSA
          <i class="right fas fa-angle-left"></i>
        </p>
      </a>
      <ul class="nav nav-treeview">
        <li class="nav-item ml-2">
          <a href="{{ route('data.incoming.letter.lksa') }}" class="nav-link {{ $active == 'data-letter-lksa' ? 'active' : '' }}">
            <i class="far fa-circle nav-icon"></i>
            <p>Surat Masuk</p>
          </a>
        </li>
      </ul>
      <ul class="nav nav-treeview">
        <li class="nav-item ml-2">
          <a href="{{ route('data.outcome.letter.lksa') }}" class="nav-link {{ $active == 'data-outcome-letter-lksa' ? 'active' : '' }}">
            <i class="far fa-circle nav-icon"></i>
            <p>Surat Keluar</p>
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
          <a href="{{ route('data.pengguna') }}" class="nav-link {{ $active == 'data-user' ? 'active' : '' }}">
            <i class="far fa-circle nav-icon"></i>
            <p>Data Pengguna</p>
          </a>
        </li>
      </ul>
    </li>
    <li class="nav-item {{ $active == 'master-data-pendidikan' ? 'menu-open' : '' }}">
      <a href="#" class="nav-link">
        <i class="nav-icon fas fa-server"></i>
        <p>
          Master Data
          <i class="right fas fa-angle-left"></i>
        </p>
      </a>
      <ul class="nav nav-treeview">
        <li class="nav-item ml-2">
          <a href="{{ route('master.data.pendidikan') }}" class="nav-link {{ $active == 'master-data-pendidikan' ? 'active' : '' }}">
            <i class="far fa-circle nav-icon"></i>
            <p>Pendidikan</p>
          </a>
        </li>
      </ul>
      <ul class="nav nav-treeview">
        <li class="nav-item ml-2">
          <a href="{{ route('master.data.position') }}" class="nav-link {{ $active == 'master-data-position' ? 'active' : '' }}">
            <i class="far fa-circle nav-icon"></i>
            <p>Jabatan</p>
          </a>
        </li>
      </ul>
    </li>
  </ul>
</nav>