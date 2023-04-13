@extends('layout.app')

@section('title')
  Input Surat LKSA
@endsection

@push('addons-css')
<style>
  .table-data {
      border: 1px solid #ccc;
      border-collapse: collapse;
      margin: 0;
      padding: 0;
      width: 100%;
      table-layout: fixed;
  }

  .table-data caption {
      font-size: 1.5em;
      margin: .5em 0 .75em;
  }

  .table-data tr {
      background-color: #f8f8f8;
      border: 1px solid #ddd;
      padding: .35em;
  }

  .table-data th,
  .table-data td {
      padding: .625em;
      text-align: center;
  }

  .table-data th {
      font-size: .85em;
      letter-spacing: .1em;
      text-transform: uppercase;
  }

  @media screen and (max-width: 600px) {
    .table-data {
        border: 0;
    }
    .table-data caption {
        font-size: 1.3em;
    }
    
    .table-data thead {
        border: none;
        clip: rect(0 0 0 0);
        height: 1px;
        margin: -1px;
        overflow: hidden;
        padding: 0;
        position: absolute;
        width: 1px;
    }
    
    .table-data tr {
        border-bottom: 3px solid #ddd;
        display: block;
        margin-bottom: .625em;
    }
    
    .table-data td {
        border-bottom: 1px solid #ddd;
        display: block;
        font-size: .8em;
        text-align: right;
    }
    
    .table-data td::before {
        /*
        * aria-label has no advantage, it won't be read inside a table
        content: attr(aria-label);
        */
        content: attr(data-label);
        float: left;
        font-weight: bold;
        text-transform: uppercase;
    }
    
    .table-data td:last-child {
        border-bottom: 0;
    }
  }
  
  .tb-width{
      width: 198px;
  }

  @media screen and (max-width: 600px) {
      .tb-width{
          width: 10px;
      }
  }
</style>
@endpush

@section('content')
<div>
  <livewire:create-letter-lksa>
</div>
@endsection

@push('addons-js')
<script>
  // Show modal add donatur
  $("#btnAddDonatur").on("click", () => {
    $("#modal-add-donatur").modal("show")
  })
  

  window.addEventListener('close-modal', event => {
    // close modal
    $('#modal-add-donatur').modal('hide')
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

    // preview image
    imageUpload.onchange = (evt) => {
        const [file] = imageUpload.files;
        if (file) {
            imagePreview.src = URL.createObjectURL(file);
        }
    };
</script>
<script>
    window.addEventListener('show-error', event => {
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: event.detail.message
        })
    })
</script>
@endpush