@extends('layout.app')

@section('title')
Ubah Data Pengurus
@endsection

@push('addons-css')
@endpush

@section('content')
<div>
  <livewire:edit-pengurus :idpengurus="$id">
</div>
@endsection

@push('addons-js')
<script>
    // preview image
    imageUpload.onchange = (evt) => {
        const [file] = imageUpload.files;
        if (file) {
            imagePreview.src = URL.createObjectURL(file);
        }
    };
</script>
@endpush