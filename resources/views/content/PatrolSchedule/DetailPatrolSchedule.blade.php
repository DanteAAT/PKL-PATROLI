@extends('adminlte::page')

@section('title', 'Tanggapan')

@section('content_header')

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('home') }}">Beranda</a></li>
            <li class="breadcrumb-item"><a href="{{ url('patrol-schedule') }}">Daftar Jadwal Patroli</a></li>
            <li class="breadcrumb-item active" aria-current="page">Detail Jadwal Patroli</li>
        </ol>
    </nav>

@stop

@section('content')

    <h3 class="page-title">
        Form Detail Jadwal Patroli
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
                Form Detail
            </h5>
            <div class="float-right">
                <button onclick="location.href='{{ url('patrol-schedule') }}'" name="Find" class="btn btn-sm btn-info"
                    title="Back"><i class="fa fa-angle-left"></i> Kembali</button>
            </div>
        </div>

        <form method="post" action="/system-user/process-edit-system-user" enctype="multipart/form-data">
            @csrf
            <div class="card-body">
                <div class="row form-group">
                    <div class="col-md-12">
                        <div class="form-group">
                            <a class="text-dark">Nama Jadwal Patroli</a>
                            <input class="form-control input-bb" type="text" name="name" id="name"
                                value="{{ $patrol['patrol_name'] }}" readonly />
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <div class="card border border-dark">
                            <div class="card-header bg-dark clearfix">
                                <h5 class="mb-0 float-left">
                                    Jadwal Patroli
                                </h5>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table style="width:100%"
                                        class="table table-striped table-bordered table-hover table-full-width">
                                        <thead>
                                            <tr>
                                                <th style='text-align:center' width='5%'>No</th>
                                                <th style='text-align:center' width='20%'>Nama Lokasi</th>
                                                <th style='text-align:center' width='20%'>Jam Mulai Patroli</th>
                                                <th style='text-align:center' width='20%'>Jam Akhir Patroli</th>
                                                <th style='text-align:center' width='35%'>Keterangan</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php $no = 1; @endphp
                                            @foreach ($patrol_schedule as $patrol_schedules)
                                                <tr>
                                                    <td style='text-align:center' width='5%'>
                                                        {{ $no }}.</td>
                                                    <td style='text-align:center' width='20%'>
                                                        {{ $patrol_schedules->callLocation['location_name'] }}</td>
                                                    <td style='text-align:center' width='20%'>
                                                        {{ $patrol_schedules['patrol_start_time'] }}</td>
                                                    <td style='text-align:center' width='20%'>
                                                        {{ $patrol_schedules['patrol_end_time'] }}</td>
                                                    <td style='text-align:center' width='35%'>
                                                        {{ $patrol_schedules['patrol_information'] }}</td>
                                                </tr>
                                                @php $no++; @endphp
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="form-group">
                        <div class="card border border-dark">
                            <div class="card-header bg-dark clearfix">
                                <h5 class="mb-0 float-left">
                                    Tugas Patroli
                                </h5>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered table-hover table-full-width">
                                        <thead>
                                            <tr>
                                                <th style='text-align:center'>No</th>
                                                <th style='text-align:center'>Tugas</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $no = 1; ?>
                                            @foreach ($patrol_task as $patrol_tasks)
                                                <tr>
                                                    <td style='text-align:center' width='5%'>{{ $no }}.
                                                    </td>
                                                    <td style='text-align:center' width='95%'>
                                                        {{ $patrol_tasks['task'] }}
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
                </div>
            </div>
        </form>
    </div>

@stop

@section('footer')

@stop

@section('css')

@stop

@section('js')

@stop
