<li class="nav-item">
    <a class="nav-link {{ Route::is('admin.requirement.index') ? 'active' : '' }}" href="{{ route('admin.requirement.index') }}">Persyaratan Dokumen</a>
</li>
<li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle {{ Route::is('admin.submission.*') ? 'active' : '' }}" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        Daftar Pengajuan Dokumen
    </a>
    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
        <a class="dropdown-item" href="{{route('admin.submission.ktp')}}">KTP</a>
        <a class="dropdown-item" href="{{route('admin.submission.kia')}}">KIA</a>
        <a class="dropdown-item" href="{{route('admin.submission.kk')}}">KK</a>
        <a class="dropdown-item" href="{{route('admin.submission.al')}}">Akta Kelahiran</a>
        <a class="dropdown-item" href="{{route('admin.submission.ak')}}">Akta Kematian</a>
    </div>
</li>
<li class="nav-item">
    <a href="{{ route('admin.reprint.index') }}" class="nav-link {{ Route::is('admin.reprint.*') ? 'active' : '' }}">
        Cetak Ulang Dokumen
    </a>
</li>
<li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle {{ Route::is('admin.qualified.*') ? 'active' : '' }}" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        Terkualifikasi
    </a>
    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
        <a class="dropdown-item" href="{{route('admin.qualified.ktp.index')}}">KTP</a>
        <a class="dropdown-item" href="{{route('admin.qualified.kia.index')}}">KIA</a>
        <a class="dropdown-item" href="{{route('admin.qualified.kk.index')}}">KK</a>
        <a class="dropdown-item" href="{{route('admin.qualified.al.index')}}">Akta Kelahiran</a>
        <a class="dropdown-item" href="{{route('admin.qualified.ak.index')}}">Akta Kematian</a>
    </div>
</li>
<li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle {{ Route::is('admin.stored.*') ? 'active' : '' }}" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        Arsip
    </a>
    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
        <a class="dropdown-item" href="{{route('admin.stored.ktp.index')}}">KTP</a>
        <a class="dropdown-item" href="{{route('admin.stored.kia.index')}}">KIA</a>
        <a class="dropdown-item" href="{{route('admin.stored.kk.index')}}">KK</a>
        <a class="dropdown-item" href="{{route('admin.stored.al.index')}}">Akta Kelahiran</a>
        <a class="dropdown-item" href="{{route('admin.stored.ak.index')}}">Akta Kematian</a>
    </div>
</li>