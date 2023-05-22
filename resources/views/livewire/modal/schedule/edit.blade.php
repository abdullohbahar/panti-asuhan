<!-- Modal -->
<div wire:ignore.self class="modal fade" id="modal-edit-agenda" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Agenda Kegiatan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form wire:submit.prevent="update">
            <div class="row">
                <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6">
                    <div class="form-group">
                        <label>Tanggal</label>
                        <input type="date" wire:model="tanggal" class="form-control @error("tanggal") is-invalid @enderror" id="">
                        @error("tanggal")
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6">
                    <div class="form-group">
                        <label>Acara</label>
                        <input type="text" wire:model="acara" class="form-control @error("acara") is-invalid @enderror" id="">
                        @error("acara")
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6">
                    <div class="form-group">
                        <label>Pengundang</label>
                        <input type="text" wire:model="pengundang" class="form-control @error("pengundang") is-invalid @enderror" id="">
                        @error("pengundang")
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6">
                    <div class="form-group">
                        <label>Nomor HP Pengundang</label>
                        <input type="text" wire:model="nomor_hp_pengundang" class="form-control @error("nomor_hp_pengundang") is-invalid @enderror" id="">
                        @error("nomor_hp_pengundang")
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6">
                    <div class="form-group">
                        <label>Keterangan</label>
                        <textarea wire:model="keterangan" class="form-control @error("keterangan") is-invalid @enderror"></textarea>
                        @error("keterangan")
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