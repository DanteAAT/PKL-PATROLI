<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Casts\Attribute;

class PersonilScheduling extends Model
{
    use HasFactory;

    protected $fillable = [
        'personil_id',
        'patrol_id',
        'patrol_day',
    
    ];
    protected $table = 'personil_scheduling';
    public $timestamps = true;

    protected $primaryKey = 'personil_scheduling_id';

    public function callPersonil()
    {
        return $this->belongsTo(Personil::class, 'personil_id');
    }
    public function callPatrol()
    {
        return $this->belongsTo(Patrol::class, 'patrol_id');
    }
}
