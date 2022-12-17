<table class="table-data">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama Donatur</th>
            <th>Nominal</th>
            <th>Keterangan</th>
            <th>Tanggal Donasi</th>
        </tr>
    </thead>
    <tbody>
        @php
        $no = 1;
        @endphp
        @foreach ($donations as $index => $donation)
        <tr>
            <td>{{ $no++ }}</td>
            <td>{{ $donation->donatur->nama }}</td>
            <td>{{ $donation->nominal }}</td>
            <td>{{ $donation->keterangan }}</td>
            <td>{{ date('d-m-Y',strtotime($donation->tanggal_sumbangan)) }}</td>
        </tr>
        @endforeach
    </tbody>
</table>