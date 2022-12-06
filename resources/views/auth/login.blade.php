@extends('auth.layout.app')

@section('title')
    Login
@endsection

@push('addons-css')
<style>
    #showPassword:hover{
        cursor: pointer;
    }
</style>
@endpush

@section('content')
<div>
    <livewire:login>
</div>
@endsection

@push('addons-js')
<script>
    $("#showPassword").on("click", () => {
        var passType = document.getElementById("password");

        if(passType.type === "password"){
            passType.type = "text"
            $("#icon").removeClass("fa-eye").addClass("fa-eye-slash")
        }else{
            passType.type = "password"
            $("#icon").removeClass("fa-eye-slash").addClass("fa-eye")
        }
    })
</script>
@endpush