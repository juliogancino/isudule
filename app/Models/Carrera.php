<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Carrera extends Model
{
    use HasFactory;

    public function horarios()
    {
        return $this->hasMany(Horarios::class);
    }

    public function profesores()
    {
        return $this->hasMany(Profesores::class);
    }
}
