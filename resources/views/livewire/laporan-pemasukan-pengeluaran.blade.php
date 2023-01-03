<div>
    {{-- Modal --}}
    {{-- @include('livewire.modal.donation.modal-add-donation-money')
    @include('livewire.modal.donation.modal-edit-donation') --}}
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Laporan Pemasukan Pengeluaran</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
            <li class="breadcrumb-item active">Laporan Pemasukan Pengeluaran</li>
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
                        <h5><b>Laporan Pemasukan Pengeluaran</b></h5>
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
                            <a href="{{ route('laporan.pemasukan.pengeluaran') }}" class="btn btn-warning btn-block">Reset Filter</a>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-12 col-lg-2 col-xl-2">
                        <div class="form-group">
                            @if ($date1)
                                <a href="{{ url('cetak-laporan-pemasukan-pengeluaran-donasi-excel/'.$date1.'/'.$date2) }}" class="btn btn-success btn-block"><i class="fas fa-file-excel"></i> Export Excel</a>
                            @else
                                <a href="{{ url('cetak-laporan-pemasukan-pengeluaran-donasi-excel/0/0') }}" class="btn btn-success btn-block"><i class="fas fa-file-excel"></i> Export Excel</a>
                            @endif
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-12 col-lg-2 col-xl-2">
                        <div class="form-group">
                            @if ($date1)
                                <a href="{{ url('cetak-laporan-pemasukan-pengeluaran-donasi/'.$date1.'/'.$date2) }}" class="btn btn-danger btn-block"><i class="fas fa-file-pdf"></i> Export PDF</a>
                            @else
                                <a href="{{ url('cetak-laporan-pemasukan-pengeluaran-donasi/0/0') }}" class="btn btn-danger btn-block"><i class="fas fa-file-pdf"></i> Export PDF</a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            @if ($date1)
                <div class="card-body">
                    <div class="row justify-content-end">
                        <div class="col-12 mt-2">
                            <table class="table-data">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Tanggal</th>
                                        <th scope="col">Uraian</th>
                                        <th scope="col">Jenis Donasi</th>
                                        <th scope="col">Pemasukan</th>
                                        <th scope="col">Pengeluaran</th>
                                        <th scope="col">Saldo</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($count == 0)
                                        <tr>
                                            <td colspan="5">Data Not Found</td>
                                        </tr>
                                    @endif
                                    <?php 
                                    $saldo = 0;
                                    $no = 1; ?>
                                    @foreach ($donations as $index => $donation)
                                        @php
                                            if($donation->transaksi == "pemasukan"){
                                                $saldo += $donation->pemasukan;
                                            }else{
                                                $saldo -= $donation->pengeluaran;
                                            }
                                        @endphp
                                        <tr>
                                            <td data-label="#">{{ $no++ }}</td>
                                            <td data-label="Tanggal">{{ date('d-m-Y',strtotime($donation->tanggal_donasi)) }}</td>
                                            <td data-label="Uraian">{{ $donation->keterangan }}</td>
                                            <td data-label="Jenis Donasi">
                                                @if ($donation->jenis_donasi == 'pengeluaran')
                                                    
                                                @else
                                                    {{ $donation->jenis_donasi }}
                                                @endif
                                            </td>
                                            <td data-label="Pemasukan">
                                                @if ($donation->pemasukan)
                                                    {{ "Rp " . number_format($donation->pemasukan, 2, ',', '.'); }}
                                                @endif
                                            </td>
                                            <td data-label="Pengeluaran">
                                                @if ($donation->pengeluaran)
                                                    {{ "Rp " . number_format($donation->pengeluaran, 2, ',', '.'); }}
                                                @endif
                                            </td>
                                            <td data-label="Saldo">
                                                {{ "Rp " . number_format($saldo, 2, ',', '.'); }}
                                            </td>
                                        </tr>
                                    @endforeach
                                    <tr style="background: #48cbe0">
                                        <td colspan="4" class="text-right">
                                            <b>Saldo Akhir</b>
                                        </td>
                                        <td colspan="3">
                                            <b>
                                                {{ "Rp " . number_format($pemasukan - $pengeluaran, 2, ',', '.'); }}
                                            </b>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            @endif
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