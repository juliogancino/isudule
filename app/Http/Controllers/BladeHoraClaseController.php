<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Clase;
use App\Models\Profesor;


class BladeHoraClaseController extends Controller
{
    public function getClaseProfe( $hora_id,$dia, $h_id)
    {
        $clase = Clase:: where('horario_id',$hora_id)
        ->where('dia',$dia)
        ->where('h_id',$h_id)
        ->get();     
        
        return $clase;
    }
}
