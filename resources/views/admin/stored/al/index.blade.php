@extends('layouts.admin.app')
@section('content')
<div class="container">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item bread"><a href="{{url('/')}}">Utama</a></li>
            <li class="breadcrumb-item">Arsip<a href="#"></a></li>
            <li class="breadcrumb-item active" aria-current="page">Akta Lahir</li>
        </ol>
    </nav>
    <div class="card card-body">
        <stored-birth-certificate-index :latest_date="{{ json_encode($latestDate) }}" :oldest_date="{{ json_encode($oldestDate) }}"  ajax_url="{{ $ajaxUrl }}" export_url="{{ $exportUrl }}"/>
    </div>
</div>
@endsection