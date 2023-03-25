<div>
    @include('livewire.modal.berkas.unggah-berkas')

  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Profile Anak</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
            <li class="breadcrumb-item active">Profile Anak</li>
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
          <div class="row">
            @if (auth()->user()->role == 'admin-yayasan' || Auth()->user()->role == 'ketua-yayasan')
              <div class="col-12 text-right">
                <a href="{{ route('edit.data.anak.asuh',$anak->id) }}" class="btn btn-warning">Ubah Data</a>
              </div>
            @endif
          </div>
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-3 col-xl-3 text-center">
              <img class="img-fluid w-75" src="{{ asset('storage/'.$anak->foto) }}" alt="">
            </div>
            <div class="col-sm-12 col-md-12 col-lg-9 col-xl-9">
              <div class="row">
                <div class="col-12">
                  <table class="table table-borderless">
                    <tr>
                      <td>
                        <h6>Nama</h6>
                      </td>
                      <td>
                        <h6>: {{ $anak->nama_lengkap }}</h6>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <h6>Umur</h6>
                      </td>
                      <td>
                        <h6>: {{ \Carbon\Carbon::parse($anak->tanggal_lahir)->age }}</h6>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <h6>Jenis Kelamin</h6>
                      </td>
                      <td>
                        <h6>: {{ $anak->jenis_kelamin }}</h6>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <h6>Tempat, Tanggal lahir</h6>
                      </td>
                      <td>
                        <h6>: {{ $anak->tempat_lahir }}, {{ $anak->tanggal_lahir != null ? \Carbon\Carbon::parse($anak->tanggal_lahir)->format('d-m-Y') : '-' }}</h6>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <h6>Pendidikan</h6>
                      </td>
                      <td>
                        <h6>: {{ $anak->pendidikan }}</h6>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <h6>Alamat</h6>
                      </td>
                      <td>
                        <h6>: {{ $anak->alamat }}</h6>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <h6>Status</h6>
                      </td>
                      <td>
                        <h6>: {{ $anak->status }}</h6>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <h6>Tipe</h6>
                      </td>
                      <td>
                        <h6>: {{ $anak->tipe }}</h6>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <h6>Tanggal Masuk</h6>
                      </td>
                      <td>
                        <h6>: {{ $anak->tgl_masuk != null ? \Carbon\Carbon::parse($anak->tgl_masuk)->format('d-m-Y') : '-' }}</h6>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <h6>Tanggal Keluar</h6>
                      </td>
                      <td>
                        <h6>: {{ $anak->tgl_keluar != null ? \Carbon\Carbon::parse($anak->tgl_keluar)->format('d-m-Y') : '-' }}</h6>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <h6>Nama Ayah Kandung</h6>
                      </td>
                      <td>
                        <h6>: {{ $anak->nama_ayah_kandung }}</h6>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <h6>Nama Ibu Kandung</h6>
                      </td>
                      <td>
                        <h6>: {{ $anak->nama_ibu_kandung }}</h6>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <h6>Nama Wali</h6>
                      </td>
                      <td>
                        <h6>: {{ $anak->pemilik_nohp }}</h6>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <h6>Nomor HP Wali</h6>
                      </td>
                      <td>
                        <h6>: {{ $anak->nohp_ortu }}</h6>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <h6>Wali Anak</h6>
                      </td>
                      <td>
                        <h6>: {{ $anak->wali_anak }}</h6>
                      </td>
                    </tr>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="content">
    <div class="container-fluid">
      <div class="card">
        <div class="card-header">
          <div class="row">
            <div class="col-sm-12 col-md-6 col-lg-4 col-xl-4">
              <input type="text" wire:model="search" class="form-control rounded-pill" placeholder="Cari Nama Berkas">
            </div>
            @if (auth()->user()->role == 'admin-yayasan' || Auth()->user()->role == 'ketua-yayasan')
              <div class="col-sm-12 col-md-6 col-lg-8 col-xl-8 text-right">
                <button class="btn btn-success" data-toggle="modal" data-target="#unggahBerkas">Unggah Berkas</button>
              </div>
            @endif
          </div>
        </div>
        <div class="card-body">
          <div class="row text-center">
            <?php $no = 1 ?>
            <div class="col-12">
              <table class="table table-bordered" style="width: 100%">
                <thead>
                  <tr>
                    <th scope="col">No</th>
                    <th scope="col">Nama Berkas</th>
                    <th scope="col">Tanggal Upload</th>
                    <th scope="col">Berkas</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($documents as $document)
                  <tr>
                    <th scope="row">
                      {{ $no++ }}
                    </th>
                    <td>
                      {{ $document->nama_dokumen }}
                    </td>
                    <td>
                      {{ \Carbon\Carbon::parse($document->created_at)->format('Y-m-d') }}
                    </td>
                    <td style="height: 50px">
                      <button wire:click="download('{{ $document->file }}','{{ $document->nama_dokumen }}')" class="btn btn-info btn-sm">Unduh Berkas</button>
                      @if (auth()->user()->role == 'admin-yayasan' || Auth()->user()->role == 'ketua-yayasan')
                        <button wire:click="deleteConfirmation('{{ $document->file }}','{{ $document->id }}')" class="btn btn-danger btn-sm">Hapus Berkas</button>
                      @endif
                    </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- /.content -->
</div>