<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProgresionUser extends Model
{
    //
    use HasFactory;
    protected $fillable = [
        'progresion_id',
        'user_id',
    ];

    protected $casts = [
        'progresion_id' => 'integer',
        'user_id' => 'integer',
    ];
}
