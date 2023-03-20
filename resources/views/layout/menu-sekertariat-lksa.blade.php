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
          <a href="{{ route('create.letter.lksa') }}" class="nav-link {{ $active == 'create-letter-lksa' ? 'active' : '' }}">
            <i class="far fa-circle nav-icon"></i>
            <p>Tambah Surat</p>
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
        <li class="nav-item ml-2">
          <a href="{{ route('data.outcome.letter.lksa') }}" class="nav-link {{ $active == 'data-outcome-letter-lksa' ? 'active' : '' }}">
            <i class="far fa-circle nav-icon"></i>
            <p>Surat Keluar</p>
          </a>
        </li>
      </ul>
    </li>
  </ul>
</nav>