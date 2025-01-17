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
    <li class="nav-item {{ $active == 'data-warga-dusun' || $active == 'citizens' || $active == 'create-citizen' || $active == 'data-warga-meninggal' || $active == 'data-warga-dhuafa' || $active == 'data-warga-jamaah' || $active == 'data-warga-fakir-miskin' || $active == 'data-warga-jompo' || $active == 'create-citizen' ? 'menu-open' : '' }}">
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
        <li class="nav-item ml-2">
          <a href="{{ route('data.warga.dusun') }}" class="nav-link {{ $active == 'data-warga-dusun' ? 'active' : '' }}">
            <i class="nav-icon far fa-circle"></i>
            <p>
              Dusun
            </p>
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
    </li>
    <li class="nav-item {{ $active == 'create-letter-lksa' || $active == 'data-penomoran-surat-lksa' || $active == 'create-penomoran-surat-lksa' || $active == 'create-outgoing-letter-lksa' || $active == 'data-letter-lksa' || $active == 'data-outcome-letter-lksa' ? 'menu-open' : '' }}">
      <a href="#" class="nav-link">
        <i class="nav-icon fas fa-envelope"></i>
        <p>
          Surat LKSA
          <i class="right fas fa-angle-left"></i>
        </p>
      </a>
      <ul class="nav nav-treeview">
        <li class="nav-header">Surat Masuk</li>
        <li class="nav-item ml-2">
          <a href="{{ route('create.letter.lksa') }}" class="nav-link {{ $active == 'create-letter-lksa' ? 'active' : '' }}">
            <i class="far fa-circle nav-icon"></i>
            <p>Tambah Surat Masuk</p>
          </a>
        </li>
      </ul>
      <ul class="nav nav-treeview">
        <li class="nav-item ml-2">
          <a href="{{ route('data.incoming.letter.lksa') }}" class="nav-link {{ $active == 'data-letter-lksa' ? 'active' : '' }}">
            <i class="far fa-circle nav-icon"></i>
            <p>Surat Masuk</p>
          </a>
        </li>
      </ul>
      <ul class="nav nav-treeview">
        <li class="nav-header">Penomoran Surat</li>
        <li class="nav-item ml-2">
          <a href="{{ route('create.numbering.letter.lksa') }}" class="nav-link {{ $active == 'create-penomoran-surat-lksa' ? 'active' : '' }}">
            <i class="far fa-circle nav-icon"></i>
            <p>Tambah Penomoran Surat</p>
          </a>
        </li>
      </ul>
      <ul class="nav nav-treeview">
        <li class="nav-item ml-2">
          <a href="{{ route('data.numbering.letter.lksa') }}" class="nav-link {{ $active == 'data-penomoran-surat-lksa' ? 'active' : '' }}">
            <i class="far fa-circle nav-icon"></i>
            <p>Data Penomoran Surat</p>
          </a>
        </li>
      </ul>
    </li>
  </ul>
</nav>