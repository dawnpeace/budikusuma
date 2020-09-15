@extends('layouts.admin.app')
@section('content')
<div class="container">
    <div class="card card-body">

        <submission-identitycard-index ajax_url="{{route('admin.submission.ktp.datatable')}}" />
    </div>
</div>
@endsection