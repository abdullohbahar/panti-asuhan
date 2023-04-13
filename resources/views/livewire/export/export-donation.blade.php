<div>
    <!-- Modal -->
    <div wire:ignore.self class="modal fade" id="modal-export-excel" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Export Donasi Excel</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form wire:submit.prevent="export">
                        <div class="row">
                            <div class="col-sm-12 col-md-6 col-lg-6">
                                <div class="form-group">
                                    <label>Mulai Tanggal</label>
                                    <input type="date" wire:model="date1" class="form-control @error('date1') is-invalid @enderror" id="">
                                    @error('date1')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6 col-lg-6">
                                <div class="form-group">
                                    <label for="">Sampai Tanggal</label>
                                    <input type="date" wire:model="date2" class="form-control @error('date2') is-invalid @enderror" id="">
                                    @error('date2')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label>Tipe Donasi</label>
                                    <select wire:model="type" class="form-control @error('type') is-invalid @enderror" id="">
                                        <option value="">-- Pilih Tipe Donasi --</option>
                                        <option value="all">Semua Tipe</option>
                                        <option value="Zakat">Zakat</option>
                                        <option value="Operasional Yayasan">Operasional Yayasan</option>
                                        <option value="Sodaqoh / Infaq">Sodaqoh / Infaq</option>
                                        <option value="Lain-lain">Lain-lain</option>
                                    </select>
                                    @error('type')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <button class="btn btn-success btn-block">Export Excel</button>
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
</div>