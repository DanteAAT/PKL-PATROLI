<?php

namespace App\Http\Controllers;

use App\Models\Location;
use Illuminate\Http\Request;
use PDF;
use TCPDF;
use SimpleSoftwareIO\QrCode\Facades\QrCode;


class LocationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $location = Location::where('data_state', 0)->get();
        return view('content/Location/ListLocation', compact('location'));
    }

    public function screenTambah()
    {
        $location = Location::where('data_state', 0)->get();
        return view('content/Location/TambahLocation', ['location' => $location]);
    }

    public function tambah(Request $request)
    {
        $request->validate([
            'location_name' => 'required',
            'longitude' => 'required',
            'latitude' => 'required',
            'location_information' => 'required',
        ]);

        $location = [
            'location_name' => $request->location_name,
            'location_floor' => $request->location_floor,
            'longitude' => $request->longitude,
            'latitude' => $request->latitude,
            'location_information' => $request->location_information,
        ];
        Location::create($location);
        return redirect()->to('/location');
    }

    public function update(Request $request, $location_id)
    {
        $request->validate([
            'location_name' => 'required',
            'location_floor' => 'required',
            'longitude' => 'required',
            'latitude' => 'required',
            'location_information' => 'required',
        ]);
        $location = [
            'location_name' => $request->location_name,
            'location_floor' => $request->location_floor,
            'longitude' => $request->longitude,
            'latitude' => $request->latitude,
            'location_information' => $request->location_information,
        ];
        Location::where('location_id', $location_id)->update($location);
        return redirect()->to('/location');
    }

    public function edit($location_id)
    {
        $location = Location::where('location_id', $location_id)->first();
        return view('content/Location/EditLocation', ['location' => $location]);
    }

    public function delete($location_id)
    {
        $location = ['data_state' => 1];
        Location::where('location_id', $location_id)->update($location);
        return redirect()->to('/location');
    }

    public function detail($location_id)
    {
        $location = Location::where('location_id', $location_id)->first();
        return view('content/Location/DetailLocation', ['location' => $location]);
    }

    public function scan($location_id)
{
    $location = Location::where('location_id', $location_id)->first();
    $filename = 'Location.pdf';

    $code = $location_id;

    $style = array(
        'border' => 0,
        'position' => 'C',
        'fgcolor' => array(0, 0, 0), 
        'bgcolor' => array(255, 255, 255), 
        'module_width' => 1, 
        'module_height' => 1, 
    );

    $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
    $pdf->SetTitle('Location');
    $pdf->AddPage();
    
    $pdf->SetFont('helvetica', '', 20);
    $pdf->Cell(0, 0, 'Scan Disini', 0, 1, 'C');
    $pdf->write2DBarcode($code, 'QRCODE,H', 20, 30, 80, 80, $style, 'N');
    
    $pdf->SetFont('helvetica', '', 15);
    $text = 'Lantai ' . $location['location_floor'];
    $pdf->Cell(0, 15, $text, 0, 1, 'C', 0); 
    $pdf->SetFont('helvetica', '', 20);
    $pdf->Cell(0, 15, $location['location_name'], 0, 1, 'C');
    $pdf->Output(public_path($filename), 'F');
    return response()->download(public_path($filename));
}

}