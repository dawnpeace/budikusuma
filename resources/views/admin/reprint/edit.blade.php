@extends('layouts.admin.app')
@section('content')
<div class="container">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item bread"><a href="{{url('/admin')}}">Utama</a></li>
            <li class="breadcrumb-item">Cetak Ulang<a href="#"></a></li>
        </ol>
    </nav>
    <div class="card card-body">
        <reprint-edit
            media_url="{{route('admin.reprint.media', $document->id)}}"
            :document="{{ json_encode($document) }}"
            delete_url="{{ $deleteUrl }}"
            redirect_url="{{ $redirectUrl }}"
            submit_url="{{ $submitUrl }}"
            />
    </div>
</div>
@endsection
