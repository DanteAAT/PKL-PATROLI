<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EquipmentData extends Model
{
    use HasFactory;

    protected $fillable = [
        'take_equipment_id',
        'equipment_id',
    ];
    protected $table = 'equipment_data';
    public $timestamps = true;

    protected $primaryKey = 'equipment_data_id';


}
