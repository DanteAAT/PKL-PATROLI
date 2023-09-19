@extends('adminlte::page')

@section('title', 'Tanggapan')

@section('content_header')

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('home') }}">Beranda</a></li>
            <li class="breadcrumb-item active" aria-current="page">Daftar Penilaian Kesehatan</li>
        </ol>
    </nav>

@stop

@section('content')

    <h3 class="page-title">
        <b>Daftar Penilaian Kesehatan</b> <small>Mengelola Penilaian Kesehatan</small>
    </h3>
    <br />
    @if (session('msg'))
        <div class="alert alert-info" role="alert">
            {{ session('msg') }}
        </div>
    @endif
    @if (session('danger'))
        <div class="alert alert-danger" role="danger">
            {{ session('danger') }}
        </div>
    @endif
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
    <div class="card border border-dark">
        <div class="card-header bg-dark clearfix">
            <h5 class="mb-0 float-left">
                Daftar
            </h5>
            <div class="form-actions float-right">
                <button onclick="location.href='{{ url('penilaian-kesehatan/tambah') }}'" name="Find"
                    class="btn btn-sm btn-info" title="Add Data"><i class="fa fa-plus"></i> Tambah Penilaian Kesehatan
                    Baru</button>
                <button onclick="location.href='{{ url('/penilaian-kesehatan/cetak-pdf') }}'" class="btn btn-sm btn-info"
                    title="Print PDF" style="margin-left: 5px"><i class="fa fa-print"></i> Print PDF
                </button>
                <button onclick="location.href='{{ url('/penilaian-kesehatan/cetak-excel') }}'" class="btn btn-sm btn-info"
                    title="Print Excel" style="margin-left: 5px"><i class="fa fa-print"></i> Print Excel
                </button>

            </div>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table id="example" style="width:100%"
                    class="table table-striped table-bordered table-hover table-full-width">
                    <thead>
                        <tr>
                            <th style='text-align:center'>No</th>
                            <th style='text-align:center'>Nama Personil</th>
                            <th style='text-align:center'>Jadwal Penilaian Kesehatan</th>
                            <th style='text-align:center'>Kategori Penilaian Kesehatan</th>
                            <th style='text-align:center'>Nilai</th>
                            <th style='text-align:center'>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1; ?>
                        @foreach ($penilaian_kesehatan as $pk)
                            <tr>
                                <td style='text-align:center' width='5%'>{{ $no }}.</td>
                                <td style='text-align:center' width='10%'>
                                    {{ $pk->callPersonilPenilaianKesehatan['name'] }}</td>
                                <td style='text-align:center' width='15%'>
                                    {{ $bulan[$pk->callJadwalPenilaianKesehatan['period_month']] }} {{ $pk->callJadwalPenilaianKesehatan['period_year'] }}</td>
                                <td style='text-align:center' width='15%'>
                                    {{ $pk->callKategoriPenilaianKesehatan['penilaian_kesehatan_category_name'] }}</td>
                                <td style='text-align:center' width='10%'>{{ $pk['value'] }}</td>
                                <td style='text-align:center' width='15%'>
                                    <a type="button" class="btn btn-outline-warning btn-sm"
                                        href="{{ url('/penilaian-kesehatan/edit/' . $pk['penilaian_kesehatan_id']) }}">Edit</a>
                                    <a type="button" class="btn btn-outline-danger btn-sm"
                                        href="{{ url('/penilaian-kesehatan/hapus/' . $pk['penilaian_kesehatan_id']) }}">Hapus</a>
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
