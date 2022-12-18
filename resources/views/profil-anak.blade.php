@extends('layout.app')

@section('title')
    Bukti Donasi
@endsection

@push('addons-css')
@endpush

@section('content')
<div>
  <livewire:profile-anak :idchild="$id">
</div>
@endsection

@push('addons-js')
<script>
  window.addEventListener('close-modal', event => {
    // close modal
    $('#unggahBerkas').modal('hide')

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