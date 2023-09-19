<?php

namespace App\Http\Controllers;

use App\Models\EmergencyMessage;
use App\Models\PatrolSchedule;
use App\Models\PatrolTask;
use App\Models\Personil;
use App\Models\PersonilScheduling;
use App\Models\Presensi;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use PDF;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class PresensiController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(Request $request)
    {
        if (!Session::get('validate')) {
            $validate = false;
            $msg = '';
            return view('content/Presensi/Presensi', compact('validate', 'msg'));
        } else {
            $validate = Session::get('validate');
            Session::forget('validate');
            if ($validate['validate'] == 'success') {
                $msg = $validate['msg'];
                $personil_scheduling_id = $validate['personil_scheduling_id'];
                $PersonilScheduling = PersonilScheduling::where('data_state', '=', 0)->where('personil_scheduling_id', $personil_scheduling_id)->first();
                $PatrolTask = PatrolTask::where('data_state', '=', 0)->where('patrol_id', $PersonilScheduling->patrol_id)->get();
                $emergency_message = EmergencyMessage::where('data_state', 0)->get();
                $validate = true;

                $User = User::where('user_id', Auth::id())->first();
                $presensi = Presensi::where('data_state', '=', 0)->where('personil_scheduling_id', $personil_scheduling_id)->where('personil_id', $User->personil_id)->whereDate('date_time', Carbon::today())->orderByDesc('date_time')->first();
                return view('content/Presensi/Presensi', compact('validate', 'msg', 'PatrolTask', 'personil_scheduling_id', 'presensi', 'emergency_message'));
            } else {
                $msg = $validate['msg'];
                $validate = false;
                return view('content/Presensi/Presensi', compact('validate', 'msg'));
            }
        }
    }

    public function validasi(Request $request)
    {
        $jamSekarang = date('H:i:s');
        $jadwal = PatrolSchedule::where('data_state', '=', 0);
        $lokasi = $jadwal->where('location_id', '=', $request->location_id)->get();
        if (!count($lokasi) == 0) {
            $jamPagi = $lokasi->where('patrol_start_time', '<=', $jamSekarang);
            if (!count($jamPagi) == 0) {
                $jamAkhir = $jamPagi->where('patrol_end_time', '>=', $jamSekarang);
                if (!count($jamAkhir) == 0) {
                    $penjadwalan = [];
                    $User = User::where('user_id', Auth::id())->first();
                    foreach ($jamAkhir as $jamAkhirs) {
                        $penjadwalan1 = PersonilScheduling::where('data_state', '=', 0)->where('personil_id', $User->personil_id)->where('patrol_id', $jamAkhirs->patrol_id)->first();
                        if ($penjadwalan1 != null) {
                            $penjadwalan = $penjadwalan1;
                        }
                    }
                    if ($penjadwalan != null) {
                        $hariIni = date('l');
                        $namaHariIndonesia = '';
                        switch ($hariIni) {
                            case 'Monday':
                                $namaHariIndonesia = 'Senin';
                                break;
                            case 'Tuesday':
                                $namaHariIndonesia = 'Selasa';
                                break;
                            case 'Wednesday':
                                $namaHariIndonesia = 'Rabu';
                                break;
                            case 'Thursday':
                                $namaHariIndonesia = 'Kamis';
                                break;
                            case 'Friday':
                                $namaHariIndonesia = 'Jumat';
                                break;
                            case 'Saturday':
                                $namaHariIndonesia = 'Sabtu';
                                break;
                            case 'Sunday':
                                $namaHariIndonesia = 'Minggu';
                                break;
                            default:
                                $namaHariIndonesia = '';
                                break;
                        }
                        $text = str_replace(['[', ']', '"'], '', $penjadwalan->patrol_day);
                        $patrol_days = explode(',', $text);
                        if (in_array($namaHariIndonesia, $patrol_days)) {
                            $msg = [
                                'validate' => 'success',
                                'msg' => 'Scan QR Berhasil!',
                                'personil_scheduling_id' => $penjadwalan->personil_scheduling_id
                            ];
                            Session::put('validate', $msg);
                            Session::put('location_id_presensi', $request->location_id);
                        } else {
                            $msg = [
                                'validate' => 'error',
                                'msg' => 'Kamu tidak dijadwalkan pada hari ini!'
                            ];
                            Session::put('validate', $msg);
                        }
                    } else {
                        $msg = [
                            'validate' => 'error',
                            'msg' => 'Tidak ada jadwal yang sesuai!'
                        ];
                        Session::put('validate', $msg);
                    }
                } else {
                    $msg = [
                        'validate' => 'error',
                        'msg' => 'Sudah terlambat untuk melakukan presensi!'
                    ];
                    Session::put('validate', $msg);
                }
            } else {
                $msg = [
                    'validate' => 'error',
                    'msg' => 'Masih terlalu awal untuk melakukan presensi!'
                ];
                Session::put('validate', $msg);
            }
        } else {
            $msg = [
                'validate' => 'error',
                'msg' => 'Jadwal pada lokasi ini tidak ada!'
            ];
            Session::put('validate', $msg);
        }
    }

    public function tambah(Request $request)
    {
        $PersonilScheduling = PersonilScheduling::where('data_state', '=', 0)->where('personil_scheduling_id', $request->personil_scheduling_id)->first();
        $lokasi = Session::get('location_id_presensi');
        $Presensi = [
            'personil_scheduling_id' => $request->personil_scheduling_id,
            'patrol_id' => $PersonilScheduling->patrol_id,
            'location_id' => $lokasi,
            'personil_id' => $PersonilScheduling->personil_id,
            'date_time' => date('Y-m-d H:i:s'),
            'checked' => json_encode($request->PatrolTasks),
            'information' => $request->information,
        ];
        Presensi::create($Presensi);
        Session::forget('location_id_presensi');
        return redirect()->to('/presensi')->with('msg', 'Presensi Berhasil!');
    }

    public function laporanIndex()
    {
        $presensi = Presensi::where('data_state', 0)->get();
        $personil = Personil::select('name', 'personil_id')
            ->where('data_state', 0)
            ->get();

        if (!Session::get('laporan_personil_id')) {
            $personil_id = null;
        } else {
            $personil_id = Session::get('laporan_personil_id');
            $presensi = $presensi->where('personil_id', $personil_id);
        }

        if (!Session::get('start_date')) {
            $start_date = date('Y-m-d');
        } else {
            $start_date = Session::get('start_date');
        }

        if (!Session::get('end_date')) {
            $end_date = date('Y-m-d');
            $stop_date = date('Y-m-d', strtotime($end_date . ' +1 day'));
        } else {
            $end_date = Session::get('end_date');
            $stop_date = date('Y-m-d', strtotime($end_date . ' +1 day'));
        }

        $presensi = $presensi->where('date_time', '>=', $start_date)->where('date_time', '<=', $stop_date);

        return view('content/Presensi/LaporanPresensi', compact('presensi', 'start_date', 'end_date', 'personil', 'personil_id'));
    }

    public function filter(Request $request)
    {
        $personil_id = $request->personil_id;
        $start_date = $request->start_date;
        $end_date = $request->end_date;

        Session::put('laporan_personil_id', $personil_id);
        Session::put('start_date', $start_date);
        Session::put('end_date', $end_date);

        return redirect('/laporan-presensi');
    }

    public function CetakPDF()
    {

        $filename = 'Laporan Presensi.pdf';

        $presensi = Presensi::where('data_state', 0)->get();
        $personil = Personil::select('name', 'personil_id')
            ->where('data_state', 0)
            ->get();

        if (!Session::get('laporan_personil_id')) {
            $personil_id = null;
        } else {
            $personil_id = Session::get('laporan_personil_id');
            $presensi = $presensi->where('personil_id', $personil_id);
        }

        if (!Session::get('start_date')) {
            $start_date = date('Y-m-d');
        } else {
            $start_date = Session::get('start_date');
        }

        if (!Session::get('end_date')) {
            $end_date = date('Y-m-d');
            $stop_date = date('Y-m-d', strtotime($end_date . ' +1 day'));
        } else {
            $end_date = Session::get('end_date');
            $stop_date = date('Y-m-d', strtotime($end_date . ' +1 day'));
        }

        $presensi = $presensi->where('date_time', '>=', $start_date)->where('date_time', '<=', $stop_date);

        $html = view()->make('content/Presensi/CetakLaporanPresensi', ['presensi' => $presensi, 'start_date' => $start_date, 'end_date' => $end_date, 'personil' => $personil])->render();
        $pdf = new PDF;
        $pdf::SetTitle('Laporan Presensi');
        $pdf::AddPage();
        $pdf::writeHTML($html);
        $pdf::Output(public_path($filename), 'F');
        return response()->download(public_path($filename));
    }


    public function CetakExcel()
    {
        $presensi = Presensi::where('data_state', 0)->get();
        $personil = Personil::select('name', 'personil_id')
            ->where('data_state', 0)
            ->get();

        if (!Session::get('laporan_personil_id')) {
            $personil_id = null;
        } else {
            $personil_id = Session::get('laporan_personil_id');
            $presensi = $presensi->where('personil_id', $personil_id);
        }

        if (!Session::get('start_date')) {
            $start_date = date('Y-m-d');
        } else {
            $start_date = Session::get('start_date');
        }

        if (!Session::get('end_date')) {
            $end_date = date('Y-m-d');
            $stop_date = date('Y-m-d', strtotime($end_date . ' +1 day'));
        } else {
            $end_date = Session::get('end_date');
            $stop_date = date('Y-m-d', strtotime($end_date . ' +1 day'));
        }

        $presensi = $presensi->where('date_time', '>=', $start_date)->where('date_time', '<=', $stop_date);


        $spreadsheet = new Spreadsheet();
        $activeWorksheet = $spreadsheet->getActiveSheet();

        $spreadsheet->getDefaultStyle()
            ->getFont()
            ->setName('Arial')
            ->setSize('12');
        $activeWorksheet->getColumnDimension('A')->setWidth(5);
        $activeWorksheet->getColumnDimension('B')->setWidth(20);
        $activeWorksheet->getColumnDimension('C')->setWidth(20);
        $activeWorksheet->getColumnDimension('D')->setWidth(20);
        $activeWorksheet->getColumnDimension('E')->setWidth(35);

        $activeWorksheet->setCellValue('A1', 'Laporan Presensi');
        $activeWorksheet->getStyle('A1')->getFont()->setSize('16')->setBold(true);
        $activeWorksheet->mergeCells('A1:E1');

        $activeWorksheet->setCellValue('A2', 'Periode ' . $start_date . ' s/d ' . $end_date);
        $activeWorksheet->getStyle('A2')->getFont()->setSize('12');
        $activeWorksheet->mergeCells('A2:E2');
        $activeWorksheet->getStyle('A1:A2')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

        $activeWorksheet
            ->setCellValue('A3', 'No')
            ->setCellValue('B3', 'Nama Personil')
            ->setCellValue('C3', 'Tanggal')
            ->setCellValue('D3', 'Waktu')
            ->setCellValue('E3', 'Keterangan');
        $activeWorksheet->getStyle('A3:E3')->getFont()->setBold(true);
        $activeWorksheet->getStyle('A3:E3')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
        $styleArray = [
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK,
                    'color' => ['argb' => '000000'],
                ],
            ],
        ];

        $cell = 4;
        $no = 1;
        foreach ($presensi as $presensis) {
            $activeWorksheet->getStyle('A' . $cell)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
            $activeWorksheet->getStyle('B' . $cell)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT);
            $activeWorksheet->getStyle('C' . $cell)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
            $activeWorksheet->getStyle('D' . $cell)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
            $activeWorksheet->getStyle('E' . $cell)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
            $activeWorksheet
                ->setCellValue('A' . $cell, $no)
                ->setCellValue('B' . $cell, $presensis->callPersonil['name'])
                ->setCellValue('C' . $cell, date('d-m-Y', strtotime($presensis['date_time'])))
                ->setCellValue('D' . $cell, date('H:i:s', strtotime($presensis['date_time'])))
                ->setCellValue('E' . $cell, $presensis['information']);
            $no++;
            $cell++;
        }

        $lastCell = $cell - 1;

        $activeWorksheet->getStyle('A3:E' . $lastCell)->applyFromArray($styleArray);
        $writer = new Xlsx($spreadsheet);
        $writer->save('Laporan Presensi.xlsx');
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="Laporan Presensi.xlsx"');
        header('Cache-Control: max-age=0');

        $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xlsx');
        $writer->save('php://output');
    }

}