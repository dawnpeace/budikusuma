<li class="nav-item">
    <a class="nav-link" href="{{ route('requirement.index') }}">Persyaratan Dokumen</a>
</li>
<li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        Daftar Pengajuan Dokumen
    </a>
    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
        <a class="dropdown-item" href="{{route('admin.submission.ktp')}}">KTP</a>
        <a class="dropdown-item" href="{{route('admin.submission.kia')}}">KIA</a>
        <a class="dropdown-item" href="{{route('admin.submission.kk')}}">KK</a>
        <a class="dropdown-item" href="{{route('admin.submission.al')}}">Akta Kelahiran</a>
    </div>
</li>
<li class="nav-item dropdown">
    <a href="#" role="button" data-toggle="dropdown" id="navbarDropdown2" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">
        Daftar Cetak Ulang Dokumen
    </a>
    <div class="dropdown-menu" aria-labelledby="navbarDropdown2">
        <a class="dropdown-item" href="{{route('reprint.ktp.index')}}">KTP</a>
    </div>
</li>