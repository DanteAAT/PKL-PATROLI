<?php

namespace App\Http\Controllers;

use App\Models\Personil;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class PersonilController extends Controller
{
   
    public function index()
    {
        $Personil = Personil::where('data_state', '=', 0)->get();
        return view('content/Personil/ListPersonil', compact('Personil'));
    }

    public function tambah(Request $request)
    {
        $request->validate([
            'name' => ['required', 'max:255'],
            'tempat' => ['required', 'max:230'],
            'tanggal' => ['required', 'date'],
            'gender' => ['required', 'max:5'],
            'phone_number' => ['required', 'max:15'],
            'address' => ['required', 'max:255']
        ]);

        $tanggal = Carbon::createFromFormat('Y-m-d', $request->tanggal)->format('d-m-Y');
        Personil::create([
            'name' => $request->name,
            'ttl' => strtoupper($request->tempat) . ', ' . $tanggal,
            'gender' => $request->gender,
            'phone_number' => $request->phone_number,
            'address' => strtoupper($request->address),
        ]);

        
        $getPersonil = Personil::where('data_state', 0)->where('name', $request->name)->orderBy('personil_id', 'desc')->first();
        User::create([
            'user_group_id' => 2,
            'personil_id' => $getPersonil->personil_id,
            'name' => $request->name,
            'phone_number' => $request->phone_number,
            'password' => Hash::make($request->name),
        ]);
        return redirect()->to('/personil')->with('msg', 'Tambah Personil Sukses');
    }

    public function edit($personil_id)
    {
        $Personil = Personil::where('personil_id', $personil_id)->first();
        $ttl = explode(", ", $Personil->ttl);
        return view('content/Personil/EditPersonil', compact('Personil', 'ttl'));
    }

    public function update(Request $request, $personil_id)
    {
        $request->validate([
            'name' => ['required', 'max:255'],
            'tempat' => ['required', 'max:230'],
            'tanggal' => ['required', 'date'],
            'gender' => ['required', 'max:5'],
            'phone_number' => ['required', 'max:15'],
            'address' => ['required', 'max:255']
        ]);

        $tanggal = Carbon::createFromFormat('Y-m-d', $request->tanggal)->format('d-m-Y');
        $Personil = [
            'name' => $request->name,
            'ttl' => strtoupper($request->tempat) . ', ' . $tanggal,
            'gender' => $request->gender,
            'phone_number' => $request->phone_number,
            'address' => strtoupper($request->address),
        ];
        Personil::where('personil_id', $personil_id)->update($Personil);
        return redirect()->to('/personil')->with('msg', 'Edit Personil Sukses');
    }

    public function detail($personil_id)
    {
        $Personil = Personil::where('personil_id', $personil_id)->first();
        $ttl = explode(", ", $Personil->ttl);
        return view('content/Personil/DetailPersonil', compact('Personil', 'ttl'));
    }

    public function delete($personil_id)
    {
        $Personil = ['data_state' => 1];
        Personil::where('personil_id', $personil_id)->update($Personil);
        return redirect()->to('/personil')->with('msg', 'Hapus Personil Sukses');
    }
}