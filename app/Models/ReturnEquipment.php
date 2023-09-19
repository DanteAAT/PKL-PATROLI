<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReturnEquipment extends Model
{
    use HasFactory;

    protected $fillable=[
        'return_equipment_id',
        'personil_id',
        'take_equipment_id',
        'return_date',
        'return_equipment_checklist',
        'information_per_item',
        'no_return_equipment',
    ];


    protected $table = 'return_equipment';
    public $timestamps = true;

    protected $primaryKey = 'return_equipment_id';

    public function callPersonil3()
    {
        return $this->belongsTo(Personil::class, 'personil_id');
    }
    public function callNoTakeEquipment()
    {
        return $this->belongsTo(TakeEquipment::class, 'take_equipment_id');
    }
}
