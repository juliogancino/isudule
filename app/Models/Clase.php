<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Clase extends Model
{
    use HasFactory;

    public function profesor()
    {
        return $this->belongsTo(Profesor::class);
    }

    public function horario()
    {
        return $this->belongsTo(Horario::class);
    }

    public function hora()
    {
        return $this->belongsTo(Horas::class);
    }

    public function materia()
    {
        return $this->belongsTo(Materia::class);
    }
}
