<div>

  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Unggah Berkas Anak</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
            <li class="breadcrumb-item active">Unggah Berkas Anak</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <section class="content">
    <div class="container-fluid">
      <div class="card">
        <div class="card-body">
          <form wire:submit.prevent="store">
            <div class="row">
              <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                <div class="form-group">
                  <label for="">Nama Berkas</label>
                  <input type="text" class="form-control @error('nama_dokumen') is-invalid @enderror" wire:model="nama_dokumen" id="">
                  @error('nama_dokumen')
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
                  @enderror
                </div>
              </div>
              <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                <div class="form-group">
                  <label for="">Berkas</label>
                  <input type="file" class="form-control @error('file') is-invalid @enderror" wire:model="file" id="upload{{ $iteration }}">
                  @error('file')
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
                  @enderror
                </div>
              </div>
              <div class="col-12">
                <button type="submit" class="btn btn-success btn-block" wire:loading.attr="disabled">Simpan</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="card">
        <div class="card-header">
          <div class="row justify-content-between">
            <div class="col-12">
              <h5>Nama : <b class="text-uppercase">{{ $child->nama_lengkap }}</b></h5>
            </div>
          </div>
        </div>
        <div class="card-body">
          <div class="row text-center">
            <?php $no = 1 ?>
            <div class="col-12">
              <table class="table-bordered" style="width: 100%">
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
  </section>
  <!-- /.content -->
</div>