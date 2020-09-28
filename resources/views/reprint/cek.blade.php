@extends('layouts.app')
@section('content')
<div class="container">
    <div class="justify-content-center">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('/')}}">Utama</a></li>
                <li class="breadcrumb-item">Cetak Ulang</li>
                <li class="breadcrumb-item active" aria-current="page">Lihat Permintaan</li>
            </ol>
        </nav>
        <div class="card card-body border-primary mb-3">
            <ul>
                <li>Untuk permintaan dokumen yang sudah melebihi batas 2 bulan harap mengunjungi kantor Dukcapil Sanatab</li>
            </ul>
        </div>
        <div class="card card-boy">
            <div class="p-4">
                <h5 class="text-center">Lihat Permintaan Cetak Ulang</h5>
                <hr>
                <reprint-check submit_url="{{route('reprint.check.submit')}}" redirect_url="{{url('/')}}" />
            </div>
        </div>
    </div>
</div>
@endsection