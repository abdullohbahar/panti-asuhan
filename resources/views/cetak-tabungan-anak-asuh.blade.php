<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cetak Tabungan Anak Asuh</title>

    <style>
        .text-right{
            text-align: right !important;
        }

        .text-left{
            text-align: left !important;
        }

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
</head>

<body>
    <section>
        <table class="table-data">
            <thead>
                <tr>
                    <th scope="col" rowspan="2" style="width: 50px !important" class="text-left">#</th>
                    <th scope="col" rowspan="2" class="text-left" style="width: 100px">Tanggal</th>
                    <th scope="col" colspan="2" style="width: 70%">Transaksi</th>
                    <th scope="col" rowspan="2">Saldo</th>
                </tr>
                <tr>
                    <th scope="col">Debet</th>
                    <th scope="col">Kredit</th>
                </tr>
            </thead>
            <tbody>
                @php
                $no = 1;
                @endphp
                @foreach ($datas as $index => $saving)
                <tr>
                    <td data-label="#" class="text-left">{{ $no++ }}</td>
                    <td data-label="Tanggal" class="text-left">{{ $saving->tanggal }}</td>
                    <td data-label="Debet">
                        @if ($saving->mengambil)
                            {{ number_format($saving->mengambil, 2, ',', '.'); }}
                        @endif
                    </td>
                    <td data-label="Kredit">
                        @if ($saving->menabung)
                            {{ number_format($saving->menabung, 2, ',', '.'); }}
                        @endif
                    </td>
                    <td data-label="Saldo" class="text-right">{{ number_format($saving->saldo, 2, ',', '.'); }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </section>
</body>

</html>