<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistorialVista extends Model
{
    use HasFactory;

    protected $table = 'historial_vista';

    protected $fillable = [
        'id',
        'user_id',
        'cita_id',
        'eje',
        'cilindro',
        'esfera',
        'documentacion'
    ];

    // Relación con el usuario
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relación con la cita
    public function cita()
    {
        return $this->belongsTo(Cita::class);
    }
}
