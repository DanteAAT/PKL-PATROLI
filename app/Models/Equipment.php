<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Equipment extends Model
{
    use HasFactory;
    protected $fillable = [
        'equipment_name',
        'equipment_amount',
        'equipment_information',
        'last_take_name',
        'last_take_date',
        'quality',
        'data_state',
    ];
    protected $table = 'equipment';
    public $timestamps = true;

    protected $primaryKey = 'equipment_id';


    public function callTakeEquipment()
    {
        return $this->hasMany(TakeEquipment::class, 'equipment_id');
    }
}
