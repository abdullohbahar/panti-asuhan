<table class="table-data">
    <thead>
        <tr>
            <th>No</th>
            <th>Tanggal</th>
            <th>Uraian</th>
            <th>Nominal</th>
        </tr>
    </thead>
    <tbody>
        @php
        $no = 1;
        @endphp
        @foreach ($donations as $donation)
        <tr>
            <td>{{ $no++ }}</td>
            <td>{{ \Carbon\Carbon::parse($donation->tanggal_donasi)->format('d-m-Y') }} {{ \Carbon\Carbon::parse($donation->created_at)->format('H:i:s') }}</td>
            <td>{{ $donation->keterangan }}</td>
            <td>{{ "Rp " . number_format($donation->pengeluaran, 2, ',', '.'); }}</td>
        </tr>
        @endforeach
    </tbody>
</table>