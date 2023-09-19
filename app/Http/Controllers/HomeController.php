<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use App\Models\JadwalPenilaianKesehatan;
use App\Models\PenilaianKesehatan;
use App\Models\Personil;
use App\Models\Product;
use App\Models\ProductStock;
use App\Models\SalesItem;
use DB;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\Console\Helper\Table;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        $berita = Berita::where('data_state', 0)->whereDate('start_date_show', '<=', now())->whereDate('last_date_show', '>=', now())->get();


        $penilaian_kesehatan = PenilaianKesehatan::select(
            'penilaian_kesehatan.*', 
            'personil.name',
            'penilaian_kesehatan_category.penilaian_kesehatan_category_name'
        )
        ->join('personil', 'penilaian_kesehatan.personil_id', '=', 'personil.personil_id')
        ->join('penilaian_kesehatan_category', 'penilaian_kesehatan.penilaian_kesehatan_category_id', '=', 'penilaian_kesehatan_category.penilaian_kesehatan_category_id')
        ->where('penilaian_kesehatan.data_state', 0)    
        ->orderBy('personil.personil_id')
        ->get();
        
        $jadwal_penilaian_kesehatan = JadwalPenilaianKesehatan::where('data_state', 0)->get();
        


        //START USER 
        $menus = User::select('system_menu_mapping.*', 'system_menu.*')
            ->join('system_user_group', 'system_user_group.user_group_id', '=', 'system_user.user_group_id')
            ->join('system_menu_mapping', 'system_menu_mapping.user_group_level', '=', 'system_user_group.user_group_level')
            ->join('system_menu', 'system_menu.id_menu', '=', 'system_menu_mapping.id_menu')
            ->where('system_user.user_id', '=', Auth::id())
            ->orderBy('system_menu_mapping.id_menu', 'ASC')
            ->get();
        //END USER 

        return view('home', compact('menus', 'berita', 'penilaian_kesehatan', 'jadwal_penilaian_kesehatan'));
    }
}