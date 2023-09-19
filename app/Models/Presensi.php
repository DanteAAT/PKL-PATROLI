<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Presensi extends Model
{
    use HasFactory;
    protected $fillable = [
        'personil_scheduling_id',
        'patrol_id',
        'location_id',
        'personil_id',
        'date_time',
        'checked',
        'information',
        'data_state',
    ];
    protected $table = 'presensi';
    public $timestamps = true;

    protected $primaryKey = 'presensi_id';

    public function callPersonil()
    {
        return $this->belongsTo(Personil::class, 'personil_id');
    }

    public function callPatrol()
    {
        return $this->belongsTo(Patrol::class, 'patrol_id');
    }

    public function callLocation()
    {
        return $this->belongsTo(Location::class, 'location_id');
    }
}