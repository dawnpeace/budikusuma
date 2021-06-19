@extends('layouts.admin.app')
@section('content')
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item bread"><a href="{{url('/admin')}}">Utama</a></li>
                <li class="breadcrumb-item">Pembaruan<a href="#"></a></li>
                <li class="breadcrumb-item active" aria-current="page">Akta Lahir</li>
            </ol>
        </nav>
        <div class="card card-body">
            <renewal-family-card-edit
                stored_url="{{route('admin.stored.kk.edit', $card->card)}}"
                submit_url="{{route('admin.renewal.kk.update', $card)}}"
                redirect_url="{{route('admin.renewal.kk.index')}}"
                :card="{{json_encode($card)}}"/>
        </div>
    </div>
@endsection
