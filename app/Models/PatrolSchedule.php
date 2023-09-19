<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PatrolSchedule extends Model
{
    use HasFactory;

    protected $fillable=[
        'patrol_id',
        'location_id',
        'patrol_start_time',
        'patrol_end_time',
        'patrol_information',
    ];


    protected $table = 'patrol_schedule';
    public $timestamps = true;
    protected $primaryKey = 'patrol_schedule_id';


    public function callLocation()
    {
        return $this->belongsTo(Location::class, 'location_id');
    }
}
