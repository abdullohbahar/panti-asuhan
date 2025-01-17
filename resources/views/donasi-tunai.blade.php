@extends('layout.app')

@section('title')
    Donasi Tunai
@endsection

@push('addons-css')
@endpush

@section('content')
    <div>
        <livewire:donasi-tunai>
    </div>
@endsection

@push('addons-js')
    @if (session()->has('message'))
        <script>
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
                title: '{{ session('message') }}'
            })
        </script>
    @endif

    @if (session()->has('id'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                setTimeout(() => {
                    window.location.href = 'print-invoice-donation/{{ session('id') }}';
                }, 1500);
            });
        </script>
    @endif

    @if (session()->has('error'))
        <script>
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
                icon: 'error',
                title: '{{ session('error') }}'
            })
        </script>
    @endif
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

        window.addEventListener('show-error', event => {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: event.detail.message
            })
        })

        // Delete Confirmation
        window.addEventListener('show-delete-confirmation', event => {
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

        window.addEventListener('deleted', event => {
            Swal.fire(
                'Terhapus',
                event.detail.message,
                'success'
            )
        })
    </script>
@endpush
