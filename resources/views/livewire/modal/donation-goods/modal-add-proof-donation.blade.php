<!-- Modal -->
<div wire:ignore.self class="modal fade" id="modal-add-proof-donation" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Upload Bukti Donasi</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form wire:submit.prevent="store">
          <div class="row">
            <div class="col-12">
              <div class="col-12">
                <div class="form-group">
                  <label for="">Bukti Donasi</label>
                  <input type="file" wire:model="file" class="form-control @error('file') is-invalid @enderror" autofocus>
                  @error('file')
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
                  @enderror
                </div>
              </div>
              <div class="col-12">
                <button type="submit" class="btn btn-success btn-block mt-2">Upload</button>
              </div>
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