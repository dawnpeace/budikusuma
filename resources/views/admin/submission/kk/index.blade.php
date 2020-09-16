@extends('layouts.admin.app')
@section('content')
<div class="container">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item bread"><a href="{{url('/')}}">Utama</a></li>
            <li class="breadcrumb-item">Pengajuan<a href="#"></a></li>
            <li class="breadcrumb-item active" aria-current="page">Kartu Keluarga</li>
        </ol>
    </nav>
    <div class="card card-body">
        <submission-family-card-index ajax_url="{{route('admin.submission.kk.datatable')}}" />
    </div>
</div>
@endsection