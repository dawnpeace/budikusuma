@extends('layouts.admin.app')
@section('content')
<div class="container">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item bread"><a href="{{url('/admin')}}">Utama</a></li>
            <li class="breadcrumb-item">Arsip</li>
            <li class="breadcrumb-item active" aria-current="page">KIA</li>
        </ol>
    </nav>
    <div class="card card-body">
        <stored-child-id-card-index :latest_date="{{ json_encode($latestDate) }}" :oldest_date="{{ json_encode($oldestDate) }}"  ajax_url="{{ $ajaxUrl }}" export_url="{{ $exportUrl }}"/>
    </div>
</div>
@endsection