<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JadwalPenilaianKesehatan extends Model
{
    use HasFactory;

    protected $fillable=[
        'period_month',
        'period_year',
    ];


    protected $table = 'penilaian_kesehatan_schedule';
    public $timestamps = true;

    protected $primaryKey = 'penilaian_kesehatan_schedule_id';

    public function callPenilaianKesehatan()
    {
        return $this->hasMany(PenilaianKesehatan::class, 'penilaian_kesehatan_schedule_id');
    }
}