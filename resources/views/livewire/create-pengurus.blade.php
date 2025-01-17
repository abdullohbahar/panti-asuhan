<div>
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Tambah Pengurus</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
            <li class="breadcrumb-item active">Tambah Pengurus</li>
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
                <button class="btn btn-success mt-2" data-toggle="modal" data-target="#importPengurus"><i class="fas fa-file-excel"></i> Import Melalui Excel</button>
            </div>
            <div class="card-body">
                <form wire:submit.prevent="store">
                    <div class="row">
                        <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6">
                            <div class="form-group">
                                <label>Foto Pengurus</label>
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
                                <input type="text" wire:model="nama" class="form-control @error("nama") is-invalid @enderror" id="">
                                @error("nama")
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6">
                            <label>Masa Bakti</label>
                            <div class="row">
                                <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6">
                                    <div class="form-group">
                                        <label for="">Dari</label>
                                        <input type="date" wire:model="from" class="form-control @error('from') is-invalid @enderror" id="">
                                        @error("from")
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6">
                                    <div class="form-group">
                                        <label for="">Sampai</label>
                                        <input type="date" wire:model="to" class="form-control @error('to') is-invalid @enderror" id="">
                                        @error("to")
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6">
                            <label for="">&nbsp;</label>
                            <div class="form-group">
                                <label>Nomor Telepon</label>
                                <input type="text" wire:model="no_hp" class="form-control @error("no_hp") is-invalid @enderror" id="">
                                @error("no_hp")
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
                                <label>Jabatan</label>
                                <select wire:model="jabatan" class="form-control @error("jabatan") is-invalid @enderror" id="">
                                    <option value="">-- Pilih Jabatan --</option>
                                    @foreach ($positions as $position)
                                        <option value="{{ $position->name }}">{{ $position->name }}</option>
                                    @endforeach
                                </select>
                                @error("jabatan")
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6">
                            <div class="form-group">
                                <label>Pendidikan</label>
                                <select wire:model="pendidikan" class="form-control @error("pendidikan") is-invalid @enderror" id="">
                                    <option value="">-- Pilih Pendidikan --</option>
                                    @foreach ($pendidikans as $pendidikan)
                                        <option value="{{ $pendidikan->name }}">{{ $pendidikan->name }}</option>
                                    @endforeach
                                </select>
                                {{-- <input type="text" wire:model="pendidikan" class="form-control @error("pendidikan") is-invalid @enderror" id=""> --}}
                                @error("pendidikan")
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6">
                            <div class="form-group">
                                <label>Pekerjaan</label>
                                <input type="text" wire:model="pekerjaan" class="form-control @error("pekerjaan") is-invalid @enderror" id="">
                                @error("pekerjaan")
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6">
                            <div class="form-group">
                                <label>Status Pengurus</label>
                                <select wire:model="status" class="form-control @error("status") is-invalid @enderror" id="">
                                    <option value="">-- Pilih Status --</option>
                                    <option value="Pengurus Aktif">Pengurus Aktif</option>
                                    <option value="Pengurus Mengundurkan Diri">Pengurus Mengundurkan Diri</option>
                                    <option value="Pengurus Meninggal">Pengurus Meninggal</option>
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
                                <label>Alamat</label>
                                <textarea wire:model="alamat" class="form-control @error("alamat") is-invalid @enderror"></textarea>
                                @error("alamat")
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12 mt-3">
                            <button class="btn btn-success btn-block" wire:loading.attr="disabled">
                                Tambah Data Pengurus
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <livewire:import.import-pengurus>
  </section>
  <!-- /.content -->
</div>