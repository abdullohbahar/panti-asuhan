<div>
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Input Data Pengeluaran Yayasan</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
            <li class="breadcrumb-item active">Input Data Pengeluaran Yayasan</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-10">
                <div class="card">
                    <div class="card-header">
                        &nbsp; Harap menggunakan file template excel jika ingin melakukan import data. Dan baca aturan untuk pengisian.
                        <button class="btn btn-warning mt-2" data-toggle="modal" data-target="#petunjuk"><i class="fas fa-exclamation-triangle"></i> Petunjuk Pengisian</button>
                        <button class="btn btn-info mt-2" wire:click="downloadTemplate"><i class="fas fa-download"></i> Download Template Excel</button>
                        <button class="btn btn-success mt-2" data-toggle="modal" data-target="#import"><i class="fas fa-file-excel"></i> Import Melalui Excel</button>
                    </div>
                    <div class="card-header">
                        <h5>Saldo bulan ini : {{ "Rp. " . number_format($totalSaldo, 2, ',', '.'); }}</h5>
                    </div>
                    <div class="card-body">
                        <form wire:submit.prevent="store">
                            <div class="row">
                                <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                    <div class="form-group">
                                        <label>Tanggal</label>
                                        <input type="date" wire:model="tanggal_donasi" class="form-control @error("tanggal_donasi") is-invalid @enderror" id="">
                                        @error("tanggal_donasi")
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                    <div class="form-group">
                                        <label>Nominal</label>
                                        <input type="text" wire:model="pengeluaran" class="form-control @error("pengeluaran") is-invalid @enderror" id="nominal">
                                        @error("pengeluaran")
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                    <div class="form-group">
                                        <label>Uraian</label>
                                        <textarea wire:model="keterangan" class="form-control @error("keterangan") is-invalid @enderror"></textarea>
                                        @error("keterangan")
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12 mt-3">
                                    <button class="btn btn-success btn-block" wire:loading.attr="disabled">
                                        Submit
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <livewire:import.import-pengeluaran-yayasan>
  </section>
  <!-- /.content -->
</div>

@push('component-scripts')
    <script>
        var rupiah = document.getElementById("nominal");
        rupiah.addEventListener("keyup", function (e) {
            // tambahkan 'Rp.' pada saat form di ketik
            // gunakan fungsi formatRupiah() untuk mengubah angka yang di ketik menjadi format angka
            rupiah.value = formatRupiah(this.value, "Rp. ");
        });

        /* Fungsi formatRupiah */
        function formatRupiah(angka, prefix) {
            var number_string = angka.replace(/[^,\d]/g, "").toString(),
                split = number_string.split(","),
                sisa = split[0].length % 3,
                rupiah = split[0].substr(0, sisa),
                ribuan = split[0].substr(sisa).match(/\d{3}/gi);

            // tambahkan titik jika yang di input sudah menjadi angka ribuan
            if (ribuan) {
                separator = sisa ? "." : "";
                rupiah += separator + ribuan.join(".");
            }

            rupiah = split[1] != undefined ? rupiah + "," + split[1] : rupiah;
            return prefix == undefined ? rupiah : rupiah ? "Rp. " + rupiah : "";
        }

    </script>
@endpush