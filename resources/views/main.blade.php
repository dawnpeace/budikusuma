@extends('layouts.app')
@section('content')

@if(session('status'))
<div class="container alert alert-success">
    <i class="fa fa-check-circle-o "></i> {{ session('status') }}
</div>
@endif

<div class="container p-4 bg-white border-secondary">
    
    <h2 class="text-center">Selamat datang di Portal Sanatab</h2>
    <hr>
    
    <div class="row mt-5">
        <div class="col-md-4 col-sm-12 mb-4 p-3 d-flex flex-column align-items-center justify-content-center">
            <h4 class="text-center">
                <a href="{{route('requirement.index')}}">
                    <span class="fa fa-file-archive-o"></span> Laman Persyaratan
                </a>
            </h4>
            <small class="text-center">Detail persyaratan permohonan dokumen baru.</small>
        </div>
        @can('access-common-page')
        <div class="col-md-4 col-sm-12 mb-4 p-3 d-flex flex-column align-items-center justify-content-center">
            <h4 class="text-center">
                <span class="fa fa-file-o"></span> Laman Pendaftaran Dokumen
            </h4>
            <ul class="list-group w-100">
                <li class="list-group-item">
                    <a href="{{route('apply.ktp')}}">Kartu Tanda Penduduk</a>
                </li>
                <li class="list-group-item">
                    <a href="{{route('apply.kartukeluarga')}}">Kartu Keluarga</a>
                </li>
                <li class="list-group-item">
                    <a href="{{route('apply.kia')}}">Kartu Identitas Anak</a>
                </li>
                <li class="list-group-item">
                    <a href="{{route('apply.aktelahir')}}">Akta Kelahiran</a>
                </li>
                <li class="list-group-item">
                    <a href="{{route('apply.aktakematian')}}">Akta Kematian</a>
                </li>
            </ul>
        </div>
        
        <div class="col-md-4 col-sm-12 mb-4 p-3 d-flex flex-column align-items-center justify-content-center">
            <h4 class="text-center">
                <span class="fa fa-address-card-o"></span> Laman Cetak Ulang Dokumen
            </h4>
            <ul class="list-group w-100">
                <li class="list-group-item">
                    <a href="{{route('reprint.ktp.index')}}">Kartu Tanda Penduduk</a>
                </li>
                <li class="list-group-item">
                    <a href="{{route('reprint.kk.index')}}">Kartu Keluarga</a>
                </li>
                <li class="list-group-item">
                    <a href="{{route('reprint.kia.index')}}">Kartu Identitas Anak</a>
                </li>
                <li class="list-group-item">
                    <a href="{{route('reprint.al.index')}}">Akta Kelahiran</a>
                </li>
            </ul>
        </div>
        @endcan
    </div>
</div>
@endsection