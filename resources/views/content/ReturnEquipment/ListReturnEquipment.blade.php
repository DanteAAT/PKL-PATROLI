@extends('adminlte::page')

@section('title', 'Tanggapan')

@section('content_header')

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('home') }}">Beranda</a></li>
            <li class="breadcrumb-item active" aria-current="page">Daftar Pengembalian Perlengkapan</li>
        </ol>
    </nav>

@stop

@section('content')

    <script src="https://kit.fontawesome.com/ccc7ad4dc8.js" crossorigin="anonymous"></script>
    <h3 class="page-title">
        <b>Daftar Pengembalian Perlengkapan</b> <small>Mengelola Pengembalian Perlengkapan </small>
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
                <button onclick="location.href='{{ url('return-equipment/choose-take-equipment') }}'" name=""
                    class="btn btn-sm btn-info" title="List Ambil Perlengkapan"> List Ambil Perlengkapan <i
                        class="fa fa-angle-right"></i></button>
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
                            <th style='text-align:center'>Nomor Pengembalian</th>
                            <th style='text-align:center'>Nomor Pengambilan</th>
                            <th style='text-align:center'>Pengembalian</th>
                            <th style='text-align:center'>List Barang</th>
                            <th style='text-align:center'>Keterangan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $no = 1; @endphp

                        @foreach ($return_equipment as $return_equipments)
                            @php $checklist = json_decode($return_equipments->return_equipment_checklist);@endphp

                            @php $listBarang = explode(',', str_replace(['[', ']', '"'], '', $return_equipments->return_equipment_checklist));@endphp
                            <tr>
                                <td style='text-align:center' width='5%'>{{ $no }}.</td>
                                <td style='text-align:center' width='13%'>{{ $return_equipments->callPersonil3['name'] }}</td>
                                <td style='text-align:center' width='13%'>{{ $return_equipments['no_return_equipment'] }}</td>
                                <td style='text-align:center' width='13%'>{{ $return_equipments->callNoTakeEquipment['no_take_equipment'] }}</td>
                                <td style='text-align:center' width='15%'>{{ $return_equipments['return_date'] }}</td>
                                {{-- <td style='text-align:center' width='20%'>{{ $return_equipments['return_equipment_checklist'] }}</td> --}}
                                <td style='text-align:center' width='20%'>
                                    @foreach ($listBarang as $index => $equipmentId)
                                        @php
                                            $equipmentData = \App\Models\EquipmentData::find($equipmentId);
                                        @endphp
                                        @if ($equipmentData)
                                            @php
                                                $equipment = \App\Models\Equipment::find($equipmentData->equipment_id);
                                                $count = count($listBarang);
                                            @endphp
                                            @if ($equipment)
                                                {{ $equipment->equipment_name }}@if ($index < $count - 1)
                                                    ,
                                                @endif
                                            @endif
                                        @endif
                                    @endforeach

                                </td>
                                <td style='text-align:center' width='20%'>
                                    {{ $return_equipments['information_per_item'] }}</td>
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
