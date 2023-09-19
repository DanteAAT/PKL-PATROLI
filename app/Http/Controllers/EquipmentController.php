<?php

namespace App\Http\Controllers;

use App\Models\Equipment;
use App\Models\Personil;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class EquipmentController extends Controller
{
   
    public function index()
    {
        $Equipment = Equipment::where('data_state', '=', 0)->get();
        foreach ($Equipment as $Equipments) {
            $personil = Personil::where('personil_id', $Equipments->last_take_name)->first();
            $Equipments->personil_name = $personil ? $personil->personil_name : '-';
        }
        // $personil = Personil::where('personil_id', $Equipment['last_take_name'])->first();
        return view('content/Equipment/ListEquipment', compact('Equipment', 'personil'));
    }
    
    public function screenTambah(Request $request)
    {
        $Personil = Personil::where('data_state', '=', 0)->get();
        return view('content/Equipment/TambahEquipment', compact('Personil'));
    }

    public function tambah(Request $request)
    {
        $request->validate([
            'equipment_name' => ['required', 'max:255'],
            'equipment_amount' => ['required', 'max:11'],
            'quality' => ['required', 'max:11'],
        ]);

        Equipment::create([
            'equipment_name' => $request->equipment_name,
            'equipment_amount' => $request->equipment_amount,
            'quality' => $request->quality,
            'equipment_information' => $request->equipment_information,
        ]);
        return redirect()->to('/equipment')->with('msg', 'Tambah Perlengkapan Sukses');
    }

    public function edit($equipment_id)
    {
        $Equipment = Equipment::where('equipment_id', $equipment_id)->first();
        return view('content/Equipment/EditEquipment', compact('Equipment'));
    }

    public function update(Request $request, $equipment_id)
    {
        $request->validate([
            'equipment_name' => ['required', 'max:255'],
            'equipment_amount' => ['required', 'max:11'],
            'quality' => ['required', 'max:11'],
        ]);

        $Equipment = [
            'equipment_name' => $request->equipment_name,
            'equipment_amount' => $request->equipment_amount,
            'quality' => $request->quality,
            'equipment_information' => $request->equipment_information,
        ];
        Equipment::where('equipment_id', $equipment_id)->update($Equipment);
        return redirect()->to('/equipment')->with('msg', 'Edit Perlengkapan Sukses');
    }

    public function detail($equipment_id)
    {
        $Equipment = Equipment::where('equipment_id', $equipment_id)->first();
        return view('content/Equipment/DetailEquipment', compact('Equipment'));
    }

    public function delete($equipment_id)
    {
        $Equipment = ['data_state' => 1];
        Equipment::where('equipment_id', $equipment_id)->update($Equipment);
        return redirect()->to('/equipment')->with('msg', 'Hapus Perlengkapan Sukses');
    }
}