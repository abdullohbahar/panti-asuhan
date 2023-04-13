<div>
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Tambah Surat Keluar LKSA</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
            <li class="breadcrumb-item active">Tambah Surat Keluar LKSA</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid chocolat-open">
        <div class="card">
            <div class="card-header">
            </div>
            <div class="card-body">
                <form wire:submit.prevent="store">
                    <div class="row">
                        <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6">
                            <div class="form-group">
                                <label>Surat</label>
                                <input type="file" wire:model="file" class="form-control @error("file") is-invalid @enderror" id="">
                                @error("file")
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6">
                            <div class="form-group">
                                <label>Nomor Surat</label>
                                <input type="text" wire:model="nomor_surat" class="form-control @error("nomor_surat") is-invalid @enderror" id="">
                                @error("nomor_surat")
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6">
                            <div class="form-group">
                                <label>Perihal Surat</label>
                                <input type="text" wire:model="perihal" class="form-control @error("perihal") is-invalid @enderror" id="">
                                @error("perihal")
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6">
                            <div class="form-group">
                                <label>Nomor Urutan</label>
                                <input type="text" wire:model="nomor_urutan" class="form-control @error("nomor_urutan") is-invalid @enderror" id="">
                                @error("nomor_urutan")
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6">
                            <div class="form-group">
                                <label>Tanggal Surat</label>
                                <input type="date" wire:model="tanggal" class="form-control @error("tanggal") is-invalid @enderror" id="">
                                @error("tanggal")
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6">
                            <div class="form-group">
                                <label>Tujuan</label>
                                <input type="text" wire:model="tujuan" class="form-control @error("tujuan") is-invalid @enderror" id="">
                                @error("tujuan")
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <hr>
                            <h4><b>Disposisi</b><i style="font-size: 15px;"> *kosongkan saja jika tidak ingin mengisi</i></h4>
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6">
                            <div class="form-group">
                                <label>Tanggal Diterima</label>
                                <input type="date" wire:model="tanggal_diterima" class="form-control @error("tanggal_diterima") is-invalid @enderror" id="">
                                @error("tanggal_diterima")
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6">
                            <div class="form-group">
                                <label>Dokumentasi</label>
                                <input type="file" wire:model="file_dokumentasi" class="form-control @error("file_dokumentasi") is-invalid @enderror" id="">
                                @error("file_dokumentasi")
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                            <div class="form-group">
                                <label for="">Disposisi / Penugasan</label>
                                <textarea wire:model="disposisi_penugasan" class="form-control @error("disposisi_penugasan") is-invalid @enderror" cols="30" rows="10"></textarea>
                                @error("disposisi_penugasan")
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12 mt-3">
                            <button class="btn btn-success btn-block" wire:loading.attr="disabled">
                                Tambah Surat
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
  </section>
  <!-- /.content -->
</div>