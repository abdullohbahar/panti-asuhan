<div>
    {{-- Modal --}}
    @include('livewire.modal.report.modal-add-report-fund')
    @include('livewire.modal.report.modal-edit-report-fund')
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Laporan Penggunaan Dana Donasi</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
            <li class="breadcrumb-item active">Laporan Penggunaan Dana Donasi</li>
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
                    <div class="col-8">
                        <h5>Sisa Dana Donasi: <b>{{ "Rp " . number_format($totalDana->total, 2, ',', '.'); }}</b></h5>
                    </div>
                    <div class="col-4 text-right">
                        <div class="row">
                            <div class="col-sm-12 col-md-6">
                                <button wire:click="exportExcel" id="print" class="btn btn-warning btn-block btn-sm mb-2"><i class="fas fa-print"></i> Export</button>
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <button id="btnAddReport" wire:click="resetInput" class="btn btn-primary btn-sm mb-2"><b><i class="fas fa-plus"></i> Penggunaan Dana</b></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-header">
                <div class="row">
                    <div class="col-sm-12 col-md-12 col-lg-3 col-xl-3">
                        <div class="form-group">
                            <input type="date" wire:model.defer="date1" class="form-control" name="" id="">
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-12 col-lg-3 col-xl-3">
                        <div class="form-group">
                            <input type="date" wire:model.defer="date2" class="form-control" name="" id="">
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-12 col-lg-2 col-xl-2">
                        <div class="form-group">
                            <button wire:click="filter" id="filter" class="btn btn-info btn-block">Filter Data</button>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-12 col-lg-2 col-xl-2">
                        <div class="form-group">
                            <a href="{{ route('donation') }}" class="btn btn-warning btn-block">Reset Filter</a>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-12 col-lg-2 col-xl-2">
                        <div class="form-group">
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="row justify-content-end">
                    {{-- <div class="col-0 mr-2">
                        <input type="text" wire:model="search" class="form-control rounded-pill" placeholder="Cari Nama Donatur">
                    </div> --}}
                    <div class="col-12 mt-2">
                        <table class="table-data">
                            <thead>
                                <tr>
                                    <th scope="col" style="width: 50px !important">#</th>
                                    <th scope="col">Nominal</th>
                                    <th scope="col">Keterangan</th>
                                    <th scope="col">Tanggal Penggunaan Dana</th>
                                    <th scope="col" style="width: 150px !important">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($count == 0)
                                    <tr>
                                        <td colspan="5">Data Not Found</td>
                                    </tr>
                                @endif
                                @php
                                    $no = 1;
                                @endphp
                                @foreach ($reports as $index => $report)
                                    <tr>
                                        <td data-label="#">{{ $no++ }}</td>
                                        <td data-label="Nominal">{{ "Rp " . number_format($report->nominal, 2, ',', '.'); }}</td>
                                        <td data-label="Keterangan">{{ $report->keterangan }}</td>
                                        <td data-label="Tanggal Donasi">{{ date('d-m-Y',strtotime($report->tanggal)) }}</td>
                                        <td data-label="Aksi">
                                            <button wire:click="show('{{ $report->id }}')" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#modal-edit-report-fund" data-toggle="tooltip" data-placement="top" title="Ubah Data"><i class="fas fa-pencil-alt"></i></button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                {{ $reports->links() }}
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

    </script>
@endpush