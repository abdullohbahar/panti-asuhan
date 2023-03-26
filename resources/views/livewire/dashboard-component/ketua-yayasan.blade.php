<div class="row">
    <div class="col-lg-3 col-6">
      <!-- small box -->
      <div class="small-box bg-info" onclick="window.location='data-santri-dalam'">
        <div class="inner">
          <h4>{{ $santriDalam }}</h4>
          <p>Santri Dalam</p>
        </div>
        <div class="icon">
          <i class="fas fa-users"></i>
        </div>
        <a href="#" class="small-box-footer"></a>
      </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-6">
      <!-- small box -->
      <div class="small-box bg-success" onclick="window.location='data-santri-luar'">
        <div class="inner">
          <h4>{{ $santriLuar }}</h4>
          <p>Santri Luar</p>
        </div>
        <div class="icon">
          <i class="fas fa-users"></i>
        </div>
        <a href="#" class="small-box-footer"></a>
      </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-6">
      <!-- small box -->
      <div class="small-box bg-warning" onclick="window.location='donatur'">
        <div class="inner">
          <h4>{{ $total_donatur }}</h4>
          <p>Total Donatur</p>
        </div>
        <div class="icon">
          <i class="fas fa-users"></i>
        </div>
        <a href="#" class="small-box-footer"></a>
      </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-6">
      <!-- small box -->
      <div class="small-box bg-danger" onclick="window.location='/pengurus'">
        <div class="inner">
          <h4>{{ $pengurus }}</h4>
          <p>Total Pengurus</p>
        </div>
        <div class="icon">
          <i class="fas fa-users"></i>
        </div>
        <a href="#" class="small-box-footer"></a>
      </div>
    </div>
    {{-- Data warga --}}
    <div class="col-lg-3 col-6">
      <!-- small box -->
      <div class="small-box bg-info" onclick="window.location='data-warga-dhuafa'">
        <div class="inner">
          <h4>{{ $wargaDhuafa }}</h4>
          <p>Warga Dhuafa</p>
        </div>
        <div class="icon">
          <i class="fas fa-users"></i>
        </div>
        <a href="#" class="small-box-footer"></a>
      </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-6">
      <!-- small box -->
      <div class="small-box bg-success" onclick="window.location='data-warga-fakir-miskin'">
        <div class="inner">
          <h4>{{ $wargaFakirMiskin }}</h4>
          <p>Warga Fakir Miskin</p>
        </div>
        <div class="icon">
          <i class="fas fa-users"></i>
        </div>
        <a href="#" class="small-box-footer"></a>
      </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-6">
      <!-- small box -->
      <div class="small-box bg-warning" onclick="window.location='data-warga-jompo'">
        <div class="inner">
          <h4>{{ $wargaJompo }}</h4>
          <p>Warga Jompo</p>
        </div>
        <div class="icon">
          <i class="fas fa-users"></i>
        </div>
        <a href="#" class="small-box-footer"></a>
      </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-6">
      <!-- small box -->
      <div class="small-box bg-danger" onclick="window.location='data-warga-jamaah'">
        <div class="inner">
          <h4>{{ $wargaJamaah }}</h4>
          <p>Warga Jamaah</p>
        </div>
        <div class="icon">
          <i class="fas fa-users"></i>
        </div>
        <a href="#" class="small-box-footer"></a>
      </div>
    </div>
    <div class="col-lg-3 col-6">
      <!-- small box -->
      <div class="small-box bg-info" onclick="window.location='data-warga-meninggal'">
        <div class="inner">
          <h4>{{ $wargaMeninggal }}</h4>
          <p>Warga Meninggal</p>
        </div>
        <div class="icon">
          <i class="fas fa-users"></i>
        </div>
        <a href="#" class="small-box-footer"></a>
      </div>
    </div>
    <div class="col-lg-3 col-6">
      <!-- small box -->
      <div class="small-box bg-success" onclick="window.location='data-warga-dusun'">
        <div class="inner">
          <h4>{{ $wargaDusun }}</h4>
          <p>Warga Dusun</p>
        </div>
        <div class="icon">
          <i class="fas fa-users"></i>
        </div>
        <a href="#" class="small-box-footer"></a>
      </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-3 col-6">
      <!-- small box -->
      <div class="small-box bg-info" onclick="window.location='data-donasi-tunai'">
        <div class="inner">
          <h4>{{ "Rp " . number_format($donasiTunai, 2, ',', '.'); }}</h4>
          <p>Total Donasi Tunai Bulan Ini</p>
        </div>
        <div class="icon">
          <i class="fas fa-hand-holding-usd"></i>
        </div>
        <a href="#" class="small-box-footer"></a>
      </div>
    </div>
    <div class="col-lg-3 col-6">
      <!-- small box -->
      <div class="small-box bg-success" onclick="window.location='data-donasi-transfer'">
        <div class="inner">
          <h4>{{ "Rp " . number_format($donasiTransfer, 2, ',', '.'); }}</h4>
          <p>Total Donasi Transfer Bulan Ini</p>
        </div>
        <div class="icon">
          <i class="fas fa-hand-holding-usd"></i>
        </div>
        <a href="#" class="small-box-footer"></a>
      </div>
    </div>
    <div class="col-lg-3 col-6">
    <!-- small box -->
      <div class="small-box bg-warning" onclick="window.location='donasi-barang'">
        <div class="inner">
          <h4>{{ $donasiBarang }}</h4>
          <p>Total Donasi Barang Bulan Ini</p>
        </div>
        <div class="icon">
          <i class="fas fa-boxes"></i>
        </div>
        <a href="#" class="small-box-footer"></a>
      </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-3 col-6">
      <!-- small box -->
      <div class="small-box bg-info" onclick="window.location='/data-pengeluaran'">
        <div class="inner">
          <h4>{{ "Rp " . number_format($pengeluaran, 2, ',', '.'); }}</h4>
          <p>Total Pengeluaran Yayasan Bulan Ini</p>
        </div>
        <div class="icon">
          <i class="fas fa-hand-holding-usd"></i>
        </div>
        <a href="#" class="small-box-footer"></a>
      </div>
    </div>
    <div class="col-lg-3 col-6">
      <!-- small box -->
      <div class="small-box bg-success" onclick="window.location='/data-pemasukan-lksa'">
        <div class="inner">
          <h4>{{ "Rp " . number_format($pemaskuanLKSA, 2, ',', '.'); }}</h4>
          <p>Total Pemasukan LKSA Bulan Ini</p>
        </div>
        <div class="icon">
          <i class="fas fa-hand-holding-usd"></i>
        </div>
        <a href="#" class="small-box-footer"></a>
      </div>
    </div>
    <div class="col-lg-3 col-6">
      <!-- small box -->
      <div class="small-box bg-warning" onclick="window.location='/data-pengeluaran-lksa'">
        <div class="inner">
          <h4>{{ "Rp " . number_format($pengeluaranLKSA, 2, ',', '.'); }}</h4>
          <p>Total Pengeluaran LKSA Bulan Ini</p>
        </div>
        <div class="icon">
          <i class="fas fa-hand-holding-usd"></i>
        </div>
        <a href="#" class="small-box-footer"></a>
      </div>
    </div>
    <!-- ./col -->
  </div>