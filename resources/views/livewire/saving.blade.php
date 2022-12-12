<div>
    {{-- Modal --}}
    @include('livewire.modal.saving.modal-add-saving')
    @include('livewire.modal.saving.modal-edit-saving')
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Tabungan Anak Asuh</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
            <li class="breadcrumb-item active">Tabungan Anak Asuh</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <div class="row justify-content-end">
                    <div class="col-12 text-right">
                        <button id="btnAddSaving" class="btn btn-primary btn-sm"><b><i class="fas fa-plus"></i> Tabungan Anak Asuh</b></button>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="row justify-content-end">
                    <div class="col-0 mr-2">
                        <input type="text" wire:model="search" class="form-control rounded-pill" placeholder="Cari Nama">
                    </div>
                    <div class="col-12 mt-2">
                        <table class="table-data">
                            <thead>
                                <tr>
                                    <th scope="col" style="width: 50px !important">#</th>
                                    <th scope="col">Nama</th>
                                    <th scope="col">Total Tabungan</th>
                                    <th scope="col" style="width: 200px !important">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($count == 0)
                                    <tr>
                                        <td colspan="4">Data Not Found</td>
                                    </tr>
                                @endif
                                @foreach ($savings as $index => $saving)
                                    <tr>
                                        {{-- <td data-label="#">{{ $savings->firstItem() + $index }}</td> --}}
                                        <td data-label="Nama">{{ $saving->nama }}</td>
                                        <td data-label="Total Tabungan">{{ $saving->alamat }}</td>
                                        <td data-label="Aksi">
                                            <button wire:click="show('{{ $saving->id }}')" class="btn btn-info btn-sm" data-toggle="modal" data-target="#modal-edit-donatur" data-toggle="tooltip" data-placement="top" title="Lihat Riwayat Donasi">
                                                <i class="fas fa-history"></i>
                                            </button>
                                            <button wire:click="show('{{ $saving->id }}')" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#modal-edit-donatur" data-toggle="tooltip" data-placement="top" title="Ubah Data Donatur"><i class="fas fa-pencil-alt"></i></button>
                                            <button wire:click="deleteConfirmation('{{ $saving->id }}')" class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="top" title="Hapus Data Donatur"><i class="fas fa-trash-alt"></i></button>
                                        </td>
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

            $("body").on("change", "select[name='donatur_id']", function(){
                @this.donatur_id = $(this).val()
            })

            Livewire.hook('message.processed', (message, component) => {
                $('.select2').select2();
            })
        })
    </script>
@endpush