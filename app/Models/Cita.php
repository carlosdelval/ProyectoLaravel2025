<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cita extends Model
{
    protected $table = 'citas';

    protected $fillable = [
        'id',
        'user_id',
        'fecha',
        'hora',
        'graduada'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function historialVista()
    {
        return $this->hasOne(HistorialVista::class);
    }
}
