<div>
    @include('livewire.modal.donation-goods.modal-add-donation-item')
    @include('livewire.modal.donation-goods.modal-edit-donation-item')

    <!-- Content Header (Page header) -->
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

  <div class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <div class="row justify-content-between">
                    <div class="col-sm-12 col-md-8">
                        <h5><b>Donasi Barang</b></h5>
                    </div>
                    <div class="col-sm-12 col-md-4 text-right">
                        <button wire:click="exportExcel" class="btn btn-success btn-sm"><b><i class="fas fa-file-excel"></i> Export Excel</b></button>
                        <a href="{{ route('export.donasi.barang.pdf') }}" class="btn btn-danger btn-sm"><b><i class="fas fa-file-pdf"></i> Export PDF</b></a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="row justify-content-end">
                    <div class="col-0 mr-2">
                        <input type="text" wire:model="search" class="form-control rounded-pill" placeholder="Cari">
                    </div>
                    <div class="col-12 mt-2">
                        <table class="table-data">
                            <thead>
                                <tr>
                                    <th scope="col" style="width: 20px !important">#</th>
                                    <th scope="col">Nama Donatur</th>
                                    <th scope="col">Keterangan Barang</th>
                                    <th scope="col">Penerima</th>
                                    <th scope="col">Tanggal Donasi</th>
                                    @if (auth()->user()->role == 'admin-yayasan' || Auth()->user()->role == 'ketua-yayasan')
                                        <th scope="col">Aksi</th>
                                    @endif
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
                                        <td data-label="Tipe Donasi">{{ $donation->donatur->nama }}</td>
                                        <td data-label="Keterangan Barang">
                                            @php
                                                $results = '';

                                                foreach ($donation->details as $value) {
                                                    $results .= $value->nama_barang . ' ' . $value->jumlah . ', ';
                                                }

                                                $results = rtrim($results, ', ');
                                            @endphp
                                            {{ $results }}
                                        </td>
                                        <td data-label="Penerima">{{ $donation->penerima }}</td>
                                        <td data-label="Tanggal Donasi">{{ $donation->tanggal_donasi }}</td>
                                        @if (auth()->user()->role == 'admin-yayasan' || Auth()->user()->role == 'ketua-yayasan')
                                            <td data-label="Aksi">
                                                <a href="{{ route('proof.of.donation',$donation->id) }}" class="btn btn-info btn-sm" data-toggle="tooltip" data-placement="top" title="Upload Bukti Donasi"><i class="fas fa-upload"></i></a>
                                                {{-- <button wire:click="printInvoice('{{ $donation->id }}')" class="btn btn-primary btn-sm" data-toggle="tooltip" data-placement="top" title="Cetak tanda donasi"><i class="fas fa-print"></i></button> --}}
                                                <a href="{{ route('print.invoice.donation.goods',$donation->id) }}" class="btn btn-primary btn-sm" data-toggle="tooltip" data-placement="top" title="Cetak tanda donasi"><i class="fas fa-print"></i></a>
                                                <button wire:click="show('{{ $donation->id }}','{{ $donation->donatur_id }}')" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#modal-edit-donation-item" data-toggle="tooltip" data-placement="top" title="Edit Donasi"><i class="fas fa-pencil-alt"></i></button>
                                                <button wire:click="deleteConfirmation('{{ $donation->id }}')" class="btn btn-danger btn-sm"><i class="fas fa-trash-alt" data-toggle="tooltip" data-placement="top" title="Hapus Donasi"></i></button>
                                            </td>
                                        @endif
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
  </div>
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
    </script>
@endpush