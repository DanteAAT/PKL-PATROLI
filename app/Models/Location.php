<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    use HasFactory;

    protected $fillable=[
        'location_id',
        'location_name',
        'location_floor',
        'longitude',
        'latitude',
        'location_information',
    ];


    protected $table = 'location';
    public $timestamps = true;

    protected $primaryKey = 'location_id';

    public function callPatrolSchedule()
    {
        return $this->hasMany(PatrolSchedule::class, 'location_id');
    }

    public function callPresensi()
    {
        return $this->hasMany(Presensi::class, 'location_id');
    }
}