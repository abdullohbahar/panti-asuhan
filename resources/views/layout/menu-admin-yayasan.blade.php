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
    <li class="nav-item {{ $active == 'create-agenda' || $active == 'data-agenda' ? 'menu-open' : '' }}">
      <a href="#" class="nav-link">
        <i class="nav-icon fas fa-users"></i>
        <p>
          Agenda Kegiatan
          <i class="right fas fa-angle-left"></i>
        </p>
      </a>
      <ul class="nav nav-treeview">
        <li class="nav-item ml-2">
          <a href="{{ route('create.agenda.kegiatan') }}" class="nav-link {{ $active == 'create-santri' ? 'active' : '' }}">
            <i class="nav-icon far fa-circle"></i>
            <p>
              Tambah Agenda Kegiatan
            </p>
          </a>
        </li>
        <li class="nav-item ml-2">
          <a href="{{ route('data.agenda.kegiatan') }}" class="nav-link {{ $active == 'data-agenda' ? 'active' : '' }}">
            <i class="nav-icon far fa-circle"></i>
            <p>
              Data Agenda Kegiatan
            </p>
          </a>
        </li>
      </ul>
    </li>
    <li class="nav-item {{ $active == 'santri-dalam' || $active == 'santri-luar' || $active == 'alumni' || $active == 'create-santri' ? 'menu-open' : '' }}">
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
        <li class="nav-item ml-2">
          <a href="{{ route('santri.alumni') }}" class="nav-link {{ $active == 'alumni' ? 'active' : '' }}">
            <i class="nav-icon far fa-circle"></i>
            <p>
              Data Alumni Santri
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
    <li class="nav-item {{ $active == 'pengurus' || $active == 'create-pengurus' || $active == 'show' || $active == 'data-pengurus-meninggal' || $active == 'data-pengurus-mengundurkan-diri' ? 'menu-open' : '' }}">
      <a href="#" class="nav-link">
        <i class="nav-icon fas fa-users"></i>
        <p>
          Pengurus
          <i class="right fas fa-angle-left"></i>
        </p>
      </a>
      <ul class="nav nav-treeview">
        <li class="nav-item ml-2">
          <a href="{{ route('tambah.pengurus') }}" class="nav-link {{ $active == 'create-pengurus' ? 'active' : '' }}">
            <i class="nav-icon far fa-circle"></i>
            <p>
              Tambah Pengurus
            </p>
          </a>
        </li>
        <li class="nav-item ml-2">
          <a href="{{ route('pengurus') }}" class="nav-link {{ $active == 'pengurus' ? 'active' : '' }}">
            <i class="nav-icon far fa-circle"></i>
            <p>
              Pengurus Aktif
            </p>
          </a>
        </li>
        <li class="nav-item ml-2">
          <a href="{{ route('data.pengurus.mengundurkan.diri') }}" class="nav-link {{ $active == 'data-pengurus-mengundurkan-diri' ? 'active' : '' }}">
            <i class="nav-icon far fa-circle"></i>
            <p>
              Mengundurkan Diri
            </p>
          </a>
        </li>
        <li class="nav-item ml-2">
          <a href="{{ route('data.pengurus.meninggal') }}" class="nav-link {{ $active == 'data-pengurus-meninggal' ? 'active' : '' }}">
            <i class="nav-icon far fa-circle"></i>
            <p>
              Pengurus Meninggal
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
    <li class="nav-item {{ $active == 'create-letter-yayasan' || $active == 'data-penomoran-surat-yayasan' || $active == 'create-penomoran-surat-yayasan' || $active == 'data-letter-yayasan' || $active == 'create-outgoing-letter-yayasan' || $active == 'data-outcome-letter-yayasan' ? 'menu-open' : '' }}">
      <a href="#" class="nav-link">
        <i class="nav-icon fas fa-envelope"></i>
        <p>
          Surat Yayasan
          <i class="right fas fa-angle-left"></i>
        </p>
      </a>
      <ul class="nav nav-treeview">
        <li class="nav-header">Surat Masuk</li>
        <li class="nav-item ml-2">
          <a href="{{ route('create.letter.yayasan') }}" class="nav-link {{ $active == 'create-letter-yayasan' ? 'active' : '' }}">
            <i class="far fa-circle nav-icon"></i>
            <p>Tambah Surat Masuk</p>
          </a>
        </li>
      </ul>
      <ul class="nav nav-treeview">
        <li class="nav-item ml-2">
          <a href="{{ route('data.incoming.letter.yayasan') }}" class="nav-link {{ $active == 'data-letter-yayasan' ? 'active' : '' }}">
            <i class="far fa-circle nav-icon"></i>
            <p>Surat Masuk</p>
          </a>
        </li>
      </ul>
      <ul class="nav nav-treeview">
        <li class="nav-header">Penomoran Surat</li>
        <li class="nav-item ml-2">
          <a href="{{ route('create.numbering.letter.yayasan') }}" class="nav-link {{ $active == 'create-penomoran-surat-yayasan' ? 'active' : '' }}">
            <i class="far fa-circle nav-icon"></i>
            <p>Tambah Penomoran Surat</p>
          </a>
        </li>
      </ul>
      <ul class="nav nav-treeview">
        <li class="nav-item ml-2">
          <a href="{{ route('data.numbering.letter.yayasan') }}" class="nav-link {{ $active == 'data-penomoran-surat-yayasan' ? 'active' : '' }}">
            <i class="far fa-circle nav-icon"></i>
            <p>Data Penomoran Surat</p>
          </a>
        </li>
      </ul>
      {{-- <ul class="nav nav-treeview">
        <li class="nav-header">Surat Keluar</li>
        <li class="nav-item ml-2">
          <a href="{{ route('create.outgoing.letter.yayasan') }}" class="nav-link {{ $active == 'create-outgoing-letter-yayasan' ? 'active' : '' }}">
            <i class="far fa-circle nav-icon"></i>
            <p>Tambah Surat Keluar</p>
          </a>
        </li>
        <li class="nav-item ml-2">
          <a href="{{ route('data.outcome.letter.yayasan') }}" class="nav-link {{ $active == 'data-outcome-letter-yayasan' ? 'active' : '' }}">
            <i class="far fa-circle nav-icon"></i>
            <p>Surat Keluar</p>
          </a>
        </li>
      </ul> --}}
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
    <li class="nav-item {{ $active == 'master-data-pendidikan' || $active == 'master-data-position' ? 'menu-open' : '' }}">
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