<?php

namespace App\Http\Controllers;

use App\Models\EmergencyMessage;
use App\Models\Location;
use App\Models\PatrolSchedule;
use App\Models\PatrolTask;
use App\Models\PersonilScheduling;
use App\Models\Presensi;
use App\Models\User;
use Carbon\Carbon;

use Illuminate\Support\Facades\Session;
use DB;
use Illuminate\Http\Request;
use Twilio\Rest\Client;

use Illuminate\Support\Facades\Auth;

class EmergencyMessageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $emergency_message = EmergencyMessage::where('data_state', 0)->get();
        return view('content/EmergencyMessage/ListEmergencyMessage', compact('emergency_message'));
    }

    public function screenTambah()
    {
        $emergency_message = EmergencyMessage::get();
        return view('content/EmergencyMessage/TambahEmergencyMessage', ['emergency_message' => $emergency_message]);
    }

    public function tambah(Request $request)
    {
        $request->validate([
            'emergency_message_name' => 'required',
            'emergency_message_phone_number' => 'required',
            'emergency_message_text' => 'required',
        ]);

        $emergency_message = [
            'emergency_message_name' => $request->emergency_message_name,
            'emergency_message_phone_number' => $request->emergency_message_phone_number,
            'emergency_message_text' => $request->emergency_message_text,
        ];
        EmergencyMessage::create($emergency_message);
        return redirect()->to('/emergency-message');
    }


    public function update(Request $request, $emergency_message_id)
    {
        $request->validate([
            'emergency_message_name' => 'required',
            'emergency_message_phone_number' => 'required',
            'emergency_message_text' => 'required',
        ]);
        $emergency_message = [
            'emergency_message_name' => $request->emergency_message_name,
            'emergency_message_phone_number' => $request->emergency_message_phone_number,
            'emergency_message_text' => $request->emergency_message_text,
        ];
        EmergencyMessage::where('emergency_message_id', $emergency_message_id)->update($emergency_message);
        return redirect()->to('/emergency-message');
    }

    public function edit($emergency_message_id)
    {
        $emergency_message = EmergencyMessage::where('emergency_message_id', $emergency_message_id)->first();
        return view('content/EmergencyMessage/EditEmergencyMessage', ['emergency_message' => $emergency_message]);
    }

    public function delete($emergency_message_id)
    {
        $emergency_message = ['data_state' => 1];
        EmergencyMessage::where('emergency_message_id', $emergency_message_id)->update($emergency_message);
        return redirect()->to('/emergency-message');
    }

    public function detail($emergency_message_id)
    {
        $emergency_message = EmergencyMessage::where('emergency_message_id', $emergency_message_id)->first();
        return view('content/EmergencyMessage/DetailEmergencyMessage', ['emergency_message' => $emergency_message]);
    }
    public function kirimPesan(Request $request,$emergency_message_id)
    {
        $teslokasi = Session::get('location_id_presensi');
        $location_name = DB::table('location')->where('location_id', $teslokasi)->value('location_name');
        $emergency_message = EmergencyMessage::where('emergency_message_id',$emergency_message_id)->first();   
        $phone_number = $emergency_message->emergency_message_phone_number; 
        $emergency_text = $emergency_message->emergency_message_text; 
        $token = "q#dXRhVLu7_8kWx_m4Q@";
        $target = "$phone_number";
        $curl = curl_init();
        
        curl_setopt_array($curl, array(
          CURLOPT_URL => 'https://api.fonnte.com/send',
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => 'POST',
          CURLOPT_POSTFIELDS => array(
        'target' => $target,
        'message' => $emergency_text . "\nlokasinya : " . $location_name,
        ),
          CURLOPT_HTTPHEADER => array(
            "Authorization: $token"
          ),
        ));
        
        $response = curl_exec($curl);
        
        curl_close($curl);

        echo 'Pesan Darurat Sudah Terkirim';
    }

}