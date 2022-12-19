<div>
    {{-- Modal --}}
    @include('livewire.modal.donation-type.modal-add-donation-type')
    @include('livewire.modal.donation-type.modal-edit-donation-type')
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Tipe Donasi</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
            <li class="breadcrumb-item active">Tipe Donasi</li>
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
                    <div class="col-12">
                        <button id="btnAdd" wire:click="resetInput" class="btn btn-primary btn-sm"><b><i class="fas fa-plus"></i> Tipe Donasi</b></button>
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
                                    <th scope="col">#</th>
                                    <th scope="col">Tipe Donasi</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($count == 0)
                                    <tr>
                                        <td colspan="3">Data Not Found</td>
                                    </tr>
                                @endif
                                @foreach ($types as $index => $type)
                                    <tr>
                                        <td data-label="#">{{ $types->firstItem() + $index }}</td>
                                        <td data-label="Tipe Donasi">{{ $type->jenis_donasi }}</td>
                                        <td data-label="Aksi">
                                            <button wire:click="show('{{ $type->id }}')" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#modal-edit-donation-type"><i class="fas fa-pencil-alt"></i></button>
                                            <button wire:click="deleteConfirmation('{{ $type->id }}')" class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                {{ $types->links() }}
            </div>
        </div>
    </div>
  </section>
  <!-- /.content -->
</div>