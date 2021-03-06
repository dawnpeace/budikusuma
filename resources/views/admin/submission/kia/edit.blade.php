@extends('layouts.admin.app')
@section('content')
<div class="container">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item bread"><a href="{{url('/')}}">Utama</a></li>
            <li class="breadcrumb-item">Pengajuan<a href="#"></a></li>
            <li class="breadcrumb-item active" aria-current="page">Kartu Identitas Anak</li>
        </ol>
    </nav>
    <div class="card card-body">
        <submission-child-id-card-edit media_url="{{route('media', $media)}}" submit_url="{{$submitUrl}}" :card='{{json_encode($card)}}' redirect_url="{{$redirectUrl}}" delete_url="{{$deleteUrl}}" />
    </div>
</div>
@endsection
