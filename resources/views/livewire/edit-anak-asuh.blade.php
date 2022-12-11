<div>
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Ubah Data Anak Asuh</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">Ubah Data Anak Asuh</li>
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
                </div>
                <div class="card-body">
                    <form wire:submit.prevent="update">
                        <div class="row">
                            <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                <div class="form-group">
                                    <label>Foto Anak *<i>Biarkan Kosong Jika Tidak Ingin Diubah</i></label>
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
                                <img wire:ignore.self src="{{ asset('storage/'.$foto) }}" class="image-fluid w-50 mb-2" id="imagePreview">
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
                                        @if ($jenis_kelamin == "Laki-laki")
                                            <option value="Laki-laki" selected>Laki-laki</option>
                                            <option value="Perempuan">Perempuan</option>
                                        @else
                                            <option value="Laki-laki">Laki-laki</option>
                                            <option value="Perempuan" selected>Perempuan</option>
                                        @endif
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
                                    <label>Keterangan</label>
                                    <textarea wire:model="keterangan" class="form-control @error("keterangan") is-invalid @enderror">{!! $keterangan !!}</textarea>
                                    @error("keterangan")
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
                                        @if ($status == "Aktif")
                                            <option value="Aktif" selected>Aktif</option>
                                            <option value="Non-Aktif">Non-Aktif</option>
                                            @else
                                            <option value="Aktif">Aktif</option>
                                            <option value="Non-Aktif" selected>Non-Aktif</option>
                                        @endif
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
                                    <label>No Handphone Orang Tua</label>
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
                                    <label>Akta Anak *<i>Biarkan kosong jika tidak ingin diubah</i></label>
                                    <input type="file" wire:model="akta" class="form-control @error("akta") is-invalid @enderror">
                                    @error("akta")
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                @if ($akta)
                                    <a target="_blank" class="btn btn-info btn-block" href="{{ asset('storage/'.$akta) }}">Lihat Akta Yang Telah Diupload</a>
                                @endif
                            </div>
                            <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                <div class="form-group">
                                    <label>Kartu Keluarga *<i>Biarkan kosong jika tidak ingin diubah</i></label>
                                    <input type="file" wire:model="kartu_keluarga" class="form-control @error("kartu_keluarga") is-invalid @enderror">
                                    @error("kartu_keluarga")
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                @if ($kartu_keluarga)
                                    <a target="_blank" class="btn btn-info btn-block" href="{{ asset('storage/'.$kartu_keluarga) }}">Lihat Kartu Keluarga Yang Telah Diupload</a>
                                @endif
                            </div>
                            <div class="col-12 mt-3">
                                <button type="submit" class="btn btn-success btn-block">Ubah Data Anak</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>