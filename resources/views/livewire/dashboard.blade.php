<div>
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Dashboard</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
            <li class="breadcrumb-item active">Dashboard</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      @if (Auth()->user()->role == 'ketua-yayasan' || Auth()->user()->role == 'admin-yayasan' || Auth()->user()->role == 'pembina-yayasan')
        @include('livewire.dashboard-component.ketua-yayasan')
      @elseif(Auth()->user()->role == 'bendahara-yayasan')
        @include('livewire.dashboard-component.bendahara-yayasan')
      @elseif(Auth()->user()->role == 'admin-donasi')
        @include('livewire.dashboard-component.admin-donasi')
      @elseif(Auth()->user()->role == 'sekertariat-yayasan')
        @include('livewire.dashboard-component.sekertariat-yayasan')
      @elseif(Auth()->user()->role == 'ketua-lksa')
        @include('livewire.dashboard-component.ketua-lksa')
      @elseif(Auth()->user()->role == 'bendahara-lksa')
        @include('livewire.dashboard-component.bendahara-lksa')
      @elseif(Auth()->user()->role == 'sekertariat-lksa')
        @include('livewire.dashboard-component.sekertariat-lksa')
      @elseif(Auth()->user()->role == 'penerima-donasi')
        @include('livewire.dashboard-component.penerima-donasi')
      @endif
    </div>
  </section>
  <!-- /.content -->
</div>

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
    setTimeout(() => {
      openWindowPopup('/print-invoice-donation/{{ session('id') }}', 1200, 800)
    }, 800);
  </script>
@endif
@endpush