@extends('adminlte::page')

@section('title', 'Tanggapan')

@section('content_header')

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('home') }}">Beranda</a></li>
            <li class="breadcrumb-item"><a href="{{ url('personil-scheduling') }}">Daftar Penjadwalan Personil</a></li>
            <li class="breadcrumb-item active" aria-current="page">Tambah Penjadwalan Personil</li>
        </ol>
    </nav>


    <style>
        .form-check {
            cursor: pointer;
            border: 10px;
            font-size: 20px;
            /* ukuran teks */
        }

        .form-check-input {
            cursor: pointer;
            width: 19px;
            height: 21px;
        }
    </style>


@stop

@section('content')

    <h3 class="page-title">
        Form Tambah Penjadwalan Personil
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
                Form Tambah
            </h5>
            <div class="float-right">
                <button onclick="location.href='{{ url('personil-scheduling') }}'" name="Find"
                    class="btn btn-sm btn-info" title="Back"><i class="fa fa-angle-left"></i> Kembali</button>
            </div>
        </div>

        <form method="" action="/personil-scheduling/tambah/process" enctype="multipart/form-data">
            @csrf
            <div class="card-body">
                <div class="row form-group">
                    <div class="col-md-3">
                        <a class="text-dark">Nama Personil<a class='red'> *</a></a>
                        <select class="selection-search-clear" name="personil_id" id=""
                            style="width: 100% !important">
                            <option value="" selected hidden></option>
                            @foreach ($personil as $pers)
                                <option value="{{ $pers['personil_id'] }}">{{ $pers['name'] }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3">
                        <a class="text-dark">Jadwal Patroli<a class='red'> *</a></a>
                        <select class="selection-search-clear" name="patrol_id" id=""
                            style="width: 100% !important">
                            <option value="" selected hidden></option>
                            @foreach ($patrol as $patrols)
                                <option value="{{ $patrols['patrol_id'] }}">{{ $patrols['patrol_name'] }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <a class="text-dark">Pemilihan Hari<a class='red'> *</a></a><br>
                            <label class="form-check" for="checkbox1">
                                <input class="form-check-input" type="checkbox" id="checkbox1" name="patrol_day[]"
                                    value="Senin" />
                                Senin
                            </label>
                            <label class="form-check" for="checkbox2">
                                <input class="form-check-input" type="checkbox" name="patrol_day[]" id="checkbox2"
                                    value="Selasa" />
                                Selasa
                            </label>
                            <label class="form-check" for="checkbox3">
                                <input class="form-check-input" type="checkbox" name="patrol_day[]" id="checkbox3"
                                    value="Rabu" />
                                Rabu
                            </label>
                            <label class="form-check" for="checkbox4">
                                <input class="form-check-input" type="checkbox" name="patrol_day[]" id="checkbox4"
                                    value="Kamis" />
                                Kamis
                            </label>
                            <label class="form-check" for="checkbox5">
                                <input class="form-check-input" type="checkbox" name="patrol_day[]" id="checkbox5"
                                    value="Jumat" />
                                Jumat
                            </label>
                            <label class="form-check" for="checkbox6">
                                <input class="form-check-input" type="checkbox" name="patrol_day[]" id="checkbox6"
                                    value="Sabtu" />
                                Sabtu
                            </label>
                            <label class="form-check" for="checkbox7">
                                <input class="form-check-input" type="checkbox" name="patrol_day[]" id="checkbox7"
                                    value="Minggu" />
                                Minggu
                            </label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer text-muted">
                <div class="form-actions float-right">
                    <button type="reset" name="Reset" class="btn btn-danger" onClick="window.location.reload();"><i
                            class="fa fa-times"></i> Batal</button>
                    <button type="submit" name="Save" class="btn btn-primary" title="Save"><i
                            class="fa fa-check"></i>
                        Simpan</button>
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
