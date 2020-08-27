@extends('layouts.app')
@section('content')
<div class="container">
    <div class="justify-content-center">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">Utama<a href="#"></a></li>
                <li class="breadcrumb-item active" aria-current="page">Persyaratan</li>
            </ol>
        </nav>
        <div class="card card-boy">
            <div class="p-4">
                <requirement-content document_url="{{route('requirement.show')}}" :items="{{json_encode($items)}}" />
            </div>
        </div>
    </div>
</div>
@endsection