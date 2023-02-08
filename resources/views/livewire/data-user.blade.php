<div>
    {{-- Modal --}}
    {{-- @include('livewire.modal.donation-type.modal-add-donation-type')
    @include('livewire.modal.donation-type.modal-edit-donation-type') --}}
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Data Pengguna</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
            <li class="breadcrumb-item active">Data Pengguna</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
        <div class="card">
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
                                    <th scope="col">Username</th>
                                    <th scope="col">Hak Akses</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($count == 0)
                                    <tr>
                                        <td colspan="5">Data Not Found</td>
                                    </tr>
                                @endif
                                @foreach ($users as $index => $user)
                                    <tr>
                                        <td data-label="#">{{ $users->firstItem() + $index }}</td>
                                        <td data-label="Username">
                                            {{ $user->username }}
                                        </td>
                                        <td data-label="Hak Akses">
                                            {{ str_replace("-", " ",$user->role) }}
                                        </td>
                                        <td data-label="Aksi">
                                            <div class="btn-group-vertical" role="group" aria-label="Basic example">
                                                <a href="{{ route('edit.pengguna.admin.yayasan',$user->id) }}" class="btn btn-primary btn-sm mb-2" data-toggle="tooltip" data-placement="top" title="Ubah Pengguna"><i class="fas fa-pencil"></i> Ubah</a>
                                                <button wire:click="deleteConfirmation('{{ $user->id }}')" class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="top" title="Hapus Data Pengguna"><i class="fas fa-trash"></i> Hapus</button>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                {{ $users->links() }}
            </div>
        </div>
    </div>
  </section>
  <!-- /.content -->
</div>
