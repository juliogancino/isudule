<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profesor extends Model
{
    use HasFactory;

    public function clases()
    {
        return $this->hasMany(Clase::class);
    }
    public function carrera()
    {
        return $this->hasMany(Carrera::class);
    }
}
