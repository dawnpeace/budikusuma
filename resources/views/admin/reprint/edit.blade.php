@extends('layouts.admin.app')
@section('content')
<div class="container">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item bread"><a href="{{url('/admin')}}">Utama</a></li>
            <li class="breadcrumb-item">Cetak Ulang<a href="#"></a></li>
            <li class="breadcrumb-item active" aria-current="page">Akta Lahir</li>
        </ol>
    </nav>
    <div class="card card-body">
        <reprint-edit :document="{{ json_encode($document) }}"/>
    </div>
</div>
@endsection