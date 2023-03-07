@extends('layout.app')

@section('title')
  Dashboard
@endsection

@push('addons-css')
<style>
  .small-box:hover{
    cursor: pointer;
  }
</style>
@endpush

@section('content')
<div>
  <livewire:dashboard>
</div>
@endsection

@push('addons-js')
@endpush