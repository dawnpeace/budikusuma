@extends('layouts.admin.app')
@section('content')
<div class="container">
    <div class="card card-body">
        <submission-family-card-index ajax_url="{{route('admin.submission.kk.datatable')}}" />
    </div>
</div>
@endsection