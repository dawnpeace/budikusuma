@extends('layouts.app')

@section('content')
<div class="container">
    <div class="justify-content-center">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item bread"><a href="{{url('/')}}">Utama</a></li>
                <li class="breadcrumb-item">Pengajuan<a href="#"></a></li>
                <li class="breadcrumb-item active" aria-current="page">KK</li>
            </ol>
        </nav>
        <apply-family-card redirect_url='{{url("/")}}' submit_url='{{route("apply.kartukeluarga.submit")}}' />

    </div>
</div>
@endsection