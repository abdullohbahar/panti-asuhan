<table class="table-data">
    <thead>
        <tr>
            <th>No</th>
            <th>Foto</th>
            <th>Nama</th>
            <th>Jenis Kelamin</th>
            <th>Tempat, Tanggal Lahir</th>
            <th>Alamat</th>
            <th>Status</th>
            <th>Nama Ayah Kandung</th>
            <th>Nama Ibu Kandung</th>
            <th>Nomor Hp Orangtua</th>
            <th>Akta</th>
            <th>Kartu Keluarga</th>
            <th>Keterangan</th>
        </tr>
    </thead>
    <tbody>
        @php
        $no = 1;
        @endphp
        @foreach ($anakAsuhs as $index => $anak)
        <tr>
            <td>{{ $no++ }}</td>
            @if ($anak->foto)
                <img src="{{ asset('storage/'.$anak->foto) }}">
            @else
                <img src="{{ asset('./template/dist/img/default-picture.png') }}">
            @endif
            <td>{{ $anak->nama }}</td>
            <td>{{ $anak->jenis_kelamin }}</td>
            <td>{{ $anak->tempat_lahir }}, {{ date('d-m-Y',strtotime($anak->tanggal_lahir)) }}</td>
            <td>{{ $anak->alamat }}</td>
            <td>{{ $anak->status }}</td>
            <td>{{ $anak->nama_ayah_kandung }}</td>
            <td>{{ $anak->nama_ibu_kandung }}</td>
            <td>{{ $anak->nohp_ortu }}</td>
            <td>{{ $anak->akta }}</td>
            <td>{{ $anak->kartu_keluarga }}</td>
            <td>{{ $anak->keterangan }}</td>
        </tr>
        @endforeach
    </tbody>
</table>