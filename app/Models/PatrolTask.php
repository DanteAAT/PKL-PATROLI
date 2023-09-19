<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PatrolTask extends Model
{
    use HasFactory;

    protected $fillable = [
        'patrol_id',
        'task',
    ];


    protected $table = 'patrol_task';
    public $timestamps = true;
    protected $primaryKey = 'patrol_task_id';
}