@extends('adminlte::page')

@section('title', 'Tanggapan')
@section('js')
@stop

@section('content_header')

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('home') }}">Beranda</a></li>
            <li class="breadcrumb-item"><a href="{{ url('personil') }}">Daftar Personil</a></li>
            <li class="breadcrumb-item active" aria-current="page">Detail Personil</li>
        </ol>
    </nav>

@stop

@section('content')

    <h3 class="page-title">
        Form Detail Personil
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
                Form Detail
            </h5>
            <div class="float-right">
                <button onclick="location.href='{{ url('personil') }}'" name="Find" class="btn btn-sm btn-info"
                    title="Back"><i class="fa fa-angle-left"></i> Kembali</button>
            </div>
        </div>

        <form>
            @csrf
            <div class="card-body">
                <div class="row form-group">
                    <div class="col-md-4">
                        <div class="form-group">
                            <a class="text-dark">Nama<a class='red'> *</a></a>
                            <input class="form-control input-bb" type="text" name="name" id="name"
                                value="{{ $Personil['name'] }}" autocomplete="off" readonly />
                            @error('name')
                                <p class='text-danger text-xs pt-1'> {{ $message }} </p>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <a class="text-dark">Tempat Lahir<a class='red'> *</a></a>
                            <input class="form-control input-bb" type="text" name="tempat" id="tempat"
                                value="{{ $ttl[0] }}" autocomplete="off" readonly />
                            @error('tempat')
                                <p class='text-danger text-xs pt-1'> {{ $message }} </p>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <a class="text-dark">Tanggal Lahir<a class='red'> *</a></a>
                            <input class="form-control input-bb" type="date" name="tanggal" id="tanggal"
                                value="{{ date('Y-m-d', strtotime($ttl[1])) }}" autocomplete="off" readonly />
                            @error('tanggal')
                                <p class='text-danger text-xs pt-1'> {{ $message }} </p>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <a class="text-dark">Jenis Kelamin<a class='red'> *</a></a>
                        @if ($Personil['gender'] == 1)
                            <input class="form-control input-bb" type="text" name="tempat" id="tempat"
                                value="Laki - Laki" autocomplete="off" readonly />
                        @else
                            <input class="form-control input-bb" type="text" name="tempat" id="tempat"
                                value="Perempuan" autocomplete="off" readonly />
                        @endif
                        @error('gender')
                            <p class='text-danger text-xs pt-1'> {{ $message }} </p>
                        @enderror
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <a class="text-dark">No HP<a class='red'> *</a></a>
                            <input class="form-control input-bb" type="number" name="phone_number" id="phone_number"
                                value="{{ $Personil['phone_number'] }}" autocomplete="off" readonly />
                            @error('phone_number')
                                <p class='text-danger text-xs pt-1'> {{ $message }} </p>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <a class="text-dark">Alamat<a class='red'> *</a></a>
                            <input class="form-control input-bb" type="text" name="address" id="address"
                                value="{{ $Personil['address'] }}" autocomplete="off" readonly />
                            @error('address')
                                <p class='text-danger text-xs pt-1'> {{ $message }} </p>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

@stop

@section('footer')

@stop

@section('css')

@stop
