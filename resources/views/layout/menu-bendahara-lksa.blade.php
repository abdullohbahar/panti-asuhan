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