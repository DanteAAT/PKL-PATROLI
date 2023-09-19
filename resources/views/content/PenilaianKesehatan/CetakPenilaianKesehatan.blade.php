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
    @php
    $bulan = [
        '01' => 'Januari',
        '02' => 'Februari',
        '03' => 'Maret',
        '04' => 'April',
        '05' => 'Mei',
        '06' => 'Juni',
        '07' => 'Juli',
        '08' => 'Agustus',
        '09' => 'September',
        '10' => 'Oktober',
        '11' => 'November',
        '12' => 'Desember',
    ];
@endphp
    <div class="form-group">
        <h1 align="center">Laporan Data Penilaian Kesehatan</h1>
        <table class="static" align="center" rules="all" border="1px" style="width: 95%; ">
            <tr>
                <th>ID Penilaian Kesehatan</th>
                <th>Nama Personil</th>
                <th>Jadwal Penilaian Kesehatan</th>
                <th>Kategori Penilaian Kesehatan</th>
                <th>Nilai</th>
            </tr>
            @foreach ($penilaian_kesehatan as $pk)
                <tr align="center">
                    <td> {{ $pk['penilaian_kesehatan_id']}}</td>
                    <td> {{ $pk->callPersonilPenilaianKesehatan['name'] }}</td>
                    <td> {{ $bulan[$pk->callJadwalPenilaianKesehatan['period_month']] }} {{$pk->callJadwalPenilaianKesehatan['period_year']}}</td>
                    <td> {{ $pk->callKategoriPenilaianKesehatan['penilaian_kesehatan_category_name'] }}</td>
                    <td> {{ $pk['value'] }}</td>
                </tr>
            @endforeach
        </table>
    </div>
</body>

</html>
