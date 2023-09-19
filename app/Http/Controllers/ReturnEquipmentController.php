<?php

namespace App\Http\Controllers;

use App\Models\Equipment;
use App\Models\EquipmentData;
use App\Models\Personil;
use App\Models\ReturnEquipment;
use App\Models\TakeEquipment;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ReturnEquipmentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {
        $return_equipment = ReturnEquipment::where('data_state', 0)->get();
        return view('content/ReturnEquipment/ListReturnEquipment', compact('return_equipment'));
    }


    public function indexReturnEquipment()
    {
        $take_equipment = TakeEquipment::where('data_state', 0)->get();
        return view('content/ReturnEquipment/ListChooseTakeEquipment', compact('take_equipment'));
    }


    public function screenTambah()
    {
        // $take_equipment_id = TakeEquipment::where('data_state', '=', 0)->get();
        // $equipment_data = EquipmentData::where('data_state', '=', 0)->where('take_equipment_id' , $take_equipment_id)->first();
        // return $equipment_data;
        $take_equipment_id = TakeEquipment::where('data_state', 0)->get();
        // $equipment_data = EquipmentData::where('data_state', 0)->where('take_equipment_id', $take_equipment_id)->get();
        $personil = Personil::where('data_state', 0)->get();
        // return $equipment_data;

        $return_equipment = ReturnEquipment::get();
        return view('content/ReturnEquipment/TambahReturnEquipment', compact('return_equipment', 'personil'));
    }

    public function tambahPilih(Request $request,$take_equipment_id)
    {
        $request->validate([
            'personil_id' => 'required',
            'information_per_item' => 'required',
        ]);
        $take_equipment = TakeEquipment::where('take_equipment_id', $take_equipment_id)->first();
        $return_equipment = [
            'personil_id' => $request->personil_id,
            'return_date' => date('Y-m-d H:i:s'),
            'return_equipment_checklist' => json_encode($request->return_equipment_checklist),
            'information_per_item' => $request->information_per_item,
            'take_equipment_id' => $take_equipment['take_equipment_id'],
        ];
        ReturnEquipment::create($return_equipment); 
        $statusTakeEquipment = [
            'status' => $request->status,
        ];
        TakeEquipment::where('take_equipment_id', $take_equipment_id)->update($statusTakeEquipment);
        return redirect()->to('/return-equipment')->with('msg', 'Pengembalian Berhasil');;
    }

    public function updateStatus(Request $request,$take_equipment_id)
    {
            
        $take_equipment = TakeEquipment::where('take_equipment_id', $take_equipment_id)->first();
            $newStatus = $request->input('newStatus');
        
            TakeEquipment::where('take_equipment_id', $take_equipment)
                ->update(['status' => $newStatus]);

                // return $newStatus;
            return response()->json(['message' => 'Status berhasil diperbarui']);
    }


    public function screenPilih($take_equipment_id)
    {
        $personil = Personil::where('data_state', 0)->get();
        $take_equipment = TakeEquipment::where('take_equipment_id', $take_equipment_id)->first();
        $equipment_data = EquipmentData::where('data_state', 0)->where('take_equipment_id', $take_equipment_id)->get();
        $return_equipment = ReturnEquipment::where('data_state', 0)->where('take_equipment_id',$take_equipment_id)->orderByDesc('return_equipment_id')->first();
        // return $return_equipment;
        return view('content/ReturnEquipment/TambahReturnEquipment', compact('take_equipment', 'personil', 'equipment_data', 'return_equipment'));
    }
}