<div>
    {{-- Modal --}}
    @include('livewire.modal.unit.modal-add-unit')
    @include('livewire.modal.unit.modal-edit-unit')
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Data Satuan</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
            <li class="breadcrumb-item active">Data Satuan</li>
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
                    <div class="col-12 text-right">
                        <button id="btnAddUnit" wire:click="resetInput" class="btn btn-primary btn-sm"><b><i class="fas fa-plus"></i> Data Satuan</b></button>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="row justify-content-end">
                    <div class="col-0 mr-2">
                        <input type="text" wire:model="search" class="form-control rounded-pill" placeholder="Cari Satuan">
                    </div>
                    <div class="col-12 mt-2">
                        <table class="table-data">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Satuan</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($count == 0)
                                    <tr>
                                        <td colspan="3">Data Not Found</td>
                                    </tr>
                                @endif
                                @foreach ($units as $index => $unit)
                                    <tr>
                                        <td data-label="#">{{ $units->firstItem() + $index }}</td>
                                        <td data-label="Satuan">{{ $unit->unit }}</td>
                                        <td data-label="Aksi">
                                            <button wire:click="show('{{ $unit->id }}')" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#modal-edit-unit" data-toggle="tooltip" data-placement="top" title="Ubah Data Unit"><i class="fas fa-pencil-alt"></i></button>
                                            <button wire:click="deleteConfirmation('{{ $unit->id }}')" class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="top" title="Hapus Data Unit"><i class="fas fa-trash-alt"></i></button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                {{ $units->links() }}
            </div>
        </div>
    </div>
  </section>
  <!-- /.content -->
</div>