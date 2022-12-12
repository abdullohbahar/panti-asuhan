<!-- Modal -->
<div wire:ignore.self class="modal fade" id="modal-add-saving" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah Tabungan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form wire:submit.prevent="store">
          <div class="row">
            <div class="col-12">
              <div class="form-group">
                <label for="">Nama Anak Asuh</label>
                <select wire:model="anak_asuh_id" style="width: 100%" class="form-control select2 @error('anak_asuh_id') is-invalid @enderror">
                  <option>-- Pilih Anak Asuh --</option>
                  @foreach ($childs as $child)
                      <option value="{{ $child->id }}">{{ $child->nama_lengkap }}</option>
                  @endforeach
                </select>
                @error('anak_asuh_id')
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
                @enderror
              </div>
            </div>
            <div class="col-12">
              <button type="submit" class="btn btn-success btn-block mt-2">Tambah Tabungan</button>
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