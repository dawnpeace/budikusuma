@extends('layouts.admin.app')
@section('content')
<div class="container">
    <div class="card card-body">
        <submission-birth-certificate-index ajax_url="{{route('admin.submission.al.datatable')}}" />
    </div>
</div>
@endsection