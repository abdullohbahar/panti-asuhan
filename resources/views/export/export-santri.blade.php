<!DOCTYPE html>
<html lang="en">
<head>
    <style>
        @media print
    {    
        .no-print, .no-print *
        {
            display: none !important;
        }
    }
    </style>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Data {{ $tipe }}</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.0/css/all.min.css" integrity="sha512-BnbUDfEUfV0Slx6TunuB042k9tuKe3xrD6q4mg5Ed72LTgzDIcLPxg6yI2gcMFRyomt+yJJxE+zJwNmxki6/RA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <div class="container-fluid">
        <div class="row justify-content-between mt-3">
            <div class="col-1">
                <a href="{{ url()->previous() }}" class="btn btn-warning no-print">
                    Back
                </a>
            </div>
            <div class="col-2">
                <button onclick="window.print();return false;" class="btn btn-success no-print">
                    <i class="fas fa-print"></i>
                    Export
                </button>
            </div>
        </div>
        <div class="row justify-content-center mt-5">
            <div class="col-12">
                <table border="1" class="table table-bordered">
                    <thead>
                        <tr>
                            <td>
                                No
                            </td>
                            <td style="width: 140px">
                                Foto
                            </td>
                            <td>
                                Nomor Induk Santri
                            </td>
                            <td>
                                Nomor Induk Keluarga
                            </td>
                            <td>
                                Nama
                            </td>
                            <td>
                                Jenis Kelamin
                            </td>
                            <td>
                                Tempat, Tanggal Lahir
                            </td>
                            <td>
                                Usia
                            </td>
                            <td>
                                Pendidikan
                            </td>
                            <td>
                                Tipe
                            </td>
                            <td>
                                Alamat
                            </td>
                            <td>
                                Status
                            </td>
                            <td>
                                Tanggal masuk
                            </td>
                            <td>
                                Tanggal Keluar
                            </td>
                            <td>
                                Nama Ayah Kandung
                            </td>
                            <td>
                                Nama Ibu Kandung
                            </td>
                            <td>
                                Nomor HP Wali
                            </td>
                            <td>
                                Nama Wali
                            </td>
                            <td>
                                Rekomendasi / Penanggung Jawab
                            </td>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $no = 1;
                        @endphp
                        @foreach ($santris as $santri)
                            <tr>
                                <td>
                                    {{ $no++ }}
                                </td>
                                <td>
                                    <img src="{{ asset('storage/'.$santri->foto) }}" class="w-100" alt="" srcset="">
                                </td>
                                <td>
                                    {{ $santri->nik }}
                                </td>
                                <td>
                                    {{ $santri->nis }}
                                </td>
                                <td>
                                    {{ $santri->nama_lengkap }}
                                </td>
                                <td>
                                    {{ $santri->jenis_kelamin }}
                                </td>
                                <td>
                                    {{ $santri->tempat_lahir }}, {{ $santri->tanggal_lahir }}
                                </td>
                                <td>
                                    {{ \Carbon\Carbon::parse($santri->tanggal_lahir)->age }}
                                </td>
                                <td>
                                    {{ $santri->pendidikan }}
                                </td>
                                <td>
                                    {{ $santri->tipe }}
                                </td>
                                <td>
                                    {{ $santri->alamat }}
                                </td>
                                <td>
                                    {{ $santri->status }}
                                </td>
                                <td>
                                    {{ $santri->tgl_masuk }}
                                </td>
                                <td>
                                    {{ $santri->tgl_keluar }}
                                </td>
                                <td>
                                    {{ $santri->nama_ayah_kandung }}
                                </td>
                                <td>
                                    {{ $santri->nama_ibu_kandung }}
                                </td>
                                <td>
                                    {{ $santri->nohp_ortu }}
                                </td>
                                <td>
                                    {{ $santri->pemilik_nohp }}
                                </td>
                                <td>
                                    {{ $santri->wali_anak }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>
</body>
</html>