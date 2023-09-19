<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use Illuminate\Http\Request;

class BeritaController extends Controller
{
    public function index()
    {
        $berita = Berita::where('data_state', 0)->get();
        return view('content/Berita/ListBerita', compact('berita'));
    }

    public function screenTambah()
    {
        $berita = Berita::where('data_state', 0)->get();
        return view('content/Berita/TambahBerita', compact('berita'));
    }

    public function tambah(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:png,jpeg,jpg,gif,mp4,webm',
            'information_berita' => 'required',
            'start_date_show' => 'required',
            'last_date_show' => 'required',
        ]);

        $file = $request->file('file');
        $file->move('upload', $file->getClientOriginalName());
        $file_name = $file->getClientOriginalName();

        $berita = [
            'file' => $file_name,
            'information_berita' => $request->information_berita,
            'start_date_show' => $request->start_date_show,
            'last_date_show' => $request->last_date_show,
        ];
        Berita::create($berita);
        return redirect()->to('/berita');
    }


    public function update(Request $request, $berita_id)
    {
        $request->validate([
            // 'file' => 'required|mimes:png,jpeg,jpg,gif,mp4,webm',
            'information_berita' => 'required',
            'start_date_show' => 'required',
            'last_date_show' => 'required',
        ]);

        $file = $request->file('file');
        $file_name = $request->input('existing_file'); // Ambil nama file yang ada sebelumnya

        
        if ($file) {
            $file->move('upload', $file->getClientOriginalName());
            $file_name = $file->getClientOriginalName();
        }

        $berita = [
            'file' => $file_name,
            'information_berita' => $request->information_berita,
            'start_date_show' => $request->start_date_show,
            'last_date_show' => $request->last_date_show,
        ];
        Berita::where('berita_id', $berita_id)->update($berita);
        return redirect()->to('/berita');
    }

    public function edit($berita_id)
    {
        $berita = Berita::where('berita_id', $berita_id)->first();
        return view('content/Berita/EditBerita', ['berita' => $berita]);
    }

    public function delete($berita_id)
    {
        $berita = ['data_state' => 1];
        Berita::where('berita_id', $berita_id)->update($berita);
        return redirect()->to('/berita');
    }

    public function detail($berita_id)
    {
        $berita = Berita::where('berita_id', $berita_id)->first();
        return view('content/Berita/DetailBerita', ['berita' => $berita]);
    }


}