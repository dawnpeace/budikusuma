@extends('layouts.app')
@section('content')
<div class="container">
    <div class="justify-content-center">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('/')}}">Utama</a></li>
                <li class="breadcrumb-item">Cetak Ulang</li>
                <li class="breadcrumb-item active" aria-current="page">Kartu Identitas Anak</li>
            </ol>
        </nav>
        <div class="card card-boy">
            <div class="p-4">
                <h5 class="text-center">Cetak Ulang KIA</h5>
                <hr>
                <reprint-child-id-card reprint_url="{{route('reprint.kia.store')}}" submit_url="{{route('reprint.kia.submit')}}" redirect_url="{{url('/')}}" />
            </div>
        </div>
    </div>
</div>
@endsection