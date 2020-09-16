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
        <submission-child-id-card-index ajax_url="{{route('admin.submission.kia.datatable')}}" />
    </div>
</div>
@endsection