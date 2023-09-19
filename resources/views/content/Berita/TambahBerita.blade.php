@extends('adminlte::page')

@section('title', 'Tanggapan')

@section('content_header')

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ url('home') }}">Beranda</a></li>
        <li class="breadcrumb-item"><a href="{{ url('berita') }}">Daftar Berita</a></li>
        <li class="breadcrumb-item active" aria-current="page">Tambah Berita</li>
    </ol>
  </nav>

  
@stop

@section('content')

<h3 class="page-title">
    Form Tambah Berita  
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
            Form Tambah
        </h5>
        <div class="float-right">
            <button onclick="location.href='{{ url('berita') }}'" name="Find" class="btn btn-sm btn-info" title="Back"><i class="fa fa-angle-left"></i>  Kembali</button>
        </div>
    </div>

    <form method="post" action="/berita/tambah/process" enctype="multipart/form-data">
        @csrf
        <div class="card-body">
            <div class="row form-group">
                <div class="col-md-3">
                    <div class="form-group">
                        <a class="text-dark">Pilih File Gambar atau Video<a class='red'> *</a></a>
                        <input class="form-control" type="file" name="file" accept="image/*, video/*" id="" value=""/>
                        @if ($errors->has('file'))
                        {{$errors->first('file')}}
                        @endif
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <a class="text-dark">Tanggal Mulai Tampil<a class='red'> *</a></a>
                        <input class="form-control" type="date" name="start_date_show" id="" value=""/>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <a class="text-dark">Tanggal Terakhir Tampil<a class='red'> *</a></a>
                        <input class="form-control input-bb" type="date" name="last_date_show" id="" value=""/>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <a class="text-dark">Keterangan</a>           
                        <textarea name="information_berita" id="location_information" cols="20" rows="5"
                        class="form-control input-bb"></textarea>
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



