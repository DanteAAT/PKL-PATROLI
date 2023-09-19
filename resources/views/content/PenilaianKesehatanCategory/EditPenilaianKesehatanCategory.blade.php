@extends('adminlte::page')

@section('title', 'Tanggapan')

@section('content_header')
    
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ url('home') }}">Beranda</a></li>
        <li class="breadcrumb-item"><a href="{{ url('kategori-penilaian-kesehatan') }}">Daftar Kategori Penilaian Kesehatan</a></li>
        <li class="breadcrumb-item active" aria-current="page">Edit Kategori Penilaian Kesehatan</li>
    </ol>
  </nav>

@stop

@section('content') 

<h3 class="page-title">
    Form Edit Kategori Penilaian Kesehatan
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
            <button onclick="location.href='{{ url('kategori-penilaian-kesehatan') }}'" name="Find" class="btn btn-sm btn-info" title="Back"><i class="fa fa-angle-left"></i>Kembali</button>
        </div>
    </div>

    <form action="{{ url('/kategori-penilaian-kesehatan/edit/process/' . $penilaian_kesehatan_category['penilaian_kesehatan_category_id']) }}" enctype="multipart/form-data">
        @csrf
        <div class="card-body">
            <div class="row form-group">
                <div class="col-md-4">
                    <div class="form-group">
                        <a class="text-dark">Kode<a class='red'> *</a></a>
                        <input class="form-control input-bb" type="text" name="penilaian_kesehatan_category_code" id="name" value="{{ $penilaian_kesehatan_category['penilaian_kesehatan_category_code'] }}"/>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <a class="text-dark">Nama Kategori Penilaian Kesehatan<a class='red'> *</a></a>
                        <input class="form-control input-bb" type="text" name="penilaian_kesehatan_category_name" id="name" value="{{ $penilaian_kesehatan_category['penilaian_kesehatan_category_name'] }}"/>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <a class="text-dark">Keterangan<a class='red'> *</a></a>
                        <textarea name="penilaian_kesehatan_category_information" id="location_information" cols="20" rows="5" class="form-control input-bb">{{ $penilaian_kesehatan_category['penilaian_kesehatan_category_information'] }}</textarea>
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