@extends('adminlte::page')

@section('title', 'Tanggapan')

@section('content_header')

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('home') }}">Beranda</a></li>
            <li class="breadcrumb-item"><a href="{{ url('patrol-schedule') }}">Daftar Jadwal Patroli</a></li>
            <li class="breadcrumb-item active" aria-current="page">Edit Jadwal Patroli</li>
        </ol>
    </nav>

@stop

@section('content')

    <h3 class="page-title">
        Form Edit Jadwal Patroli
    </h3>
    <br />
    <div class="alert alert-danger d-none" role="alert" id="msg">
    </div>
    @if (session('msg'))
        <div class="alert alert-info" role="alert">
            {{ session('msg') }}
        </div>
    @endif
    <div class="card border border-dark">
        <div class="card-header border-dark bg-dark">
            <h5 class="mb-0 float-left">
                Form Edit
            </h5>
            <div class="float-right">
                <button onclick="location.href='{{ url('patrol-schedule') }}'" name="Find" class="btn btn-sm btn-info"
                    title="Back"><i class="fa fa-angle-left"></i>Kembali</button>
            </div>
        </div>
        <form action="{{ url('/patrol-schedule/edit/process/' . $patrol['patrol_id']) }}" enctype="multipart/form-data">
            @csrf
            <div class="card-body">
                <div class="row form-group">
                    <div class="col-md-12">
                        <div class="form-group">
                            <a class="text-dark">Nama Jadwal Patroli</a>
                            <input class="form-control input-bb" type="text" name="patrol_name" id="name"
                                value="{{ $patrol['patrol_name'] }}"  />
                        </div>
                    </div>
                </div>
            </div>
    </div>
    <div class="card border border-dark">
        <div class="card-header bg-dark clearfix">
            <h5 class="mb-0 float-left">
                Jadwal Patroli
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
                            <th style='text-align:center' width='35%'>Keterangan</th>
                            <th style='text-align:center' width='5%'></th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $no = 1; @endphp
                        @foreach ($patrol_schedule as $patrol_schedules)
                            <tr>
                                <td style='text-align:center' width='5%'>
                                    {{ $no }}.</td>
                                <td style='text-align:center' width='20%'>
                                    <select class="form-control" name="location_id{{ $no }}">
                                        @foreach ($location as $loc)
                                            @if ($loc['location_id'] == $patrol_schedules['location_id'])
                                                <option value="{{ $patrol_schedules['location_id'] }}" selected>
                                                    {{ $loc->location_name }}
                                                </option>
                                            @else
                                                <option value="{{ $loc['location_id'] }}">{{ $loc->location_name }}
                                                </option>
                                            @endif
                                        @endforeach
                                    </select>
                                </td>
                                <td style='text-align:center' width='20%'>
                                    <input class="form-control input-bb" type="time"
                                        name="patrol_start_time{{ $no }}"
                                        value="{{ $patrol_schedules['patrol_start_time'] }}" />
                                </td>
                                <td style='text-align:center' width='20%'>
                                    <input class="form-control input-bb" type="time"
                                        name="patrol_end_time{{ $no }}"
                                        value="{{ $patrol_schedules['patrol_end_time'] }}" />
                                </td>
                                <td style='text-align:center' width='30%'>
                                    <textarea rows="1" cols="" rows="" class="form-control input-bb"
                                        name="patrol_information{{ $no }}">{{ $patrol_schedules['patrol_information'] }}</textarea>
                                </td>
                                <td style='text-align:center' width='5%'>
                                    <a type="button" class="btn btn-outline-danger btn-sm"
                                        href="/patrol-schedule/edit/hapus-jadwal-patroli/{{ $patrol['patrol_id'] }}/{{ $patrol_schedules['patrol_schedule_id'] }}">
                                        <i class="fa-solid fa-minus"></i>
                                    </a>
                                </td>
                            </tr>
                            @php $no++; @endphp
                        @endforeach
                        @if (count($jadwalPatroliEdit) != 0)
                            @foreach ($jadwalPatroliEdit as $jadwalPatroliEdits)
                                <tr>
                                    <td style='text-align:center' width='5%'>
                                        {{ $no }}.</td>
                                    <td style='text-align:left' width='20%'>
                                        @foreach ($location as $loc)
                                            @if ($loc['location_id'] == $jadwalPatroliEdits['location_id'])
                                                {{ $loc->location_name }}
                                            @endif
                                        @endforeach
                                        </select>
                                    </td>
                                    <td style='text-align:left' width='20%'>
                                        {{ $jadwalPatroliEdits['patrol_start_time'] }}
                                    </td>
                                    <td style='text-align:left' width='20%'>
                                        {{ $jadwalPatroliEdits['patrol_end_time'] }}
                                    </td>
                                    <td style='text-align:left' width='30%'>
                                        {{ $jadwalPatroliEdits['patrol_information'] }}
                                    </td>
                                    <td style='text-align:center' width='5%'>
                                        <a type="button" class="btn btn-outline-danger btn-sm"
                                            href="/patrol-schedule/edit/hapus-jadwal-patroli-session/{{ $patrol['patrol_id'] }}/{{ $jadwalPatroliEdits['index'] }}">
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
                            </td>
                            <td width='20%'>
                                <input class="form-control input-bb" type="time" name="patrol_start_time"
                                    id="patrol_start_time" />
                            </td>
                            <td width='20%'>
                                <input class="form-control input-bb" type="time" name="patrol_end_time"
                                    id="patrol_end_time" />
                            </td>
                            <td width='30%'>
                                <textarea rows="1" cols="" rows="" class="form-control input-bb" name="patrol_information"
                                    id="patrol_information"></textarea>
                            </td>
                            <td style='text-align:center' width='5%'>
                                <a type="button" class="btn btn-outline-success btn-sm" id="plusJadwalPatroli">
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
                Tugas Patroli
            </h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table style="width:100%" class="table table-striped table-bordered table-hover table-full-width">
                    <thead>
                        <tr>
                            <th style='text-align:center' width='5%'>No</th>
                            <th style='text-align:center' width='95%'>Tugas Patroli</th>
                            <th style='text-align:center' width='5%'></th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $no = 1; @endphp
                        @foreach ($task as $tasks)
                            <tr>
                                <td style='text-align:center' width='5%'>{{ $no }}.</td>
                                <td style='text-align:center' width='95%'>
                                    <input class="form-control input-bb" type="text" name="task{{ $no }}"
                                        value="{{ $tasks['task'] }}" />
                                </td>
                                <td style='text-align:center' width='5%'>
                                    <a type="button" class="btn btn-outline-danger btn-sm"
                                        href="/patrol-schedule/edit/hapus-task/{{ $patrol['patrol_id'] }}/{{ $tasks['patrol_task_id'] }}">
                                        <i class="fa-solid fa-minus"></i>
                                    </a>
                                </td>
                            </tr>
                            @php $no++; @endphp
                        @endforeach
                        @if (count($taskEdit) != 0)
                            @foreach ($taskEdit as $taskEdits)
                                <tr>
                                    <td style='text-align:center' width='5%'>{{ $no }}.
                                    </td>
                                    <td style='text-align:left' width='90%'>{{ $taskEdits['task'] }}
                                    </td>
                                    <td style='text-align:center' width='5%'>
                                        <a type="button" class="btn btn-outline-danger btn-sm"
                                            href="/patrol-schedule/edit/hapus-task-session/{{ $patrol['patrol_id'] }}/{{ $taskEdits['index'] }}">
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
                                    <input class="form-control input-bb" type="text" name="task" id="task"
                                        value="" />
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
            </div>
        </div>
    </div>
    <div class="card-footer text-muted">
        <div class="form-actions float-right">
            <button type="reset" name="Reset" class="btn btn-danger" onClick="window.location.reload();"><i
                    class="fa fa-times"></i> Batal</button>
            <button type="submit" name="Save" class="btn btn-primary" title="Save"><i class="fa fa-check"></i>
                Simpan</button>
        </div>
    </div>
    </form>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        const plusTask = document.getElementById("plusTask");
        plusTask.addEventListener("click", function() {
            $.ajax({
                url: '{{ route('editTaskSession') }}',
                type: 'POST',
                data: {
                    'task': document.getElementById("task").value,
                    '_token': '{{ csrf_token() }}'
                },
                success: function(response) {
                    window.location.href =
                        '/patrol-schedule/edit/{{ $patrol['patrol_id'] }}';
                },
                error: function() {
                    const msg = document.getElementById("msg");
                    msg.classList.remove('d-none');
                    msg.textContent = 'Task tambahan tidak boleh kosong!';
                }
            });

        });

        const plusJadwalPatroli = document.getElementById("plusJadwalPatroli");
        plusJadwalPatroli.addEventListener("click", function() {
            $.ajax({
                url: '{{ route('editJadwalPatroliSession') }}',
                type: 'POST',
                data: {
                    'location_id': document.getElementById("location_id").value,
                    'patrol_start_time': document.getElementById("patrol_start_time").value,
                    'patrol_end_time': document.getElementById("patrol_end_time").value,
                    'patrol_information': document.getElementById("patrol_information").value,
                    '_token': '{{ csrf_token() }}'
                },
                success: function(response) {
                    window.location.href =
                        '/patrol-schedule/edit/{{ $patrol['patrol_id'] }}';
                },
                error: function() {
                    const msg = document.getElementById("msg");
                    msg.classList.remove('d-none');
                    msg.textContent = 'Jadwal Patroli tambahan tidak boleh kosong!';
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
