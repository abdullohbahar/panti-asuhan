<div>
  <div class="card card-outline card-primary">
    <div class="card-header text-center">
      <a href="../../index2.html" class="h1"><b>Admin</b>LTE</a>
    </div>
    <div class="card-body">
      @if (session()->has('message'))
        <div class="alert alert-danger">{{ session('message') }}</div>
      @endif
      <form wire:submit.prevent="store">
        <div class="input-group mb-3">
          <input type="text" wire:model="username" class="form-control @error("username") is-invalid @enderror" placeholder="Username">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
          @error("username")
            <div class="invalid-feedback">
              {{ $message }}
            </div>
          @enderror
        </div>
        <div class="input-group mb-3">
          <input type="password" wire:model="password" class="form-control @error("password") is-invalid @enderror" placeholder="Password" id="password">
          <div class="input-group-append" id="showPassword">
            <div class="input-group-text">
              <span id="icon" class="fas fa-eye"></span>
            </div>
          </div>
          @error("password")
            <div class="invalid-feedback">
              {{ $message }}
            </div>
          @enderror
        </div>
        <div class="row">
          <!-- /.col -->
          <div class="col-12">
            <button type="submit" class="btn btn-primary btn-block">Masuk</button>
          </div>
          <!-- /.col -->
        </div>
      </form>
    </div>
    <!-- /.card-body -->
  </div>
</div>