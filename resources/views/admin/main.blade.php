@extends('layouts.admin.app')
@section('content')
    <div class="container">
        <div>
            <main-component :cards="{{ json_encode($cards) }}"/>
        </div>
        <div>
            <queue-component ajax_url="{{ route('admin.queue.datatable') }}"/>
        </div>
    </div>
@endsection