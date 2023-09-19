@extends('adminlte::page')

@section('title', 'Tanggapan')

@section('content_header')

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('home') }}">Beranda</a></li>
            <li class="breadcrumb-item"><a href="{{ url('return-equipment') }}">Pengembalian Perlengkapan</a></li>
            <li class="breadcrumb-item active" aria-current="page">Daftar Pilih Ambil Perlengkapan</li>
        </ol>
    </nav>

@stop

@section('content')

<script src="https://kit.fontawesome.com/ccc7ad4dc8.js" crossorigin="anonymous"></script>
    <h3 class="page-title">
        <b>Daftar Pilih Ambil Perlengkapan</b> <small>Mengelola Pilih Ambil Perlengkapan </small>
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
                {{-- <button onclick="location.href='{{ url('take-equipment/tambah') }}'" name=""
                    class="btn btn-sm btn-info" title="Add Data"><i class="fa fa-plus"></i> Tambah Ambil Perlengkapan
                    Baru</button> --}}
                    
                    <button onclick="location.href='{{ url('return-equipment') }}'" name="Find" class="btn btn-sm btn-info"
                        title="Back"><i class="fa fa-angle-left"></i> Kembali</button>
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
                            <th style='text-align:center'>Tanggal dan Jam Mengambil</th>
                            <th style='text-align:center'>Status Dikembalikan</th>
                            <th style='text-align:center'>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $no = 1; @endphp

                        @foreach ($take_equipment as $take_equipments)
                        @if ($take_equipments['status'] <= 1 )
                        <tr>
                            <td style='text-align:center' width='5%'>{{ $no }}.</td>
                            <td style='text-align:center' width='15%'>{{ $take_equipments->callPersonil2['name'] }}</td>
                            <td style='text-align:center' width='20%'>{{ $take_equipments->callPatrol['patrol_name'] }}</td>  
                            <td style='text-align:center' width='20%'>{{ $take_equipments['date_and_time_pick_up'] }}</td>
                            <td style='text-align:center' width='20%'>
                                @if ($take_equipments['status'] == 0)
                                Belum Dikembalikan
                                @elseif ($take_equipments['status'] == 1)
                                Dikembalikan Sebagian
                                @elseif ($take_equipments['status'] == 2)
                                Sudah Dikembalikan
                                @endif
                            </td>
                            <td style='text-align:center' width='10%'>
                                <a type="button" class="btn btn-outline-success btn-sm"
                                    href="{{ url('/return-equipment/choose-take-equipment/pilih/' . $take_equipments['take_equipment_id']) }}">Pilih</a>
                            </td>
                        </tr>
                        @php $no++; @endphp
                        @endif 
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
