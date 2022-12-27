<table class="table-data">
    <thead>
        <tr>
            <th colspan="5" style="height: 80; text-align:center;">
                <p style="font-size: 200px">YAYASAN AL DZIKRO</p>
                <p> Manggung RT 07, Wukirsari, Imogiri, Bantul, Yogyakarta 55782, Telp: (0274)2810607</p>
                <p> Keputusan Menteri Hukum dan HAM RI No. Nomor: AHU-4001. AH.01.02. Tahun 2008</p>
                <p> Keputusan Kepala BKPM DIY No: 223/323/GR.I/2015 Tentang Ijin Operasional</p>
                <p>Kelompok Sasaran: Anak Yatim, Piatu, Yatim Piatu, Masyarakat dan Orang Jompo</p>
            </th>
        </tr>
        <tr>
            <th colspan="5"></th>
        </tr>
        <tr style="background-color: #D2D3D4">
            <th>No</th>
            <th style="width: 13">Tanggal</th>
            <th style="width: 50">Uraian</th>
            <th style="width: 13">Pemasukan</th>
            <th style="width: 13">Pengeluaran</th>
        </tr>
    </thead>
    <tbody>
        @php
        $no = 1;
        @endphp
        @foreach ($donations as $index => $donation)
        <tr>
            <td>{{ $no++ }}</td>
            <td>{{ $donation->tanggal_donasi }}</td>
            <td>{{ $donation->keterangan }}</td>
            <td>{{ $donation->pemasukan }}</td>
            <td>{{ $donation->pengeluaran }}</td>
        </tr>
        @endforeach
        {{-- <tr>
            <td colspan="3" style="text-align: right"><b>Saldo Akhir</b></td>
            <td colspan="2" style="text-align: left">{{ $pemasukan - $pengeluaran }}</td>
        </tr> --}}
    </tbody>
</table>