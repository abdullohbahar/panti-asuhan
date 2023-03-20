<div class="row">
  <!-- ./col -->
  <div class="col-lg-3 col-6">
    <!-- small box -->
    <div class="small-box bg-info" onclick="window.location='/data-pemasukan-lksa'">
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
    <div class="small-box bg-success" onclick="window.location='/data-pengeluaran-lksa'">
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