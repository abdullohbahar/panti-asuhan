<!-- Modal -->
<div wire:ignore.self class="modal fade" id="modal-edit-donation-item" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Ubah Donatur</h5>
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
                <select name="donatur_id" wire:model="donatur_id" style="width: 100%" class="form-control select2 @error('donatur_id') is-invalid @enderror">
                  <option>-- Pilih Donatur --</option>
                  @foreach ($donaturs as $donatur)
                      <option value="{{ $donatur->id }}">{{ $donatur->nama }}</option>
                  @endforeach
                </select>
                @error('donatur_id')
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
                @enderror
              </div>
            </div>
            <div class="col-12">
              <div class="form-group">
                <label for="">Tanggal Donasi</label>
                <input type="date" wire:model="tanggal_sumbangan" class="form-control @error('tanggal_sumbangan') is-invalid @enderror" autofocus>
                @error('tanggal_sumbangan')
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
                @enderror
              </div>
            </div>
            <div class="col-12">
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