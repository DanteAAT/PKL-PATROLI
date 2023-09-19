@extends('adminlte::page')

@section('title', 'Tanggapan')

@section('content_header')

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('home') }}">Beranda</a></li>
            <li class="breadcrumb-item active" aria-current="page">Daftar Personil</li>
        </ol>
    </nav>

@stop

@section('content')

    <h3 class="page-title">
        <b>Daftar Personil</b> <small>Mengelola System Personil </small>
    </h3>
    <br />

    @if (session('msg'))
        <div class="alert alert-info" role="alert">
            {{ session('msg') }}
        </div>
    @endif

    <div class="card border border-dark">
        <div class="card-header bg-dark clearfix">
            <h5 class="mb-0 float-left">
                Daftar
            </h5>
            <div class="form-actions float-right">
                <button onclick="location.href='{{ url('personil/tambah') }}'" name="" class="btn btn-sm btn-info"
                    title="Add Data"><i class="fa fa-plus"></i> Tambah Personil Baru</button>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="example" style="width:100%"
                    class="table table-striped table-bordered table-hover table-full-width">
                    <thead>
                        <tr>
                            <th style='text-align:center'>No</th>
                            <th style='text-align:center'>Nama</th>
                            <th style='text-align:center'>Tempat Tanggal Lahir</th>
                            <th style='text-align:center'>Jenis Kelamin</th>
                            <th style='text-align:center'>No Hp</th>
                            <th style='text-align:center'>Alamat</th>
                            <th style='text-align:center'>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $no = 1; @endphp
                        @foreach ($Personil as $Personils)
                            <tr>
                                <td style='text-align:center' width='5%'>{{ $no }}.</td>
                                <td style='text-align:center' width='15%'>{{ $Personils['name'] }}</td>
                                <td style='text-align:center' width='20%'>{{ $Personils['ttl'] }}</td>
                                <td style='text-align:center' width='15%'>@if ($Personils['gender'] == 1)
                                    Laki-Laki
                                    @else
                                    Perempuan
                                    @endif </td>
                                <td style='text-align:center' width='15%'>{{ $Personils['phone_number'] }}
                                <td style='text-align:center' width='15%'>{{ $Personils['address'] }}</td>
                                <td style='text-align:center' width='15%'>
                                    <a type="button" class="btn btn-outline-warning btn-sm"
                                        href="{{ url('/personil/edit/' . $Personils['personil_id']) }}">Edit</a>
                                    <a type="button" class="btn btn-outline-info btn-sm"
                                        href="{{ url('/personil/detail/' . $Personils['personil_id']) }}">Detail</a>
                                    <a type="button" class="btn btn-outline-danger btn-sm"
                                        href="{{ url('/personil/hapus/' . $Personils['personil_id']) }}">Hapus</a>
                                </td>
                            </tr>
                            @php $no++; @endphp
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>



    </div>
@stop

@section('footer')

@stop

@section('css')

@stop

@section('js')

@stop