<div>
    {{-- @include('livewire.modal.berkas.unggah-berkas') --}}

  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Profile Warga</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
            <li class="breadcrumb-item active">Profile Warga</li>
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
            <div class="col-12 text-right">
              <a href="{{ route('edit.data.anak.asuh',$citizen->id) }}" class="btn btn-warning">Ubah Data</a>
            </div>
          </div>
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-9 col-xl-9">
              <div class="row">
                <div class="col-12">
                  <table class="table table-borderless">
                    <tr>
                      <td>
                        <h6>Nama</h6>
                      </td>
                      <td>
                        <h6>: {{ $citizen->nama_lengkap }}</h6>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <h6>Umur</h6>
                      </td>
                      <td>
                        <h6>: {{ \Carbon\Carbon::parse($citizen->tanggal_lahir)->age }}</h6>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <h6>Jenis Kelamin</h6>
                      </td>
                      <td>
                        <h6>: {{ $citizen->jenis_kelamin }}</h6>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <h6>Tempat, Tanggal lahir</h6>
                      </td>
                      <td>
                        <h6>: {{ $citizen->tempat_lahir }}, {{ $citizen->tanggal_lahir }}</h6>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <h6>Alamat</h6>
                      </td>
                      <td>
                        <h6>: {{ $citizen->alamat }}</h6>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <h6>Status</h6>
                      </td>
                      <td>
                        <h6>: {{ $citizen->status }}</h6>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <h6>Nomor HP</h6>
                      </td>
                      <td>
                        <h6>: {{ $citizen->nohp_ortu }}</h6>
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

  {{-- <section class="content">
    <div class="container-fluid">
      <div class="card">
        <div class="card-header">
          <div class="row">
            <div class="col-sm-12 col-md-6 col-lg-4 col-xl-4">
              <input type="text" wire:model="search" class="form-control rounded-pill" placeholder="Cari Nama Berkas">
            </div>
            <div class="col-sm-12 col-md-6 col-lg-8 col-xl-8 text-right">
              <button class="btn btn-success" data-toggle="modal" data-target="#unggahBerkas">Unggah Berkas</button>
            </div>
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
                    <td style="height: 50px">
                      <button wire:click="download('{{ $document->file }}','{{ $document->nama_dokumen }}')" class="btn btn-info btn-sm">Unduh Berkas</button>
                      <button wire:click="deleteConfirmation('{{ $document->file }}','{{ $document->id }}')" class="btn btn-danger btn-sm">Hapus Berkas</button>
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
  </section> --}}
  <!-- /.content -->
</div>