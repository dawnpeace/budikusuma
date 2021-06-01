@extends('layouts.app')
@section('content')
<div class="container">
    <div class="justify-content-center">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('/')}}">Utama</a></li>
                <li class="breadcrumb-item">Cetak Ulang</li>
                <li class="breadcrumb-item active" aria-current="page">Akta Lahir</li>
            </ol>
        </nav>
        @include('appliance.info-card')
        <div class="card card-boy">
            <div class="p-4">
                <h5 class="text-center">Cetak Ulang Akta Lahir</h5>
                <hr>
                <reprint-birth-certificate
                    has_printed="{{ $hasPrinted }}"
                    :cards="{{json_encode($cards)}}"
                    submit_url="{{route('reprint.al.submit')}}"
                    redirect_url="{{route('reprint.al.index')}}"
                    media_url="{{route('al.pdf')}}"
                />
            </div>
        </div>
    </div>
</div>
@endsection
