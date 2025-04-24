<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Progresion extends Model
{
    //
    use HasFactory;
    protected $fillable = [
        'user_id',   
        'nombre',
        'uac',
        'num_progresion',
        'materia',
        'status',
        'documento',
        'instrumento_evaluacion',
    ];

    protected $casts = [
        'documento' => 'array',
        'instrumento_evaluacion' => 'array',
        'user_id' => 'integer',

    ];

    /**
     * The roles that belong to the Progresion
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'progresion_users', 'progresion_id', 'user_id');
    }
}
