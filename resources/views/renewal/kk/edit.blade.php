@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="justify-content-center">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item bread"><a href="{{url('/')}}">Utama</a></li>
                    <li class="breadcrumb-item">Pengajuan Pembaruan Kartu Keluarga<a href="#"></a></li>
                </ol>
            </nav>
            <div class="card card-boy">
                <div class="p-4">
                    <common-renewal-family-card-edit submit_url="{{route('renewal.kk.store', $card)}}" redirect_url="{{route('renewal.kk.index')}}" :card="{{(json_encode($card))}}"/>
                </div>
            </div>
        </div>
    </div>
@endsection
