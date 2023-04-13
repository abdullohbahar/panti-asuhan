<!-- Modal -->
<div wire:ignore.self class="modal fade" id="modal-edit-penomoran-surat" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Penomoran Surat</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form wire:submit.prevent="update">
            <div class="row">
                <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6">
                    <div class="form-group">
                        <label>Surat <i>* Biarkan kosong jika tidak ingin mengubah surat</i></label>
                        <input type="file" wire:model="file" class="form-control @error("file") is-invalid @enderror" id="">
                        @error("file")
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6">
                    <div class="form-group">
                        <label>Perihal Surat</label>
                        <input type="text" wire:model="perihal" class="form-control @error("perihal") is-invalid @enderror" id="">
                        @error("perihal")
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6">
                    <div class="form-group">
                        <label>Tanggal Surat Keluar</label>
                        <input type="date" wire:model="tgl_keluar" class="form-control @error("tgl_keluar") is-invalid @enderror" id="">
                        @error("tgl_keluar")
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6">
                    <div class="form-group">
                        <label>Tujuan</label>
                        <input type="text" wire:model="tujuan" class="form-control @error("tujuan") is-invalid @enderror" id="">
                        @error("tujuan")
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="col-12 mt-3">
                    <button class="btn btn-success btn-block" wire:loading.attr="disabled">
                        Tambah
                    </button>
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