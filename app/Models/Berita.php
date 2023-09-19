<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Berita extends Model
{
    use HasFactory;
    protected $fillable=[
        'berita_id',
        'file',
        'information_berita',
        'start_date_show',
        'last_date_show',
    ];


    protected $table = 'berita';
    public $timestamps = true;

    protected $primaryKey = 'berita_id';
}
