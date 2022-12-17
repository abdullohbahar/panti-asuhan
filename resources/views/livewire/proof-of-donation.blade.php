<div>
        @include('livewire.modal.donation-goods.modal-add-proof-donation')

  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Bukti Donasi</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
            <li class="breadcrumb-item active">Donasi</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid chocolat-open">
        <div class="card">
            <div class="card-header">
                <div class="row justify-content-between">
                    <div class="col-12">
                        <h5>Bukti Donasi Dari Bapak/Ibu <b class="text-uppercase">{{ $name->donatur->nama }}</b></h5>
                        <h5>Tanggal Donasi : <b class="text-uppercase">{{ $name->tanggal_sumbangan }}</b></h5>
                    </div>
                    <div class="col-12 text-right">
                        <button id="btnAddProofDonation" class="btn btn-primary btn-sm"><b><i class="fas fa-plus"></i> Tambah Bukti Donasi</b></button>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="row text-center">
                    <?php $no = 1 ?>
                    @foreach ($files as $file)
                        <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6 mt-5">
                            <img src="{{ asset('storage/'.$file->file) }}" class="img-fluid" style="width: 300px; height: 300px;" alt="hello" srcset="">
                            <button class="btn btn-danger mt-2 btn-block" wire:click="deleteConfirmation('{{ $file->id }}')">Hapus Foto</button>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="card-footer">
                {{-- {{ $types->links() }} --}}
            </div>
        </div>
    </div>
  </section>
  <!-- /.content -->
</div>