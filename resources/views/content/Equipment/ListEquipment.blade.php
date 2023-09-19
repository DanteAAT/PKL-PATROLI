@extends('adminlte::page')

@section('title', 'Tanggapan')

@section('content_header')

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('home') }}">Beranda</a></li>
            <li class="breadcrumb-item active" aria-current="page">Daftar Perlengkapan</li>
        </ol>
    </nav>

@stop

@section('content')

    <h3 class="page-title">
        <b>Daftar Perlengkapan</b> <small>Mengelola System Perlengkapan </small>
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
                <button onclick="location.href='{{ url('equipment/tambah') }}'" name="" class="btn btn-sm btn-info"
                    title="Add Data"><i class="fa fa-plus"></i> Tambah Perlengkapan Baru</button>
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
                            <th style='text-align:center'>Jumlah</th>
                            <th style='text-align:center'>Kualitas</th>
                            <th style='text-align:center'>Keterangan</th>
                            <th style='text-align:center'>Nama Terakhir Ambil</th>
                            <th style='text-align:center'>Tanggal Terakhir Ambil</th>
                            <th style='text-align:center'>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $no = 1; @endphp
                        @foreach ($Equipment as $Equipments)
                            <tr>
                                <td style='text-align:center' width='5%'>{{ $no }}.</td>
                                <td style='text-align:center' width='15%'>{{ $Equipments['equipment_name'] }}</td>
                                <td style='text-align:center' width='10%'>{{ $Equipments['equipment_amount'] }}</td>
                                <td style='text-align:center' width='10%'>
                                    @if ($Equipments['quality'] == 1)
                                        Bagus
                                    @elseif ($Equipments['quality'] == 2)
                                        Sedang
                                    @elseif ($Equipments['quality'] == 3)
                                        Rusak
                                    @endif
                                </td>
                                <td style='text-align:center' width='15%'>{{ $Equipments['equipment_information'] }}
                                <td style='text-align:center' width='15%'>
                                    @if ($Equipments['last_take_name'] == null)
                                        -
                                    @else
                                        {{ $personil ? $personil->name : '-' }}
                                    @endif
                                </td>
                                <td style='text-align:center' width='15%'>
                                    @if ($Equipments['last_take_date'] == null)
                                        -
                                    @else
                                        {{ $Equipments['last_take_date'] }}
                                    @endif
                                </td>
                                <td style='text-align:center' width='15%'>
                                    <a type="button" class="btn btn-outline-warning btn-sm"
                                        href="{{ url('/equipment/edit/' . $Equipments['equipment_id']) }}">Edit</a>
                                    <a type="button" class="btn btn-outline-info btn-sm"
                                        href="{{ url('/equipment/detail/' . $Equipments['equipment_id']) }}">Detail</a>
                                    <a type="button" class="btn btn-outline-danger btn-sm"
                                        href="{{ url('/equipment/hapus/' . $Equipments['equipment_id']) }}">Hapus</a>
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
