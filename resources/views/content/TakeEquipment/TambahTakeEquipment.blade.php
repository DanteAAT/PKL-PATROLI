@extends('adminlte::page')

@section('title', 'Tanggapan')

@section('content_header')

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('home') }}">Beranda</a></li>
            <li class="breadcrumb-item"><a href="{{ url('take-equipment') }}">Daftar Ambil Perlengkapan</a></li>
            <li class="breadcrumb-item active" aria-current="page">Tambah Ambil Perlengkapan</li>
        </ol>
    </nav>

@stop

@section('content')

    <h3 class="page-title">
        Form Tambah Ambil Perlengkapan
    </h3>
    <br />

    @if (session('msg'))
        <div class="alert alert-info" role="alert">
            {{ session('msg') }}
        </div>
    @endif

    @if ($take_equipment_input == [])
        <div class="card border border-dark">
            <div class="card-header border-dark bg-dark">
                <h5 class="mb-0 float-left">
                    Form Tambah
                </h5>
                <div class="float-right">
                    <button onclick="location.href='{{ url('take-equipment') }}'" name="Find" class="btn btn-sm btn-info"
                        title="Back"><i class="fa fa-angle-left"></i> Kembali</button>
                </div>
            </div>


            <form method="POST" action="/take-equipment/tambah/input" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <div class="row form-group">
                        <div class="col-md-3">
                            <div class="form-group">
                                <a class="text-dark">Nama Personil<a class='red'> *</a></a>
                                <select class="selection-search-clear" name="personil_id" id="personil_id"
                                    style="width: 100% !important">
                                    <option value="" selected hidden></option>
                                    @foreach ($personil as $pers)
                                        <option value="{{ $pers['personil_id'] }}">{{ $pers->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <a class="text-dark">Nama Jadwal Patrol<a class='red'> *</a></a>
                                <select class="selection-search-clear" name="patrol_id" id="patrol_id"
                                    style="width: 100% !important">
                                    <option value="" selected hidden></option>
                                    @foreach ($patrol as $patrols)
                                        <option value="{{ $patrols['patrol_id'] }}">{{ $patrols->patrol_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <a class="text-dark">Tanggal dan Jam Ammbil<a class='red'> *</a></a>
                                <input class="form-control input-bb" type="text" name="date_and_time_pick_up"
                                    id="date_and_time_pick_up" value="{{date('Y-m-d H:i:s')}}" readonly />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer text-muted">
                    <div class="form-actions float-right">
                        @if ($take_equipment_input == [])
                            <button type="reset" name="Reset" class="btn btn-danger"
                                onClick="window.location.reload();"><i class="fa fa-times"></i> Batal</button>
                            <button type="submit" class="btn btn-success"><i class="fa fa-plus"></i> Tambah</button>
                        @endif
                    </div>
                </div>
            </form>
        </div>
    @endif


    @if ($take_equipment_input != [])
        <div class="card border border-dark">
            <div class="card-header bg-dark clearfix">
                <h5 class="mb-0 float-left">
                    Daftar Ambil Perlengkapan
                </h5>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table style="width:100%" class="table table-striped table-bordered table-hover table-full-width">
                        <thead>
                            <tr>
                                <th style='text-align:center' width='5%'>No</th>
                                <th style='text-align:center' width='20%'>Nama Personil</th>
                                <th style='text-align:center' width='20%'>Jadwal Patrol</th>
                                <th style='text-align:center' width='20%'>Tanggal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (count($take_equipment_input) != 0)
                                @php $no = 1; @endphp
                                @foreach ($take_equipment_input as $take_equipment_inputs)
                                    <tr>
                                        <td style='text-align:center' width='5%'>{{ $no }}.</td>
                                        <td style='text-align:center' width='20%'>{{ $take_equipment_inputs['name'] }}</td>
                                        <td style='text-align:center' width='20%'>{{ $take_equipment_inputs['patrol_name'] }}</td>
                                        <td style='text-align:center' width='20%'>{{ $take_equipment_inputs['date_and_time_pick_up'] }}</td>
                                        <td style='text-align:center' width='5%'></a>
                                        </td>
                                    </tr>
                                    @php $no++; @endphp
                                @endforeach
                            @endif
                            <tr>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>


        <div class="card border border-dark">
            <div class="card-header bg-dark clearfix">
                <h5 class="mb-0 float-left">
                    Daftar Ambil Perlengkapan
                </h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table style="width:100%" class="table table-striped table-bordered table-hover table-full-width">
                        <thead>
                            <tr>
                                <th style='text-align:center' width='5%'>No</th>
                                <th style='text-align:center' width='90%'>Perlengkapan</th>
                                <th style='text-align:center' width='5%'></th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (count($equipment_data) != 0)
                                @php $no = 1; @endphp
                                @foreach ($equipment_data as $equipment_datas)
                                    <tr>
                                        <td style='text-align:center' width='5%'>{{ $no }}.</td>
                                        <td style='text-align:center' width='90%'>
                                            {{ $equipment_datas['equipment_name'] }}
                                        </td>
                                        <td style='text-align:center' width='5%'>
                                            <a type="button" class="btn btn-outline-danger btn-sm"
                                                href="/take-equipment/hapus-id-equipment/{{ $equipment_datas['index'] }}">
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
                                        <select class="selection-search-clear" name="equipment_id" id="equipment_id"
                                            style="width: 100% !important">
                                            <option value="" selected hidden></option>
                                            @foreach ($equipment as $equips)
                                                <option value="{{ $equips['equipment_id'] }}">
                                                    {{ $equips->equipment_name }}</option>
                                            @endforeach
                                        </select>
                                        @error('equipment_id')
                                            <p class='text-danger text-xs pt-1'> {{ $message }} </p>
                                        @enderror
                                    </div>
                                </td>
                                <td style='text-align:center' width='5%'>
                                    <a type="button" class="btn btn-outline-success btn-sm" id="plusEquipmentId">
                                        <i class="fa-solid fa-plus"></i>
                                    </a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="card-footer text-muted">
                        <div class="form-actions float-right">
                            <a href="/take-equipment/tambah/process" name="Save" class="btn btn-primary"
                                title="Save"><i class="fa fa-check"></i>
                                Simpan</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif


    {{-- <form method="" action="{{ url('/take-equipment/tambah/sessionList') }}" enctype="multipart/form-data">
            @csrf
            <div class="card-body">
                <div class="row form-group">
                    <div class="col-md-4">
                        <div class="form-group">
                            <a class="text-dark">Nama Personil<a class='red'> *</a></a>
                            <select class="selection-search-clear" name="personil_id" id="personil_id"
                                style="width: 100% !important">
                                <option value="" selected hidden></option>
                                @foreach ($personil as $pers)
                                    <option value="{{ $pers['personil_id'] }}">{{ $pers->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <a class="text-dark">Perlengkapan<a class='red'> *</a></a>
                            <select class="selection-search-clear" name="equipment_id" id="equipment_id"
                                style="width: 100% !important">
                                <option value="" selected hidden></option>
                                @foreach ($equipment as $equips)
                                    <option value="{{ $equips['equipment_id'] }}">{{ $equips->equipment_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <a class="text-dark">Jadwal Patroli<a class='red'> *</a></a>
                            <select class="selection-search-clear" name="patrol_id" id="patrol_id"
                                style="width: 100% !important">
                                <option value="" selected hidden></option>
                                @foreach ($patrol as $patrols)
                                    <option value="{{ $patrols['patrol_id'] }}">{{ $patrols->patrol_name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <a class="text-dark">tanggal dan jadwal mengambil<a class='red'> *</a></a>
                            <input class="form-control input-bb" type="date" name="date_and_time_pick_up"
                                id="date_and_time_pick_up" value="" readonly />
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer text-muted">
                <div class="form-actions float-right">
                    <a name="button" id="plusTakeEquipment" class="btn btn-primary" title="Save">Tambah</a>
                </div>
            </div>
    </div>
    </form>
    
    <div class="card border border-dark">
        <div class="card-header border-dark bg-dark">
            <h5 class="mb-0 float-left">
                Hasil Data
            </h5>
            <div class="float-right">
                <button onclick="location.href='{{ url('take-equipment') }}'" name="Find" class="btn btn-sm btn-info"
                    title="Back"><i class="fa fa-angle-left"></i> Kembali</button>
            </div>
        </div>



        
        <div class="card-body">
            <div class="table-responsive">
                <table style="width:100%" class="table table-striped table-bordered table-hover table-full-width">
                    <thead>
                        <tr>  
                            <th style='text-align:center' width='5%'>No</th>
                            <th style='text-align:center' width='20%'>Nama Personil</th>
                            <th style='text-align:center' width='20%'>Nama Perlengkapan</th>
                            <th style='text-align:center' width='20%'>Jadwal Patroli</th>
                            <th style='text-align:center' width='30%'>Tanggal & Jam Mengambil</th>
                            <th style='text-align:center' width='5%'>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (count($take_equipment) != 0)
                        @php $no = 1; @endphp
                        @foreach ($take_equipment as $take_equipments)
                            <tr>
                                <td style='text-align:center' width='5%'>{{ $no }}.</td>
                                <td style='text-align:center' width='15%'>{{ $take_equipments['name'] }}</td>
                                <td style='text-align:center' width='20%'>{{ $take_equipments['equipment_name'] }}</td>
                                <td style='text-align:center' width='20%'>{{ $take_equipments['patrol_name'] }}</td>
                                <td style='text-align:center' width='20%'>{{ $take_equipments['date_and_time_pick_up'] }}</td>
                                <td style='text-align:center' width='5%'>
                                    <a type="button" class="btn btn-outline-danger btn-sm"
                                        href="/take-equipment/hapus-take-equipment/{{ $take_equipments['index'] }}">
                                        <i class="fa-solid fa-minus"></i>
                                    </a>
                                </td>
                            </tr>
                            @php $no++; @endphp
                        @endforeach
                        @endif
                    </tbody>
                </table>
                
                <div class="card-footer text-muted">
                    <div class="form-actions float-right">
                        <a href="/take-equipment/tambah/process" name="Save" class="btn btn-primary"
                            title="Save"><i class="fa fa-check"></i>
                            Simpan</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form> --}}

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        const plusEquipmentId = document.getElementById("plusEquipmentId");
        plusEquipmentId.addEventListener("click", function() {
            $.ajax({
                url: '{{ route('equipmentIdSession') }}',
                type: 'POST',
                data: {
                    'equipment_id': document.getElementById("equipment_id").value,
                    '_token': '{{ csrf_token() }}'
                },
                success: function(response) {
                    window.location.href = '/take-equipment/tambah';
                }
            });

        });

        const plusTakeEquipment = document.getElementById("plusTakeEquipment");
        plusTakeEquipment.addEventListener("click", function() {
            // function plusTakeEquipment() {
            $.ajax({
                url: '{{ route('TakeEquipmentSession') }}',
                type: 'POST',
                data: {
                    'personil_id': document.getElementById("personil_id").value,
                    'patrol_id': document.getElementById("patrol_id").value,
                    'date_and_time_pick_up': document.getElementById("date_and_time_pick_up").value,
                    'equipment_id': document.getElementById("equipment_id").value,
                    '_token': '{{ csrf_token() }}'
                },
                success: function(response) {
                    window.location.href = '/take-equipment/tambah';
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
