<table class="table-data">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama Donatur</th>
            <th>Tipe</th>
            <th>Tanggal Donasi</th>
            <th>Nominal</th>
            <th>Keterangan</th>
        </tr>
    </thead>
    <tbody>
        @php
            $no = 1;
        @endphp
        @foreach ($donations as $donation)
            <tr>
                <td>{{ $no++ }}</td>
                <td>{{ $donation->donaturName->nama }}</td>
                <td>{{ $donation->tipe }}</td>
                <td>{{ \Carbon\Carbon::parse($donation->tanggal_donasi)->format('d-m-Y') }}
                    {{ \Carbon\Carbon::parse($donation->created_at)->format('H:i:s') }}</td>
                <td>{{ 'Rp ' . number_format($donation->pemasukan, 2, ',', '.') }}</td>
                <td>{{ $donation->keterangan }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
