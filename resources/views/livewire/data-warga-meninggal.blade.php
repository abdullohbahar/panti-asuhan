<div>
    {{-- Modal --}}
    {{-- @include('livewire.modal.donation-type.modal-add-donation-type')
    @include('livewire.modal.donation-type.modal-edit-donation-type') --}}
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Data Warga Meninggal</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
            <li class="breadcrumb-item active">Data Warga Meninggal</li>
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
                            <div class="col-sm-12 col-md-6">
                                <button wire:click="exportExcel" class="btn btn-success btn-sm btn-block mt-2"><b><i class="fas fa-print"></i> Export Excel</b></button>
                            </div>
                            <div class="col-ms-12 col-md-6">
                                <a href="{{ route('export.warga','Sudah Meninggal') }}" class="btn btn-danger btn-sm btn-block mt-2"><b><i class="fas fa-file-pdf"></i> Export PDF</b></a>
                            </div>
                        </div>
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
                                    <th scope="col">Nama</th>
                                    <th scope="col">Tempat, Tanggal Lahir</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($count == 0)
                                    <tr>
                                        <td colspan="4">Data Not Found</td>
                                    </tr>
                                @endif
                                @foreach ($citizens as $index => $citizen)
                                    <tr>
                                        <td data-label="#">{{ $citizens->firstItem() + $index }}</td>
                                        <td data-label="Nama Lengkap">
                                            {{ $citizen->nama_lengkap }}
                                        </td>
                                        <td data-label="Tempat, Tanggal Lahir">
                                            {{ $citizen->tempat_lahir }}, {{ $citizen->tanggal_lahir }}
                                        </td>
                                        <td data-label="Aksi">
                                            <div class="btn-group-vertical" role="group" aria-label="Basic example">
                                                <a href="{{ route('profil.warga',$citizen->id) }}" class="btn btn-primary btn-sm mb-2" data-toggle="tooltip" data-placement="top" title="Profil Warga Fakir Miskin"><i class="fas fa-user"></i> Profil Warga</a>
                                                {{-- <a href="{{ route('berkas.anak.asuh',$citizen->id) }}" class="btn btn-info btn-sm my-2" data-toggle="tooltip" data-placement="top" title="Unggah Berkas"><i class="fas fa-upload"></i> Unggah Berkas</a> --}}
                                                <button wire:click="deleteConfirmation('{{ $citizen->id }}')" class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="top" title="Hapus Data Warga Fakir Miskin"><i class="fas fa-trash"></i> Hapus</button>
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
                {{ $citizens->links() }}
            </div>
        </div>
    </div>
  </section>
  <!-- /.content -->
</div>
