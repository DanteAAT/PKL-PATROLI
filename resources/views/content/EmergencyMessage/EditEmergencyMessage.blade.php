@extends('adminlte::page')

@section('title', 'Tanggapan')

@section('content_header')

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('home') }}">Beranda</a></li>
            <li class="breadcrumb-item"><a href="{{ url('emergency-message') }}">Daftar Emergency Message</a></li>
            <li class="breadcrumb-item active" aria-current="page">Edit Emergency Message</li>
        </ol>
    </nav>

@stop

@section('content')

    <h3 class="page-title">
        Form Edit Emergency Message
    </h3>
    <br />
    @if (session('msg'))
        <div class="alert alert-info" role="alert">
            {{ session('msg') }}
        </div>
    @endif
    <div class="card border border-dark">
        <div class="card-header border-dark bg-dark">
            <h5 class="mb-0 float-left">
                Form Edit
            </h5>
            <div class="float-right">
                <button onclick="location.href='{{ url('emergency-message') }}'" name="Find" class="btn btn-sm btn-info"
                    title="Back"><i class="fa fa-angle-left"></i> Kembali</button>
            </div>
        </div>

        <form action="{{ url('/emergency-message/edit/process/' . $emergency_message['emergency_message_id']) }}"
            enctype="multipart/form-data">
            @csrf
            <div class="card-body">
                <div class="row form-group">
                    <div class="col-md-4">
                        <div class="form-group">
                            <a class="text-dark">Nama Pelayanan Darurat</a>
                            <input class="form-control input-bb" type="text" name="emergency_message_name" id="name"
                                value="{{ $emergency_message['emergency_message_name'] }}" />
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <a class="text-dark">Nomer Darurat</a>
                            <input class="form-control input-bb" type="text" name="emergency_message_phone_number"
                                id="name" value="{{ $emergency_message['emergency_message_phone_number'] }}" />
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <a class="text-dark">Pesan Darurat</a>
                            <input class="form-control input-bb" type="text" name="emergency_message_text" id="name"
                                value="{{ $emergency_message['emergency_message_text'] }}" />
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer text-muted">
                <div class="form-actions float-right">
                    <button type="reset" name="Reset" class="btn btn-danger" onClick="window.location.reload();"><i
                            class="fa fa-times"></i> Batal</button>
                    <button type="submit" name="Save" class="btn btn-primary" title="Save"><i class="fa fa-check"></i>
                        Simpan</button>
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
