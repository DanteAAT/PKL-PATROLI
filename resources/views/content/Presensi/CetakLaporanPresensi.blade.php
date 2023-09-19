<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Cetak Laporan Presensi</title>
    <style>
        table.static {
            position: relative;
            border: 1px solid #543535;
        }
    </style>
</head>

<body>
    <div class="form-group">
        <h1 align="center">Laporan Presensi</h1>
        <h4 align="center">Periode {{ $start_date }} s/d {{ $end_date }}</h4>
        <table class="static" rules="all" border="1px" style="width: 95%; ">
            <tr align="center">
                <th width="5%"><b>No</b></th>
                <th width="20%"><b>Nama Personil</b></th>
                <th width="20%"><b>Tanggal</b></th>
                <th width="20%"><b>Waktu</b></th>
                <th width="35%"><b>Keterangan</b></th>
            </tr>
            <?php $no = 1; ?>
            @foreach ($presensi as $presensis)
                <tr>
                    <td width="5%" align="center">{{ $no }}</td>
                    <td width="20%" align="center">{{ $presensis->callPersonil['name'] }}</td>
                    <td width="20%" align="center">{{ date('d-m-Y', strtotime($presensis['date_time'])) }}</td>
                    <td width="20%" align="center">{{ date('H:i:s', strtotime($presensis['date_time'])) }}</td>
                    <td width="35%" align="center">{{ $presensis['information'] }}</td>
                </tr>
                <?php $no++; ?>
            @endforeach
        </table>
    </div>
</body>
</html>