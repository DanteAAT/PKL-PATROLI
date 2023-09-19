@extends('adminlte::page')

@section('title', 'Tanggapan')

@section('content_header')

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('home') }}">Beranda</a></li>
            <li class="breadcrumb-item active" aria-current="page">Daftar Jadwal Patroli </li>
        </ol>
    </nav>

@stop

@section('content')

    <h3 class="page-title">
        <b>Daftar Jadwal Patroli </b> <small>Mengelola Jadwal Patroli</small>
    </h3>
    <br />
    @if (session('msg'))
        <div class="alert alert-success" role="alert">
            {{ session('msg') }}
        </div>
    @endif
    <div class="card border border-dark">
        <div class="card-header bg-dark clearfix">
            <h5 class="mb-0 float-left">
                Daftar
            </h5>
            <div class="form-actions float-right">
                <button onclick="location.href='{{ url('patrol-schedule/tambah') }}'" name="Find"
                    class="btn btn-sm btn-info" title="Add Data"><i class="fa fa-plus"></i> Tambah Jadwal Patroli
                    Baru</button>
            </div>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table id="example" style="width:100%"
                    class="table table-striped table-bordered table-hover table-full-width">
                    <thead>
                        <tr>
                            <th style='text-align:center'>No</th>
                            <th style='text-align:center'>Nama Jadwal Patroli</th>
                            <th style='text-align:center'>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1; ?>
                        @foreach ($Patrol as $Patrols)
                            <tr>
                                <td style='text-align:center' width='5%'>{{ $no }}.</td>
                                <td style='text-align:center' width='75%'>{{ $Patrols['patrol_name'] }}</td>
                                <td style='text-align:center' width='20%'>
                                    <a type="button" class="btn btn-outline-warning btn-sm"
                                        href="{{ url('/patrol-schedule/edit/' . $Patrols['patrol_id']) }}">Edit</a>
                                    <a type="button" class="btn btn-outline-info btn-sm"
                                        href="{{ url('/patrol-schedule/detail/' . $Patrols['patrol_id']) }}">Detail</a>
                                    <a type="button" class="btn btn-outline-danger btn-sm"
                                        href="{{ url('/patrol-schedule/hapus/' . $Patrols['patrol_id']) }}">Hapus</a>
                                    <a type="button" class="btn btn-outline-info btn-sm"
                                        href="{{ url('/patrol-schedule/mapping/' . $Patrols['patrol_id']) }}">Mapping</a>
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
