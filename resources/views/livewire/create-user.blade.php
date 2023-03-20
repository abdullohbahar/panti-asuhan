<div>
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Tambah Data Pengguna</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
            <li class="breadcrumb-item active">Tambah Data Pengguna</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid chocolat-open">
        <div class="row justify-content-center">
            <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6">
                <div class="card">
                    <div class="card-header">
                    </div>
                    <div class="card-body">
                        <form wire:submit.prevent="store">
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label>Username</label>
                                        <input type="text" wire:model="username" class="form-control @error("username") is-invalid @enderror" id="">
                                        @error("username")
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label>Hak Akses</label>
                                        <select wire:model="role" class="form-control @error("role") is-invalid @enderror" id="">
                                            <option value="">-- Pilih Hak Akses --</option>
                                            <option value="admin-yayasan">Admin Yayasan</option>
                                            <option value="pembina-yayasan">Pembina Yayasan</option>
                                            <option value="ketua-yayasan">Ketua Yayasan</option>
                                            <option value="bendahara-yayasan">Bendahara Yayasan</option>
                                            <option value="admin-donasi">Admin Donasi</option>
                                            <option value="sekertariat-yayasan">Sekertariat Yayasan</option>
                                            <option value="ketua-LKSA">Ketua LKSA</option>
                                            <option value="bendahara-LKSA">Bendahara LKSA</option>
                                            <option value="sekertariat-LKSA">Sekertariat LKSA</option>
                                        </select>
                                        @error("role")
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label>Password</label>
                                        <input type="password" autocomplete="new-password" wire:model="password" class="form-control @error("password") is-invalid @enderror" id="">
                                        @error("password")
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12 mt-3">
                                    <button class="btn btn-success btn-block" wire:loading.attr="disabled">
                                        Tambah Pengguna
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
  </section>
  <!-- /.content -->
</div>