<div>
    <!-- Modal -->
    <div wire:ignore.self class="modal fade" id="importSantri" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Import Santri</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <div class="modal-body">
                <form wire:submit.prevent="store">
                    <div class="row">
                        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                            <div class="form-group">
                                <label for="">File Excel</label>
                                <input type="file" wire:model="file" class="form-control @error('file') is-invalid @enderror" id="upload{{ $iteration }}">
                                @error('file')
                                <div class="invalid-feedback">
                                {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12">
                            <button type="submit" class="btn btn-success btn-block" wire:loading.attr="disabled">Import</button>
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

    <!-- Modal -->
    <div wire:ignore.self class="modal fade" id="petunjuk" aria-labelledby="petunjuk" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="petunjuk">Petunjuk</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-12">
                        Untuk melakukan pengisian excel, anda wajib mengisi kolom
                        <ul>
                            <li>Nama Lengkap</li>
                            <li>Jenis Kelamin (Laki-Laki / Perempuan)</li>
                            <li>Tipe (Santri Dalam / Santri Luar / Alumni)</li>
                            <li>Status (Yatim / Piatu / Yatim Piatu)</li>
                        </ul>
                        <p>Untuk kolom lain dikosongkan tidak masalah.</p>
                        <p>Untuk Pengisian Jenis Kelamin, Tipe, dan Status harus disesuaikan dengan yang ada didalam kurung. <b>Jika TIPE tidak sesuai maka data tidak akan muncul dihalaman data santri</b></p>
                        <p>Untuk import excel tidak support foto</p>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</div>