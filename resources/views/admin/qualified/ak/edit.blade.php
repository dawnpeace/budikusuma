@extends('layouts.admin.app')
@section('content')
<div class="container">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item bread"><a href="{{url('/admin')}}">Utama</a></li>
            <li class="breadcrumb-item">Data Terkualifikasi</li>
            <li class="breadcrumb-item active" aria-current="page">Akta Kematian</li>
        </ol>
    </nav>
    <div class="card card-body">
        <qualified-death-certificate-edit redirect_url="{{$redirectUrl}}" submit_url="{{ $submitUrl }}" :card="{{ json_encode($card) }}" />
    </div>
</div>
@endsection