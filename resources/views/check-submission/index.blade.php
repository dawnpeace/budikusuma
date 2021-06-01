@extends('layouts.app')
@section('content')
<div class="container">
    <div class="justify-content-center">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item bread"><a href="{{url('/')}}">Utama</a></li>
                <li class="breadcrumb-item">Periksa Pengajuan<a href="#"></a></li>
            </ol>
        </nav>
        <div class="card card-boy">
            <div class="p-4">
                <check-appliance
                    ktp_pdf_url="{{route('check.pdf.ktp')}}"
                    kk_pdf_url="{{route('check.pdf.kk')}}"
                    kia_pdf_url="{{route('check.pdf.kia')}}"
                    al_pdf_url="{{route('check.pdf.al')}}"
                    ak_pdf_url="{{route('check.pdf.ak')}}"
                    redirect_url='{{url("/")}}'
                    submit_url='{{route("check.submit")}}' />
            </div>
        </div>
    </div>
</div>
@endsection
