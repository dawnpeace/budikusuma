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
                    <common-renewal-family-card-index view_url="{{route('renewal.kk.edit')}}" :cards="{{(json_encode($cards))}}"/>
                </div>
            </div>
        </div>
    </div>
@endsection
