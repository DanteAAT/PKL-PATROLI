@extends('adminlte::page')

@section('title', 'Tanggapan')

@section('content_header')
    
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ url('home') }}">Beranda</a></li>
        <li class="breadcrumb-item"><a href="{{ url('penilaian-kesehatan') }}">Daftar Penilaian Kesehatan</a></li>
        <li class="breadcrumb-item active" aria-current="page">Edit Penilaian Kesehatan</li>
    </ol>
  </nav>

@stop

@section('content') 

<h3 class="page-title">
    Form Edit Penilaian Kesehatan
</h3>
<br/>
@if(session('msg'))
<div class="alert alert-info" role="alert">
    {{session('msg')}}
</div>
@endif
    <div class="card border border-dark">
    <div class="card-header border-dark bg-dark">
        <h5 class="mb-0 float-left">
            Form Edit
        </h5>
        <div class="float-right">
            <button onclick="location.href='{{ url('penilaian-kesehatan') }}'" name="Find" class="btn btn-sm btn-info" title="Back"><i class="fa fa-angle-left"></i>Kembali</button>
        </div>
    </div>

    <form action="{{ url('/penilaian-kesehatan/edit/process/' . $penilaian_kesehatan['penilaian_kesehatan_id']) }}" enctype="multipart/form-data">
        @csrf
        @php
        $bulan = [
            '01' => 'Januari',
            '02' => 'Februari',
            '03' => 'Maret',
            '04' => 'April',
            '05' => 'Mei',
            '06' => 'Juni',
            '07' => 'Juli',
            '08' => 'Agustus',
            '09' => 'September',
            '10' => 'Oktober',
            '11' => 'November',
            '12' => 'Desember',
        ];
    @endphp
        <div class="card-body">
            <div class="row form-group">
                <div class="col-md-3">
                    <a class="text-dark">Nama Personil<a class='red'> *</a></a>
                    <select class="selection-search-clear" name="personil_id" id="" style="width: 100% !important">
                        @foreach ($personil as $pers)
                            <option value="{{ $pers['personil_id'] }}" {{ $pers['personil_id'] == $penilaian_kesehatan->personil_id ? 'selected' : '' }}>
                                {{ $pers['name'] }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <a class="text-dark">Jadwal Patroli<a class='red'> *</a></a>
                    <select class="selection-search-clear" name="penilaian_kesehatan_schedule_id" id="" style="width: 100% !important">
                        @foreach ($penilaian_kesehatan_schedule as $pks)
                            <option value="{{ $pks['penilaian_kesehatan_schedule_id'] }}" {{ $pks['penilaian_kesehatan_schedule_id'] == $penilaian_kesehatan->penilaian_kesehatan_schedule_id ? 'selected' : '' }}>
                                {{ $bulan[$pks['period_month']]  }} {{ $pks['period_year'] }}   
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <a class="text-dark">Kategori Penilaian Kesehatan<a class='red'> *</a></a>
                        <select class="selection-search-clear" name="penilaian_kesehatan_category_id" id=""
                                style="width: 100% !important">
                                <option value="" selected hidden></option>
                                @foreach ($penilaian_kesehatan_category as $pkc)
                                    <option value="{{ $pkc['penilaian_kesehatan_category_id'] }}" {{ $pks['penilaian_kesehatan_schedule_id'] == $penilaian_kesehatan->penilaian_kesehatan_category_id ? 'selected' : '' }}>{{ $pkc['penilaian_kesehatan_category_name'] }}</option>
                                @endforeach
                            </select>
                    </div>
                </div>   
                <div class="col-md-3">
                    <div class="form-group">
                        <a class="text-dark">Nilai<a class='red'> *</a></a><br>
                        <input class="form-control input-bb" type="text" name="value" id="name" value="{{ $penilaian_kesehatan['value'] }}"/>
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