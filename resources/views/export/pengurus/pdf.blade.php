<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Export Pengurus</title>
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
                <th style="width: 100px">Foto</th>
                <th>Nama</th>
                <th>Jenis Kelamin</th>
                <th>Tempat, Tanggal Lahir</th>
                <th>Usia</th>
                <th>Pendidikan</th>
                <th>Alamat</th>
                <th>Nomor HP</th>
                <th>Jabatan</th>
                <th>Pekerjaan</th>
            </tr>
        </thead>
        <tbody style="font-size: 12px;">
            @php
            $no = 1;
            @endphp
            @foreach ($penguruses as $pengurus)
            @php
                if($pengurus->foto){
                    $image_path = public_path('storage/'.$pengurus->foto);
                }else{
                    $image_path = public_path('template/dist/img/default-picture.png');
                }

                $image_data = base64_encode(file_get_contents($image_path));
            @endphp
            <tr>
                <td>{{ $no++ }}</td>
                <td><img src="data:image/jpeg;base64,{{ $image_data }}" style="width: 100%" alt="" srcset=""></td>
                <td>{{ $pengurus->nama }}</td>
                <td>{{ $pengurus->jenis_kelamin }}</td>
                <td>{{ $pengurus->tempat_lahir }}, {{ \Carbon\Carbon::parse($pengurus->tanggal_lahir)->format('d-m-Y') }}</td>
                <td>{{ \Carbon\Carbon::parse($pengurus->tanggal_lahir)->age }}</td>
                <td>{{ $pengurus->pendidikan }}</td>
                <td>{{ $pengurus->alamat }}</td>
                <td>{{ $pengurus->no_hp }}</td>
                <td>{{ $pengurus->jabatan }}</td>
                <td>{{ $pengurus->pekerjaan }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>