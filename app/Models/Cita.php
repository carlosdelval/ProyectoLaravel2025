<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Cita extends Model
{
    use HasFactory;
    protected $table = 'citas';

    protected $fillable = [
        'id',
        'user_id',
        'optica_id',
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

    public function optica()
    {
        return $this->belongsTo(Optica::class);
    }
}
