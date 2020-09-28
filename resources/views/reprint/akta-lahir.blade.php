@extends('layouts.app')
@section('content')
<div class="container">
    <div class="justify-content-center">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('/')}}">Utama</a></li>
                <li class="breadcrumb-item">Cetak Ulang</li>
                <li class="breadcrumb-item active" aria-current="page">Akta Kelahiran</li>
            </ol>
        </nav>
        <div class="card card-boy">
            <div class="p-4">
                <h5 class="text-center">Cetak Ulang Akta Lahir</h5>
                <hr>
                <reprint-birth-certificate reprint_url="{{route('reprint.al.store')}}" submit_url="{{route('reprint.al.submit')}}" redirect_url="{{url('/')}}" />
            </div>
        </div>
    </div>
</div>
@endsection