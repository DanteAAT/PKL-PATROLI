<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Personil extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'ttl',
        'gender',
        'phone_number',
        'address',
        'data_state',
    ];
    protected $table = 'personil';
    public $timestamps = true;

    protected $primaryKey = 'personil_id';


    public function callPersonilScheduling()
    {
        return $this->hasMany(PersonilScheduling::class, 'personil_id');
    }
    public function callPresensi()
    {
        return $this->hasMany(Presensi::class, 'personil_id');
    }
    public function callTakeEquipment()
    {
        return $this->hasMany(TakeEquipment::class, 'personil_id');
    }
    public function callReturnEquipment()
    {
        return $this->hasMany(ReturnEquipment::class, 'personil_id');
    }
    public function callPenilaianKesehatan()
    {
        return $this->hasMany(PenilaianKesehatan::class, 'personil_id');
    }
}
