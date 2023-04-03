<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Profesor;

class BladeProfeHorasController extends Controller
{
    public function getHorasProfeAjax(Request $request) {
        
        if ($request->ajax()){
            $horas= Profesor::where('id',$request->id)->get();
           
            return response()->json($horas);
        }
    }   

    public function index(Request $request)
    {
        $profesores = Profesor::where('id',$request->id)->get();
        return response()->json($profesores);
    }

}
