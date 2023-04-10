<!DOCTYPE html>
<html lang="en">
    <head>
        <style>

        body{
            font-family:Arial, Helvetica, sans-serif !important;
        }
        
        @page { 
            size: 20.7cm potrait;
            margin-bottom: 10px;
            margin-left: 10px;
        }

        .bg-color{
            background-color: black; 
            color:white;
        }

        .text-center{
            text-align: center;
        }

        .text-right{
            text-align: right !important;
        }

        table{
            border-collapse: collapse;
        }

        .p-1{
            padding: 0.25rem!important;
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

        p{
            margin: 5px;
        }

        h3{
            margin: 5px;
        }

        .font-12{
            font-size: 12px;
        }

        .garis {
            border-top: 5px solid black;
            border-bottom: 1px solid black;
            padding: 1px 0;
            margin-right: -100px;
            margin-left: -100px;
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


        </style>
        <title>Tanda Terima Donasi Tunai</title>

        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
        {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.0/css/all.min.css" integrity="sha512-BnbUDfEUfV0Slx6TunuB042k9tuKe3xrD6q4mg5Ed72LTgzDIcLPxg6yI2gcMFRyomt+yJJxE+zJwNmxki6/RA==" crossorigin="anonymous" referrerpolicy="no-referrer" /> --}}
    </head>
    <body>
        <div class="container-fluid mt-3">
            <div class="row text-center">
                <div class="col-12 font-12">
                    <img src="data:image/jpeg;base64,{{ $image }}" style="width: 85%;" alt="" srcset="">
                </div>
                <div class="garis">

                </div>
                <p style="margin: 2px; font-size: 14px"><b>TANDA TERIMA</b></p>
                <p style="margin: 0px; font-size: 13px"><b>No : {{ $no }} / Kw-Al Dzikro / {{ $bulan }} / {{ date('Y') }}</b></p>
                <input type="checkbox" id="Zakat" @if ($tipe == 'Zakat') checked @else class="check" @endif><label for="Zakat" style="font-size: 13px">Zakat</label> &nbsp; &nbsp; &nbsp; &nbsp;
                {{-- <input type="checkbox" id="Infaq" @if ($tipe == 'Infaq') checked @else class="check" @endif><label for="Infaq" style="font-size: 13px">Infaq</label> &nbsp; &nbsp; &nbsp; &nbsp; --}}
                <input type="checkbox" id="Sodaqoh" @if ($tipe == 'Sodaqoh' || $tipe == 'Sodaqoh / Infaq') checked @else class="check" @endif><label for="Sodaqoh" style="font-size: 13px">Sodaqoh / Infaq</label> &nbsp; &nbsp; &nbsp; &nbsp;
                <input type="checkbox" id="OperasiYayasan" @if ($tipe == 'Operasional Yayasan') checked @else class="check" @endif><label for="OperasiYayasan" style="font-size: 13px">Operasional Yayasan</label> &nbsp; &nbsp; &nbsp; &nbsp;
                {{-- <input type="checkbox" id="BiayaPendidikan" @if ($tipe == 'Biaya Pendidikan') checked @else class="check" @endif><label for="BiayaPendidikan" style="font-size: 13px">Biaya Pendidikan</label> &nbsp; &nbsp; &nbsp; &nbsp;
                <input type="checkbox" id="TabunganAnak" @if ($tipe == 'Tabungan Anak') checked @else class="check" @endif><label for="TabunganAnak" style="font-size: 13px">Tabungan Anak</label> &nbsp; &nbsp; &nbsp; &nbsp; --}}
                <input type="checkbox" id="Lain-lain......" @if ($tipe == 'Lain-lain') checked @else class="check" @endif><label style="margin-top: 100px; font-size: 13px;" for="Lain-lain......">Lain-lain..............</label>
                <p style="margin: 5px; font-size: 12px"><b><i>Assalamu'alaikum Wr. Wb.</i></b></p>
            </div>
            <div style="font-size: 12px;">
                <table style="width: 100%">
                    <tr>
                        <td style="width: 150px !important;">Telah Diterima Dari</td>
                        <td>: <b>{{ $nama }}</b></td>
                        <td rowspan="5"><img src="data:image/png;base64, {!! base64_encode($qr) !!} "></td>
                    </tr>
                    <tr>
                        <td style="width: 150px !important;">Alamat</td>
                        <td>: {{ $alamat }}</td>
                    </tr>
                    <tr>
                        <td style="width: 150px !important;">Nomor HP</td>
                        <td>: {{ $no_hp }}</td>
                    </tr>
                    <tr>
                        <td>Uang Sejumlah</td>
                        <td>: {{ "Rp. " . number_format($nominal, 0, '', '.'); }}</td>
                    </tr>
                    <tr>
                        <td>Terbilang</td>
                        <td>: {{ $terbilang }}<td>
                    </tr>
                    <tr>
                        <td>Keterangan</td>
                        <td>: {{ $keterangan }}</td>
                    </tr>
                    <tr>
                        <td colspan="3" style="text-align:center">
                            <h5 style="margin: 5px; font-size: 12px"><i>Wassalamu'alaikum Wr. Wb.</i></h5>
                        </td>
                    </tr>
                </table>
            </div>
            
            <table style="width: 100%">
                <tr>
                    <td style="width: 215px;">
                        <p style="font-size: 12px">Donatur / Yang Menyerahkan</p>
                    </td>
                    <td style="text-align: center">
                        <i style="font-size: 10px;">Jazakumullahu Ahsanul Jaza</i>
                    </td>
                    <td>
                        <p style="font-size: 12px;">Wukirsari, {{ $tanggal }}</p>
                        <p style="font-size: 12px">Yang Menerima</p>
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
                        <p style="font-size: 12px;">
                            (&nbsp; {{ $nama }} &nbsp;)
                        </p>
                    </td>
                    <td></td>
                    <td>
                        <p style="font-size: 12px;">
                            (&nbsp; {{ $penerima }} &nbsp;)
                        </p>
                    </td>
                </tr>
            </table>
            <p style="font-size: 10px; margin-top:20px; text-align:center">{{ $created_at }}</p>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>
    </body>
</html>
