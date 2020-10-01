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
    </div>
</li>
<li class="nav-item">
    <a href="{{ route('admin.reprint.index') }}" class="nav-link {{ Route::is('admin.reprint.*') ? 'active' : '' }}">
        Cetak Ulang Dokumen
    </a>
</li>