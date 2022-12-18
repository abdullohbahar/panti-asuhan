<!-- Modal -->
<div wire:ignore.self class="modal fade" id="modal-add-donatur" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah Donatur</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form wire:submit.prevent="store">
          <div class="row">
            <div class="col-12">
              <div class="form-group">
                <label for="">Nama Donatur</label>
                <input type="text" wire:model="nama" class="form-control @error('nama') is-invalid @enderror" id="" placeholder="Nama Donatur" autofocus>
                @error('nama')
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
                @enderror
              </div>
            </div>
            <div class="col-12">
              <div class="form-group">
                <label for="">Nomor HP</label>
                <input type="text" wire:model="no_hp" class="form-control @error('no_hp') is-invalid @enderror" id="" placeholder="Nomor HP Donatur" autofocus>
                @error('no_hp')
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
                @enderror
              </div>
            </div>
            <div class="col-12">
                <div class="form-group">
                    <label>Alamat Donatur</label>
                    <textarea wire:model="alamat" class="form-control @error('alamat') is-invalid @enderror"></textarea>
                    @error('alamat')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>
            <div class="col-12">
              <button type="submit" class="btn btn-success btn-block mt-2">Tambah Donatur</button>
            </div>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>