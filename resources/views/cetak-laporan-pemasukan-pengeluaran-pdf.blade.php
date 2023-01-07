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
            padding: 0.15rem!important;
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

        .font-12{
            font-size: 13px;
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
                    <h3>YAYASAN AL DZIKRO</h3>
                    <p> Manggung RT 07, Wukirsari, Imogiri, Bantul, Yogyakarta 55782, Telp: (0274)2810607</p>
                    <p> Keputusan Menteri Hukum dan HAM RI No. Nomor: AHU-4001. AH.01.02. Tahun 2008</p>
                    <p> Keputusan Kepala BKPM DIY No: 223/323/GR.I/2015 Tentang Ijin Operasional</p>
                    <p class="bg-color">Kelompok Sasaran: Anak Yatim, Piatu, Yatim Piatu, Masyarakat dan Orang Jompo</p>
                </div>
            </div>
            <div class="row justify-content-center mt-2">
                <div class="col-12">
                    <table border="1" class="font-12" style="width: 100%; margin-top: 20px">
                        <tr>
                            <th style="width: 30px !important" class="text-center">NO</th>
                            <th class="text-center" style="margin-right: 5px;">TANGGAL</th>
                            <th class="text-center" style="width: 300px;">URAIAN</th>
                            <th class="text-center">PEMASUKAN</th>
                            <th class="text-center">PENGELUARAN</th>
                            <th class="text-center">SALDO</th>
                        </tr>
                        <?php 
                        $no = 1; 
                        $saldo = $saldoBulanSebelumnya;
                        ?>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>Saldo Bulan Sebelumnya</td>
                            <td></td>
                            <td></td>
                            <td>
                                <div class="angka p-1">
                                    {{ "Rp " .  number_format($saldo, 0, '', '.'); }}
                                </div>
                            </td>
                        </tr>
                        @foreach ($donations as $donation)
                        @php
                            if($donation->transaksi == "pemasukan"){
                                $saldo += $donation->pemasukan;
                            }else{
                                $saldo -= $donation->pengeluaran;
                            }
                        @endphp
                            <tr>
                                <td data-label="#" class="text-center">{{ $no++ }}</td>
                                <td data-label="Tanggal" class="text-center">{{ date('d-m-Y',strtotime($donation->tanggal_donasi)) }}</td>
                                <td class="p-1">{{ $donation->keterangan }}</td>
                                <td data-label="Pemasukan" class="text-right">
                                    @if ($donation->pemasukan)
                                        {{-- <div class="rp p-1">
                                            Rp
                                        </div> --}}
                                        <div class="angka p-1">
                                            {{ "Rp " . number_format($donation->pemasukan, 0, '', '.'); }}
                                        </div>
                                    @endif
                                </td>
                                <td data-label="Pengeluaran">
                                    @if ($donation->pengeluaran)
                                        {{-- <div class="rp p-1">
                                            Rp
                                        </div> --}}
                                        <div class="angka p-1">
                                            {{ "Rp " . number_format($donation->pengeluaran, 0, '', '.'); }}
                                        </div>
                                    @endif
                                </td>
                                <td data-label="Saldo">
                                    <div class="angka p-1">
                                        {{ "Rp " . number_format($saldo, 0, '', '.'); }}
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        <tr>
                            <td colspan="3" class="text-right p-1">
                                <b>Saldo Akhir</b>
                            </td>
                            <td colspan="3" class="text-center">
                                <div class="p-1">
                                    <div>
                                        {{ "Rp " . number_format($pemasukan - $pengeluaran, 0, '', '.'); }}
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>
    </body>
</html>
