<?php

namespace App\Http\Controllers;

use App\Models\Patrol;
use App\Models\PatrolSchedule;
use App\Models\Personil;
use App\Models\PersonilScheduling;
use Illuminate\Http\Request;
use PDF;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class PersonilSchedulingController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {
        $personil_scheduling = PersonilScheduling::where('data_state', 0)->get();
        return view('content/PersonilScheduling/ListPersonilScheduling', compact('personil_scheduling'));
    }


    public function screenTambah()
    {
        $personil = Personil::where('data_state', 0)->get();
        $patrol = Patrol::where('data_state', 0)->get();
        return view('content/PersonilScheduling/TambahPersonilScheduling', compact('personil', 'patrol'));
    }


    public function tambah(Request $request)
    {
        $request->validate([
            'personil_id' => 'required',
            'patrol_id' => 'required',
            'patrol_day' => 'required',

        ]);

        $personil_scheduling = [
            'personil_id' => $request->personil_id,
            'patrol_id' => $request->patrol_id,
            'patrol_day' => json_encode($request->patrol_day),
        ];
        PersonilScheduling::create($personil_scheduling);
        return redirect()->to('/personil-scheduling')->with('msg', 'Tambah Penjadwalan Personil Sukses');
    }


    public function update(Request $request, $personil_scheduling_id)
    {
        $request->validate([
            'personil_id' => 'required',
            'patrol_id' => 'required',
            'patrol_day' => 'required',
        ]);
        $personil_scheduling = [
            'personil_id' => $request->personil_id,
            'patrol_id' => $request->patrol_id,
            'patrol_day' => json_encode($request->patrol_day),
        ];
        PersonilScheduling::where('personil_scheduling_id', $personil_scheduling_id)->update($personil_scheduling);
        return redirect()->to('/personil-scheduling')->with('msg', 'Update Pendjadwalan Patroli Sukses');
    }

    public function edit($personil_scheduling_id)
    {
        $personil = Personil::where('data_state', 0)->get();
        $patrol = Patrol::where('data_state', 0)->get();
        $personil_scheduling = PersonilScheduling::where('personil_scheduling_id', $personil_scheduling_id)->first();
        return view('content/PersonilScheduling/EditPersonilScheduling', compact('personil_scheduling', 'personil', 'patrol'));
    }

    public function delete($personil_scheduling_id)
    {
        $personil_scheduling = ['data_state' => 1];
        PersonilScheduling::where('personil_scheduling_id', $personil_scheduling_id)->update($personil_scheduling);
        return redirect()->to('/personil-scheduling');
    }

    public function detail($personil_scheduling_id)
    {
        $personil_scheduling = PersonilScheduling::where('personil_scheduling_id', $personil_scheduling_id)->first();
        $patrol = Patrol::where('data_state', 0)->where('patrol_id', $personil_scheduling->patrol_id)->first();
        $personil = Personil::where('data_state', 0)->get();
        return view('content/PersonilScheduling/DetailPersonilScheduling', compact('personil_scheduling', 'personil', 'patrol'));
    }



    public function CetakPDF()
    {
        $filename = 'PersonilScheduling.pdf';
        $personil_scheduling = PersonilScheduling::where('data_state', '=', 0)->get();
        $html = view()->make('content/PersonilScheduling/CetakPersonilScheduling', ['personil_scheduling' => $personil_scheduling])->render();
        $pdf = new PDF;
        $pdf::SetTitle('PersonilScheduling');
        $pdf::AddPage();
        $pdf::writeHTML($html);
        $pdf::Output(public_path($filename), 'F');
        return response()->download(public_path($filename));
    }

    public function CetakExcel()
    {
        $personil_scheduling = PersonilScheduling::where('data_state', '=', 0)->get();
        $spreadsheet = new Spreadsheet();
        $activeWorksheet = $spreadsheet->getActiveSheet();
        $activeWorksheet
            ->setCellValue('A1', 'ID')
            ->setCellValue('B1', 'Nama Personil')
            ->setCellValue('C1', 'Jadwal Patroli')
            ->setCellValue('D1', 'Hari Patroli');
        $cell = 2;
        foreach ($personil_scheduling as $ps) {
            $patrol_day = json_decode($ps->patrol_day);
            $activeWorksheet
                ->setCellValue('A' . $cell, $ps->personil_scheduling_id)
                ->setCellValue('B' . $cell, $ps->callPersonil->name)
                ->setCellValue('C' . $cell, $ps->callPatrol->patrol_name)
                ->setCellValue('D' . $cell, implode(", ", $patrol_day));
            $cell++;
        }
        $writer = new Xlsx($spreadsheet);
        $writer->save('hello world.xlsx');
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="PersonilScheduling.xlsx"');
        header('Cache-Control: max-age=0');

        $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xlsx');
        $writer->save('php://output');
    }

}