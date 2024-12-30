<!DOCTYPE html>
<html lang="en">

<head>
    <style>
        @media print {
            body {
                -webkit-print-color-adjust: exact;
                font-size: 10px;
            }


            .no-print,
            .no-print * {
                display: none !important;
            }

            .bg-color {
                background-color: black !important;
                color: white;
            }

            .rp {
                display: flex;
                justify-content: space-between;
                align-items: center;
            }

        }

        @page {
            size: 20.7cm potrait;
            margin-bottom: 0px;
            margin-left: 10px;
            margin-top: 10px;
            margin-right: 0px;
        }

        body {
            font-family: Arial, Helvetica, sans-serif !important;
        }

        .bg-color {
            background-color: black;
            color: white;
        }

        .text-center {
            text-align: center;
        }

        .text-right {
            text-align: right !important;
        }

        /* table{
            border-collapse: collapse;
        } */

        .p-1 {
            padding: 0.25rem !important;
        }

        .rp {
            float: left;
            text-align: left;
            direction: ltr;
        }

        .angka {
            float: right;
            text-align: right;
            direction: rtl;
        }

        p {
            margin: 5px;
        }

        h3 {
            margin: 5px;
        }

        .font-12 {
            font-size: 12px;
        }

        .garis {
            border-top: 5px solid black;
            border-bottom: 1px solid black;
            padding: 1px 0;
        }

        .check {
            display: inline;
            width: 10px;
            height: 10px;
            border: 0px solid black;
            margin-right: 5px;
            margin-top: 10px;
        }

        input[type="checkbox"]:checked {
            width: 10px;
            height: 10px;
            border: 1px solid black;
            margin-right: 5px;
            margin-top: 10px;
        }

        input[type="checkbox"]:checked:before {
            content: "\2713";
            position: relative;
            top: -10px;
            left: 5px;
            font-size: 20px;
            color: black;
        }

        .table {
            width: 100%;
            margin-bottom: 0.15rem;
            color: #212529;
            border-collapse: collapse;
        }

        .table th,
        .table td {
            padding: 0.15rem;
            vertical-align: top;
            border-top: 1px solid #dee2e6;
        }

        .table thead th {
            vertical-align: bottom;
            border-bottom: 2px solid #dee2e6;
        }

        .table tbody+tbody {
            border-top: 2px solid #dee2e6;
        }

        .table-sm th,
        .table-sm td {
            padding: 0.15rem;
        }

        .table-bordered {
            border: 1px solid #dee2e6;
        }

        .table-bordered th,
        .table-bordered td {
            border: 1px solid #dee2e6;
        }

        .table-bordered thead th,
        .table-bordered thead td {
            border-bottom-width: 2px;
        }
    </style>
    <title>Laporan Keuangan</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css"
        integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.0/css/all.min.css" integrity="sha512-BnbUDfEUfV0Slx6TunuB042k9tuKe3xrD6q4mg5Ed72LTgzDIcLPxg6yI2gcMFRyomt+yJJxE+zJwNmxki6/RA==" crossorigin="anonymous" referrerpolicy="no-referrer" /> --}}
</head>

<body>
    <div class="container-fluid mt-3">
        {{-- <div class="row justify-content-between">
                <div class="col-1">
                    <a href="{{ url()->previous() }}" class="btn btn-warning no-print">
                        Back
                    </a>
                </div>
                <div class="col-2">
                    <button onclick="window.print();return false;" class="btn btn-success no-print">
                        Cetak PDF
                    </button>
                </div>
            </div> --}}
        <div class="row text-center">
            <div class="col-12 font-12">
                <img src="data:image/jpeg;base64,{{ $image }}" style="width: 70%" alt="" srcset="">
            </div>
            <div class="garis">

            </div>
            <p style="font-size:12px; font-weight:bold">TANDA TERIMA</p>
            <h4 style="margin: 0px; font-size:12px; font-weight:bold">No : {{ $no }} / Kw-Al Dzikro /
                {{ $bulan }} / {{ date('Y') }}</h4>
            <h5 style="margin: 5px; font-size:12px; font-weight:bold"><i>Assalamu'alaikum Wr. Wb.</i></h5>
        </div>
        <div style="font-size: 12.5px;">
            <table style="width: 100%">
                <tr>
                    <td style="width: 125px !important;">Telah Diterima Dari</td>
                    <td style="width: 500px;">: <b>{{ $nama }}</b></td>
                    <td rowspan="4">
                        <img src="data:image/png;base64, {!! base64_encode($qr) !!}"
                            style="margin-top: -35px; margin-bottom: -15px;">
                    </td>
                </tr>
                <tr>
                    <td style="width: 125px !important;">Alamat</td>
                    <td>: {{ $alamat }}</td>
                </tr>
                <tr>
                    <td style="width: 125px !important;">Nomor HP</td>
                    <td>: {{ $no_hp }}</td>
                </tr>
                <tr>
                    <td>Keterangan Barang</td>
                    <td>:</td>
                </tr>
            </table>
            <table class="table table-bordered" style="width: 100%; margin-top: 2px;">
                <tr>
                    <td>
                        <b>Nama Barang</b>
                    </td>
                    <td>
                        <b>Jumlah</b>
                    </td>
                </tr>
                @foreach ($keterangans as $keterangan)
                    <tr>
                        <td>
                            <p style="margin:1px">
                                {{ $keterangan->nama_barang }}
                            </p>
                        </td>
                        <td>
                            <p style="margin:1px">
                                {{ $keterangan->jumlah }}
                            </p>
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>

        <table style="width: 100%; margin-bottom: -20px;">
            <tr>
                <td colspan="3" style="text-align:center; font-size: 13px;">
                    <h5 style="margin: 5px"><i>Wassalamu'alaikum Wr. Wb.</i></h5>
                </td>
            </tr>
            <tr>
                <td style="width: 215px;">
                    <p style="font-size: 11px">Donatur / Yang Menyerahkan</p>
                </td>
                <td style="text-align: center">
                    <i style="font-size: 10px;">Jazakumullahu Ahsanul Jaza</i>
                </td>
                <td>
                    <p style="font-size: 11px;">Wukirsari, {{ $tanggal }}</p>
                    <p style="font-size: 12px; padding-top: 5px">Yang Menerima</p>
                </td>
            </tr>
            <tr>
                <td>
                </td>
                <td style="text-align: center;">
                    <p>
                        <i style="font-size: 10px;">
                            Semoga Allah memberikan pahala yang berlipat
                        </i>
                    </p>
                    <p style="margin: -10px">
                        <i style="font-size: 10px;">
                            atas apa yang telah diberikan dan menjadi
                        </i>
                    </p>
                    <p>
                        <i style="font-size: 10px;">
                            pembersih bagimu. Aamiin ya Rabbal 'Alamin
                        </i>
                    </p>
                </td>
                <td>
                </td>
            </tr>
            <tr>
                <td>
                    <p style="font-size: 11px;">
                        (&nbsp; {{ $nama }} &nbsp;)
                    </p>
                </td>
                <td></td>
                <td>
                    <p style="font-size: 11px;">
                        (&nbsp; {{ $penerima }} &nbsp;)
                    </p>
                </td>
            </tr>
        </table>
        <p style="font-size: 10px; margin-top:20px; text-align:center">{{ $created_at }}</p>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous">
    </script>
</body>

</html>
