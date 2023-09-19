<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmergencyMessage extends Model
{
    use HasFactory;

    protected $fillable = [
        'emergency_message_name',
        'emergency_message_phone_number',
        'emergency_message_text',
        ];
    protected $table = 'emergency_message';
    public $timestamps = true;
    protected $primaryKey = 'emergency_message';


}
