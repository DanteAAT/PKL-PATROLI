<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TakeEquipment extends Model
{
    use HasFactory;

    protected $fillable = [
        'personil_id',
        'patrol_id',
        'date_and_time_pick_up',
        'no_take_equipment',
        'status',
    ];
    protected $table = 'take_equipment';
    public $timestamps = true;

    protected $primaryKey = 'take_equipment_id';


    public function callPersonil2()
    {
        return $this->belongsTo(Personil::class, 'personil_id');
    }
    public function callEquipment()
    {
        return $this->belongsTo(Equipment::class, 'equipment_id');
    }
    public function callPatrol()
    {
        return $this->belongsTo(Patrol::class, 'patrol_id');
    }
    public function callReturnEquipment()
    {
        return $this->hasMany(ReturnEquipment::class, 'take_equipment_id');
    }

    

}
