@extends('adminlte::page')

@section('title', 'Tanggapan')

@section('content_header')

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('home') }}">Beranda</a></li>
            <li class="breadcrumb-item"><a href="{{ url('personil-scheduling') }}">Daftar Penjadwalan Personil</a></li>
            <li class="breadcrumb-item active" aria-current="page">Detail Penjadwalan Personil</li>
        </ol>
    </nav>

@stop

@section('content')

    <h3 class="page-title">
        Form Detail Penjadwalan Personil
    </h3>
    <br />
    @if (session('msg'))
        <div class="alert alert-info" role="alert">
            {{ session('msg') }}
        </div>
    @endif

    @php $patrol_day = json_decode($personil_scheduling->patrol_day) @endphp

    <div class="card border border-dark">
        <div class="card-header border-dark bg-dark">
            <h5 class="mb-0 float-left">
                Form Detail
            </h5>
            <div class="float-right">
                <button onclick="location.href='{{ url('personil-scheduling') }}'" name="Find" class="btn btn-sm btn-info"
                    title="Back"><i class="fa fa-angle-left"></i> Kembali</button>
            </div>
        </div>

        <form method="post" action="/system-user/process-edit-system-user" enctype="multipart/form-data">
            @csrf
            <div class="card-body">
                <div class="row form-group">
                    <div class="col-md-4">
                        <div class="form-group">
                            <a class="text-dark">ID Produk</a>
                            <input class="form-control input-bb" type="text" name="name" id="name"
                                value="{{ $personil_scheduling['personil_scheduling_id'] }}" readonly />
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <a class="text-dark">ID Personil</a>
                            <input class="form-control input-bb" type="text" name="name" id="name"
                                value="{{ $personil_scheduling['personil_id'] }}" readonly />
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <a class="text-dark">Nama Personil</a>
                            <input class="form-control input-bb" type="text" name="name" id="name"
                                value="{{ $personil_scheduling->callPersonil['name'] }}" readonly />
                        </div>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-md-4">
                        <div class="form-group">
                            <a class="text-dark">ID Penjadwalan Patroli</a>
                            <input class="form-control input-bb" type="text" name="name" id="name"
                                value="{{ $patrol['patrol_id'] }}" readonly />
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <a class="text-dark">Informasi Patroli</a>
                            <input class="form-control input-bb" type="text" name="name" id="name"
                                value="{{ $patrol['patrol_name'] }}" readonly />
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <a class="text-dark">Hari Patroli </a>
                            @foreach ($patrol_day as $patrol_days)
                                <input class="form-control input-bb" type="text" name="name" id="name"
                                    value="{{ $patrol_days }}" readonly />
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
    </div>
    </div>
    </form>

@stop

@section('footer')

@stop

@section('css')

@stop

@section('js')

@stop
