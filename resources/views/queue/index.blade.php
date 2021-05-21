@extends('layouts.app')

@section('content')
<div class="container">
    <div class="justify-content-center">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item bread"><a href="{{url('/')}}">Utama</a></li>
                <li class="breadcrumb-item">Pengajuan Antrian<a href="#"></a></li>
            </ol>
        </nav>
        <div class="card card-boy">
            <div class="p-4">
                <queue-request 
                    redirect_url="{{ route('queue.index') }}"
                    submit_url="{{ route('queue.store') }}" 
                    :queues="{{ json_encode($queues) }}"/>
            </div>
        </div>
    </div>
</div>
@endsection