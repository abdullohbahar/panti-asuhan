@extends('layout.app')

@section('title')
Jenis Donasi
@endsection

@push('addons-css')
@endpush

@section('content')
<div>
  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
        <div class="row pt-5">
            <div class="col-6">
                <a href="{{ route('donasi.tunai') }}">
                    <div class="card">
                        <div class="card-body">
                            <div class="row text-center">
                                <div class="col-12">
                                    <h3>Donasi Berupa Tunai</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-6">
                <a href="">
                    <div class="card">
                        <div class="card-body">
                            <div class="row text-center">
                                <div class="col-12">
                                    <h3>Donasi Berupa Transfer Bank</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
  </section>
  <!-- /.content -->
</div>
@endsection

@push('addons-js')
@endpush