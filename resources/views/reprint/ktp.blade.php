@extends('layouts.app')
@section('content')
<div class="container">
    <div class="justify-content-center">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('/')}}">Utama</a></li>
                <li class="breadcrumb-item">Cetak Ulang</li>
                <li class="breadcrumb-item active" aria-current="page">E-KTP</li>
            </ol>
        </nav>
        @include('appliance.info-card')
        <div class="card card-boy">
            <reprint-id-card 
                has_printed="{{ $hasPrinted }}"
                :cards="{{json_encode($cards)}}" 
                submit_url="{{ route('reprint.ktp.submit') }}"
                redirect_url="{{ route('reprint.ktp.index') }}"
            />
        </div>
    </div>
</div>
@endsection