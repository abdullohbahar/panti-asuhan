<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cetak Donasi Dana</title>

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
    <div class="section">
        <center>
            <h3>Laporan Donasi Berupa Dana</h3>
        </center>
    </div>
    <section>
        <table class="table-data">
            <thead>
                <tr>
                    <th scope="col" style="width: 50px !important" class="text-left">#</th>
                    <th scope="col">Nama Donatur</th>
                    <th scope="col" style="width: 10px !important"></th>
                    <th scope="col">Nominal</th>
                    <th scope="col">Keterangan</th>
                    <th scope="col">Tanggal Donasi</th>
                </tr>
            </thead>
            <tbody>
                @php
                $no = 1;
                @endphp
                @foreach ($donations as $index => $donation)
                <tr>
                    <td data-label="#" class="text-left">{{ $no++ }}</td>
                    <td data-label="Nama Donatur">{{ $donation->donatur->nama }}</td>
                    <td>Rp.</td>
                    <td data-label="Nominal" class="text-right">{{ number_format($donation->nominal, 2, ',', '.'); }}</td>
                    <td data-label="Keterangan">{{ $donation->keterangan }}</td>
                    <td data-label="Tanggal Donasi">{{ date('d-m-Y',strtotime($donation->tanggal_sumbangan)) }}</td>
                </tr>
                @endforeach
                <tr>
                    <td colspan="2">
                        <b>Total</b>
                    </td>
                    <td>
                        Rp.
                    </td>
                    <td class="text-right">
                        {{ number_format($total, 2, ',', '.'); }}
                    </td>
                </tr>
            </tbody>
        </table>
    </section>
</body>

</html>