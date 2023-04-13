<div>
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Profile</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
            <li class="breadcrumb-item active">Profile</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-8">
                <div class="card">
                    <div class="card-body">
                        <form wire:submit.prevent="update" action="">
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="">Username</label>
                                        <input type="text" wire:model="username" class="form-control @error('username') is-invalid @enderror" id="">
                                        @error('username')
                                            <div class="is-invalid">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="">Hak Akses</label>
                                        <input type="text" wire:model="role" class="form-control @error('role') is-invalid @enderror" id="" disabled>
                                        @error('role')
                                            <div class="is-invalid">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="">Password ( <i>Biarkan Kosong Jika Tidak Ingin Mengubah Password</i> )</label>
                                        <div class="input-group">
                                            <input type="password" autocomplete="new-password" wire:model="password" class="form-control @error('password') is-invalid @enderror" id="password">
                                            <div class="input-group-append" id="showPassword">
                                                <div class="input-group-text">
                                                <span id="icon" class="fas fa-eye"></span>
                                                </div>
                                            </div>
                                        </div>
                                        @error('password')
                                            <div class="is-invalid">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12">
                                    <button class="btn btn-success btn-block" type="submit">Simpan</button>
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