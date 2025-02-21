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
        return $this->hasMany(Cita::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'optica_user')->withTimestamps();
    }

}
