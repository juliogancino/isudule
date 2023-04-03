<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Exports\ProfesviewExport;
use Maatwebsite\Excel\Facades\Excel;

use App\Models\Profesor;
use App\Models\Carrera;
use App\Models\User;
use App\Models\Horas;
use App\Models\Clase;
use App\Models\Periodo;


class ProfesorController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $request->user()->authorizeRoles(['user', 'admin','cord']);
        $profesores = Profesor :: where('activo',1)->get();
        $periodos = Periodo :: orderBy('anio','asc')
        ->orderBy('periodo','asc')->get();
        return view('back/profesorlist', compact('profesores','periodos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $request->user()->authorizeRoles(['admin','cord']);
        $carreras = Carrera :: where('activo',1)->get();
        $tiempos=config('global.docetiempo');  

        return view('back/profesornew',compact('carreras','tiempos'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request,$id)
    {
        $request->user()->authorizeRoles(['admin','cord']);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * Show the specified schedule from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showhorario(Request $request)//$id,$mod
    {
        $profesor = Profesor:: where('id',$request->id)->first();
      
        $horas = Horas::where('activo','1')
        //->where('modalidad','=',$mod)
        ->orderBy('dia')
        ->orderBy('hora_ini')->get();
        $dias=config('global.dias');   
        $colors=config('global.colors');   
        $periodo_id = $request->periodo_id;
        $periodo = Periodo :: where('id',$periodo_id)->first();
        $nombrep=$periodo->anio.'-'.$periodo->periodo;
       return view('back/profesorhorario',compact('profesor','dias','horas','periodo_id','colors','nombrep'));
    }

    /**
     * Show the specified schedule from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
   /*  public function updateHorasProfe($id,$peri)
    {
      
        $clases = Clase::where('profesor_id',$id)
        ->where('periodo_id','=',$peri)->get();
        $suma=0;
        foreach ($clases as $cla) {
            $horaclase= Horas:: where ('id',$cla->horario_id)->first();
            if ($horaclase->count()>0){
                $suma = $suma + $horaclase->horaclase;
            }
            
        }
        $suma = $suma/60;
        $horassemana=config('global.horassemana'); 

        $profesor = Profesor:: find($id);
        $profesor->hdocencia=$suma;
        $profesor->hgestion=$horassemana-$suma - $profesor->hinvestiga - $profesor->hvincula;
        $res = $profesor->save();
        if ($res){
            return back();
        }else{
            return back()->with('mensaje','No se pudo actualizar las horas');
        }
               
    } */

    public function updateHorasProfedos(Request $request)
    {
      
        $clases = Clase::where('profesor_id',$request->id)
        ->where('periodo_id','=',$request->periodo_id)->get();
        $suma=0;
        foreach ($clases as $cla) {
            $horaclase= Horas:: where ('id',$cla->horario_id)->first();
            if ($horaclase->count()>0){
                $suma = $suma + $horaclase->horaclase;
            }
            
        }
        $suma = $suma/60;
        $horassemana=config('global.horassemana'); 

        $profesor = Profesor:: find($request->id);
        $profesor->hdocencia=$suma;
        $profesor->hgestion=$horassemana-$suma - $profesor->hinvestiga - $profesor->hvincula;
        $res = $profesor->save();
        if ($res){
            return back();
        }else{
            return back()->with('mensaje','No se pudo actualizar las horas');
        }
               
    }

    /**
     * Exporta horario a excel de un profe
     */
    public function exportProfesor(Request $request) 
    {
        $profesor = Profesor :: where('id',$request->id)->first();
        $id=$request->id;
        $periodo_id=$request->periodo_id;
        if($profesor){
            $nombreFile=$profesor->nombre.'-'.$profesor->apellido.'.xlsx';      
            //dd($request);     
            return Excel::download(new ProfesviewExport($id,$periodo_id), $nombreFile);
        }else{
            return back()->with('mensaje','No se puedo exportar a Excel');
        }
        
    }
}
