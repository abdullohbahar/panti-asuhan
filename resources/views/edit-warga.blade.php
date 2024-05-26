@extends('layout.app')

@section('title')
    Ubah warga
@endsection

@push('addons-css')
@endpush

@section('content')
    <div>
        <livewire:edit-citizen :idwarga="$id">
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
