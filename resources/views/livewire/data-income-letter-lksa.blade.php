<div>
    {{-- Modal --}}
    @include('livewire.modal.surat.modal-edit-masuk')
    @include('livewire.modal.surat.modal-detail-surat')

  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Data Surat Masuk LKSA</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
            <li class="breadcrumb-item active">Data Surat Masuk LKSA</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-body p-0">
                <div class="row justify-content-end">
                    <div class="col-0 mr-3 mt-2">
                        <input type="text" wire:model="search" class="form-control rounded-pill" placeholder="Cari perihal">
                    </div>
                    <div class="col-12 mt-2">
                        <table class="table-data">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Nama Pengirim</th>
                                    <th scope="col">Nomor Surat</th>
                                    <th scope="col">Perihal Surat</th>
                                    <th scope="col">Tanggal Surat</th>
                                    <th scope="col">File</th>
                                    @if (auth()->user()->role == 'admin-yayasan' || Auth()->user()->role == 'ketua-yayasan')
                                        <th scope="col">Aksi</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($letters as $index => $letter)
                                    <tr>
                                        <td data-label="#">{{ $letters->firstItem() + $index }}</td>
                                        <td data-label="Nama Pengirim">{{ $letter->nama_pengirim }}</td>
                                        <td data-label="Nomor Surat">{{ $letter->nomor_surat }}</td>
                                        <td data-label="Perihal Surat">{{ $letter->perihal_surat }}</td>
                                        <td data-label="Tanggal Surat">{{ $letter->tanggal }}</td>
                                        <td data-label="File"><button wire:click="download('{{ $letter->file }}','{{ $letter->perihal_surat }}')" class="btn btn-sm btn-success">Unduh Surat</button></td>
                                        @if (auth()->user()->role == 'admin-yayasan' || Auth()->user()->role == 'ketua-yayasan' || Auth()->user()->role == 'sekertariat-yayasan')
                                            <td data-label="Aksi">
                                                <button id="edit" wire:click="show('{{ $letter->id }}')" data-jenis="{{ $letter->jenis_donasi }}" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#modal-edit-letter" data-toggle="tooltip" data-placement="top" title="Ubah Surat"><i class="fas fa-pencil-alt"></i></button>
                                                <button wire:click="show('{{ $letter->id }}')" class="btn btn-info btn-sm" data-toggle="modal" data-target="#modal-detail-letter"><i class="fas fa-eye"></i></button>
                                                <button wire:click="deleteConfirmation('{{ $letter->id }}','{{ $letter->file }}')" class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="top" title="Hapus Surat"><i class="fas fa-trash-alt"></i></button>
                                            </td>
                                        @endif
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                {{ $letters->links() }}
            </div>
        </div>
    </div>
  </section>
</div>

@push('component-scripts')
    <script src="https://unpkg.com/@develoka/angka-terbilang-js/index.min.js"></script>

    <script>
        $(document).on("livewire:load", function(){
            $('.select2').select2();

            $("body").on("change", "select[name='donatur_id']", function(){
                @this.donatur_id = $(this).val()
            })

            $("body").on("click","#search", () => {
                var donatur = $("#donaturs").val();
                @this.filterDonaturId = donatur
            })

            Livewire.hook('message.processed', (message, component) => {
                $('.select2').select2();
            })

        })

        $("body").on("keyup","#nominal2",() => {
            var val = $("#nominal2").val()
            var angka = val.replace(/,.*|[^0-9]/g, '')
            var terbilang = angkaTerbilang(angka)
            @this.terbilang = terbilang + ' rupiah'
            $("#terbilang").val(terbilang)
        })


        var rupiah = document.getElementById("nominal2");
        rupiah.addEventListener("keyup", function (e) {
            // tambahkan 'Rp.' pada saat form di ketik
            // gunakan fungsi formatRupiah() untuk mengubah angka yang di ketik menjadi format angka
            rupiah.value = formatRupiah(this.value, "Rp. ");
        });

        /* Fungsi formatRupiah */
        function formatRupiah(angka, prefix) {
            var number_string = angka.replace(/[^,\d]/g, "").toString(),
                split = number_string.split(","),
                sisa = split[0].length % 3,
                rupiah = split[0].substr(0, sisa),
                ribuan = split[0].substr(sisa).match(/\d{3}/gi);

            // tambahkan titik jika yang di input sudah menjadi angka ribuan
            if (ribuan) {
                separator = sisa ? "." : "";
                rupiah += separator + ribuan.join(".");
            }

            rupiah = split[1] != undefined ? rupiah + "," + split[1] : rupiah;
            return prefix == undefined ? rupiah : rupiah ? "Rp. " + rupiah : "";
        }

        $("body").on("click", "#edit", function(){
            var jenis = $(this).data("jenis");
            if(jenis == "Transfer"){
                
            }
        })

    </script>
@endpush