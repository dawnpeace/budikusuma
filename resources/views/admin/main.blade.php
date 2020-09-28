@extends('layouts.admin.app')
@section('content')
    <div class="container">
        <main-component :cards="{{ json_encode($cards) }}"/>
    </div>
@endsection