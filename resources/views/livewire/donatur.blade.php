<div>
    {{-- Modal --}}
    @include('livewire.modal.donatur.modal-add-donatur')
    @include('livewire.modal.donatur.modal-edit-donatur')
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Donatur</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
            <li class="breadcrumb-item active">Donatur</li>
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
                <div class="row justify-content-end">
                    <div class="col-sm-12 col-md-12 col-lg-3 col-xl-3 text-right">
                        <div class="row">
                            <div class="col-sm-12 col-md-4">
                                <button wire:click="exportExcel" class="btn btn-success btn-sm btn-block mt-2"><b><i class="fas fa-print"></i> Export Excel</b></button>
                            </div>
                            <div class="col-ms-12 col-md-4">
                                <a href="{{ route('export.donatur') }}" class="btn btn-danger btn-sm btn-block mt-2"><b><i class="fas fa-file-pdf"></i> Export PDF</b></a>
                            </div>
                            @if (auth()->user()->role == 'admin-yayasan')
                                <div class="col-sm-12 col-md-4">
                                    <button id="btnAddDonatur" wire:click="resetInput" class="btn btn-primary mt-2 btn-sm btn-block"><b><i class="fas fa-plus"></i> Donatur</b></button>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="row justify-content-end">
                    <div class="col-0 mr-2">
                        <input type="text" wire:model="search" class="form-control rounded-pill" placeholder="Cari Nama">
                    </div>
                    <div class="col-12 mt-2">
                        <table class="table-data">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Nama Donatur</th>
                                    <th scope="col">Nomor Hp</th>
                                    <th scope="col">Alamat</th>
                                    @if (auth()->user()->role == 'admin-yayasan')
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
                                @foreach ($donaturs as $index => $donatur)
                                    <tr>
                                        <td data-label="#">{{ $donaturs->firstItem() + $index }}</td>
                                        <td data-label="Nama Donatur">{{ $donatur->nama }}</td>
                                        <td data-label="Nomor HP">{{ $donatur->no_hp }}</td>
                                        <td data-label="Alamat">{{ $donatur->alamat }}</td>
                                        @if (auth()->user()->role == 'admin-yayasan')
                                            <td data-label="Aksi">
                                                <button wire:click="show('{{ $donatur->id }}')" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#modal-edit-donatur" data-toggle="tooltip" data-placement="top" title="Ubah Data Donatur"><i class="fas fa-pencil-alt"></i></button>
                                                <button wire:click="deleteConfirmation('{{ $donatur->id }}')" class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="top" title="Hapus Data Donatur"><i class="fas fa-trash-alt"></i></button>
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
                {{ $donaturs->links() }}
            </div>
        </div>
    </div>
  </section>
  <!-- /.content -->
</div>