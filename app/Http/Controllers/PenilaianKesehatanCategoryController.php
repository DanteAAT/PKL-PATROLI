<?php

namespace App\Http\Controllers;

use App\Models\PenilaianKesehatanCategory;
use Illuminate\Http\Request;

class PenilaianKesehatanCategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {
        $penilaian_kesehatan_category = PenilaianKesehatanCategory::where('data_state',0)->get();
        return view('content/PenilaianKesehatanCategory/ListPenilaianKesehatanCategory', compact('penilaian_kesehatan_category'));
    }

    public function screenTambah()
    {
        $penilaian_kesehatan_category = PenilaianKesehatanCategory::where('data_state', 0)->get();
        return view('content/PenilaianKesehatanCategory/TambahPenilaianKesehatanCategory', compact('penilaian_kesehatan_category'));
    }

    public function tambah(Request $request)
    {
        $request->validate([
            'penilaian_kesehatan_category_code' => 'required',
            'penilaian_kesehatan_category_name' => 'required',
            'penilaian_kesehatan_category_information' => 'required',
        ]);

        $penilaian_kesehatan_category = [
            'penilaian_kesehatan_category_code' => $request->penilaian_kesehatan_category_code,
            'penilaian_kesehatan_category_name' => $request->penilaian_kesehatan_category_name,
            'penilaian_kesehatan_category_information' => $request->penilaian_kesehatan_category_information,
           ];
        PenilaianKesehatanCategory::create($penilaian_kesehatan_category);
        return redirect()->to('/kategori-penilaian-kesehatan')->with('msg','Tambah Penilaian Kesehatan Category Sukses');
    }

    public function update(Request $request, $penilaian_kesehatan_category_id)
    {
        $request->validate([
            'penilaian_kesehatan_category_code' => 'required',
            'penilaian_kesehatan_category_name' => 'required',
            'penilaian_kesehatan_category_information' => 'required',
        ]);    
        $penilaian_kesehatan_category = [
            'penilaian_kesehatan_category_code' => $request->penilaian_kesehatan_category_code,
            'penilaian_kesehatan_category_name' => $request->penilaian_kesehatan_category_name,
            'penilaian_kesehatan_category_information' => $request->penilaian_kesehatan_category_information,
           ];
        PenilaianKesehatanCategory::where('penilaian_kesehatan_category_id', $penilaian_kesehatan_category_id)->update($penilaian_kesehatan_category);
        return redirect()->to('/kategori-penilaian-kesehatan')->with('msg','Edit Penilaian Kesehatan Category Sukses!');
    }

    public function edit($penilaian_kesehatan_category_id)
    {
        $penilaian_kesehatan_category = PenilaianKesehatanCategory::where('penilaian_kesehatan_category_id', $penilaian_kesehatan_category_id)->first();
        return view('content/PenilaianKesehatanCategory/EditPenilaianKesehatanCategory', compact('penilaian_kesehatan_category'));
    }

    public function delete($penilaian_kesehatan_category_id)
    {
        $penilaian_kesehatan_category = ['data_state' => 1];
        PenilaianKesehatanCategory::where('penilaian_kesehatan_category_id', $penilaian_kesehatan_category_id)->update($penilaian_kesehatan_category);
        return redirect()->to('/kategori-penilaian-kesehatan')->with('C','Hapus Penilaian Kesehatan Category Sukses!');
    }

}
