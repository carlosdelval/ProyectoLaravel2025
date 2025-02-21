<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Optica extends Model
{

    use HasFactory;

    protected $fillable = ['nombre', 'direccion', 'telefono'];

    public function citas()
    {
        return $this->belongsToMany(Cita::class, 'optica_cita')->withTimestamps();
    }


}
