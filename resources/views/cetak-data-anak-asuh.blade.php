<table class="table-data">
    <thead>
        <tr>
            <th>No</th>
            <th>Foto</th>
            <th>Nomor Induk Santri</th>
            <th>Nomor Induk Keluarga</th>
            <th>Nama</th>
            <th>Jenis Kelamin</th>
            <th>Tempat, Tanggal Lahir</th>
            <th>Usia</th>
            <th>Pendidikan</th>
            <th>Tipe</th>
            <th>Alamat</th>
            <th>Status</th>
            <th>Tanggal Masuk</th>
            <th>Tanggal Keluar</th>
            <th>Nama Ayah Kandung</th>
            <th>Nama Ibu Kandung</th>
            <th>Nomor HP Wali</th>
            <th>Nama Wali</th>
            <th>Rekomendasi / Penanggung Jawab</th>
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
            <td>{{ \Carbon\Carbon::parse($anak->tanggal_lahir)->age }}</td>
            <td>{{ $anak->pendidikan }}</td>
            <td>{{ $anak->tipe }}</td>
            <td>{{ $anak->alamat }}</td>
            <td>{{ $anak->status }}</td>
            <td>{{ $anak->tgl_masuk }}</td>
            <td>{{ $anak->tgl_keluar }}</td>
            <td>{{ $anak->nama_ayah_kandung }}</td>
            <td>{{ $anak->nama_ibu_kandung }}</td>
            <td>{{ $anak->nohp_ortu }}</td>
            <td>{{ $anak->pemilik_nohp }}</td>
            <td>{{ $anak->wali_anak }}</td>
        </tr>
        @endforeach
    </tbody>
</table>