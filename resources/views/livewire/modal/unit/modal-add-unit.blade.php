<!-- Modal -->
<div wire:ignore.self class="modal fade" id="modal-add-unit" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah Unit</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form wire:submit.prevent="store">
          <div class="row">
            <div class="col-12">
              <div class="form-group">
                <label for="">Nama Unit</label>
                <input type="text" wire:model="unit" class="form-control @error('unit') is-invalid @enderror" id="" placeholder="Nama Unit" autofocus>
                @error('unit')
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
                @enderror
              </div>
            </div>
            <div class="col-12">
              <button type="submit" class="btn btn-success btn-block mt-2">Tambah Satuan</button>
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