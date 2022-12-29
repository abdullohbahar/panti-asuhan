<!DOCTYPE html>
<html lang="en">
    <head>
        <style>

            @media print
        {    
            body {
                -webkit-print-color-adjust: exact;
                font-size: 10px;
            }
            
            
            .no-print, .no-print *
            {
                display: none !important;
            }

            .bg-color{
                background-color: black !important; 
                color:white;
            }

            .rp {
                display: flex;
                justify-content: space-between;
                align-items: center;
            }

        }

        body{
            font-family:Arial, Helvetica, sans-serif !important;
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
        <title>Laporan Keuangan</title>

        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
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
                    <p> DINAS SOSIAL PEMBERDAYAAN PEREMPUAN DAN PERLINDUNGAN ANAK KABUPATEN BANTUL</p>
                    <h3>YAYASAN AL DZIKRO</h3>
                    <p>KEP. MEN HUKUM DAN HAM RI NO. AHU. 4150. AH. 01.04 TAHUN 2010</p>
                    <p>Akta Notaris Tri Diyani Kelasworo Djati, SH No. 05 Tanggal 4 Juli 2008</p>
                    <p>Nomor Izin Operasional: 222/1028/KP2TSP/2018</p>
                    <p>BRI Unit Imogiri Cab. Bantul a/n Turmudi/YYS Al Dzikro No. Rek: 3585-01-005042-53-7</p>
                    <p>Alamat : Manggung RT 07, Wukirsari, Imogiri, Bantul, D.I.Yogyakarta</p>
                    <p>Website: www.al-dzikro.org &nbsp; &nbsp; &nbsp; Telepon: (0274)2810607</p>
                    <p>Hj. Salimah 081-7412-3945 &nbsp; &nbsp; H. Abdul Wahab 0851-0002-1572 &nbsp; &nbsp; H. Subardi 0877-3834-1388</p>
                </div>
                <div class="garis">

                </div>
                <h3>TANDA TERIMA</h3>
                <h4 style="margin: 0px">No : {{ $no }} / Al-Dzikro /............/............</h4>
                <input type="checkbox" id="Zakat" @if ($tipe == 'Zakat') checked @else class="check" @endif><label for="Zakat">Zakat</label> &nbsp; &nbsp; &nbsp; &nbsp;
                <input type="checkbox" id="Infaq" @if ($tipe == 'Infaq') checked @else class="check" @endif><label for="Infaq">Infaq</label> &nbsp; &nbsp; &nbsp; &nbsp;
                <input type="checkbox" id="Sodaqoh" @if ($tipe == 'Sodaqoh') checked @else class="check" @endif><label for="Sodaqoh">Sodaqoh</label> &nbsp; &nbsp; &nbsp; &nbsp;
                <input type="checkbox" id="Lain-lain......" @if ($tipe == 'Lain-lain') checked @else class="check" @endif><label style="margin-top: 100px" for="Lain-lain......">Lain-lain..............</label>
                <h5 style="margin: 5px"><i>Assalamu'alaikum Wr. Wb.</i></h5>
            </div>
            <div style="font-size: 13px;">
                <table style="width: 100%">
                    <tr>
                        <td style="width: 125px !important;">Telah Diterima Dari</td>
                        <td>: {{ $nama }}</td>
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
                        <td>Hajat</td>
                        <td>: {{ $hajat }}</td>
                    </tr>
                    <tr>
                        <td colspan="2" style="text-align:center">
                            <h5 style="margin: 5px"><i>Wassalamu'alaikum Wr. Wb.</i></h5>
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
                        (......................................)
                    </td>
                    <td></td>
                    <td>
                        (......................................)
                    </td>
                </tr>
            </table>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>
    </body>
</html>
