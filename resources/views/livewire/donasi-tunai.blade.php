<div>
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Donasi Tunai</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
            <li class="breadcrumb-item active">Donasi Tunai</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid chocolat-open">
        <div class="card">
            <div class="card-header">
            </div>
            <div class="card-body">
                <form wire:submit.prevent="store">
                    <div class="row">
                        <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6">
                            <div class="form-group">
                                <label for="">Nama Donatur</label>
                                <select name="donatur_id" wire:model="donatur_id" style="width: 100%" class="form-control select2 @error('donatur_id') is-invalid @enderror">
                                    <option>-- Pilih Donatur --</option>
                                    @foreach ($donaturs as $donatur)
                                        <option value="{{ $donatur->id }}">{{ $donatur->nama }}</option>
                                    @endforeach
                                </select>
                                @error('donatur_id')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6">
                            <div class="form-group">
                                <label>Tanggal Donasi</label>
                                <input type="date" wire:model="tanggal_donasi" class="form-control @error("tanggal_donasi") is-invalid @enderror" id="">
                                @error("tanggal_donasi")
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12 my-2">
                            <h5>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" wire:model="tipe" id="Zakat" value="Zakat">
                                    <label class="form-check-label" for="Zakat">Zakat</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" wire:model="tipe" id="Infaq" value="Infaq">
                                    <label class="form-check-label" for="Infaq">Infaq</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" wire:model="tipe" id="Sodaqoh" value="Sodaqoh">
                                    <label class="form-check-label" for="Sodaqoh">Sodaqoh</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" wire:model="tipe" id="Lain-lain" value="Lain-lain">
                                    <label class="form-check-label" for="Lain-lain">Lain-lain</label>
                                </div>
                            </h5>
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6">
                            <div class="form-group">
                                <label>Nominal</label>
                                <input type="text" wire:model="nominal" class="form-control @error("nominal") is-invalid @enderror" id="nominal">
                                @error("nominal")
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6">
                            <div class="form-group">
                                <label>Terbilang</label>
                                <input type="text" wire:model="terbilang" class="form-control @error("terbilang") is-invalid @enderror">
                                @error("terbilang")
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                            <div class="form-group">
                                <label>Hajat</label>
                                <textarea type="text" wire:model="hajat" class="form-control @error("hajat") is-invalid @enderror"></textarea>
                                @error("hajat")
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                            <div class="form-group">
                                <label>Keterangan</label>
                                <textarea type="text" wire:model="keterangan" class="form-control @error("keterangan") is-invalid @enderror"></textarea>
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
  </section>
  <!-- /.content -->
</div>

@push('component-scripts')
    <script>
        $(document).on("livewire:load", function(){
            $('.select2').select2();

            $("body").on("change", "select[name='donatur_id']", function(){
                @this.donatur_id = $(this).val()
            })

            $("body").on("click","#search", () => {
                var donatur = $("#donaturs").val();
                @this.filterDonaturId = donatur
            })

            Livewire.hook('message.processed', (message, component) => {
                $('.select2').select2();
            })
        })


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