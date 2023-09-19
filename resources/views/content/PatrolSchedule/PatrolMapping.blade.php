@extends('adminlte::page')

@section('title', 'Tanggapan')

@section('content_header')

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('home') }}">Beranda</a></li>
            <li class="breadcrumb-item"><a href="{{ url('patrol-schedule') }}">Daftar Jadwal Patroli</a></li>
            <li class="breadcrumb-item active" aria-current="page">GMaps Patroli </li>
        </ol>
    </nav>

@stop

@section('content')

    <h3 class="page-title">
        Daftar GMaps Patroli
    </h3>
    <br />
    @if (session('msg'))
        <div class="alert alert-info" role="alert">
            {{ session('msg') }}
        </div>
    @endif
    <div class="card border border-dark" style="margin-bottom: 10vh">
        <div class="card-header bg-dark clearfix">
            <h5 class="mb-0 float-left">
                Daftar GMaps
            </h5>
            <div class="float-right">
                <button onclick="location.href='{{ url('patrol-schedule') }}'" name="Find" class="btn btn-sm btn-info"
                    title="Back"><i class="fa fa-angle-left"></i>Kembali</button>
                <button class="btn btn-sm btn-success" id="printButton" style="margin-left: 5px"><i class="fa fa-print"></i>
                    Print PDF
                </button>
            </div>
        </div>
        <div class="card-body">
            <div id="map" style="height: 70vh; width: 100%;"></div>
        </div>
    </div>
    </div>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBcybC25E2M7U_aIDZfRXDRedkHBQKditU&callback=initMap" async
        defer></script>
    <script>
        function initMap() {
            var map = new google.maps.Map(document.getElementById('map'), {
                center: {
                    lat: -7.576995752053248,
                    lng: 110.89258504397652
                },
                zoom: 18
            });

            fetch('{{ route('PatrolMappingGetMarker') }}', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        patrol_id: {{ $patrol_id }}
                    })
                })
                .then(response => response.json())
                .then(markers => {
                    var camera = {
                        lat: parseFloat(markers[0].latitude),
                        lng: parseFloat(markers[0].longitude)
                    };
                    map.setCenter(camera);
                    var number = 1;
                    markers.forEach(marker => {
                        var position = {
                            lat: parseFloat(marker.latitude),
                            lng: parseFloat(marker.longitude)
                        };

                        var titleMarker = number + '. Nama Lokasi : ' + marker.location_name +
                            ', Jam Presensi : ' + marker
                            .patrol_start_time + ' - ' + marker.patrol_end_time;

                        var mapMarker = new google.maps.Marker({
                            position: position,
                            map: map,
                            title: titleMarker
                        });

                        number++;
                    });
                    map.setZoom(18);
                })
                .catch(error => {
                    console.error('Error:', error);
                });
        }

        document.getElementById("printButton").addEventListener("click", function() {
            printDiv("map");
        });

        function printDiv(divId) {
            var divToPrint = document.getElementById(divId);
            var newWin = window.open("", "Print-Window");
            newWin.document.open();
            newWin.document.write('<html><head><title>Print</title></head><body>');
            newWin.document.write(divToPrint.innerHTML);
            newWin.document.write('</body></html>');
            newWin.document.close();
            newWin.print();
            newWin.close();
        }
    </script>
@stop

@section('footer')

@stop

@section('css')

@stop

@section('js')

@stop