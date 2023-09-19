@extends('adminlte::page')

@section('title', 'Tanggapan')

@section('content_header')

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('home') }}">Beranda</a></li>
            <li class="breadcrumb-item active" aria-current="page">Daftar Penjadwalan Personil</li>
        </ol>
    </nav>

@stop

@section('content')

<script src="https://kit.fontawesome.com/ccc7ad4dc8.js" crossorigin="anonymous"></script>
    <h3 class="page-title">
        <b>Daftar Penjadwalan Personil</b> <small>Mengelola Penjadwalan Personil </small>
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
                <button onclick="location.href='{{ url('personil-scheduling/tambah') }}'" name=""
                    class="btn btn-sm btn-info" title="Add Data"><i class="fa fa-plus"></i> Tambah Penjadwalan Personil
                    Baru</button>
                <button onclick="location.href='{{ url('/personil-scheduling/cetak-pdf') }}'" class="btn btn-sm btn-info" title="Add Data"
                    style="margin-left: 5px"><i class="fa fa-print"></i> Print PDF
                </button>
                <button onclick="location.href='{{ url('/personil-scheduling/cetak-excel') }}'" class="btn btn-sm btn-info"
                    title="Add Data" style="margin-left: 5px"><i class="fa fa-print"></i> Print Excel
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
                            <th style='text-align:center'>Jadwal Patroli</th>
                            <th style='text-align:center'>Hari Patroli</th>
                            <th style='text-align:center'>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $no = 1; @endphp

                        @foreach ($personil_scheduling as $ps)
                        @php $patrol_day = json_decode($ps->patrol_day) @endphp
                            <tr>
                                <td style='text-align:center' width='5%'>{{ $no }}.</td>
                                <td style='text-align:center' width='15%'>{{ $ps->callPersonil['name'] }}</td>
                                <td style='text-align:center' width='20%'>
                                    {{ $ps->callPatrol['patrol_name'] }}</td>
                                    <td style='text-align:center' width='15%'>
                                        @foreach ($patrol_day as $index => $patrol_days)
                                            {{ $patrol_days }}@if ($index < count($patrol_day) - 1),
                                            @endif
                                        @endforeach
                                    </td>
                                    
                                <td style='text-align:center' width='15%'>
                                    <a type="button" class="btn btn-outline-warning btn-sm"
                                        href="{{ url('/personil-scheduling/edit/' . $ps['personil_scheduling_id']) }}">Edit</a>
                                    <a type="button" class="btn btn-outline-info btn-sm"
                                        href="{{ url('/personil-scheduling/detail/' . $ps['personil_scheduling_id']) }}">Detail</a>
                                    <a type="button" class="btn btn-outline-danger btn-sm"
                                        href="{{ url('/personil-scheduling/hapus/' . $ps['personil_scheduling_id']) }}">Hapus</a>
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
