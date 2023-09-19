<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenilaianKesehatan extends Model
{
    use HasFactory;

    protected $fillable=[
        'personil_id',
        'penilaian_kesehatan_category_id',
        'penilaian_kesehatan_schedule_id',
        'value',
    ];


    protected $table = 'penilaian_kesehatan';
    public $timestamps = true;

    protected $primaryKey = 'penilaian_kesehatan_id';

    public function callPersonilPenilaianKesehatan()
    {
        return $this->belongsTo(Personil::class, 'personil_id');
    }
    public function callJadwalPenilaianKesehatan()
    {
        return $this->belongsTo(JadwalPenilaianKesehatan::class, 'penilaian_kesehatan_schedule_id');
    }
    public function callKategoriPenilaianKesehatan()
    {
        return $this->belongsTo(PenilaianKesehatanCategory::class, 'penilaian_kesehatan_category_id');
    }
}
