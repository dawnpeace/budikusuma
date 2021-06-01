@extends('layouts.app')
@section('content')
<div class="container">
    <div class="justify-content-center">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('/')}}">Utama</a></li>
                <li class="breadcrumb-item">Cetak Ulang</li>
                <li class="breadcrumb-item active" aria-current="page">Akta Kematian</li>
            </ol>
        </nav>
        <div class="card card-boy">
            <div class="p-4">
                <h5 class="text-center">Cetak Ulang Akta Kematian</h5>
                <hr>
                <reprint-death-certificate
                    has_printed="{{ $hasPrinted }}"
                    :cards="{{json_encode($cards)}}"
                    submit_url="{{route('reprint.ak.submit')}}"
                    redirect_url="{{route('reprint.ak.index')}}"
                    media_url="{{route('ak.pdf')}}"
                />
            </div>
        </div>
    </div>
</div>
@endsection
