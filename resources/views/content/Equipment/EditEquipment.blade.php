@extends('adminlte::page')

@section('title', 'Tanggapan')
@section('js')
@stop

@section('content_header')

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('home') }}">Beranda</a></li>
            <li class="breadcrumb-item"><a href="{{ url('equipment') }}">Daftar Perlengkapan</a></li>
            <li class="breadcrumb-item active" aria-current="page">Edit Perlengkapan</li>
        </ol>
    </nav>

@stop

@section('content')

    <h3 class="page-title">
        Form Edit Perlengkapan
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
                <button onclick="location.href='{{ url('equipment') }}'" name="Find" class="btn btn-sm btn-info"
                    title="Back"><i class="fa fa-angle-left"></i> Kembali</button>
            </div>
        </div>

        <form method="" action="{{ url('/equipment/edit/process/' . $Equipment['equipment_id']) }}"
            enctype="multipart/form-data">
            @csrf
            <div class="card-body">
                <div class="row form-group">
                    <div class="col-md-3">
                        <div class="form-group">
                            <a class="text-dark">Nama Perlengkapan<a class='red'> *</a></a>
                            <input class="form-control input-bb" type="text" name="equipment_name" id="equipment_name"
                                value="{{ $Equipment['equipment_name'] }}" />
                            @error('equipment_name')
                                <p class='text-danger text-xs pt-1'> {{ $message }} </p>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <a class="text-dark">Jumlah<a class='red'> *</a></a>
                            <input class="form-control input-bb" type="number" name="equipment_amount"
                                id="equipment_amount" value="{{ $Equipment['equipment_amount'] }}" />
                            @error('equipment_amount')
                                <p class='text-danger text-xs pt-1'> {{ $message }} </p>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <a class="text-dark">Kualitas<a class='red'> *</a></a>
                            <select class="selection-search-clear" name="quality" id="quality">
                                @if ($Equipment['quality'] == 1)
                                    <option value="1" selected>Bagus</option>
                                    <option value="2">Sedang</option>
                                    <option value="3">Rusak</option>
                                @elseif ($Equipment['quality'] == 2)
                                    <option value="2" selected>Sedang</option>
                                    <option value="1">Bagus</option>
                                    <option value="3">Rusak</option>
                                @elseif ($Equipment['quality'] == 3)
                                    <option value="3" selected>Rusak</option>
                                    <option value="1">Bagus</option>
                                    <option value="2">Sedang</option>
                                @endif
                            </select>
                            @error('quality')
                                <p class='text-danger text-xs pt-1'> {{ $message }} </p>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <a class="text-dark">Keterangan<a class='red'> *</a></a>
                            <textarea rows="2" cols="" rows="" class="form-control input-bb" name="equipment_information"
                                id="equipment_information">{{ $Equipment['equipment_information'] }}</textarea>
                            @error('equipment_information')
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
