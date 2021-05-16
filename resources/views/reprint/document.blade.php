@extends('layouts.app')
@section('content')
<div class="container">
    <div class="justify-content-center">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('/')}}">Utama</a></li>
                <li class="breadcrumb-item">Cetak Ulang</li>
                <li class="breadcrumb-item active" aria-current="page">Daftar Dokumen</li>
            </ol>
        </nav>
        <div class="card card-body border-primary p-2 mb-3 bg-info text-center">                
            <div>Untuk permintaan dokumen yang sudah melebihi batas 2 bulan harap mengunjungi kantor Dukcapil Sanatab</div>
        </div>
        <div class="row px-2">

            @if($hasNoDocument)
            <div class="col-12 p-2">
                <div class="card card-body">
                    <h5 class="text-center py-5">Anda belum memiliki dokumen terdaftar</h5>
                </div>
            </div>
            @endif

            @if($identityCard)
            <div class="col-6 p-2">
                <div class="card card-body">
                    <h5>E-KTP</h5>
                    <div class="text-right">
                        <a href="{{ route('reprint.ktp.index') }}" class="badge badge-info p-1">Cetak Ulang>></a>
                    </div>
                </div>
            </div>
            @endif

            @if($deathCertificate)
            <div class="col-6 p-2">
                <div class="card card-body">
                    <h5>Akta Kematian</h5>
                    <div class="text-right">
                        <a href="{{ route('reprint.ak.index') }}" class="badge badge-info p-1">Cetak Ulang>></a>
                    </div>
                </div>
            </div>
            @endif

            @if($birthCertificate)
            <div class="col-6 p-2">
                <div class="card card-body">
                    <h5>Akta Kelahiran</h5>
                    <div class="text-right">
                        <a href="{{ route('reprint.al.index') }}" class="badge badge-info p-1">Cetak Ulang>></a>
                    </div>
                </div>
            </div>
            @endif

            @if($familyCard)
            <div class="col-6 p-2">
                <div class="card card-body">
                    <h5>Kartu Keluarga</h5>
                    <div class="text-right">
                        <a href="{{ route('reprint.kk.index') }}" class="badge badge-info p-1">Cetak Ulang>></a>
                    </div>
                </div>
            </div>
            @endif

            @if($childIdentityCard)
            <div class="col-6 p-2">
                <div class="card card-body">
                    <h5>Kartu Identitas Anak</h5>
                    <div class="text-right">
                        <a href="{{ route('reprint.kia.index') }}" class="badge badge-info p-1">Cetak Ulang>></a>
                    </div>
                </div>
            </div>
            @endif
            
        </div>
    </div>
</div>
@endsection