<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patrol extends Model
{
    use HasFactory;

    protected $fillable=[
        'patrol_name',
    ];


    protected $table = 'patrol';
    public $timestamps = true;
    protected $primaryKey = 'patrol_id';

    public function callPersonilScheduling()
    {
        return $this->hasMany(PersonilScheduling::class, 'patrol_id');
    }

    public function callPresensi()
    {
        return $this->hasMany(Presensi::class, 'patrol_id');
    }
    public function callTakeEquipment()
    {
        return $this->hasMany(TakeEquipment::class, 'patrol_id');
    }
}