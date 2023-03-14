<table class="table-data">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama Donatur</th>
            <th>Tanggal Donasi</th>
            <th>Keterangan Barang</th>
        </tr>
    </thead>
    <tbody>
        @php
        $no = 1;
        @endphp
        @foreach ($donations as $donation)
        <tr>
            <td>{{ $no++ }}</td>
            <td>{{ $donation->donatur->nama }}</td>
            <td>{{ \Carbon\Carbon::parse($donation->tanggal_donasi)->format('d-m-Y') }} {{ \Carbon\Carbon::parse($donation->created_at)->format('H:i:s') }}</td>
            <td>
                @php
                    $results = '';
                    foreach ($donation->detail as $value) {
                        $results .= $value->nama_barang . ' ' . $value->jumlah . ', ';
                    }
                    $results = rtrim($results, ', ');
                @endphp
                {{ $results }}
            </td>
        </tr>
        @endforeach
    </tbody>
</table>