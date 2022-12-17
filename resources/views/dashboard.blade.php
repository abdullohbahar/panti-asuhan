@extends('layout.app')

@section('title')
  Dashboard
@endsection

@push('addons-css')
@endpush

@section('content')
<div>
  <livewire:dashboard>
</div>
@endsection

@push('addons-js')
@endpush