<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Clase;

class BladeProfeClaseController extends Controller
{
    public function getClase( $hora_id,$dia, $profesor_id, $periodo_id)
    {
        $clase = Clase:: where('horario_id',$hora_id)
        ->where('dia',$dia)
        ->where('profesor_id',$profesor_id)
        ->where('periodo_id',$periodo_id)
        ->get();     
        
        return $clase;
    }
}
