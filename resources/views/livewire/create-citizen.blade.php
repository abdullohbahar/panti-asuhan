<div>
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Tambah Data Warga</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
            <li class="breadcrumb-item active">Tambah Data Warga</li>
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
                                <label>Nama Lengkap</label>
                                <input type="text" wire:model="nama_lengkap" class="form-control @error("nama_lengkap") is-invalid @enderror" id="">
                                @error("nama_lengkap")
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6">
                            <div class="form-group">
                                <label>Jenis Kelamin</label>
                                <select wire:model="jenis_kelamin" class="form-control @error("jenis_kelamin") is-invalid @enderror" id="">
                                    <option value="">-- Pilih --</option>
                                    <option value="Laki-laki">Laki-laki</option>
                                    <option value="Perempuan">Perempuan</option>
                                </select>
                                @error("jenis_kelamin")
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6">
                            <div class="form-group">
                                <label>Tempat Lahir</label>
                                <input type="text" wire:model="tempat_lahir" class="form-control @error("tempat_lahir") is-invalid @enderror" id="">
                                @error("tempat_lahir")
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6">
                            <div class="form-group">
                                <label>Tanggal Lahir</label>
                                <input type="date" wire:model="tanggal_lahir" class="form-control @error("tanggal_lahir") is-invalid @enderror" id="">
                                @error("tanggal_lahir")
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6">
                            <div class="form-group">
                                <label>Alamat</label>
                                <textarea wire:model="alamat" class="form-control @error("alamat") is-invalid @enderror"></textarea>
                                @error("alamat")
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6">
                            <div class="form-group">
                                <label>Status</label>
                                <select wire:model="status" class="form-control @error("status") is-invalid @enderror" id="">
                                    <option value="">-- Pilih Status --</option>
                                    <option value="Dhuafa">Dhuafa</option>
                                    <option value="Fakir Miskin">Fakir Miskin</option>
                                    <option value="Jompo">Jompo</option>
                                    <option value="Jamaah">Jamaah</option>
                                    <option value="Sudah Meninggal">Sudah Meninggal</option>
                                    <option value="Warga Dusun">Warga Dusun</option>
                                </select>
                                @error("status")
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6">
                            <div class="form-group">
                                <label>No Handphone</label>
                                <input type="text" wire:model="no_hp" class="form-control @error("no_hp") is-invalid @enderror" id="">
                                @error("no_hp")
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12 mt-3">
                            <button class="btn btn-success btn-block" wire:loading.attr="disabled">
                                Tambah Data Warga
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