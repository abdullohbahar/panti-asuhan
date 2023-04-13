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
        <li class="nav-header">Pengeluaran</li>
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
        <li class="nav-item ml-2">
          <a href="{{ route('income.lksa') }}" class="nav-link {{ $active == 'income-lksa' ? 'active' : '' }}">
            <i class="far fa-circle nav-icon"></i>
            <p>Input Pemasukan</p>
          </a>
        </li>
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
        <li class="nav-header">Pengeluaran</li>
        <li class="nav-item ml-2">
          <a href="{{ route('outcome.lksa') }}" class="nav-link {{ $active == 'outcome-lksa' ? 'active' : '' }}">
            <i class="far fa-circle nav-icon"></i>
            <p>Input Pengeluaran</p>
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
  </ul>
</nav>