<div>
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Dashboard</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
            <li class="breadcrumb-item active">Dashboard</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
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
          <div class="small-box bg-warning" onclick="window.location='/data-pengeluaran'">
            <div class="inner">
              <h4>{{ "Rp " . number_format($pengeluaran, 2, ',', '.'); }}</h4>
              <p>Total Pengeluaran Bulan Ini</p>
            </div>
            <div class="icon">
              <i class="fas fa-hand-holding-usd"></i>
            </div>
            <a href="#" class="small-box-footer"></a>
          </div>
        </div>
        <!-- ./col -->
      </div>
    </div>
  </section>
  <!-- /.content -->
</div>