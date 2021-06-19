<li class="nav-item">
    <a class="nav-link {{ Route::is('requirement.index') ? 'active' : '' }}" href="{{ route('requirement.index') }}">Persyaratan Dokumen</a>
</li>
@can('access-common-page')
<li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle {{ Route::is('apply.*') ? 'active' : '' }}" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        Pengajuan
    </a>
    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
        <a class="dropdown-item" href="{{route('apply.ktp')}}">KTP</a>
        <a class="dropdown-item" href="{{route('apply.kia')}}">KIA</a>
        <a class="dropdown-item" href="{{route('apply.kartukeluarga')}}">KK</a>
        <a class="dropdown-item" href="{{route('apply.aktelahir')}}">Akta Kelahiran</a>
        <a class="dropdown-item" href="{{route('apply.aktakematian')}}">Akta Kematian</a>
        <a class="dropdown-item" href="{{route('queue.index')}}">Antrian</a>
    </div>
</li>
<li class="nav-item">
    <a href="{{route('reprint.index')}}" class="nav-link {{ Route::is('reprint.*') ? 'active' : '' }}">
        Cetak Ulang Dokumen
    </a>
</li>
<li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle {{ Route::is('check.index') || Route::is('renewal.*')  ? 'active' : '' }}" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        Periksa Permintaan
    </a>
    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
        <a class="dropdown-item" href="{{route('check.index')}}">Pengajuan Dokumen</a>
        <a class="dropdown-item" href="{{route('renewal.kk.index')}}">Pembaruan Kartu Keluarga</a>
    </div>
</li>
@endcan

@guest
<li class="nav-item dropdown">
    <a href="#" role="button" data-toggle="dropdown" id="navbarDropdown2" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle {{ Route::is('reprint.*') ? 'active' : '' }}">
        <i class="fa fa-user"></i> Daftar
    </a>
    <div class="dropdown-menu" aria-labelledby="navbarDropdown2">
        <a class="dropdown-item" href="register">Register</a>
        <a class="dropdown-item" href="login">Login</a>
    </div>
</li>
@endguest
