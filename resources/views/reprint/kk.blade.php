@extends('layouts.app')
@section('content')
<div class="container">
    <div class="justify-content-center">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('/')}}">Utama</a></li>
                <li class="breadcrumb-item">Cetak Ulang<a href="#"></a></li>
                <li class="breadcrumb-item active" aria-current="page">Kartu keluarga</li>
            </ol>
        </nav>
        <div class="card card-boy">
            <div class="p-4">
                <h5 class="text-center">Cetak Ulang KK</h5>
                <hr>
                <reprint-family-card reprint_url="{{route('reprint.kk.store')}}" submit_url="{{route('reprint.kk.submit')}}" redirect_url="{{url('/')}}" />
            </div>
        </div>
    </div>
</div>
@endsection