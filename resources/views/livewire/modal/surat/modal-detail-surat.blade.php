<!-- Modal -->
<div wire:ignore.self class="modal fade" id="modal-detail-letter" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Detail Surat</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
            <div class="col-12">
                <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <td><b>Nomor Surat</b></td>
                            <td><b>:</b></td>
                            <td>{{ $nomor_surat }}</td>
                        </tr>
                        <tr>
                            <td><b>Nama Pengirim</b></td>
                            <td><b>:</b></td>
                            <td>{{ $nama_pengirim }}</td>
                        </tr>
                        <tr>
                            <td><b>Perihal Surat</b></td>
                            <td><b>:</b></td>
                            <td>{{ $perihal_surat }}</td>
                        </tr>
                        <tr>
                            <td><b>Tanggal Surat</b></td>
                            <td><b>:</b></td>
                            <td>{{ \Carbon\Carbon::parse($tanggal)->format('d-m-Y') }}</td>
                        </tr>
                        <tr>
                            <td><b>Isi Surat</b></td>
                            <td><b>:</b></td>
                            <td>{{ $isi_surat }}</td>
                        </tr>
                        <tr>
                            <td><b>File Surat</b></td>
                            <td><b>:</b></td>
                            <td><button wire:click="download('{{ $oldSurat }}','{{ $perihal_surat }}')" class="btn btn-sm btn-success">Unduh Surat</button></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            @if ($tanggal_diterima)
                <div class="col-12">
                    <hr>
                </div>
                <div class="col-12">
                    <h5><b>Disposisi Penugasan</b></h5>
                </div>
                <div class="col-12">
                    <table class="table table-bordered">
                        <tr>
                            <td><b>Tanggal Diterima</b></td>
                            <td><b>:</b></td>
                            <td>{{ \Carbon\Carbon::parse($tanggal_diterima)->format('d-m-Y') }}</td>
                        </tr>
                        <tr>
                            <td><b>Disposisi Penugasan</b></td>
                            <td><b>:</b></td>
                            <td>{{ $disposisi_penugasan }}</td>
                        </tr>
                        <tr>
                            <td><b>File Dokumentasi</b></td>
                            <td><b>:</b></td>
                            <td><button wire:click="download('{{ $old_file_dokumentasi }}','Dokumentasi Penugasan')" class="btn btn-sm btn-success">Unduh File Dokumentasi</button></td>
                        </tr>
                    </table>
                </div>
            @endif
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>