<!-- Modal -->
<div wire:ignore.self class="modal fade" id="modal-edit-letter" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Surat</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form wire:submit.prevent="update">
            <div class="row">
                <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6">
                    <div class="form-group">
                        <label>Surat</label>
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
                        <label>Nama Pengirim</label>
                        <input type="text" wire:model="nama_pengirim" class="form-control @error("nama_pengirim") is-invalid @enderror" id="">
                        @error("nama_pengirim")
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6">
                    <div class="form-group">
                        <label>Perihal Surat</label>
                        <input type="text" wire:model="perihal_surat" class="form-control @error("perihal_surat") is-invalid @enderror" id="">
                        @error("perihal_surat")
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6">
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
                <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6">
                    <div class="form-group">
                        <label>Tanggal Surat</label>
                        <input type="date" wire:model="tanggal" class="form-control @error("tanggal") is-invalid @enderror" id="">
                        @error("tanggal")
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                    <div class="form-group">
                        <label for="">Isi Surat</label>
                        <textarea wire:model="isi_surat" class="form-control @error("isi_surat") is-invalid @enderror" cols="30" rows="10"></textarea>
                        @error("isi_surat")
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="col-12 mt-3">
                    <button class="btn btn-success btn-block" wire:loading.attr="disabled">
                        Edit Surat
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