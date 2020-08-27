@extends('layouts.app')
@section('content')
<div class="container p-4 bg-white border-secondary">
    <h2 class="text-center">Selamat datang di Portal Sanatab</h2>
    <hr>
    <div class="row mt-5">
        <div class="col-md-4 col-sm-12 mb-4 p-3">
            <h4>
                <a href="{{route('requirement.index')}}">
                    <span class="fa fa-file-archive-o"></span> Laman Persyaratan
                </a>
            </h4>
            <small>Detail persyaratan permohonan dokumen baru.</small>
        </div>

        <div class="col-md-4 col-sm-12 mb-4 p-3">
            <h4>
                <span class="fa fa-file-o"></span> Laman Pendaftaran Dokumen
            </h4>
            <ul class="list-group">
                <li class="list-group-item">
                    <a href="{{route('apply.ktp')}}">Kartu Tanda Penduduk</a>
                </li>
                <li class="list-group-item">
                    <a href="{{route('apply.kartukeluarga')}}">Kartu Keluarga</a>
                </li>
                <li class="list-group-item">
                    <a href="#">Kartu Identitas Anak</a>
                </li>
                <li class="list-group-item">
                    <a href="#">Akta Kelahiran</a>
                </li>
            </ul>
        </div>

        <div class="col-md-4 col-sm-12 mb-4 p-3">
            <h4>
                <span class="fa fa-address-card-o"></span> Laman Cetak Ulang Dokumen
            </h4>
            <ul class="list-group">
                <li class="list-group-item">
                    <a href="#">Kartu Tanda Penduduk</a>
                </li>
                <li class="list-group-item">
                    <a href="#">Kartu Keluarga</a>
                </li>
                <li class="list-group-item">
                    <a href="#">Kartu Identitas Anak</a>
                </li>
                <li class="list-group-item">
                    <a href="#">Akta Kelahiran</a>
                </li>
            </ul>
        </div>
    </div>
</div>
@endsection