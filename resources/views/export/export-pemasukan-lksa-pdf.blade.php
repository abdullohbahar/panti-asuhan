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
    <title>Data Pemasukan LKSA</title>
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
                            <td style="width: 80px;" class="text-center">
                                No
                            </td>
                            <td class="text-center">
                                Keterangan
                            </td>
                            <td class="text-center">
                                Tanggal
                            </td>
                            <td class="text-center">
                                Nominal
                            </td>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $no = 1;
                        @endphp
                        @foreach ($incomes as $income)
                            <tr>
                                <td class="text-center">
                                    {{ $no++ }}
                                </td>
                                <td>
                                    {{ $income->keterangan }}
                                </td>
                                <td class="text-center" style="width: 200px;">
                                    {{ $income->tanggal }}
                                </td>
                                <td class="text-right" style="width: 200px">
                                    {{ "Rp. " . number_format($income->pemasukan, 0, '', '.'); }}
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