<table class="table-data">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama Donatur</th>
            <th>Nomor HP</th>
            <th>Alamat</th>
        </tr>
    </thead>
    <tbody>
        @php
        $no = 1;
        @endphp
        @foreach ($donaturs as $index => $donatur)
        <tr>
            <td>{{ $no++ }}</td>
            <td>{{ $donatur->nama }}</td>
            <td>{{ $donatur->no_hp }}</td>
            <td>{{ $donatur->alamat }}</td>
        </tr>
        @endforeach
    </tbody>
</table>