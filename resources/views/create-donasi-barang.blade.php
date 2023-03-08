@extends('layout.app')

@section('title')
Donasi Barang
@endsection

@push('addons-css')
<style>
    .table-data {
        border: 1px solid #ccc;
        border-collapse: collapse;
        margin: 0;
        padding: 0;
        width: 100%;
        table-layout: fixed;
    }

    .table-data caption {
        font-size: 1.5em;
        margin: .5em 0 .75em;
    }

    .table-data tr {
        background-color: #f8f8f8;
        border: 1px solid #ddd;
        padding: .35em;
    }

    .table-data th,
    .table-data td {
        padding: .625em;
        text-align: center;
    }

    .table-data th {
        font-size: .85em;
        letter-spacing: .1em;
        text-transform: uppercase;
    }

    @media screen and (max-width: 600px) {
        .table-data {
            border: 0;
        }

        .table-data caption {
            font-size: 1.3em;
        }

        .table-data thead {
            border: none;
            clip: rect(0 0 0 0);
            height: 1px;
            margin: -1px;
            overflow: hidden;
            padding: 0;
            position: absolute;
            width: 1px;
        }

        .table-data tr {
            border-bottom: 3px solid #ddd;
            display: block;
            margin-bottom: .625em;
        }

        .table-data td {
            border-bottom: 1px solid #ddd;
            display: block;
            font-size: .8em;
            text-align: right;
        }

        .table-data td::before {
            /*
        * aria-label has no advantage, it won't be read inside a table
        content: attr(aria-label);
        */
            content: attr(data-label);
            float: left;
            font-weight: bold;
            text-transform: uppercase;
        }

        .table-data td:last-child {
            border-bottom: 0;
        }
    }

    .tb-width {
        width: 198px;
    }

    @media screen and (max-width: 600px) {
        .tb-width {
            width: 10px;
        }
    }
</style>
@endpush

@section('content')
<div>
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Donasi Barang</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">Donasi Barang</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-sm-12 col-md-10">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('store.donasi.barang') }}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                        <div class="form-group">
                                            <label for="">Nama Donatur</label>
                                            <input type="text" name="nama" value="{{ old("nama") }}" name="nama" class="form-control @error("nama") is-invalid @enderror">
                                            @error("nama")
                                            <div class="invalid-feedback">
                                                Nama harus diisi
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                        <div class="form-group">
                                            <label for="">Nomor HP Donatur</label>
                                            <input type="text" name="no_hp" value="{{ old("no_hp") }}" name="no_hp" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                        <div class="form-group">
                                            <label>Alamat Donatur</label>
                                            <textarea type="text" name="alamat" class="form-control @error("alamat") is-invalid @enderror">{{ old("alamat") }}</textarea>
                                            @error("alamat")
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                        <div class="form-group">
                                            <label>Tanggal Donasi</label>
                                            <input type="date" name="tanggal_donasi" value="{{ old("tanggal_donasi") }}" class="form-control @error("tanggal_donasi") is-invalid @enderror" id="">
                                            @error("tanggal_donasi")
                                            <div class="invalid-feedback">
                                                Tanggal harus diisi
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                        <div class="form-group">
                                            <label>Keterangan Barang</label>
                                            <textarea type="text" name="keterangan" class="form-control @error("keterangan") is-invalid @enderror">{{ old("keterangan") }}</textarea>
                                            @error("keterangan")
                                            <div class="invalid-feedback">
                                                Keterangan barang harus diisi
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12 mt-3">
                                        <button class="btn btn-success btn-block">
                                            Submit
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>
@endsection

@push('addons-js')
@if (session()->has('message'))
<script>
    const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
    })

    Toast.fire({
        icon: 'success',
        title: '{{ session('
        message ') }}'
    })
</script>
@endif
<script>
    // Show modal add donatur
    $("#btnAddMoney").on("click", () => {
        $("#modal-add-donation-money").modal("show")
    })

    $("#btnAddItem").on("click", () => {
        $("#modal-add-donation-item").modal("show")
    })

    $("#btnAddItem").on("click", () => {
        $("#modal-add-donation-item").modal("show")
    })


    window.addEventListener('close-modal', event => {
        // close modal
        $('#modal-add-donation-money').modal('hide')
        $('#modal-edit-donation').modal('hide')
        $('#modal-add-donation-item').modal('hide')
        $('#modal-edit-donation-item').modal('hide')

        // sweetalert success
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        })

        Toast.fire({
            icon: 'success',
            title: event.detail.message
        })
    })

    // Delete Confirmation
    window.addEventListener('show-delete-confirmation', event => {
        Swal.fire({
            title: 'Anda yakin?',
            text: "Kamu tidak bisa mengembalikan data yang terhapus dan data yang berhubungan akan terhapus!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Hapus!'
        }).then((result) => {
            if (result.isConfirmed) {
                Livewire.emit('deleteConfirmed')
            }
        })

    })

    window.addEventListener('deleted', event => {
        Swal.fire(
            'Terhapus',
            event.detail.message,
            'success'
        )
    })
</script>
@endpush