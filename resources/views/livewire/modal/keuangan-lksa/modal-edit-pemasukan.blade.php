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
                <label for="">Tanggal</label>
                <input type="date" wire:model="tanggal" class="form-control @error('tanggal') is-invalid @enderror">
                @error('tanggal')
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
            <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6">
                <div class="form-group">
                    <label>Terbilang</label>
                    <textarea class="form-control" wire:model="terbilang" id="terbilang" ></textarea>
                    {{-- <input type="text" id="terbilang" wire:model="terbilang" class="form-control @error("terbilang") is-invalid @enderror"> --}}
                    @error("terbilang")
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>
            <div class="col-12">
              <div class="form-group">
                  <label>Uraian</label>
                  <textarea wire:model="keterangan" cols="30" rows="8" class="form-control @error('keterangan') is-invalid @enderror"></textarea>
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