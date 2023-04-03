<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Horario extends Model
{
    use HasFactory;

    public function clases()
    {
        return $this->hasMany(Clase::class);
    }

    public function carrera()
    {
        return $this->belongsTo(Carrera::class);
    }

    public function periodo()
    {
        return $this->belongsTo(Periodo::class);
    }
}
