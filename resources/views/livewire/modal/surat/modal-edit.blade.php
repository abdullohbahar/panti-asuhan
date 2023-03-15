<!-- Modal -->
<div wire:ignore.self class="modal fade" id="modal-edit-letter" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah Unit</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form wire:submit.prevent="update">
            <div class="row">
                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                    <div class="form-group">
                        <label>Surat (<i>Biarkan kosong jika tidak ingin mengubah surat</i>)</label>
                        <input type="file" wire:model="file" class="form-control @error("file") is-invalid @enderror" id="upload{{ $iteration }}">
                        @error("file")
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                    <div class="form-group">
                        <label>Nama Surat</label>
                        <input type="text" wire:model="nama_surat" class="form-control @error("nama_surat") is-invalid @enderror" id="">
                        @error("nama_surat")
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                    <div class="form-group">
                        <label>Nomor Surat</label>
                        <input type="text" wire:model="nomor_surat" class="form-control @error("nomor_surat") is-invalid @enderror" id="">
                        @error("nomor_surat")
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                    <div class="form-group">
                        <label>Tipe</label>
                        <select wire:model="tipe" class="form-control @error("tipe") is-invalid @enderror" id="">
                            <option value="">Tipe</option>
                            <option value="Surat Masuk">Surat Masuk</option>
                            <option value="Surat Keluar">Surat Keluar</option>
                        </select>
                        @error("tipe")
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                    <div class="form-group">
                        <label for="">Keterangan / Uraian</label>
                        <textarea wire:model="keterangan" class="form-control @error("keterangan") is-invalid @enderror" cols="30" rows="10"></textarea>
                        @error("keterangan")
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="col-12 mt-3">
                    <button class="btn btn-success btn-block" wire:loading.attr="disabled">
                        Ubah Surat
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