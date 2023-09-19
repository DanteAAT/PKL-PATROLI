@extends('adminlte::page')

@section('title', 'Tanggapan')

@section('content_header')
    
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ url('home') }}">Beranda</a></li>
        <li class="breadcrumb-item"><a href="{{ url('personil-scheduling') }}">Daftar Penjadwalan Patroli</a></li>
        <li class="breadcrumb-item active" aria-current="page">Edit Penjadwalan Patroli</li>
    </ol>
  </nav>

@stop

@section('content') 

<h3 class="page-title">
    Form Edit Penjadwalan Patroli
</h3>
<br/>
@if(session('msg'))
<div class="alert alert-info" role="alert">
    {{session('msg')}}
</div>
@endif

<style>
    .form-check {
        cursor: pointer;
        font-size: 15px;
        /* ukuran teks */
    }

    .form-check-input {
        cursor: pointer;
        width: 19px;
        height: 21px;
    }
</style>

@php
    $patrol_days = json_decode($personil_scheduling->patrol_day);
@endphp

    <div class="card border border-dark">
    <div class="card-header border-dark bg-dark">
        <h5 class="mb-0 float-left">
            Form Edit
        </h5>
        <div class="float-right">
            <button onclick="location.href='{{ url('personil-scheduling') }}'" name="Find" class="btn btn-sm btn-info" title="Back"><i class="fa fa-angle-left"></i>Kembali</button>
        </div>
    </div>

    <form action="{{ url('/personil-scheduling/edit/process/' . $personil_scheduling['personil_scheduling_id']) }}" enctype="multipart/form-data">
        @csrf
        <div class="card-body">
            <div class="row form-group">
                <div class="col-md-3">
                    <a class="text-dark">Nama Personil<a class='red'> *</a></a>
                    <select class="selection-search-clear" name="personil_id" id="" style="width: 100% !important">
                        @foreach ($personil as $pers)
                            <option value="{{ $pers['personil_id'] }}" {{ $pers['personil_id'] == $personil_scheduling->personil_id ? 'selected' : '' }}>
                                {{ $pers['name'] }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <a class="text-dark">Jadwal Patroli<a class='red'> *</a></a>
                    <select class="selection-search-clear" name="patrol_id" id="" style="width: 100% !important">
                        @foreach ($patrol as $patrols)
                            <option value="{{ $patrols['patrol_id'] }}" {{ $patrols['patrol_id'] == $personil_scheduling->patrol_id ? 'selected' : '' }}>
                                {{ $patrols['patrol_name'] }}
                            </option>
                        @endforeach
                    </select>
                    
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <a class="text-dark">Pemilihan Hari<a class='red'> *</a></a><br>
                        <label class="form-check" for="checkbox1">
                            <input class="form-check-input" type="checkbox" id="checkbox1" name="patrol_day[]"
                                value="Senin" {{in_array('Senin',$patrol_days)? 'checked':''}}/>
                            Senin
                        </label>
                        <label class="form-check" for="checkbox2">
                            <input class="form-check-input" type="checkbox" name="patrol_day[]" id="checkbox2"
                                value="Selasa" {{in_array('Selasa',$patrol_days)? 'checked':''}}/>
                            Selasa
                        </label>
                        <label class="form-check" for="checkbox3">
                            <input class="form-check-input" type="checkbox" name="patrol_day[]" id="checkbox3"
                                value="Rabu" {{in_array('Rabu',$patrol_days)? 'checked':''}}/>
                            Rabu
                        </label>
                        <label class="form-check" for="checkbox4">
                            <input class="form-check-input" type="checkbox" name="patrol_day[]" id="checkbox4"
                                value="Kamis" {{in_array('Kamis',$patrol_days)? 'checked':''}}/>
                            Kamis
                        </label>
                        <label class="form-check" for="checkbox5">
                            <input class="form-check-input" type="checkbox" name="patrol_day[]" id="checkbox5"
                                value="Jumat" {{in_array('Jumat',$patrol_days)? 'checked':''}}/>
                            Jumat
                        </label>
                        <label class="form-check" for="checkbox6">
                            <input class="form-check-input" type="checkbox" name="patrol_day[]" id="checkbox6"
                                value="Sabtu" {{in_array('Sabtu',$patrol_days)? 'checked':''}}/>
                            Sabtu
                        </label>
                        <label class="form-check" for="checkbox7">
                            <input class="form-check-input" type="checkbox" name="patrol_day[]" id="checkbox7"
                                value="Minggu" {{in_array('Minggu',$patrol_days)? 'checked':''}}/>
                            Minggu
                        </label>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer text-muted">
            <div class="form-actions float-right">
                <button type="reset" name="Reset" class="btn btn-danger" onClick="window.location.reload();"><i class="fa fa-times"></i> Batal</button>
                <button type="submit" name="Save" class="btn btn-primary" title="Save"><i class="fa fa-check"></i> Simpan</button>
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