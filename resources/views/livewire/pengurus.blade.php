<div>
    
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Data Pengurus</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
            <li class="breadcrumb-item active">Data Pengurus</li>
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
                    <div class="col-2 text-right">
                        <div class="row">
                            {{-- <div class="col-sm-12 col-md-6">
                                <button wire:click="exportExcel" class="btn btn-warning btn-sm btn-block"><b><i class="fas fa-print"></i> Export</b></button>
                            </div> --}}
                            {{-- <div class="col-sm-12 col-md-6"> --}}
                                <a href="{{ route('tambah.pengurus') }}" class="btn btn-primary btn-sm btn-block"><b><i class="fas fa-plus"></i> Data Pengurus</b></a>
                            {{-- </div> --}}
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
                                    <th scope="col">Foto</th>
                                    <th scope="col">Nama</th>
                                    <th scope="col">Jabatan</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($count == 0)
                                    <tr>
                                        <td colspan="5">Data Not Found</td>
                                    </tr>
                                @endif
                                @foreach ($penguruses as $index => $pengurus)
                                    <tr>
                                        <td data-label="#">{{ $penguruses->firstItem() + $index }}</td>
                                        <td data-label="Foto">
                                            @if ($pengurus->foto)
                                                <img src="{{ asset('storage/'.$pengurus->foto) }}" class="img-fluid img-thumbnail w-50" alt="{{ $pengurus->nama_lengkap }}" srcset="">
                                            @else
                                                <img src="{{ asset('./template/dist/img/default-picture.png') }}" class="img-fluid img-thumbnail w-50" alt="{{ $pengurus->nama_lengkap }}" srcset="">
                                            @endif
                                        </td>
                                        <td data-label="Nama Lengkap">
                                            {{ $pengurus->nama }}
                                        </td>
                                        <td data-label="Jabatan">
                                            {{ $pengurus->jabatan }}
                                        </td>
                                        <td data-label="Aksi">
                                            <div class="btn-group-vertical" role="group" aria-label="Basic example">
                                                <a href="{{ route('profile.anak.asuh',$pengurus->id) }}" class="btn btn-primary btn-sm mb-2" data-toggle="tooltip" data-placement="top" title="Profil Pengurus"><i class="fas fa-user"></i> Profil Pengurus</a>
                                                {{-- <a href="{{ route('berkas.anak.asuh',$pengurus->id) }}" class="btn btn-info btn-sm my-2" data-toggle="tooltip" data-placement="top" title="Unggah Berkas"><i class="fas fa-upload"></i> Unggah Berkas</a> --}}
                                                <button wire:click="deleteConfirmation('{{ $pengurus->id }}')" class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="top" title="Hapus Data Pengurus"><i class="fas fa-trash"></i> Hapus</button>
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
                {{ $penguruses->links() }}
            </div>
        </div>
    </div>
  </section>
  <!-- /.content -->
</div>
