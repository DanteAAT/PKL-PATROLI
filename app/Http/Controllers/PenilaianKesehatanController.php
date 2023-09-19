<?php

namespace App\Http\Controllers;

use App\Models\JadwalPenilaianKesehatan;
use App\Models\PenilaianKesehatan;
use App\Models\PenilaianKesehatanCategory;
use App\Models\Personil;
use Illuminate\Http\Request;
use PDF;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;


class PenilaianKesehatanController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $penilaian_kesehatan = PenilaianKesehatan::where('data_state', 0)->get();
        return view('content/PenilaianKesehatan/ListPenilaianKesehatan', compact('penilaian_kesehatan'));
    }

    public function screenTambah()
    {
        $penilaian_kesehatan = PenilaianKesehatan::where('data_state', 0)->get();
        $personil = Personil::where('data_state', 0)->get();
        $penilaian_kesehatan_schedule = JadwalPenilaianKesehatan::where('data_state', 0)->get();
        $penilaian_kesehatan_category = PenilaianKesehatanCategory::where('data_state', 0)->get();
        return view('content/PenilaianKesehatan/TambahPenilaianKesehatan', compact('penilaian_kesehatan','personil','penilaian_kesehatan_schedule','penilaian_kesehatan_category'));
    }

    public function tambah(Request $request)
    {
        $request->validate([
            'personil_id' => 'required',
            'penilaian_kesehatan_schedule_id' => 'required',
            'penilaian_kesehatan_category_id' => 'required',
            'value' => 'required',
        ]);

        $penilaian_kesehatan = [
            'personil_id' => $request->personil_id,
            'penilaian_kesehatan_schedule_id' => $request->penilaian_kesehatan_schedule_id,
            'penilaian_kesehatan_category_id' => $request->penilaian_kesehatan_category_id,
            'value' => $request->value,
        ];
        PenilaianKesehatan::create($penilaian_kesehatan);
        return redirect()->to('/penilaian-kesehatan')->with('msg','Tambah Penilaian Kesehatan Sukses');
    }

    public function update(Request $request, $penilaian_kesehatan_id)
    {
        $request->validate([
            'personil_id' => 'required',
            'penilaian_kesehatan_schedule_id' => 'required',
            'penilaian_kesehatan_category_id' => 'required',
            'value' => 'required',
        ]);
        
        $penilaian_kesehatan = [
            'personil_id' => $request->personil_id,
            'penilaian_kesehatan_schedule_id' => $request->penilaian_kesehatan_schedule_id,
            'penilaian_kesehatan_category_id' => $request->penilaian_kesehatan_category_id,
            'value' => $request->value,
        ];
        PenilaianKesehatan::where('penilaian_kesehatan_id', $penilaian_kesehatan_id)->update($penilaian_kesehatan);
        return redirect()->to('/penilaian-kesehatan')->with('msg','Edit Penilaian Kesehatan Sukses!');
    }

    public function edit($penilaian_kesehatan_id)
    {
        $penilaian_kesehatan = PenilaianKesehatan::where('penilaian_kesehatan_id', $penilaian_kesehatan_id)->first();
        $personil = Personil::where('data_state', 0)->get();
        $penilaian_kesehatan_schedule = JadwalPenilaianKesehatan::where('data_state', 0)->get();
        $penilaian_kesehatan_category = PenilaianKesehatanCategory::where('data_state', 0)->get();
        return view('content/PenilaianKesehatan/EditPenilaianKesehatan', compact('penilaian_kesehatan','personil','penilaian_kesehatan_schedule','penilaian_kesehatan_category'));
    }

    public function delete($penilaian_kesehatan_id)
    {
        $penilaian_kesehatan = ['data_state' => 1];
        PenilaianKesehatan::where('penilaian_kesehatan_id', $penilaian_kesehatan_id)->update($penilaian_kesehatan);
        return redirect()->to('/penilaian-kesehatan')->with('danger', 'Hapus Penilaian Kesehatan Sukses!');
    }


    public function CetakPDF()
    {
        $filename = 'PenilaianKesehatan.pdf';
        $penilaian_kesehatan = PenilaianKesehatan::where('data_state', '=', 0)->get();
        $html = view()->make('content/PenilaianKesehatan/CetakPenilaianKesehatan', ['penilaian_kesehatan' => $penilaian_kesehatan])->render();
        $pdf = new PDF;
        $pdf::SetTitle('PenilaianKesehatan');
        $pdf::AddPage();
        $pdf::writeHTML($html);
        $pdf::Output(public_path($filename), 'F');
        return response()->download(public_path($filename));
    }

    public function CetakExcel()
    {
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
        $penilaian_kesehatan = PenilaianKesehatan::where('data_state', '=', 0)->get();
        $spreadsheet = new Spreadsheet();
        $activeWorksheet = $spreadsheet->getActiveSheet();
        $activeWorksheet
            ->setCellValue('A1', 'ID')
            ->setCellValue('B1', 'Nama Personil')
            ->setCellValue('C1', 'Jadwal Penilaian Kesehatan')
            ->setCellValue('D1', 'Kategori Penilaian Kesehatan')
            ->setCellValue('E1', 'Nilai');
        $cell = 2;
        foreach ($penilaian_kesehatan as $pk) {
            $activeWorksheet
                ->setCellValue('A' . $cell, $pk->penilaian_kesehatan_id)
                ->setCellValue('B' . $cell, $pk->callPersonilPenilaianKesehatan['name'])
                ->setCellValue('C' . $cell, $bulan[$pk->callJadwalPenilaianKesehatan['period_month']]. ' '. $pk->callJadwalPenilaianKesehatan['period_year'])
                ->setCellValue('D' . $cell, $pk->callKategoriPenilaianKesehatan['penilaian_kesehatan_category_name'])
                ->setCellValue('E' . $cell, $pk['value']);
            $cell++;
        }
        $writer = new Xlsx($spreadsheet);
        $writer->save('hello world.xlsx');
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="PenilaianKesehatan.xlsx"');
        header('Cache-Control: max-age=0');

        $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xlsx');
        $writer->save('php://output');
    }



}
