@extends('layouts.app')
@section('content')
<div class="container">
    <div class="justify-content-center">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('/')}}">Utama</a></li>
                <li class="breadcrumb-item">Cetak Ulang</li>
                <li class="breadcrumb-item active" aria-current="page">KIA</li>
            </ol>
        </nav>
        <div class="card card-boy">
            <div class="p-4">
                <h5 class="text-center">Cetak Ulang KIA</h5>
                <hr>
                <reprint-child-id-card
                    has_printed="{{ $hasPrinted }}"
                    :cards="{{json_encode($cards)}}"
                    submit_url="{{route('reprint.kia.submit')}}"
                    redirect_url="{{route('reprint.kia.index')}}"
                    media_url="{{route('kia.pdf')}}"
                />
            </div>
        </div>
    </div>
</div>
@endsection
