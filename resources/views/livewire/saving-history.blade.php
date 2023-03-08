<div>
    {{-- Modal --}}
    {{-- @include('livewire.modal.saving.modal-add-saving') --}}
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Detail Tabungan Anak Asuh</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
            <li class="breadcrumb-item active">Detail Tabungan Anak Asuh</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <form wire:submit.prevent="store">
                    <div class="row">
                        <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6">
                            <div class="form-group">
                                <label>Nominal</label>
                                <input wire:model="nominal" type="text" class="form-control @error('nominal') is-invalid @enderror" placeholder="Nominal" id="nominal">
                                @error('nominal')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6">
                            <div class="form-group">
                                <label>Status</label>
                                <select wire:model="status" name="status" class="form-control @error('status') is-invalid @enderror" id="" required>
                                    <option>-- Pilih Status --</option>
                                    <option value="Menabung">Menabung</option>
                                    <option value="Mengambil">Mengambil</option>
                                </select>
                                @error('status')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6">
                            <div class="form-group">
                                <label>Tanggal</label>
                                <input wire:model="tanggal" type="date" class="form-control @error('tanggal') is-invalid @enderror">
                                @error('tanggal')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12">
                            <button type="submit" class="btn btn-success btn-block">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>


        <div class="card">
            <div class="card-header">
                <div class="row justify-content-end">
                    <div class="col-12">
                        <h5>Riwayat Menabung</h5>
                    </div>
                </div>
            </div>
            <div class="card-header">
                <div class="row justify-content-end">
                    <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6 text-left">
                        <h5>Saldo Tersedia : <b>{{ "Rp " . number_format($saldo, 2, ',', '.'); }}</b></h5>
                    </div>
                    @if ($count > 0)
                        <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6 text-right">
                            <a href="{{ route('cetak.tabungan.anak.asuh',$savings[0]->saving_id) }}" class="btn btn-info">Cetak</a>
                        </div>
                    @endif
                </div>
            </div>
            <div class="card-body">
                <div class="row justify-content-end">
                    <div class="col-12 mt-2">
                        <table class="table-data">
                            <thead>
                                <tr>
                                    <th scope="col" rowspan="2">#</th>
                                    <th scope="col" rowspan="2">Tanggal</th>
                                    <th scope="col" colspan="2">Transaksi</th>
                                    <th scope="col" rowspan="2">Saldo</th>
                                </tr>
                                <tr>
                                    <th scope="col">Debet</th>
                                    <th scope="col">Kredit</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $no = 1;
                                @endphp
                                @foreach ($savings as $index => $saving)
                                    <tr>
                                        <td data-label="#">{{ $no++ }}</td>
                                        <td data-label="Tanggal">{{ $saving->tanggal }}</td>
                                        <td data-label="Debet">
                                            @if ($saving->mengambil)
                                                {{ "Rp " . number_format($saving->mengambil, 2, ',', '.'); }}
                                            @endif
                                        </td>
                                        <td data-label="Kredit">
                                            @if ($saving->menabung)
                                                {{ "Rp " . number_format($saving->menabung, 2, ',', '.'); }}
                                            @endif
                                        </td>
                                        <td class="text-right" data-label="Saldo">{{ "Rp " . number_format($saving->saldo, 2, ',', '.'); }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                {{-- {{ $donaturs->links() }} --}}
            </div>
        </div>
    </div>
  </section>
  <!-- /.content -->
</div>

@push('component-scripts')
    <script>
        $(document).on("livewire:load", function(){
            $('.select2').select2();

            $("body").on("change", "select[name='anak_asuh_id']", function(){
                @this.anak_asuh_id = $(this).val()
            })

            Livewire.hook('message.processed', (message, component) => {
                $('.select2').select2();
            })

        })
    </script>
@endpush