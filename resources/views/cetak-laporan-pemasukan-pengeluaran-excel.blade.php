<table class="table-data">
    <thead>
        <tr>
            <th colspan="7" style="height: 80; text-align:center;">
                <p style="font-size: 200px">YAYASAN AL DZIKRO</p>
                <p> Manggung RT 07, Wukirsari, Imogiri, Bantul, Yogyakarta 55782, Telp: (0274)2810607</p>
                <p> Keputusan Menteri Hukum dan HAM RI No. Nomor: AHU-4001. AH.01.02. Tahun 2008</p>
                <p> Keputusan Kepala BKPM DIY No: 223/323/GR.I/2015 Tentang Ijin Operasional</p>
                <p>Kelompok Sasaran: Anak Yatim, Piatu, Yatim Piatu, Masyarakat dan Orang Jompo</p>
            </th>
        </tr>
        <tr>
            <th colspan="7"></th>
        </tr>
        <tr style="background-color: #D2D3D4">
            <th>No</th>
            <th style="width: 20">Donatur</th>
            <th style="width: 20">Tanggal</th>
            <th style="width: 50">Uraian</th>
            <th style="width: 20">Pemasukan</th>
            <th style="width: 20">Pengeluaran</th>
            <th style="width: 20">Saldo</th>
        </tr>
    </thead>
    <tbody>
        @php
        $no = 1;
        $saldo = $saldoBulanSebelumnya;
        $format = '_-[$Rp-id-ID]* #,##0_-;-[$Rp-id-ID]* #,##0_-;_-[$Rp-id-ID]* "-"_-;_-@_-';
        @endphp
        <tr>
            <td></td>
            <td></td>
            <td style="text-align: center">Saldo Bulan Sebelumnya</td>
            <td></td>
            <td></td>
            <td></td>
            @if ($saldo != 0)
                <td data-format="{{ $format }}" style="text-align: center">{{ $saldo }}</td>
            @else
                <td style="text-align: center">{{ $saldo }}</td>
            @endif
        </tr>
        @foreach ($donations as $index => $donation)
        @php
            if($donation->transaksi == "pemasukan"){
                $saldo += $donation->pemasukan;
            }else{
                $saldo -= $donation->pengeluaran;
            }
        @endphp
        <tr>
            <td>{{ $no++ }}</td>
            <td>{{ $donation->donaturName != null ? $donation->donaturName->nama : '' }}</td>
            <td>{{ date('d-m-Y',strtotime($donation->tanggal_donasi)) }}</td>
            <td>{{ $donation->keterangan }}</td>
            <td data-format="{{ $format }}">{{ $donation->pemasukan }}</td>
            <td data-format="{{ $format }}">{{ $donation->pengeluaran }}</td>
            <td data-format="{{ $saldo == 0 ? '' : $format }}">
                {{ $saldo }}
            </td>
        </tr>
        @endforeach
        <tr>
            <td colspan="3" style="text-align: right"><b>Saldo Akhir</b></td>
            <td></td>
            <td></td>
            <td></td>
            <td data-format="{{ $format }}" style="text-align: left">{{ $saldo }}</td>
        </tr>
    </tbody>
</table>