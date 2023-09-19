@extends('adminlte::page')

@section('title', 'Tanggapan')

@section('content_header')

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('home') }}">Beranda</a></li>
            <li class="breadcrumb-item active" aria-current="page">Daftar Jadwal Penilaian Kesehatan</li>
        </ol>
    </nav>

@stop

@section('content')

    <h3 class="page-title">
        <b>Daftar Jadwal Penilaian Kesehatan</b> <small>Mengelola Jadwal Penilaian Kesehatan</small>
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
                <button onclick="location.href='{{ url('jadwal-penilaian-kesehatan/tambah') }}'" name="Find" class="btn btn-sm btn-info"
                    title="Add Data"><i class="fa fa-plus"></i> Tambah Jadwal Penilaian Kesehatan Baru</button>
            </div>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table id="example" style="width:100%"
                    class="table table-striped table-bordered table-hover table-full-width">
                    <thead>
                        <tr>
                            <th style='text-align:center'>No</th>
                            <th style='text-align:center'>Bulan Periode</th>
                            <th style='text-align:center'>Tahun Periode</th>
                            <th style='text-align:center'>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1; ?>
                        @foreach ($JadwalPenilaianKesehatan as $JadwalPenilaianKesehatans)
                            <tr>
                                <td style='text-align:center' width='5%'>{{ $no }}.</td>
                                <td style='text-align:center' width='30%'>{{ $JadwalPenilaianKesehatans['period_month'] }}</td>
                                <td style='text-align:center' width='30%'>{{ $JadwalPenilaianKesehatans['period_year'] }}</td>
                                <td style='text-align:center' width='35%'>
                                    <a type="button" class="btn btn-outline-warning btn-sm"
                                        href="{{ url('/jadwal-penilaian-kesehatan/edit/' . $JadwalPenilaianKesehatans['penilaian_kesehatan_schedule_id']) }}">Edit</a>
                                    <a type="button" class="btn btn-outline-info btn-sm"
                                        href="{{ url('/jadwal-penilaian-kesehatan/detail/' . $JadwalPenilaianKesehatans['penilaian_kesehatan_schedule_id']) }}">Detail</a>
                                    <a type="button" class="btn btn-outline-danger btn-sm"
                                        href="{{ url('/jadwal-penilaian-kesehatan/hapus/' . $JadwalPenilaianKesehatans['penilaian_kesehatan_schedule_id']) }}">Hapus</a>
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
