<div>
    {{-- Modal --}}
      <livewire:export.export-donation>
      <livewire:export.export-donation-pdf>
    @include('livewire.modal.donation.modal-edit-donation')
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Donasi</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
            <li class="breadcrumb-item active">Donasi</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <div class="row justify-content-between">
                    <div class="col-sm-12 col-md-8">
                        <h5><b>Donasi Berupa Tunai</b></h5>
                    </div>
                    <div class="col-sm-12 col-md-4 text-right">
                        {{-- <button wire:click="exportExcel" class="btn btn-success btn-sm"><b><i class="fas fa-file-excel"></i> Export Excel</b></button> --}}
                        {{-- <a href="{{ route('export.donasi.tunai.pdf') }}" class="btn btn-danger btn-sm"><b><i class="fas fa-file-pdf"></i> Export PDF</b></a> --}}
                        @if (auth()->user()->role != 'penerima-donasi')
                            <button class="btn btn-success btn-sm" data-toggle="modal" data-target="#modal-export-excel"><b><i class="fas fa-file-excel"></i> Export Excel</b></button>
                            <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modal-export-pdf"><b><i class="fas fa-file-pdf"></i> Export PDF</b></button>
                        @endif
                    </div>
                </div>
            </div>
            <div class="card-header">
                <div class="row">
                    <div class="col-sm-12 col-md-12 col-lg-2 col-xl-2">
                        <div class="form-group">
                            <input type="date" wire:model.defer="date1" class="form-control" name="" id="">
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-12 col-lg-2 col-xl-2">
                        <div class="form-group">
                            <input type="date" wire:model.defer="date2" class="form-control" name="" id="">
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-12 col-lg-2 col-xl-2">
                        <div class="form-group">
                            <button wire:click="search" id="search" class="btn btn-info btn-block">Filter Data</button>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-12 col-lg-2 col-xl-2">
                        <div class="form-group">
                            <a href="{{ route('donation.tunai') }}" class="btn btn-warning btn-block">Reset Filter</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body p-0">
                <div class="row justify-content-end">
                    <div class="col-0 mr-3 mt-2">
                        <input type="text" wire:model="search" class="form-control rounded-pill" placeholder="Cari Nama Donatur">
                    </div>
                    <div class="col-12 mt-2">
                        <table class="table-data">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Nama Donatur</th>
                                    <th scope="col">Nominal</th>
                                    <th scope="col">Tanggal Donasi</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($count == 0)
                                    <tr>
                                        <td colspan="5">Data Not Found</td>
                                    </tr>
                                @endif
                                @foreach ($donations as $index => $donation)
                                    <tr>
                                        <td data-label="#">{{ $donations->firstItem() + $index }}</td>
                                        <td data-label="Nama Donatur">{{ $donation->donatur->nama }}</td>
                                        <td data-label="Nominal">{{ "Rp " . number_format($donation->pemasukan, 2, ',', '.'); }}</td>
                                        <td data-label="Tanggal Donasi">{{ date('d-m-Y',strtotime($donation->tanggal_donasi)) }} {{ \Carbon\Carbon::parse($donation->created_at)->format('H:i:s') }}</td>
                                        <td data-label="Aksi">
                                            {{-- <button wire:click="sendConfirmation('{{ $donation->id }}')" class="btn btn-success btn-sm" data-toggle="tooltip" data-placement="top" title="Kirim ke whatsapp"><i class="fab fa-whatsapp"></i></button> --}}
                                            {{-- <button wire:click="printInvoiceDonation('{{ $donation->id }}')" class="btn btn-primary btn-sm" data-toggle="tooltip" data-placement="top" title="download bukti"><i class="fas fa-print"></i></button> --}}
                                            <a onclick="openWindowPopup('/print-invoice-donation/{{ $donation->id }}', 1200, 800)" class="btn btn-primary btn-sm" data-toggle="tooltip" data-placement="top" title="download bukti"><i class="fas fa-print"></i></a>
                                            @if (auth()->user()->role == 'penerima-donasi')
                                                <button id="edit" wire:click="show('{{ $donation->id }}','{{ $donation->donatur_id }}')" data-jenis="{{ $donation->jenis_donasi }}" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#modal-edit-donation" data-toggle="tooltip" data-placement="top" title="Ubah Donasi"><i class="fas fa-pencil-alt"></i></button>
                                            @endif
                                            @if (auth()->user()->role == 'admin-yayasan' || Auth()->user()->role == 'ketua-yayasan' || Auth()->user()->role == 'bendahara-yayasan'|| Auth()->user()->role == 'admin-donasi')
                                                <button id="edit" wire:click="show('{{ $donation->id }}','{{ $donation->donatur_id }}')" data-jenis="{{ $donation->jenis_donasi }}" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#modal-edit-donation" data-toggle="tooltip" data-placement="top" title="Ubah Donasi"><i class="fas fa-pencil-alt"></i></button>
                                                <button wire:click="deleteConfirmation('{{ $donation->id }}')" class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="top" title="Hapus Donasi"><i class="fas fa-trash-alt"></i></button>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                {{ $donations->links() }}
            </div>
        </div>
    </div>
  </section>
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

            $("body").on("keyup","#nominal2",() => {
                var val = $("#nominal2").val()
                var angka = val.replace(/,.*|[^0-9]/g, '')
                var terbilang = angkaTerbilang(angka)
                @this.terbilang = terbilang + ' rupiah'
                $("#terbilang").val(terbilang)
            })
        })


        var rupiah = document.getElementById("nominal2");
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

        $("body").on("click", "#edit", function(){
            var jenis = $(this).data("jenis");
            if(jenis == "Transfer"){
                
            }
        })

    </script>
@endpush