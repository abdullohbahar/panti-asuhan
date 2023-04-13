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
        @foreach ($lksas as $lksa)
        <tr>
            <td>{{ $no++ }}</td>
            <td>{{ \Carbon\Carbon::parse($lksa->tanggal)->format('d-m-Y') }} {{ \Carbon\Carbon::parse($lksa->created_at)->format('H:i:s') }}</td>
            <td>{{ $lksa->keterangan }}</td>
            <td>{{ "Rp " . number_format($lksa->pengeluaran, 2, ',', '.'); }}</td>
        </tr>
        @endforeach
    </tbody>
</table>