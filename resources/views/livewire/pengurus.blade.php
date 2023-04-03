<div>
    
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Data Pengurus</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
            <li class="breadcrumb-item active">Data Pengurus</li>
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
                    <div class="col-sm-12 col-md-12 col-lg-3 col-xl-3 text-right">
                        <div class="row">
                            <div class="col-sm-12 col-md-6 mt-2">
                                <button wire:click="exportExcel" class="btn btn-success btn-sm btn-block"><b><i class="fas fa-file-excel"></i> Export Excel</b></button>
                            </div>
                            <div class="col-sm-12 col-md-6 mt-2">
                                <a href="{{ route('export.pengurus.pdf') }}" class="btn btn-danger btn-sm btn-block"><b><i class="fas fa-file-pdf"></i> Export PDF</b></a>
                            </div>
                            {{-- <div class="col-sm-12 col-md-4">
                                @if (auth()->user()->role == 'admin-yayasan' || Auth()->user()->role == 'ketua-yayasan')
                                    <a href="{{ route('tambah.pengurus') }}" class="btn btn-primary btn-sm btn-block"><b><i class="fas fa-plus"></i> Data Pengurus</b></a>
                                @endif
                            </div> --}}
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body p-0">
                <div class="row justify-content-end">
                    <div class="col-0 mr-3 mt-2">
                        <input type="text" wire:model="search" class="form-control rounded-pill" placeholder="Cari">
                    </div>
                    <div class="col-12 mt-2">
                        <table class="table-data">
                            <thead>
                                <tr>
                                    <th scope="col">Foto</th>
                                    <th scope="col">Nama</th>
                                    <th scope="col">Jabatan</th>
                                    @if (auth()->user()->role == 'admin-yayasan' || Auth()->user()->role == 'ketua-yayasan')
                                        <th scope="col">Aksi</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody wire:sortable="updatePengurusOrder">
                                @php
                                    $no = 1;
                                @endphp
                                @foreach ($penguruses as $index => $pengurus)
                                    <tr wire:sortable.item="{{ $pengurus->id }}" wire:key="pengurus-{{ $pengurus->id }}" class="sortable-item">
                                        <td data-label="Foto">
                                            @if ($pengurus->foto)
                                                <img src="{{ asset('storage/'.$pengurus->foto) }}" class="img-fluid img-thumbnail w-25" alt="{{ $pengurus->nama_lengkap }}" srcset="">
                                            @else
                                                <img src="{{ asset('./template/dist/img/default-picture.png') }}" class="img-fluid img-thumbnail w-50" alt="{{ $pengurus->nama_lengkap }}" srcset="">
                                            @endif
                                        </td>
                                        <td data-label="Nama">
                                            {{ $pengurus->nama }}
                                        </td>
                                        <td data-label="Jabatan">
                                            {{ $pengurus->jabatan }}
                                        </td>
                                        @if (auth()->user()->role == 'admin-yayasan' || Auth()->user()->role == 'ketua-yayasan')
                                            <td data-label="Aksi">
                                                <div class="btn-group-vertical" role="group" aria-label="Basic example">
                                                    <a href="{{ route('profile.pengurus',$pengurus->id) }}" class="btn btn-primary btn-sm mb-2" data-toggle="tooltip" data-placement="top" title="Profil Pengurus"><i class="fas fa-user"></i> Profil Pengurus</a>
                                                    <button wire:click="deleteConfirmation('{{ $pengurus->id }}')" class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="top" title="Hapus Data Pengurus"><i class="fas fa-trash"></i> Hapus</button>
                                                </div>
                                            </td>
                                        @endif
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
  </section>
  <!-- /.content -->
</div>

@push('sortable-scripts')
    <script src="https://cdn.jsdelivr.net/gh/livewire/sortable@v0.x.x/dist/livewire-sortable.js"></script>
@endpush