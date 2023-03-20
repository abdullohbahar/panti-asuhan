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
      @endif
    </div>
  </section>
  <!-- /.content -->
</div>