@extends('adminlte::page')

@section('title', 'Tanggapan')

@section('content_header')

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('home') }}">Beranda</a></li>
            <li class="breadcrumb-item"><a href="{{ url('return-equipment') }}">Daftar Pengembalian Perlengkapan</a></li>
            <li class="breadcrumb-item"><a href="{{ url('return-equipment/choose-take-equipment') }}">Daftar Pengembalian Perlengkapan</a></li>
            <li class="breadcrumb-item active" aria-current="page">Checklist Pengembalian Perlengkapan</li>
        </ol>
    </nav>


@stop

@section('content')

    <h3 class="page-title">
        Form Checklist Pengembalian Perlengkapan
    </h3>
    <br />
    @if (session('msg'))
        <div class="alert alert-info" role="alert">
            {{ session('msg') }}
        </div>
    @endif

    <?php
    use App\Models\Equipment; ?>

    <div class="card border border-dark">
        <div class="card-header border-dark bg-dark">
            <h5 class="mb-0 float-left">
                Form Pengembalian
            </h5>
            <div class="float-right">
                <button onclick="location.href='{{ url('return-equipment/choose-take-equipment') }}'" name="Find" class="btn btn-sm btn-info"
                    title="Back"><i class="fa fa-angle-left"></i> Kembali</button>
            </div>
        </div>

        <form method="" action="{{url('/return-equipment/choose-take-equipment/pilih/process/' . $take_equipment['take_equipment_id'])}}"
            enctype="multipart/form-data">
            @csrf
            <div class="card-body">
                <div class="row form-group">
                    <div class="col-md-3">
                        <div class="form-group">
                            <a class="text-dark">Nama Personil<a class='red'> *</a></a>
                            <select class="selection-search-clear" name="personil_id" id=""
                                style="width: 100% !important">
                                <option value="" selected hidden></option>
                                @foreach ($personil as $pers)
                                    <option value="{{ $pers['personil_id'] }}">{{ $pers['name'] }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <a class="text-dark">Pengembalian<a class='red'> *</a></a>
                            <input class="form-control input-bb" type="text" name="return_date" id="return_date"
                                value="{{ date('Y-m-d H:i:s') }}" readonly />
                        </div>
                    </div>
                    
                    <div class="col-md-3">
                        <div class="form-group">
                            <a class="text-dark">Checklist Pengembalian Barang<a class='red'> *</a></a><br>
                            @foreach ($equipment_data as $equipment_datas)
                                <?php
                                $equipment = Equipment::find($equipment_datas->equipment_id);
                                if ($return_equipment != null){

                                    $equipmentChecked = explode(',', str_replace(['[', ']', '"'], '', $return_equipment->return_equipment_checklist));
                                }
                                ?>
                                @if ($return_equipment != null)
                                <label class="form-check" for="checkbox{{ $equipment_datas->equipment_data_id }}">
                                    <input class="form-check-input" type="checkbox"
                                    id="checkbox{{ $equipment_datas->equipment_data_id }}" name="return_equipment_checklist[]"
                                    value="{{ $equipment_datas->equipment_data_id }}"
                                    {{in_array($equipment_datas->equipment_data_id, $equipmentChecked)? 'checked':''}}
                                    data-status-field="status{{ $equipment->equipment_id }}" onclick="updateStatus(this)" />
                                    {{ $equipment->equipment_name }}
                                </label>

                                @else 
                                <label class="form-check" for="checkbox{{ $equipment_datas->equipment_data_id }}">
                                    <input class="form-check-input" type="checkbox"
                                    id="checkbox{{ $equipment_datas->equipment_data_id }}" name="return_equipment_checklist[]"
                                    value="{{ $equipment_datas->equipment_data_id }}"
                                    data-status-field="status{{ $equipment->equipment_id }}" onclick="updateStatus(this)" />
                                    {{ $equipment->equipment_name }}
                                </label>
                                @endif
                                @endforeach
                                <input type="hidden" id="status{{ $equipment->equipment_id }}"
                                name="status" value="" />
                            </div>
                        </div>
                    {{-- <div class="col-md-3">
                        <div class="form-group">
                            <a class="text-dark">Checklist Pengembalian Barang<a class='red'> *</a></a><br>
                            @foreach ($equipment_data as $equipment_datas)
                                <?php
                                $equipment = Equipment::find($equipment_datas->equipment_id);
                                ?>
                                @if ($equipment)
                                    <label class="form-check" for="checkbox{{ $equipment_datas->equipment_data_id }}">
                                        <input class="form-check-input" type="checkbox"
                                            id="checkbox{{ $equipment_datas->equipment_data_id }}" name="return_equipment_checklist[]"
                                            value="{{ $equipment_datas->equipment_data_id }}" data-status-field="status{{ $equipment_datas->equipment_data_id }}"
                                            onclick="updateStatus(this)"/>
                                        {{ $equipment->equipment_name }}
                                    </label>
                                    @endif
                                    <input type="" id="status{{ $equipment_datas->equipment_id }}" name="status[{{ $equipment_datas->equipment_id }}]" value="0" />
                                    @endforeach
                        </div>
                    </div> --}}
                    <div class="col-md-3">
                        <div class="form-group">
                            <a class="text-dark">Keterangan</a>
                            <textarea rows="5" cols="" rows="" class="form-control input-bb" name="information_per_item"
                                id="information_per_item"></textarea>
                        </div>
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
    </div>
    </div>
    </form>
    <!-- Include jQuery library if not already included -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
//     function updateStatus(checkbox, equipmentDataId) {
//     var checkboxes = document.querySelectorAll('[name="return_equipment_checklist[]"]');
//     var checkedCount = 0;
    
//     for (var i = 0; i < checkboxes.length; i++) {
//         if (checkboxes[i].checked) {
//             checkedCount++;
//         }
//     }
    
//     var statusField = "status" + equipmentDataId;
//     var statusInput = document.getElementById(statusField);

//     if (statusInput) {
//         var newStatus = 0;
//         if (checkedCount === 0) {
//             newStatus = 0;
//         } else if (checkedCount === checkboxes.length) {
//             newStatus = 2;
//         } else {
//             newStatus = 1;
//         }
//         statusInput.value = newStatus;
//     }
// }

    function updateStatus(checkbox) {
        var checkboxes = document.querySelectorAll('[name="return_equipment_checklist[]"]');
        var checkedCount = 0;
        for (var i = 0; i < checkboxes.length; i++) {
            if (checkboxes[i].checked) {
                checkedCount++;
            }
        }
        var statusField = checkbox.getAttribute('data-status-field');
        var statusInput = document.getElementById(statusField);

        if (statusInput) {
            var newStatus = 0;
            if (checkedCount === 0) {
                newStatus = 0;
            } else if (checkedCount === checkboxes.length) {
                newStatus = 2;
            } else {
                newStatus = 1;
            }
            statusInput.value = newStatus;
        }
    }
</script>


@stop

@section('footer')

@stop

@section('css')

@stop

@section('js')

@stop
