<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        table.static {
            position: relative;
            border: 1px solid #543535;
        }
    </style>
</head>

<body>
    <div class="form-group">
        <h1 align="center">Laporan Data Penjadwalan Personil</h1>
        <table class="static" align="center" rules="all" border="1px" style="width: 95%; ">
            <tr>
                <th>ID Penjadwalan Patroli</th>
                <th>Nama Personil</th>
                <th>Jadwal Patroli</th>
                <th>Hari Patroli</th>
            </tr>
            @foreach ($personil_scheduling as $ps)
            @php $patrol_day = json_decode($ps->patrol_day) @endphp
                <tr align="center">
                    <td> {{ $ps['personil_scheduling_id']}}</td>
                    <td> {{ $ps->callPersonil['name'] }}</td>
                    <td> {{ $ps->callPatrol['patrol_name']}}</td>
                    <td> @foreach ($patrol_day as $index => $patrol_days)
                        {{ $patrol_days }}@if ($index < count($patrol_day) - 1),
                        @endif
                    @endforeach
                </td>
                </tr>
            @endforeach
        </table>
    </div>
</body>

</html>
