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
                                    <label>No Handphone</label>
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
                                    <label>Pemilik No Handphone</label>
                                    {{-- <select name="pemilik_nohp" class="form-control" id="">
                                        <option value="Ayah">Ayah</option>
                                        <option value="Ibu">Ibu</option>
                                        <option value="Lain-lain">Lain-lain</option>
                                    </select> --}}
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