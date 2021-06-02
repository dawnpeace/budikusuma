<html lang="en">
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="{{public_path('css/app.css')}}"/>
        <style>
            #mainIcon {
                height: 100px;
                width: 82px;
                top:2.8rem;
                left:3rem;
                position:fixed;
            }
        </style>
    </head>
    <body class="bg-white">
        <div class="container-fluid bg-white pt-5 border border-dark">
            <img id="mainIcon" src="{{public_path('images/logopdf.jpeg')}}">
            <h4 class="text-center font-weight-bold text-capitalize">
                Pemerintah Kabupaten Sambas
            </h4>
            <h4 class="text-center font-weight-bold text-capitalize">
                Kecamatan Sajingan Besar
            </h4>
            <h3 class="text-center font-weight-bold text-capitalize mb-5">Desa Sanatab</h3>
            <hr class="border border-dark mx-2 mb-5">
            <div class="w-100">
                <p class="h5 text-center"><u>Dokumen Rekam Data</u></p>
                <table style="width: 100%" class="table table-sm table-bordered border-dark">
                    <tbody>
                        <tr>
                            <td width="40%">Nama </td>
                            <td>{{$name}}</td>
                        </tr>
                        <tr>
                            <td>Tanggal Pengajuan</td>
                            <td>{{$createdAt}}</td>
                        </tr>
                        <tr>
                            <td>Jenis Dokumen</td>
                            <td>{{(str_replace('_', ' ', $docType))}}</td>
                        </tr>
                        <tr>
                            <td>Status</td>
                            <td>
                                <span class="badge badge-success">{{$status}}</span>
                            </td>
                        </tr>
                        <tr>
                            <td>Keterangan</td>
                            <td>{{$note}}</td>
                        </tr>

                    </tbody>
                </table>
            </div>

        </div>
    </body>
</html>
