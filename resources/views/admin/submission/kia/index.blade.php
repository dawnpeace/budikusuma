@extends('layouts.admin.app')
@section('content')
<div class="container">
    <div class="card card-body">
        <submission-child-id-card-index ajax_url="{{route('admin.submission.kia.datatable')}}" />
    </div>
</div>
@endsection