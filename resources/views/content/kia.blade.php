@extends('layouts.app')
@section('content')
<div class="container">
    <div class="justify-content-center">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">Home<a href="#"></a></li>
                <li class="breadcrumb-item">Library<a href="#"></a></li>
                <li class="breadcrumb-item active" aria-current="page">Data</li>
            </ol>
        </nav>
        <div class="card card-boy">
            <div class="p-4">
                <content-child-identity-card current_data='{!! $kia !!}' redirect_url="{{route('requirement.kia')}}" submit_url="{{route('requirement.kia.submit')}}" />
            </div>
        </div>
    </div>
</div>
@endsection