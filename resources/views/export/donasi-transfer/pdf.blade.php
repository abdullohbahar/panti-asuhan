<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Export Donasi Transfer</title>
    <style>
        table {
            border-collapse: collapse;
        }
        
        .table {
            width: 100%;
            margin-bottom: 1rem;
            color: #212529;
        }

        .table th,
        .table td {
            padding: 0.3rem;
            vertical-align: top;
            border-top: 1px solid #dee2e6;
        }

        .table thead th {
            vertical-align: bottom;
            border-bottom: 2px solid #dee2e6;
        }

        .table tbody + tbody {
            border-top: 2px solid #dee2e6;
        }

        .table-sm th,
        .table-sm td {
            padding: 0.3rem;
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
</head>
<body>
    <table border="1" class="table table-bordered" style="width: 100%">
        <thead style="font-size: 12px; font-weight:700">
            <tr>
                <th>No</th>
                <th>Nama Donatur</th>
                <th>Tanggal Donasi</th>
                <th>Nominal</th>
                <th>Bank</th>
                <th>Nomor Rekening</th>
                <th>Nomor Transaksi</th>
                <th>Keterangan</th>
            </tr>
        </thead>
        <tbody style="font-size: 12px;">
            @php
            $no = 1;
            @endphp
            @foreach ($donations as $donation)
            <tr>
                <td>{{ $no++ }}</td>
                <td>{{ $donation->donaturName->nama }}</td>
                <td>{{ \Carbon\Carbon::parse($donation->tanggal_donasi)->format('d-m-Y') }} {{ \Carbon\Carbon::parse($donation->created_at)->format('H:i:s') }}</td>
                <td>{{ "Rp " . number_format($donation->pemasukan, 2, ',', '.'); }}</td>
                <td>{{ $donation->bank }}</td>
                <td>{{ $donation->norek }}</td>
                <td>{{ $donation->nomor_transaksi }}</td>
                <td>{{ $donation->keterangan }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>