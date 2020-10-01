<li class="nav-item">
    <a class="nav-link {{ Route::is('requirement.index') ? 'active' : '' }}" href="{{ route('requirement.index') }}">Persyaratan Dokumen</a>
</li>
<li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle {{ Route::is('apply.*') ? 'active' : '' }}" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        Pengajuan Dokumen
    </a>
    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
        <a class="dropdown-item" href="{{route('apply.ktp')}}">KTP</a>
        <a class="dropdown-item" href="{{route('apply.kia')}}">KIA</a>
        <a class="dropdown-item" href="{{route('apply.kartukeluarga')}}">KK</a>
        <a class="dropdown-item" href="{{route('apply.aktelahir')}}">Akta Kelahiran</a>
    </div>
</li>
<li class="nav-item dropdown">
    <a href="#" role="button" data-toggle="dropdown" id="navbarDropdown2" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle {{ Route::is('reprint.*') ? 'active' : '' }}">
        Cetak Ulang Dokumen
    </a>
    <div class="dropdown-menu" aria-labelledby="navbarDropdown2">
        <a class="dropdown-item" href="{{route('reprint.ktp.index')}}">KTP</a>
        <a class="dropdown-item" href="{{route('reprint.kk.index')}}">KK</a>
        <a class="dropdown-item" href="{{route('reprint.kia.index')}}">KIA</a>
        <a class="dropdown-item" href="{{route('reprint.al.index')}}">Akta Lahir</a>
    </div>
</li>
<li class="nav-item {{ Route::is('check.index') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('check.index') }}">Periksa Permintaan Dokumen</a>
</li>