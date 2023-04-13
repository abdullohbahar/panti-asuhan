<div>
    <!-- Modal -->
    <div wire:ignore.self class="modal fade" id="import" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Import Laporan Pemasukan dan Pengeluaran</h5>
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
                            <li>Tanggal</li>
                            <li>Jenis (Pemasukan / Pengeluaran)</li>
                        </ul>
                        <p>Untuk kolom lain dikosongkan tidak masalah.</p>
                        <hr>
                        <b>Penjelasan Pengisian Kolom</b>
                        <ul>
                            <li>Kolom <b>Tanggal</b> diisi dengan tanggal-bulan-tahun misal 20-31-2022</li>
                            <li>Kolom <b>Jenis</b> diisi sesuai yang ada pada tanda kurung diatas. <b><i>BESAR KECILNYA HURUF HARAP DIPERHATIKAN</i></b style="color:red;"> Jika <b>JENIS</b> tidak sesuai maka data tidak akan muncul dihalaman data</li></li>
                        </ul>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</div>