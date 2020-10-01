@extends('layouts.admin.app')
@section('content')
<div class="container">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item bread"><a href="{{url('/admin')}}">Utama</a></li>
            <li class="breadcrumb-item active" aria-current="page">Persyaratan Dokumen</li>
        </ol>
    </nav>
    <div class="card card-body">
        <requirement-index :requirements="{{ json_encode($requirements) }}" submit_url="{{ $submitUrl }}"/>
    </div>
</div>
@endsection