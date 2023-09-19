@extends('adminlte::page')

@section('title', 'Tanggapan')

@section('content_header')

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('home') }}">Beranda</a></li>
            <li class="breadcrumb-item active" aria-current="page">Presensi</li>
        </ol>
    </nav>

@stop

@section('content')
    <script src="https://kit.fontawesome.com/ccc7ad4dc8.js" crossorigin="anonymous"></script>
    <style>
        .form-check {
            cursor: pointer;
            border: 10px;
            font-size: 20px;
            /* ukuran teks */
        }

        .form-check-input {
            cursor: pointer;
            width: 19px;
            height: 21px;
        }

        .layer {
            width: 600px;
            height: 600px;
        }

        .popup {
            display: none;
            position: fixed;
            top: 40%;
            left: 50%;
            transform: translate(-50%, -50%);
            padding: 50px;
            background-color: white;
            border: 1px solid #ccc;
            box-shadow: 0px 2px 10px rgba(0, 0, 0, 0.2);
        }
    </style>

    <h3 class="page-title">
        <b>Presensi</b>
    </h3>
    <br />
    @if (session('msg'))
        <div class="alert alert-success" role="alert">
            {{ session('msg') }}
        </div>
    @endif
    @if ($msg != '')
        @if ($validate == false)
            <div class="alert alert-danger" role="alert">
                {{ $msg }}
            </div>
        @elseif ($validate == true)
            <div class="alert alert-success" role="alert">
                {{ $msg }}
            </div>
        @endif
    @endif
    <div class="card border border-dark">
        <div class="card-header bg-dark clearfix">
            <h5 class="mb-0 float-left">
                Presensi
            </h5>
        </div>


        @if ($validate == false)
            <div class="card-body d-flex" style="justify-content: center; align-items:center;">
                <div class="visible-print text-center">
                    <div class="layer">

                        <div id="reader" height="100px"></div>
                    </div>
                </div>
            </div>
        @elseif ($validate == true)
            {{-- <div class="form-actions float-left">
            <button onclick="location.href='{{ url('emergency-message') }}'" name="Find" class="btn btn-sm btn-danger"
        title="Emergency" style="height: 50px"><i class="fa-solid fa-triangle-exclamation"></i> EMERGENCY MESSAGE</button>
        </div> --}}
            <div class="form-actions float-left">
                <button style="margin-top: 20px; margin-left:20px; height:50px;" id="showPopup" class="btn btn-sm btn-danger" title="Emergency"><i
                        class="fa-solid fa-triangle-exclamation"></i> EMERGENCY MESSAGE</button>
            </div>

            <form method="POST" action="/presensi/tambah/process" enctype="multipart/form-data">
                @csrf
                <input type="text" value="{{ $personil_scheduling_id }}" name="personil_scheduling_id" hidden>
                <div class="card-body">
                    <div class="row form-group">
                        <div class="col-md-6">
                            <div class="form-group">
                                <a class="text-dark">Tugas</a><br>
                                @php
                                    if ($presensi != null) {
                                        $presensiChecked = explode(',', str_replace(['[', ']', '"'], '', $presensi->checked));
                                    }
                                    $index = 0;
                                @endphp
                                @foreach ($PatrolTask as $PatrolTasks)
                                    @if ($presensi != null)
                                        @if (in_array($PatrolTasks->patrol_task_id, $presensiChecked))
                                            <label class="form-check" for="checkbox{{ $index }}">
                                                <input class="form-check-input" type="checkbox"
                                                    id="checkbox{{ $index }}" name="PatrolTasks[]"
                                                    value={{ $PatrolTasks->patrol_task_id }} checked />
                                                {{ $PatrolTasks->task }}
                                            </label>
                                        @else
                                            <label class="form-check" for="checkbox{{ $index }}">
                                                <input class="form-check-input" type="checkbox"
                                                    id="checkbox{{ $index }}" name="PatrolTasks[]"
                                                    value={{ $PatrolTasks->patrol_task_id }} />
                                                {{ $PatrolTasks->task }}
                                            </label>
                                        @endif
                                    @else
                                        <label class="form-check" for="checkbox{{ $index }}">
                                            <input class="form-check-input" type="checkbox"
                                                id="checkbox{{ $index }}" name="PatrolTasks[]"
                                                value={{ $PatrolTasks->patrol_task_id }} />
                                            {{ $PatrolTasks->task }}
                                        </label>
                                    @endif
                                    @php $index++; @endphp
                                @endforeach
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <a class="text-dark">Keterangan</a>
                                <textarea rows="5" class="form-control input-bb" name="information" id="information"></textarea>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="card-footer text-muted">
                    <div class="form-actions float-right">
                        <button type="reset" name="Reset" class="btn btn-danger" onClick="window.location.reload();"><i
                                class="fa fa-times"></i> Batal</button>
                        <button type="submit" name="Save" class="btn btn-primary" title="Save"><i
                                class="fa fa-check"></i>
                            Simpan</button>
                    </div>
                </div>
            </form>

            <div class="popup" id="popup">

                <table id="" style=""
                    class="table table-striped table-bordered table-hover table-full-width">
                    <thead>
                        <tr>
                            <th style='text-align:center'>Nama Pelayanan Darurat</th>
                            <th style='text-align:center'>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($emergency_message as $em)
                            <tr>
                                <td style='text-align:center' width='5%'>{{ $em['emergency_message_name'] }}</td>
                                <td style='text-align:center' width='3%'>
                                    <a type="button" class="btn btn-outline-success btn-sm"
                                        href="{{ url('/emergency-message/kirim-pesan/' . $em['emergency_message_id']) }}">Message</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{-- <p>This is a simple pop-up.</p> --}}
                <button id="closePopup">Close</button>
            </div>
        @endif

    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script>
    <script>
        function onScanSuccess(decodedText) {
            $.ajax({
                url: '{{ route('PresensiValidate') }}',
                type: 'POST',
                data: {
                    'location_id': decodedText,
                    '_token': '{{ csrf_token() }}'
                },
                success: function(response) {
                    window.location.href = '/presensi';
                }
            });
        }

        let config = {
            fps: 1,
            qrbox: {
                width: 1000,
                height: 1000
            },
            rememberLastUsedCamera: true,
            supportedScanTypes: [
                Html5QrcodeScanType.SCAN_TYPE_CAMERA,
            ]
        };

        let html5QrcodeScanner = new Html5QrcodeScanner(
            "reader", config, /* verbose= */ false);
        html5QrcodeScanner.render(onScanSuccess);
    </script>

    <script>
        // Get references to the button and pop-up
        const showPopupButton = document.getElementById('showPopup');
        const popup = document.getElementById('popup');
        const closePopupButton = document.getElementById('closePopup');

        // Show the pop-up when the button is clicked
        showPopupButton.addEventListener('click', () => {
            popup.style.display = 'block';
        });

        // Close the pop-up when the close button is clicked
        closePopupButton.addEventListener('click', () => {
            popup.style.display = 'none';
        });
    </script>



@stop

@section('footer')

@stop

@section('css')

@stop

@section('js')

@stop
