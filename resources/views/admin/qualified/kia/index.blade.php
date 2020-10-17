@extends('layouts.admin.app')
@section('content')
<div class="container">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item bread"><a href="{{url('/')}}">Utama</a></li>
            <li class="breadcrumb-item">Data Terkualifikasi<a href="#"></a></li>
            <li class="breadcrumb-item active" aria-current="page">KIA</li>
        </ol>
    </nav>
    <div class="card card-body">
        <qualified-child-identity-card-index ajax_url="{{route('admin.qualified.kia.datatable')}}" />
    </div>
</div>
@endsection