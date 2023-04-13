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
            <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6">
              <div class="form-group">
                  <label>Bank</label>
                  <select wire:model="bank" class="form-control" id="">
                      <option value="">-- Pilih Bank --</option>
                      @foreach ($banks as $b)
                          <option value="{{ $b->name }}">{{ $b->name }}</option>
                      @endforeach
                      <option value="lainnya">Lainnya</option>
                  </select>
                  @error("bank")
                      <div class="invalid-feedback">
                          {{ $message }}
                      </div>
                  @enderror
              </div>
            </div>
            <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6">
              <div class="form-group">
                  <label for="" {{ $bank == 'lainnya' ? '' : 'hidden' }}>Bank lainnya</label>
                  <input type="text" {{ $bank == 'lainnya' ? '' : 'hidden' }} class="form-control" wire:model="other_bank" name="other_bank" placeholder="masukkan nama bank" id="other_bank">
              </div>
            </div>
            <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6">
                <div class="form-group">
                    <label>Nomor Rekening </label>
                    <input type="text" wire:model="norek" class="form-control @error("norek") is-invalid @enderror">
                    @error("norek")
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>
            <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6">
                <div class="form-group">
                    <label>Nomor Transaksi</label>
                    <input type="text" wire:model="nomor_transaksi" class="form-control @error("nomor_transaksi") is-invalid @enderror">
                    @error("nomor_transaksi")
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