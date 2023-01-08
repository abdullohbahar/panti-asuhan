<!-- Modal -->
<div wire:ignore.self class="modal fade" id="modal-edit-donation-item" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                  <input type="text" wire:model="nama" name="nama" class="form-control @error("nama") is-invalid @enderror" required>
                  @error("nama")
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
                <input type="date" wire:model="tanggal_donasi" class="form-control @error('tanggal_donasi') is-invalid @enderror" autofocus>
                @error('tanggal_donasi')
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
                @enderror
              </div>
            </div>
            {{-- <div class="col-12">
              <div class="form-group">
                <label>Jumlah</label>
                <div class="input-group">
                  <input wire:model="jumlah" type="text" class="form-control">
                  <select wire:model="satuan" class="form-control" id="">
                    <option>-- Pilih Satuan --</option>
                    @foreach ($units as $unit)
                      <option value="{{ $unit->unit }}">{{ $unit->unit }}</option>
                    @endforeach
                  </select>
                </div>
              </div>
            </div> --}}
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
              <button type="submit" class="btn btn-success btn-block mt-2">Ubah Donasi</button>
            </div>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal" wire:click="resetInput">Close</button>
      </div>
    </div>
  </div>
</div>