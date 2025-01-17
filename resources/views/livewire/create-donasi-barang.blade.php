<div>
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Donasi Barang</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
            <li class="breadcrumb-item active">Donasi Barang</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-sm-12 col-md-12">
                <div class="card">
                    <div class="card-body">
                        <form wire:submit.prevent="store">
                            <div class="row">
                                <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                    <div class="form-group">
                                        <label for="">Nama Donatur</label>
                                        <input type="text" wire:model="nama_donatur" name="nama_donatur" class="form-control @error("nama_donatur") is-invalid @enderror" required>
                                        @error("nama_donatur")
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                    <div class="form-group">
                                        <label for="">Nomor HP Donatur</label>
                                        <input type="text" wire:model="no_hp" name="no_hp" class="form-control">
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                    <div class="form-group">
                                        <label>Alamat Donatur</label>
                                        <textarea type="text" wire:model="alamat" class="form-control @error("alamat") is-invalid @enderror"></textarea>
                                        @error("alamat")
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
                                <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                    <div class="form-group">
                                        <label>Penerima</label>
                                        <input type="text" wire:model="penerima" class="form-control @error("penerima") is-invalid @enderror" id="">
                                        @error("penerima")
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                {{-- <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                    <div class="form-group">
                                        <label>Keterangan Barang</label>
                                        <textarea type="text" wire:model="keterangan" class="form-control @error("keterangan") is-invalid @enderror"></textarea>
                                        @error("keterangan")
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div> --}}
                                @foreach ($inputs as $key => $input)
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label for="">Nama Barang</label>
                                            <input type="text" class="form-control @error('inputs.'.$key.'.nama_barang') is-invalid @enderror" wire:model="inputs.{{ $key }}.nama_barang" id="">
                                            @error('inputs.'.$key.'.nama_barang')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label for="">Jumlah Barang</label>
                                            <input type="text" class="form-control @error('inputs.'.$key.'.jumlah') is-invalid @enderror" wire:model="inputs.{{ $key }}.jumlah" id="">
                                            @error('inputs.'.$key.'.jumlah')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label for="" style="color:white">hapus</label><br>
                                            <a href="javascript:void(0)" wire:click="removeInput({{ $key }})" class="btn btn-danger">Hapus</a>
                                        </div>
                                    </div>
                                @endforeach
                                <div class="col-12 text-right">
                                    <a href="javascript:void(0)" wire:click="addInput" class="btn btn-warning">Tambah barang</a>
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

            $("body").on("keyup","#nominal",() => {
                var val = $("#nominal").val()
                var angka = val.replace(/,.*|[^0-9]/g, '')
                var terbilang = angkaTerbilang(angka)
                @this.terbilang = terbilang + ' rupiah'
                $("#terbilang").val(terbilang)
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