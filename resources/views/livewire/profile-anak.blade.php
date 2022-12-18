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
        <div class="card-body">
          <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-3 col-xl-3 text-center">
              <img class="img-fluid w-75" src="{{ asset('storage/'.$anak->foto) }}" alt="">
            </div>
            <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6">
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
                        <h6>: {{ $anak->tempat_lahir }}, {{ $anak->tanggal_lahir }}</h6>
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
                        <h6>No HP Ortu</h6>
                      </td>
                      <td>
                        <h6>: {{ $anak->nohp_ortu }}</h6>
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
                        <h6>Keterangan</h6>
                      </td>
                      <td>
                        <h6>: {{ $anak->keterangan }}</h6>
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
          <div class="col-12 text-right">
            <button class="btn btn-success" data-toggle="modal" data-target="#unggahBerkas">Unggah Berkas</button>
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
                  @foreach ($anak->documents as $document)
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
  </section>
  <!-- /.content -->
</div>