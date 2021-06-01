@extends('layouts.admin.app')
@section('content')
<div class="container">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item bread"><a href="{{url('/admin')}}">Utama</a></li>
            <li class="breadcrumb-item">Arsip</li>
            <li class="breadcrumb-item active" aria-current="page">KTP</li>
        </ol>
    </nav>
    <div class="card card-body">
        <stored-identity-card-edit media_url="{{route('media', $media)}}" :card="{{ json_encode($card) }}" submit_url="{{ $submitUrl }}" redirect_url="{{ $redirectUrl }}"/>
    </div>
</div>
@endsection
