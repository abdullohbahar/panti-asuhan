<div>
    @include('livewire.modal.document.unggah-berkas')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Dokumen LKSA</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">Dokumen LKSA</li>
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
                    <div class="col-sm-12 text-right">
                        <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#unggahBerkas"><b><i class="fas fa-file-upload"></i> Upload Berkas</b></button>
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
                                        <th scope="col">#</th>
                                        <th scope="col">Nama Berkas</th>
                                        <th scope="col">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($count == 0)
                                        <tr>
                                            <td colspan="3">Data Not Found</td>
                                        </tr>
                                    @endif
                                    @foreach ($documents as $index => $document)
                                        <tr>
                                            <td data-label="#">{{ $documents->firstItem() + $index }}</td>
                                            <td data-label="Nama Berkas">
                                                {{ $document->name }}
                                            </td>
                                            <td data-label="Aksi">
                                                <button wire:click="download('{{ $document->file }}','{{ $document->name }}')" class="btn btn-info btn-sm">Unduh Berkas</button>
                                                <button wire:click="deleteConfirmation('{{ $document->file }}','{{ $document->id }}')" class="btn btn-danger btn-sm">Hapus Berkas</button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    {{ $documents->links() }}
                </div>
            </div>
        </div>
    </section>
</div>