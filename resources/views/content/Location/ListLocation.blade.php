@extends('adminlte::page')

@section('title', 'Tanggapan')

@section('content_header')

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('home') }}">Beranda</a></li>
            <li class="breadcrumb-item active" aria-current="page">Daftar Location</li>
        </ol>
    </nav>

@stop

@section('content')

    <h3 class="page-title">
        <b>Daftar Location</b> <small>Mengelola Location</small>
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
                <button onclick="location.href='{{ url('location/tambah') }}'" name="Find" class="btn btn-sm btn-info"
                    title="Add Data"><i class="fa fa-plus"></i> Tambah Location Baru</button>
            </div>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table id="example" style="width:100%"
                    class="table table-striped table-bordered table-hover table-full-width">
                    <thead>
                        <tr>
                            <th style='text-align:center'>No</th>
                            <th style='text-align:center'>Nama Lokasi</th>
                            <th style='text-align:center'>Lantai Lokasi</th>
                            <th style='text-align:center'>Latitude</th>
                            <th style='text-align:center'>Longitude</th>
                            <th style='text-align:center'>Keterangan</th>
                            <th style='text-align:center'>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1; ?>
                        @foreach ($location as $loc)
                            <tr>
                                <td style='text-align:center' width='5%'>{{ $no }}.</td>
                                <td style='text-align:center' width='15%'>{{ $loc['location_name'] }}</td>
                                <td style='text-align:center' width='10%'>{{ $loc['location_floor'] }}</td>
                                <td style='text-align:center 'width='10%'>{{ $loc['latitude'] }}</td>
                                <td style='text-align:center 'width='10%'>{{ $loc['longitude'] }}</td>
                                <td style='text-align:center' width='30%'>{{ $loc['location_information'] }}</td>
                                <td style='text-align:center' width='15%'>
                                    <a type="button" class="btn btn-outline-warning btn-sm"
                                        href="{{ url('/location/edit/' . $loc['location_id']) }}">Edit</a>
                                    <a type="button" class="btn btn-outline-info btn-sm"
                                        href="{{ url('/location/detail/' . $loc['location_id']) }}">Detail</a>
                                    <a type="button" class="btn btn-outline-danger btn-sm"
                                        href="{{ url('/location/hapus/' . $loc['location_id']) }}">Hapus</a>
                                    <a type="button" class="btn btn-outline-success btn-sm"
                                        href="{{ url('/location/scan/cetak-pdf/' . $loc['location_id']) }}">Scan QR</a>
                                </td>
                            </tr>
                            <?php $no++; ?>
                        @endforeach
                    </tbody>
                </table>
            </div>
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
