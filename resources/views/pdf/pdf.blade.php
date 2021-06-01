<html lang="en">
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="{{public_path('css/app.css')}}"/>
{{--        <link rel="stylesheet" href="{{asset('css/app.css')}}"/>--}}
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
                <p>Menyatakan yang diterakan dibawah ini: </p>
                <table style="width: 100%" class="table table-sm table-bordered border-dark">
                    <tbody>
                        <tr>
                            <td width="40%">Nama </td>
                            <td>{{$name}}</td>
                        </tr>
                        <tr>
                            <td>Pengajuan Atas Dokumen</td>
                            <td>{{$docType}}</td>
                        </tr>
                        <tr>
                            <td>No Dokumen</td>
                            <td>{{$docType . ' - '. $docId}}</td>
                        </tr>
                        <tr>
                            <td>No Kartu</td>
                            <td>{{$cardNo}}</td>
                        </tr>
                        <tr>
                            <td>Tanggal Rilis</td>
                            <td>{{$publishedAt}}</td>
                        </tr>
                        <tr>
                            <td>Diajukan Oleh</td>
                            <td>{{$userName}}</td>
                        </tr>

                    </tbody>
                </table>
                <p class="py-5 text-justify">Telah melakukan pengajuan dokumen pada Aplikasi Web Portal Sanatab. Demikian Surat ini dapat digunakan untuk melakukan pengambilan dokumen oleh yang bersangkutan pada Kantor Desa Sanatab.</p>
            </div>

        </div>
    </body>
</html>
