@extends('layouts.app')
@section('content')

    @if(session('status'))
        <div class="container alert alert-success">
            <i class="fa fa-check-circle-o "></i> {{ session('status') }}
        </div>
    @endif

    <div class="container p-4 border-secondary">

        <div class="row">
            <div class="card col-12">
                <div class="card-body">
                    <h2 class="text-center">Selamat datang di Portal Sanatab</h2>
                </div>
            </div>
        </div>

        @guest
            <div class="row">
                <div class="card col-12 card-body alert alert-info mt-2">
                    <p class="py-0 my-0"><i class="fa fa-info-circle"></i> Untuk mengakses fitur silahkan <a
                            href="{{route('login')}}">Masuk</a> untuk melanjutkan</p>
                </div>
            </div>
        @endguest

        <div class="row mt-5">
            <div class="col-md-3 col-sm-12 mt-5">
                <div class="card h-100">
                    <img src="{{asset('img/book.png')}}" class="card-img-top">
                    <a href="javascript:void(0)" class="btn btn-primary btn-thumbnail-top"><i
                            class="fa fa-inverse fa-clipboard"></i></a>
                    <div class="card-body">
                        <h4 class="text-center">
                            <a href="{{route('requirement.index')}}">
                                Laman Persyaratan
                            </a>
                        </h4>
                        <p class="text-center">Detail persyaratan permohonan dokumen baru.</p>
                    </div>
                </div>
            </div>

            @can('access-common-page')

                <div class="col-md-3 col-sm-12 mt-5">
                    <div class="card h-100">
                        <img src="{{asset('img/7995158.jpg')}}" alt="" class="card-img-top">
                        <a href="javascript:void(0)" class="btn btn-primary btn-thumbnail-top"><i
                                class="fa fa-inverse fa-inverse fa-id-card"></i></a>
                        <div class="card-body">
                            <h4 class="text-center">
                                <a href="{{route('apply.ktp')}}">Pengajuan Dokumen KTP</a>
                            </h4>
                            <p class="text-center">
                                Halaman pengajuan dokumen E-KTP baru
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-12 mt-5">
                    <div class="card h-100">
                        <img src="{{asset('img/certi.jpg')}}" alt="" class="card-img-top">
                        <a href="javascript:void(0)" class="btn btn-primary btn-thumbnail-top"><i
                                class="fa fa-inverse fa-inverse fa-file-o"></i></a>
                        <div class="card-body">
                            <h4 class="text-center">
                                <a href="{{route('apply.kartukeluarga')}}">Pengajuan Dokumen KK</a>
                            </h4>
                            <p class="text-center">
                                Halaman pengajuan dokumen KK baru
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-12 mt-5">
                    <div class="card h-100">
                        <img src="{{asset('img/childid.png')}}" alt="" class="card-img-top">
                        <a href="javascript:void(0)" class="btn btn-primary btn-thumbnail-top"><i
                                class="fa fa-inverse fa-inverse fa-child"></i></a>
                        <div class="card-body">
                            <h4 class="text-center">
                                <a href="{{route('apply.kia')}}">Pengajuan Dokumen KIA</a>
                            </h4>
                            <p class="text-center">
                                Halaman pengajuan dokumen Kartu Identitas Anak baru
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-12 mt-5">
                    <div class="card h-100">
                        <img src="{{asset('img/certificate animated.jpg')}}" alt="" class="card-img-top">
                        <a href="javascript:void(0)" class="btn btn-primary btn-thumbnail-top"><i
                                class="fa fa-inverse fa-inverse fa-certificate"></i></a>
                        <div class="card-body">
                            <h4 class="text-center">
                                <a href="{{route('apply.aktelahir')}}">Pengajuan Dokumen Akta Lahir</a>
                            </h4>
                            <p class="text-center">
                                Halaman pengajuan dokumen Akta Lahir baru
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-12 mt-5">
                    <div class="card h-100">
                        <img src="{{asset('img/aktamati.png')}}" alt="" class="card-img-top">
                        <a href="javascript:void(0)" class="btn btn-primary btn-thumbnail-top"><i
                                class="fa fa-inverse fa-user-circle fa-"></i></a>
                        <div class="card-body">
                            <h4 class="text-center">
                                <a href="{{route('apply.aktakematian')}}">Pengajuan Dokumen Akta Kematian</a>
                            </h4>
                            <p class="text-center">
                                Halaman pengajuan dokumen Akta Kematian baru
                            </p>
                        </div>
                    </div>
                </div>

                <div class="col-md-3 col-sm-12 mt-5">
                    <div class="card h-100">
                        <img src="{{asset('img/reprint.jpg')}}" alt="" class="card-img-top">
                        <a href="javascript:void(0)" class="btn btn-primary btn-thumbnail-top"><i
                                class="fa fa-inverse fa-print"></i></a>
                        <div class="card-body">
                            <h4 class="text-center">
                                <a href="{{route('reprint.index')}}">Cetak Ulang</a>
                            </h4>
                            <p class="text-center">
                                Halaman pengajuan Cetak Ulang Dokumen
                            </p>
                        </div>
                    </div>
                </div>

                <div class="col-md-3 col-sm-12 mt-5">
                    <div class="card h-100">
                        <img src="{{asset('img/check-document.png')}}" alt="" class="card-img-top">
                        <a href="javascript:void(0)" class="btn btn-primary btn-thumbnail-top"><i
                                class="fa fa-inverse fa-check-circle"></i></a>
                        <div class="card-body">
                            <h4 class="text-center">
                                <a href="{{route('check.index')}}">Periksa Permintaan Dokumen</a>
                            </h4>
                            <p class="text-center">
                                Halaman permintaan pengajuan dokumen baru
                            </p>
                        </div>
                    </div>
                </div>

                <div class="col-md-3 col-sm-12 mt-5">
                    <div class="card h-100">
                        <img src="{{asset('img/human-queue.png')}}" alt="" class="card-img-top">
                        <a href="javascript:void(0)" class="btn btn-primary btn-thumbnail-top"><i
                                class="fa fa-inverse fa-group"></i></a>
                        <div class="card-body">
                            <h4 class="text-center">
                                <a href="{{route('queue.index')}}">Pengajuan Antrian</a>
                            </h4>
                            <p class="text-center">
                                Halaman Pengajuan Antrian
                            </p>
                        </div>
                    </div>
                </div>
            @endcan
        </div>
    </div>
@endsection
