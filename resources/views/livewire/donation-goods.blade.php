<div>
    @include('livewire.modal.donation-goods.modal-add-donation-item')
    <div class="card">
        <div class="card-header">
            <div class="row justify-content-between">
                <div class="col-8">
                    <h5><b>Donasi Berupa Barang</b></h5>
                </div>
                <div class="col-4 text-right">
                    <button id="btnAddItem" class="btn btn-primary btn-sm"><b><i class="fas fa-plus"></i> Donasi</b></button>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="row justify-content-end">
                <div class="col-0 mr-2">
                    <input type="text" wire:model="search" class="form-control rounded-pill" placeholder="Cari">
                </div>
                <div class="col-12 mt-2">
                    <table class="table-data">
                        <thead>
                            <tr>
                                <th scope="col" style="width: 50px !important">#</th>
                                <th scope="col">Nama Donatur</th>
                                <th scope="col">Keterangan</th>
                                <th scope="col">Tanggal Donasi</th>
                                <th scope="col" style="width: 150px !important">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($count == 0)
                                <tr>
                                    <td colspan="5">Data Not Found</td>
                                </tr>
                            @endif
                            @foreach ($donations as $index => $donation)
                                <tr>
                                    <td data-label="#">{{ $donations->firstItem() + $index }}</td>
                                    <td data-label="Tipe Donasi">{{ $donation->donatur->nama }}</td>
                                    <td data-label="Bukti Donasi">{{ $donation->keterangan }}</td>
                                    <td data-label="Tanggal Donasi">{{ $donation->tanggal_sumbangan }}</td>
                                    <td data-label="Aksi">
                                        <a href="{{ route('proof.of.donation',$donation->id) }}" class="btn btn-info btn-sm"><i class="fas fa-upload"></i></a>
                                        <button wire:click="show('{{ $donation->id }}')" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#modal-edit-donation"><i class="fas fa-pencil-alt"></i></button>
                                        <button wire:click="deleteConfirmation('{{ $donation->id }}')" class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="card-footer">
            {{ $donations->links() }}
        </div>
    </div>
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