<table class="table-data">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama Lengkap</th>
            <th>Jenis Kelamin</th>
            <th>Tempat Lahir</th>
            <th>Tanggal Lahir</th>
            <th>Usia</th>
            <th>Alamat</th>
            <th>Nomor HP</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        @php
        $no = 1;
        @endphp
        @foreach ($wargas as $warga)
        <tr>
            <td>{{ $no++ }}</td>
            <td>{{ $warga->nama_lengkap }}</td>
            <td>{{ $warga->jenis_kelamin }}</td>
            <td>{{ $warga->tempat_lahir }}</td>
            <td>{{ $warga->tanggal_lahir }}</td>
            <td>
                {{ \Carbon\Carbon::parse($warga->tanggal_lahir)->age }}
            </td>
            <td>{{ $warga->alamat }}</td>
            <td>{{ $warga->no_hp }}</td>
            <td>{{ $warga->status }}</td>
        </tr>
        @endforeach
    </tbody>
</table>