<?php

namespace App\Http\Controllers;

use App\Models\JadwalPenilaianKesehatan;
use App\Models\Location;
use Illuminate\Http\Request;


class JadwalPenilaianKesehatanController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {
        $JadwalPenilaianKesehatan = JadwalPenilaianKesehatan::where('data_state', 0)->get();
        return view('content/JadwalPenilaianKesehatan/ListJadwalPenilaianKesehatan', compact('JadwalPenilaianKesehatan'));
    }

    public function screenTambah()
    {
        return view('content/JadwalPenilaianKesehatan/TambahJadwalPenilaianKesehatan');
    }

    public function tambah(Request $request)
    {
        $request->validate([
            'periode' => 'required',
        ]);

        $period_month = substr($request->periode, 5, 2);
        $period_year = substr($request->periode, 0, 4);


        $JadwalPenilaianKesehatan = [
            'period_month' => $period_month,
            'period_year' => $period_year,
        ];
        JadwalPenilaianKesehatan::create($JadwalPenilaianKesehatan);
        return redirect()->to('/jadwal-penilaian-kesehatan')->with('msg', 'Tambah Jadwal Penilaian Kesehatan Sukses!');
    }

    public function edit($penilaian_kesehatan_schedule_id)
    {
        $JadwalPenilaianKesehatan = JadwalPenilaianKesehatan::where('penilaian_kesehatan_schedule_id', $penilaian_kesehatan_schedule_id)->first();
        $periode = $JadwalPenilaianKesehatan['period_year'] . '-' . $JadwalPenilaianKesehatan['period_month'];
        return view('content/JadwalPenilaianKesehatan/EditJadwalPenilaianKesehatan', compact('JadwalPenilaianKesehatan', 'periode'));
    }

    public function update(Request $request, $penilaian_kesehatan_schedule_id)
    {
        $request->validate([
            'periode' => 'required',
        ]);

        $period_month = substr($request->periode, 5, 2);
        $period_year = substr($request->periode, 0, 4);

        $JadwalPenilaianKesehatan = [
            'period_month' => $period_month,
            'period_year' => $period_year,
        ];
        JadwalPenilaianKesehatan::where('penilaian_kesehatan_schedule_id', $penilaian_kesehatan_schedule_id)->update($JadwalPenilaianKesehatan);
        return redirect()->to('/jadwal-penilaian-kesehatan')->with('msg', 'Edit Jadwal Penilaian Kesehatan Sukses!');
    }

    public function detail($penilaian_kesehatan_schedule_id)
    {
        $JadwalPenilaianKesehatan = JadwalPenilaianKesehatan::where('penilaian_kesehatan_schedule_id', $penilaian_kesehatan_schedule_id)->first();
        $periode = $JadwalPenilaianKesehatan['period_year'] . '-' . $JadwalPenilaianKesehatan['period_month'];
        return view('content/JadwalPenilaianKesehatan/DetailJadwalPenilaianKesehatan', compact('JadwalPenilaianKesehatan', 'periode'));
    }

    public function delete($penilaian_kesehatan_schedule_id)
    {
        $JadwalPenilaianKesehatan = ['data_state' => 1];
        JadwalPenilaianKesehatan::where('penilaian_kesehatan_schedule_id', $penilaian_kesehatan_schedule_id)->update($JadwalPenilaianKesehatan);
        return redirect()->to('/jadwal-penilaian-kesehatan')->with('msg', 'Hapus Jadwal Penilaian Kesehatan Sukses!');
    }
}