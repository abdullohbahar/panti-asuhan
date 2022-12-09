<div>
    {{-- Modal --}}
    {{-- @include('livewire.modal.donation-type.modal-add-donation-type')
    @include('livewire.modal.donation-type.modal-edit-donation-type') --}}
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Data Anak Asuh</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
            <li class="breadcrumb-item active">Data Anak Asuh</li>
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
                        <a href="{{ route('tambah.anak.asuh') }}" class="btn btn-primary btn-sm"><b><i class="fas fa-plus"></i> Data Anak Asuh</b></a>
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
                                    <th scope="col" style="width: 50px !important">#</th>
                                    <th scope="col">Foto</th>
                                    <th scope="col">Nama</th>
                                    <th scope="col">Tempat, Tanggal Lahir</th>
                                    <th scope="col" style="width: 150px !important">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($count == 0)
                                    <tr>
                                        <td colspan="5">Data Not Found</td>
                                    </tr>
                                @endif
                                @foreach ($childs as $index => $child)
                                    <tr>
                                        <td data-label="#">{{ $childs->firstItem() + $index }}</td>
                                        <td data-label="Foto">
                                            @if ($child->foto)
                                                <img src="{{ asset('storage/'.$child->foto) }}" class="img-fluid img-thumbnail w-50" alt="{{ $child->nama_lengkap }}" srcset="">
                                            @else
                                                <img src="{{ asset('./template/dist/img/default-picture.png') }}" class="img-fluid img-thumbnail w-50" alt="{{ $child->nama_lengkap }}" srcset="">
                                            @endif
                                        </td>
                                        <td data-label="Nama Lengkap">
                                            {{ $child->nama_lengkap }}
                                        </td>
                                        <td data-label="Tempat, Tanggal Lahir">
                                            {!! $child->tempat_lahir !!}, {{ $child->tanggal_lahir }}
                                        </td>
                                        <td data-label="Aksi">
                                            <button wire:click="show('{{ $child->id }}')" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#modal-edit-donation-child"><i class="fas fa-pencil-alt"></i></button>
                                            <button wire:click="deleteConfirmation('{{ $child->id }}')" class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                {{ $childs->links() }}
            </div>
        </div>
    </div>
  </section>
  <!-- /.content -->
</div>