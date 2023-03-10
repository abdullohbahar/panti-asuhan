<!-- Modal -->
<div wire:ignore.self class="modal fade" id="unggahBerkas" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Unggah Berkas</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form wire:submit.prevent="store">
          <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
              <div class="form-group">
                <label for="">Nama Berkas</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" wire:model="name" id="">
                @error('name')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
                @enderror
              </div>
            </div>
            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
              <div class="form-group">
                <label for="">Berkas</label>
                <input type="file" class="form-control @error('file') is-invalid @enderror" wire:model="file" id="upload{{ $iteration }}">
                @error('file')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
                @enderror
              </div>
            </div>
            <div class="col-12">
              <button type="submit" class="btn btn-success btn-block" wire:loading.attr="disabled">Simpan</button>
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