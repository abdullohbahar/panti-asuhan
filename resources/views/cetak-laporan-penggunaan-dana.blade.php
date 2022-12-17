<table>
    <thead>
        <tr>
            <th>No</th>
            <th>Nominal</th>
            <th>Keterangan</th>
            <th>Tanggal Donasi</th>
        </tr>
    </thead>
    <tbody>
        @php
        $no = 1;
        @endphp
        @foreach ($reports as $index => $report)
        <tr>
            <td>{{ $no++ }}</td>
            <td>{{ $report->nominal }}</td>
            <td>{{ $report->keterangan }}</td>
            <td>{{ date('d-m-Y',strtotime($report->tanggal)) }}</td>
        </tr>
        @endforeach
    </tbody>
</table>