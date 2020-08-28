@extends('layouts.app')

@section('content')
<div class="container">
    <div class="justify-content-center">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                    <li class="breadcrumb-item bread"><a href="{{url('/')}}">Utama</a></li>
                    <li class="breadcrumb-item">Pengajuan<a href="#"></a></li>
                    <li class="breadcrumb-item active" aria-current="page">E-KTP</li>
            </ol>
        </nav>
        @include('appliance.info-card')
        <div class="card card-boy">
            <div class="p-4">
                <apply-id-card redirect_url='{{url("/")}}' submit_url='{{route("apply.ktp.submit")}}' />
            </div>
        </div>
    </div>
</div>
@endsection