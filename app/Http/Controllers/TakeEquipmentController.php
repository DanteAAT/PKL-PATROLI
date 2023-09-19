<?php

namespace App\Http\Controllers;

use App\Models\Equipment;
use App\Models\EquipmentData;
use App\Models\Patrol;
use App\Models\PatrolSchedule;
use App\Models\Personil;
use App\Models\TakeEquipment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;

class TakeEquipmentController extends Controller
{
    public function index()
    {
        $take_equipment = TakeEquipment::where('data_state', 0)->get();
        return view('content/TakeEquipment/ListTakeEquipment', compact('take_equipment'));
    }

    public function screenTambah()
    {
        if (!Session::get('take_equipment_input')) {
            $take_equipment_input = [];
        } else {
            $take_equipment_input = Session::get('take_equipment_input');
        }
        if (!Session::get('patrol_name')) {
            $patrol_name = '';
        } else {
            $patrol_name = Session::get('patrol_name');
        }

        if (!Session::get('take_equipment')) {
            $take_equipment = [];
        } else {
            $take_equipment = Session::get('take_equipment');
        }
        if (!Session::get('equipment_data')) {
            $equipment_data = [];
        } else {
            $equipment_data = Session::get('equipment_data');
        }

        // if (!Session::get('patrol_name')) {
        //     $patrol_name = [];
        // } else {
        //     $patrol_name = Session::get('patrol_name');
        // }
        $personil = Personil::where('data_state', 0)->get();
        $equipment = Equipment::where('data_state', 0)->get();
        $patrol_schedule = PatrolSchedule::where('data_state', 0)->get();
        $patrol = Patrol::where('data_state', 0)->get();




        return view('content/TakeEquipment/TambahTakeEquipment', compact('personil', 'equipment', 'patrol_schedule', 'take_equipment', 'patrol', 'equipment_data', 'take_equipment_input', 'patrol_name'));
    }


    public function sessionList(Request $request)
    {
        $request->validate([
            'personil_id' => 'required',
            'equipment_id' => 'required',
            'patrol_id' => 'required',
        ]);

        $personil = Personil::where('data_state', 0)->where('personil_id', $request->personil_id)->first();
        $patrol = Patrol::where('data_state', 0)->where('patrol_id', $request->patrol_id)->first();
        $equipment = Equipment::where('data_state', 0)->where('equipment_id', $request->equipment_id)->first();


        $lastdataTakeEquipment = Session::get('take_equipment');
        if ($lastdataTakeEquipment != null) {
            $lastIndexTakeEquipment = collect($lastdataTakeEquipment)->sortByDesc('index')->first();
            $take_equipment = array(
                'index' => $lastIndexTakeEquipment['index'] + 1,
                'personil_id' => $request->personil_id,
                'name' => $personil->name,
                'equipment_id' => $request->equipment_id,
                'equipment_name' => $equipment->equipment_name,
                'patrol_id' => $request->patrol_id,
                'patrol_name' => $patrol->patrol_name,
                'date_and_time_pick_up' => date('Y-m-d H:i:s'),
            );
            array_push($lastdataTakeEquipment, $take_equipment);
            Session::put('take_equipment', $lastdataTakeEquipment);
        } else {
            // $lastdataTakeEquipment = [];
            $take_equipment = array(
                'index' => 0,
                'personil_id' => $request->personil_id,
                'name' => $personil->name,
                'equipment_id' => $request->equipment_id,
                'equipment_name' => $equipment->equipment_name,
                'patrol_id' => $request->patrol_id,
                'patrol_name' => $patrol->patrol_name,
                'date_and_time_pick_up' => date('Y-m-d H:i:s'),
            );
            // array_push($lastdataTakeEquipment, $take_equipment);
            Session::push('take_equipment', $take_equipment);
        }
        // dd(Session::get('take_equipment'));
        return redirect('/take-equipment/tambah');
    }

    public function tambah(Request $request)
    {

        // if ( Session::get('take_equipment_input') && Session::get('equipment_data')) {
        //     $take_equipment_input = Session::get('take_equipment_input');
        //     foreach ($take_equipment_input as $take_equipment_inputs) {
        //             $create_take_equipment = [
        //                 'personil_id' => $take_equipment_inputs['personil_id'],
        //                 'patrol_id' => $take_equipment_inputs['patrol_id'],
        //                 // 'date_and_time_pick_up' => $take_equipment_inputs['date_and_time_pick_up'],
        //                 'date_and_time_pick_up' => date('Y-m-d H:i:s'),
        //             ];
        //             TakeEquipment::create($create_take_equipment);
        //     }

        //     $equipment_data = Session::get('equipment_data');
        //     $getTakeEquipmentId = TakeEquipment::orderByDesc('take_equipment_id')->value('take_equipment_id');

        //     foreach ($equipment_data as $equipment_datas) {
        //     $create_equipment_data=[
        //         'take_equipment_id' => $getTakeEquipmentId,
        //         'equipment_id' => $equipment_datas['equipment_id'],
        //     ];
        //     EquipmentData::create($create_equipment_data);
        // }
        
        //     $current_equipment = Equipment::where('equipment_id', $equipment_datas['equipment_id'])->first();
        //     $current_quantity = $current_equipment->equipment_amount;
        //     $new_quantity = $current_quantity - 1;
        //     Equipment::where('equipment_id', $equipment_datas['equipment_id'])->update(['equipment_amount' => $new_quantity]);
        //     Session::forget('take_equipment');
        //     Session::forget('equipment_data');
        //     return redirect()->to('/take-equipment')->with('msg', 'Tambah Ambil Perlengkapan Sukses');
        // } else {
        //     return redirect()->to('/take-equipment/tambah')->with('msg', 'Tidak boleh kosong!');
        // }
        if (Session::get('take_equipment_input') && Session::get('equipment_data')) {
            $take_equipment_input = Session::get('take_equipment_input');
        
            foreach ($take_equipment_input as $take_equipment_inputs) {
                $create_take_equipment = [
                    'personil_id' => $take_equipment_inputs['personil_id'],
                    'patrol_id' => $take_equipment_inputs['patrol_id'],
                    'date_and_time_pick_up' => $take_equipment_inputs['date_and_time_pick_up'],
                ];
                TakeEquipment::create($create_take_equipment);
            }
        
            $equipment_data = Session::get('equipment_data');
            $getTakeEquipmentId = TakeEquipment::orderByDesc('take_equipment_id')->value('take_equipment_id');
            foreach ($equipment_data as $equipment_datas) {
                $equipment_id = $equipment_datas['equipment_id'];
                // $current_equipment = Equipment::where('equipment_id', $equipment_id)->first();
                // $current_quantity = $current_equipment->equipment_amount;
        
                // if ($current_quantity <= 0) {
                //     return redirect()->to('/take-equipment/tambah')->with('msg', 'Jumlah Perlengkapan tidak mencukupi!');
                // }
        
                $create_equipment_data = [
                    'take_equipment_id' => $getTakeEquipmentId,
                    'equipment_id' => $equipment_id,
                ];
                EquipmentData::create($create_equipment_data);
                // $new_quantity = $current_quantity - 1;
                $updateEquipment = [
                    // 'equipment_amount' => $new_quantity,
                    'last_take_name' => $take_equipment_inputs['personil_id'],
                    'last_take_date' => $take_equipment_inputs['date_and_time_pick_up'],
                ];
                Equipment::where('equipment_id', $equipment_id)->update($updateEquipment);
            }
        
            Session::forget('take_equipment_input');
            Session::forget('equipment_data');
            return redirect()->to('/take-equipment')->with('msg', 'Tambah Ambil Perlengkapan Sukses');
        } else {
            return redirect()->to('/take-equipment/tambah')->with('msg', 'Tidak boleh kosong!');
        }
        
    }


    public function equipmentIdSession(Request $request)
    {
        $request->validate([
            'equipment_id' => 'required',
        ]);

        $lastEquipmentData = Session::get('equipment_data');
        $equipment = Equipment::where('data_state', 0)->where('equipment_id', $request->equipment_id)->first();

        if ($lastEquipmentData != null) {
            $lastIndex = collect($lastEquipmentData)->sortByDesc('index')->first();
            $equipment_data = [
                'index' => $lastIndex['index'] + 1,
                'equipment_id' => $request->equipment_id,
                'equipment_name' => $equipment->equipment_name,
            ];
            array_push($lastEquipmentData, $equipment_data);
            Session::put('equipment_data', $lastEquipmentData);
        } else {
            $equipment_data = [
                'index' => 0,
                'equipment_id' => $request->equipment_id,
                'equipment_name' => $equipment->equipment_name,
            ];
            Session::push('equipment_data', $equipment_data);
        }
    }

    public function takeEquipmentInput(Request $request)
    {

        $sessionTake_equipment_input = Session::get('take_equipment_input');
        $personil = Personil::where('data_state', 0)->where('personil_id', $request->personil_id)->first();
        $patrol = Patrol::where('data_state', 0)->where('patrol_id', $request->patrol_id)->first();
        $take_equipment_input[] = [
            'personil_id' => $request->personil_id,
            'name' => $personil->name,
            'patrol_id' => $request->patrol_id,
            'patrol_name' => $patrol->patrol_name,
            'date_and_time_pick_up' => date('Y-m-d H:i:s'),
        ];
        Session::put('take_equipment_input', $take_equipment_input);
        return redirect('/take-equipment/tambah');        
    }


    public function deleteIdEquipment($index)
    {
        $equipment_data = Session::get('equipment_data');
        unset($equipment_data[$index]);
        Session::put('equipment_data', $equipment_data);
        return redirect()->to('/take-equipment/tambah');
    }

}