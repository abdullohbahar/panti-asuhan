@extends('layout.app')

@section('title')
    Berkas Anak Asuh
@endsection

@push('addons-css')
@endpush

@section('content')
<div>
  <livewire:child-document :idchild="$id">
</div>
@endsection

@push('addons-js')
<script>
  // Show modal add donatur
  $("#btnAddProofDonation").on("click", () => {
    $("#modal-add-proof-donation").modal("show")
  })

  window.addEventListener('close-modal', event => {
    // close modal
    $('#modal-add-proof-donation').modal('hide')
    $('#modal-edit-donatur').modal('hide')

    // sweetalert success
    const Toast = Swal.mixin({
      toast: true,
      position: 'top-end',
      showConfirmButton: false,
      timer: 3000,
      timerProgressBar: true,
      didOpen: (toast) => {
        toast.addEventListener('mouseenter', Swal.stopTimer)
        toast.addEventListener('mouseleave', Swal.resumeTimer)
      }
    })
  
    Toast.fire({
      icon: 'success',
      title: event.detail.message
    })
  })

  // Delete Confirmation
    window.addEventListener('show-delete-confirmation',event =>{
      Swal.fire({
        title: 'Anda yakin?',
        text: "Kamu tidak bisa mengembalikan data yang terhapus dan data yang berhubungan akan terhapus!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya, Hapus!'
      }).then((result) => {
        if (result.isConfirmed) {
          Livewire.emit('deleteConfirmed')
        }
      })

    })

    window.addEventListener('deleted', event =>{
      Swal.fire(
        'Terhapus',
        event.detail.message,
        'success'
      )
    })
</script>
@endpush