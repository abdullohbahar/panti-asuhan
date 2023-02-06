<div>
    <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Data Santri Luar</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
            <li class="breadcrumb-item active">Data Santri Luar</li>
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
                                    <th scope="col">Foto</th>
                                    <th scope="col">Nama</th>
                                    <th scope="col">Tempat, Tanggal Lahir</th>
                                    <th scope="col">Aksi</th>
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
                                            {{ $child->tempat_lahir }}, {{ $child->tanggal_lahir }}
                                        </td>
                                        <td data-label="Aksi">
                                            <div class="btn-group-vertical" role="group" aria-label="Basic example">
                                                <a href="{{ route('profile.anak.asuh',$child->id) }}" class="btn btn-primary btn-sm mb-2" data-toggle="tooltip" data-placement="top" title="Profil Santri Luar"><i class="fas fa-user"></i> Profil Anak</a>
                                                {{-- <a href="{{ route('berkas.anak.asuh',$child->id) }}" class="btn btn-info btn-sm my-2" data-toggle="tooltip" data-placement="top" title="Unggah Berkas"><i class="fas fa-upload"></i> Unggah Berkas</a> --}}
                                                <button wire:click="deleteConfirmation('{{ $child->id }}')" class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="top" title="Hapus Data Santri Luar"><i class="fas fa-trash"></i> Hapus</button>
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
                {{ $childs->links() }}
            </div>
        </div>
    </div>
  </section>
  <!-- /.content -->
</div>
