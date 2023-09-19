@extends('adminlte::page')

@section('title', 'Tanggapan')
@section('js')
@stop

@section('content_header')

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('home') }}">Beranda</a></li>
            <li class="breadcrumb-item"><a href="{{ url('personil') }}">Daftar Personil</a></li>
            <li class="breadcrumb-item active" aria-current="page">Edit Personil</li>
        </ol>
    </nav>

@stop

@section('content')

    <h3 class="page-title">
        Form Edit Personil
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
                <button onclick="location.href='{{ url('personil') }}'" name="Find" class="btn btn-sm btn-info"
                    title="Back"><i class="fa fa-angle-left"></i> Kembali</button>
            </div>
        </div>

        <form method="" action="{{ url('/personil/edit/process/' . $Personil['personil_id']) }}"
            enctype="multipart/form-data">
            @csrf
            <div class="card-body">
                <div class="row form-group">
                    <div class="col-md-4">
                        <div class="form-group">
                            <a class="text-dark">Nama<a class='red'> *</a></a>
                            <input class="form-control input-bb" type="text" name="name" id="name"
                                value="{{ $Personil['name'] }}" />
                            @error('name')
                                <p class='text-danger text-xs pt-1'> {{ $message }} </p>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <a class="text-dark">Tempat Lahir<a class='red'> *</a></a>
                            <input class="form-control input-bb" type="text" name="tempat" id="tempat"
                                value="{{ $ttl[0] }}" />
                            @error('tempat')
                                <p class='text-danger text-xs pt-1'> {{ $message }} </p>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <a class="text-dark">Tanggal Lahir<a class='red'> *</a></a>
                            <input class="form-control input-bb" type="date" name="tanggal" id="tanggal"
                                value="{{ date('Y-m-d', strtotime($ttl[1])) }}" />
                            @error('tanggal')
                                <p class='text-danger text-xs pt-1'> {{ $message }} </p>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <a class="text-dark">Jenis Kelamin<a class='red'> *</a></a>
                        <select class="selection-search-clear" name="gender" style="width: 100% !important">
                            @if ($Personil['gender'] == 1)
                                <option value="1" selected>Laki - Laki</option>
                                <option value="2">Perempuan</option>
                            @else
                                <option value="1">Laki - Laki</option>
                                <option value="2" selected>Perempuan</option>
                            @endif
                        </select>
                        @error('gender')
                            <p class='text-danger text-xs pt-1'> {{ $message }} </p>
                        @enderror
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <a class="text-dark">No HP<a class='red'> *</a></a>
                            <input class="form-control input-bb" type="number" name="phone_number" id="phone_number"
                                value="{{ $Personil['phone_number'] }}" />
                            @error('phone_number')
                                <p class='text-danger text-xs pt-1'> {{ $message }} </p>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <a class="text-dark">Alamat<a class='red'> *</a></a>
                            <input class="form-control input-bb" type="text" name="address" id="address"
                                value="{{ $Personil['address'] }}" />
                            @error('address')
                                <p class='text-danger text-xs pt-1'> {{ $message }} </p>
                            @enderror
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
        </form>
    </div>

@stop

@section('footer')

@stop

@section('css')

@stop
