<div>
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Tambah Data Anak Asuh</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
            <li class="breadcrumb-item active">Tambah Data Anak Asuh</li>
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
                &nbsp; Harap menggunakan file template excel jika ingin melakukan import data. Dan baca aturan untuk pengisian.
                <button class="btn btn-warning mt-2" data-toggle="modal" data-target="#petunjuk"><i class="fas fa-exclamation-triangle"></i> Petunjuk Pengisian</button>
                <button class="btn btn-info mt-2" wire:click="downloadTemplate"><i class="fas fa-download"></i> Download Template Excel</button>
                <button class="btn btn-success mt-2" data-toggle="modal" data-target="#importSantri"><i class="fas fa-file-excel"></i> Import Melalui Excel</button>
            </div>
            <div class="card-body">
                <form wire:submit.prevent="store">
                    <div class="row">
                        <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6">
                            <div class="form-group">
                                <label>Foto Anak</label>
                                <input type="file" wire:model="foto" class="form-control @error("foto") is-invalid @enderror" id="imageUpload">
                                @error("foto")
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6 text-center">
                            {{-- preview image --}}
                            <img wire:ignore.self src="" class="image-fluid w-50 mb-2" id="imagePreview">
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6">
                            <div class="form-group">
                                <label>Nomor Induk Santri</label>
                                <input type="text" wire:model="nis" class="form-control @error("nis") is-invalid @enderror" id="">
                                @error("nis")
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6">
                            <div class="form-group">
                                <label>NIK</label>
                                <input type="text" wire:model="nik" class="form-control @error("nik") is-invalid @enderror" id="">
                                @error("nik")
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
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
                                <label>Pendidikan</label>
                                <input type="text" wire:model="pendidikan" class="form-control @error("pendidikan") is-invalid @enderror" id="">
                                @error("pendidikan")
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
                                    <option value="Yatim">Yatim</option>
                                    <option value="Piatu">Piatu</option>
                                    <option value="Yatim Piatu">Yatim Piatu</option>
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
                                <label>Tipe</label>
                                <select wire:model="tipe" class="form-control @error("tipe") is-invalid @enderror" id="">
                                    <option value="">-- Pilih Tipe --</option>
                                    <option value="Santri Dalam">Santri Dalam</option>
                                    <option value="Santri Luar">Santri Luar</option>
                                    <option value="Alumni">Alumni</option>
                                </select>
                                @error("tipe")
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6">
                            <div class="form-group">
                                <label>Tanggal Masuk</label>
                                <input type="date" class="form-control" wire:model="tgl_masuk" id="">
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6">
                            <div class="form-group">
                                <label>Tanggal Keluar</label>
                                <input type="date" class="form-control" wire:model="tgl_keluar" id="">
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6">
                            <div class="form-group">
                                <label>Nama Ayah Kandung</label>
                                <input type="text" wire:model="nama_ayah_kandung" class="form-control @error("nama_ayah_kandung") is-invalid @enderror" id="">
                                @error("nama_ayah_kandung")
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6">
                            <div class="form-group">
                                <label>Nama Ibu Kandung</label>
                                <input type="text" wire:model="nama_ibu_kandung" class="form-control @error("nama_ibu_kandung") is-invalid @enderror" id="">
                                @error("nama_ibu_kandung")
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6">
                            <div class="form-group">
                                <label>No Handphone Wali</label>
                                <input type="text" wire:model="nohp_ortu" class="form-control @error("nohp_ortu") is-invalid @enderror" id="">
                                @error("nohp_ortu")
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6">
                            <div class="form-group">
                                <label>Nama Wali</label>
                                <input type="text" wire:model="pemilik_nohp" class="form-control @error("pemilik_nohp") is-invalid @enderror" id="">
                                @error("pemilik_nohp")
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6">
                            <div class="form-group">
                                <label>Rekomendasi / Penanggung Jawab</label>
                                <input type="text" wire:model="wali_anak" class="form-control @error("wali_anak") is-invalid @enderror" id="">
                                @error("wali_anak")
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12 mt-3">
                            <button class="btn btn-success btn-block" wire:loading.attr="disabled">
                                Tambah Data Anak
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
  </section>

  <livewire:import.import-santri>
  <!-- /.content -->
</div>