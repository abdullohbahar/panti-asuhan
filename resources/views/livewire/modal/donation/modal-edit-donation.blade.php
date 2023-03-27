<!-- Modal -->
<div wire:ignore.self class="modal fade" id="modal-edit-donation" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Ubah Donasi</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form wire:submit.prevent="update">
          <div class="row">
            <div class="col-12">
              <div class="form-group">
                  <label for="">Nama Donatur</label>
                  <input type="text" wire:model="nama_donatur" name="nama_donatur" class="form-control @error("nama_donatur") is-invalid @enderror" required>
                  @error("nama_donatur")
                      <div class="invalid-feedback">
                          {{ $message }}
                      </div>
                  @enderror
              </div>
            </div>
            <div class="col-12">
                <div class="form-group">
                    <label for="">Nomor HP Donatur</label>
                    <input type="text" wire:model="no_hp" name="no_hp" class="form-control">
                </div>
            </div>
            <div class="col-12">
                <div class="form-group">
                    <label>Alamat Donatur</label>
                    <textarea type="text" wire:model="alamat" class="form-control @error("alamat") is-invalid @enderror"></textarea>
                    @error("alamat")
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>
            <div class="col-12 my-2">
              <h5>
                <div class="row">
                    <div class="col-sm-12 col-md-6">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" wire:model="tipe" id="Zakat" value="Zakat">
                            <label class="form-check-label" for="Zakat">Zakat</label>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-6">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" wire:model="tipe" id="Infaq" value="Sodaqoh / Infaq">
                            <label class="form-check-label" for="Infaq">Sodaqoh / Infaq</label>
                        </div>
                    </div>
                    {{-- <div class="col-sm-12 col-md-6">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" wire:model="tipe" id="Sodaqoh" value="Sodaqoh">
                            <label class="form-check-label" for="Sodaqoh">Sodaqoh</label>
                        </div>
                    </div> --}}
                    <div class="col-sm-12 col-md-6">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" wire:model="tipe" id="OperasiYayasan" value="Operasional Yayasan">
                            <label class="form-check-label" for="OperasiYayasan">Operasional Yayasan</label>
                        </div>
                    </div>
                    {{-- <div class="col-sm-12 col-md-6">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" wire:model="tipe" id="BiayaPendidikan" value="Biaya Pendidikan">
                            <label class="form-check-label" for="BiayaPendidikan">Biaya Pendidikan</label>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-6">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" wire:model="tipe" id="TabunganAnak" value="Tabungan Anak">
                            <label class="form-check-label" for="TabunganAnak">Tabungan Anak</label>
                        </div>
                    </div> --}}
                    <div class="col-sm-12 col-md-6">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" wire:model="tipe" id="Lain-lain" value="Lain-lain">
                            <label class="form-check-label" for="Lain-lain">Lain-lain</label>
                        </div>
                    </div>
                </div>
              </h5>
            </div>
            <div class="col-12">
              <div class="form-group">
                <label for="">Tanggal Donasi</label>
                <input type="date" wire:model="tanggal_donasi" class="form-control @error('tanggal_donasi') is-invalid @enderror">
                @error('tanggal_donasi')
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
                @enderror
              </div>
            </div>
            <div class="col-12">
              <div class="form-group">
                <label for="">Nominal</label>
                <input type="text" wire:model="pemasukan" class="form-control @error('pemasukan') is-invalid @enderror" id="nominal2" placeholder="Nominal" autofocus>
                @error('pemasukan')
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
                @enderror
              </div>
            </div>
            <div class="col-12">
              <div class="form-group">
                <label for="">Terbilang</label>
                <input type="text" wire:model="terbilang" class="form-control @error('terbilang') is-invalid @enderror" id="nominal2" placeholder="Nominal" autofocus>
                @error('terbilang')
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
                @enderror
              </div>
            </div>
            <div class="col-12">
              <div class="form-group">
                  <label>Keterangan</label>
                  <textarea wire:model="keterangan" class="form-control @error('keterangan') is-invalid @enderror"></textarea>
                  @error('keterangan')
                      <div class="invalid-feedback">
                          {{ $message }}
                      </div>
                  @enderror
              </div>
            </div>
            <div class="col-12">
              <button type="submit" class="btn btn-success btn-block mt-2">Ubah</button>
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