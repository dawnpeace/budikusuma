@extends('layouts.admin.app')
@section('content')
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item bread"><a href="{{url('/admin')}}">Utama</a></li>
                <li class="breadcrumb-item">Pembaruan<a href="#"></a></li>
                <li class="breadcrumb-item active" aria-current="page">Kartu Keluarga</li>
            </ol>
        </nav>
        <div class="card card-body">
            <renewal-family-card-index ajax_url="{{route('admin.renewal.kk.datatable')}}"/>
        </div>
    </div>
@endsection
