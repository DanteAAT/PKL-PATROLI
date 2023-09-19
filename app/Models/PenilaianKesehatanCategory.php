<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenilaianKesehatanCategory extends Model
{
    use HasFactory;

    protected $fillable=[
        'penilaian_kesehatan_category_id',
        'penilaian_kesehatan_category_code',
        'penilaian_kesehatan_category_name',
        'penilaian_kesehatan_category_information',
    ];


    protected $table = 'penilaian_kesehatan_category';
    public $timestamps = true;

    protected $primaryKey = 'penilaian_kesehatan_category_id';

    public function callPenilaianKesehatan()
    {
        return $this->hasMany(PenilaianKesehatan::class, 'penilaian_kesehatan_category_id');
    }
}
