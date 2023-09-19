@extends('adminlte::page')

@section('title', 'Tanggapan')

@section('content_header')

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('home') }}">Beranda</a></li>
            <li class="breadcrumb-item"><a href="{{ url('patrol-schedule') }}">Daftar Jadwal Patroli</a></li>
            <li class="breadcrumb-item active" aria-current="page">Tambah Jadwal Patroli</li>
        </ol>
    </nav>


@stop

@section('content')

    <h3 class="page-title">
        Form Tambah Jadwal Patroli
    </h3>
    <br />
    @if (session('msg'))
        <div class="alert alert-danger" role="alert">
            {{ session('msg') }}
        </div>
    @endif

    <div class="card border border-dark">
        <div class="card-header border-dark bg-dark">
            <h5 class="mb-0 float-left">
                Nama Jadwal
            </h5>
            <div class="float-right">
                <button onclick="location.href='{{ url('patrol-schedule') }}'" name="Find" class="btn btn-sm btn-info"
                    title="Back"><i class="fa fa-angle-left"></i> Kembali</button>
            </div>
        </div>

        <form method="POST" action="/patrol-schedule/tambah/jadwal" enctype="multipart/form-data">
            @csrf
            <div class="card-body">
                <div class="row form-group">
                    <div class="col-md-3">
                        <div class="form-group">
                            <a class="text-dark">Nama Jadwal Patroli<a class='red'> *</a></a>
                            <input class="form-control input-bb" type="text" name="patrol_name" id="patrol_name"
                                value="{{ $patrol_name }}" />
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer text-muted">
                <div class="form-actions float-right">
                    @if ($patrol_name == '')
                        <button type="reset" name="Reset" class="btn btn-danger" onClick="window.location.reload();"><i
                                class="fa fa-times"></i> Batal</button>
                        <button type="submit" class="btn btn-success"><i class="fa fa-plus"></i> Tambah</button>
                    @endif
                </div>
            </div>
        </form>
    </div>

    @if ($patrol_name != '')
        <div class="card border border-dark">
            <div class="card-header border-dark bg-dark">
                <h5 class="mb-0 float-left">
                    Daftar Jadwal Patroli
                </h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table style="width:100%" class="table table-striped table-bordered table-hover table-full-width">
                        <thead>
                            <tr>
                                <th style='text-align:center' width='5%'>No</th>
                                <th style='text-align:center' width='20%'>Nama Lokasi</th>
                                <th style='text-align:center' width='20%'>Jam Mulai Patroli</th>
                                <th style='text-align:center' width='20%'>Jam Akhir Patroli</th>
                                <th style='text-align:center' width='30%'>Keterangan</th>
                                <th style='text-align:center' width='5%'></th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (count($JadwalPatroli) != 0)
                                @php $no = 1; @endphp
                                @foreach ($JadwalPatroli as $JadwalPatrolis)
                                    <tr>
                                        <td style='text-align:center' width='5%'>{{ $no }}.</td>
                                        <td style='text-align:center' width='20%'>
                                            {{ $JadwalPatrolis['location_name'] }}</td>
                                        <td style='text-align:center' width='20%'>
                                            {{ $JadwalPatrolis['patrol_start_time'] }}</td>
                                        <td style='text-align:center' width='20%'>
                                            {{ $JadwalPatrolis['patrol_end_time'] }}</td>
                                        <td style='text-align:center' width='30%'>
                                            {{ $JadwalPatrolis['patrol_information'] }}</td>
                                        <td style='text-align:center' width='5%'>
                                            <a type="button" class="btn btn-outline-danger btn-sm"
                                                href="/patrol-schedule/hapus-jadwal-patroli/{{ $JadwalPatrolis['index'] }}">
                                                <i class="fa-solid fa-minus"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    @php $no++; @endphp
                                @endforeach
                            @endif
                            <tr>
                                <td width='5%'></td>
                                <td width='20%'>
                                    <select class="selection-search-clear" name="location_id" id="location_id">
                                        <option value="" selected hidden></option>
                                        @foreach ($location as $loc)
                                            <option value="{{ $loc['location_id'] }}">{{ $loc->location_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('location_id')
                                        <p class='text-danger text-xs pt-1'> {{ $message }} </p>
                                    @enderror
                                </td>
                                <td width='20%'>
                                    <input class="form-control input-bb" type="time" name="patrol_start_time"
                                        id="patrol_start_time" />
                                    @error('patrol_start_time')
                                        <p class='text-danger text-xs pt-1'> {{ $message }} </p>
                                    @enderror
                                </td>
                                <td width='20%'>
                                    <input class="form-control input-bb" type="time" name="patrol_end_time"
                                        id="patrol_end_time" />
                                    @error('patrol_end_time')
                                        <p class='text-danger text-xs pt-1'> {{ $message }} </p>
                                    @enderror
                                </td>
                                <td width='30%'>
                                    <textarea rows="1" cols="" rows="" class="form-control input-bb" name="patrol_information"
                                        id="patrol_information"></textarea>
                                    @error('patrol_information')
                                        <p class='text-danger text-xs pt-1'> {{ $message }} </p>
                                    @enderror
                                </td>
                                <td style='text-align:center' width='5%'>
                                    <a type="button" class="btn btn-outline-success btn-sm" id="plusTaskJadwalPatroli">
                                        <i class="fa-solid fa-plus"></i>
                                    </a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="card border border-dark">
            <div class="card-header bg-dark clearfix">
                <h5 class="mb-0 float-left">
                    Daftar Tugas Patroli
                </h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table style="width:100%" class="table table-striped table-bordered table-hover table-full-width">
                        <thead>
                            <tr>
                                <th style='text-align:center' width='5%'>No</th>
                                <th style='text-align:center' width='90%'>Tugas Patroli</th>
                                <th style='text-align:center' width='5%'></th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (count($task) != 0)
                                @php $no = 1; @endphp
                                @foreach ($task as $tasks)
                                    <tr>
                                        <td style='text-align:center' width='5%'>{{ $no }}.</td>
                                        <td style='text-align:center' width='90%'>{{ $tasks['task'] }}</td>
                                        <td style='text-align:center' width='5%'>
                                            <a type="button" class="btn btn-outline-danger btn-sm"
                                                href="/patrol-schedule/hapus-task/{{ $tasks['index'] }}">
                                                <i class="fa-solid fa-minus"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    @php $no++; @endphp
                                @endforeach
                            @endif
                            <tr>
                                <td width='5%'></td>
                                <td style='text-align:center' width='90%'>
                                    <div style="margin: 0 30% 0 30%;">
                                        <input class="form-control input-bb" type="text" name="task"
                                            id="task" value="" />
                                        @error('task')
                                            <p class='text-danger text-xs pt-1'> {{ $message }} </p>
                                        @enderror
                                    </div>
                                </td>
                                <td style='text-align:center' width='5%'>
                                    <a type="button" class="btn btn-outline-success btn-sm" id="plusTask">
                                        <i class="fa-solid fa-plus"></i>
                                    </a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="card-footer text-muted">
                        <div class="form-actions float-right">
                            <a href="/patrol-schedule/tambah/process" name="Save" class="btn btn-primary"
                                title="Save"><i class="fa fa-check"></i>
                                Simpan</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        const plusTaskJadwalPatroli = document.getElementById("plusTaskJadwalPatroli");
        plusTaskJadwalPatroli.addEventListener("click", function() {
            $.ajax({
                url: '{{ route('JadwalPatroliSession') }}',
                type: 'POST',
                data: {
                    'location_id': document.getElementById("location_id").value,
                    'patrol_start_time': document.getElementById("patrol_start_time").value,
                    'patrol_end_time': document.getElementById("patrol_end_time").value,
                    'patrol_information': document.getElementById("patrol_information").value,
                    '_token': '{{ csrf_token() }}'
                },
                success: function(response) {
                    window.location.href = '/patrol-schedule/tambah';
                }
            });

        });

        const plusTask = document.getElementById("plusTask");
        plusTask.addEventListener("click", function() {
            $.ajax({
                url: '{{ route('taskSession') }}',
                type: 'POST',
                data: {
                    'location_id': document.getElementById("location_id").value,
                    'patrol_start_time': document.getElementById("patrol_start_time").value,
                    'patrol_end_time': document.getElementById("patrol_end_time").value,
                    'patrol_information': document.getElementById("patrol_information").value,
                    'task': document.getElementById("task").value,
                    '_token': '{{ csrf_token() }}'
                },
                success: function(response) {
                    window.location.href = '/patrol-schedule/tambah';
                }
            });
        });
    </script>
@stop

@section('footer')

@stop

@section('css')

@stop

@section('js')

@stop
