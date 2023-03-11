<div>
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Input Pemasukan LKSA</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
            <li class="breadcrumb-item active">Input Pemasukan LKSA</li>
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
                        <h5>Saldo bulan ini : {{ "Rp. " . number_format($totalSaldo, 2, ',', '.'); }}</h5>
                    </div>
                    <div class="card-body">
                        <form wire:submit.prevent="store">
                            <div class="row">
                                <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                    <div class="form-group">
                                        <label>Tanggal</label>
                                        <input type="date" wire:model="tanggal" class="form-control @error("tanggal") is-invalid @enderror" id="">
                                        @error("tanggal")
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                    <div class="form-group">
                                        <label>Nominal</label>
                                        <input type="text" wire:model="pemasukan" class="form-control @error("pemasukan") is-invalid @enderror" id="nominal">
                                        @error("pemasukan")
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6">
                                    <div class="form-group">
                                        <label>Terbilang</label>
                                        <textarea class="form-control" wire:model="terbilang" id="terbilang" ></textarea>
                                        {{-- <input type="text" id="terbilang" wire:model="terbilang" class="form-control @error("terbilang") is-invalid @enderror"> --}}
                                        @error("terbilang")
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
  </section>
  <!-- /.content -->
</div>

@push('component-scripts')
    <script src="https://unpkg.com/@develoka/angka-terbilang-js/index.min.js"></script>
    <script>
        var rupiah = document.getElementById("nominal");
        rupiah.addEventListener("keyup", function (e) {
            // tambahkan 'Rp.' pada saat form di ketik
            // gunakan fungsi formatRupiah() untuk mengubah angka yang di ketik menjadi format angka
            rupiah.value = formatRupiah(this.value, "Rp. ");
        });

        $("body").on("keyup","#nominal",() => {
            var val = $("#nominal").val()
            var angka = val.replace(/,.*|[^0-9]/g, '')
            var terbilang = angkaTerbilang(angka)
            @this.terbilang = terbilang + ' rupiah'
            $("#terbilang").val(terbilang)
        })

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