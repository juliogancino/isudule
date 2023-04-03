<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Exports\ClasesExport;
use App\Exports\ClasesviewExport;
use Maatwebsite\Excel\Facades\Excel;

use App\Models\Clase;
use App\Models\Profesor;
use App\Models\Horas;
use App\Models\Materia;
use App\Models\User;
use App\Models\Horario;
use App\Models\Carrera;

class ClaseController extends Controller
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
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $buscar = Clase :: where ('profesor_id',$request->profesor_id)
        -> where ('horario_id',$request->horario_id)
        -> where ('materia_id',$request->materia_id)
        -> where ('carrera_id',$request->carrera_id)
        -> where ('dia',$request->dia)
        -> where ('h_id',$request->h_id)->get();
        $cant = $buscar->count();
      
        if ($cant>0){
            return back()->with('mensaje','La clase no pudo ser agregada, ya existe !!');
        }


        $nuevaclase=new Clase;
        $nuevaclase->descripcion=$request->descripcion;
        $nuevaclase->codigo=$request->codigo;
        $nuevaclase->nom_materia=$request->nom_materia;
        $nuevaclase->modalidad=$request->modalidad;
        $nuevaclase->horario_id=$request->horario_id;
        $nuevaclase->horariof_id=$request->horario_id;
        $nuevaclase->profesor_id=$request->profesor_id;
        $nuevaclase->materia_id=$request->materia_id;
        $nuevaclase->carrera_id=$request->carrera_id; 
        $nuevaclase->h_id=$request->h_id; 
        $nuevaclase->periodo_id=$request->periodo_id; 
        $nuevaclase->dia=$request->dia;
        $nuevaclase->tipo=$request->tipo;
        $nuevaclase->activo=1;
        $nuevaclase->user_id=auth()->user()->id; 
        $res=$nuevaclase->save();
        if ($res){

            //cuenta horas de clase
            $clases = Clase :: where('profesor_id',$request->profesor_id)
            ->where('periodo_id',$nuevaclase->periodo_id)->get();
            $suma=0;
            foreach ($clases as $cla) {
                $horaclase= Horas:: where ('id',$cla->horario_id)->first();
                if ($horaclase->count()>0){
                    $suma = $suma + $horaclase->horaclase;
                }
                
            }
            $totDocencia = $suma/60;
           
            $horassemana=config('global.horassemana'); 
                        
            //actualizar horas docencia
            $upDocenciaProfe = Profesor:: find($request->profesor_id);
            $totAdmin = $horassemana - $totDocencia - $upDocenciaProfe->hinvestiga - $upDocenciaProfe->hvincula;          
            $upDocenciaProfe->hdocencia = $totDocencia;
            $upDocenciaProfe->hgestion = $totAdmin;
            $resup=$upDocenciaProfe->save();
            /* if ($resup){
                dd('docencia actualizada');
            }
             */

            $modalidad=$request->modalidad;  
            switch ($modalidad) {
                case 'Presencial':
                    $mod=0;
                    break;
                case 'Semipresencial':
                    $mod=1;
                    break;
                case 'Linea':
                    $mod=2;
                    break;
                case 'Hibrida':
                    $mod=1;
                    break;
                default:
                    $mod=1;
                    break;
            }
            $hid=$request->h_id; 
            $carrera_id=$request->carrera_id; 
            $periodo_id=$request->periodo_id; 

            $carrera = Carrera :: where('id',$carrera_id)->first();
            $nomcarrera=$carrera->nombre;    

            $profesores = Profesor::where('activo',1)
                ->orderBy('nombre','asc')
                ->get();
            $horas = Horas::where('activo','1')
                ->where('num_cal','1')                
                ->where('modalidad',$mod)
                ->orderBy('hora_ini')->get();
            $materias = Materia::where('activo','1')
                ->where('carrera_id',$carrera_id)
                ->orderBy('nombre','asc')->get();
            $dias=config('global.dias');   
            $tipo=config('global.tipo'); 
            $colors=config('global.colors'); 
            $horario = Horario:: where('id',$hid)->first();
            return view('back/horarioaddclass',compact('modalidad','hid','carrera_id','profesores','horas','materias','dias','tipo','colors','nomcarrera','periodo_id','horario'));
        }else{
            return back()->with('mensaje','La clase no pudo ser agregada, intente nuevamente');
            $hid=0;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request,$id)
    {
        $request->user()->authorizeRoles(['user', 'admin','cord']);

        $horario = Horario:: where('id',$id)->first();

        $modalidad=$horario->modalidad;  
        //dd($modalidad);
        switch ($modalidad) {
            case 'Presencial':
                $mod=0;
                break;
            case 'Semipresencial':
                $mod=1;
                break;
            case 'Linea':
                $mod=2;
                break;
            case 'Hibrida':
                $mod=1;
                break;
            default:
                $mod=1;
                break;
        }
        $hid=$id; 
        $nomcarrera=$horario->carrera->nombre;    
        $carrera_id=$horario->carrera_id;   
        $periodo_id=$horario->periodo_id; 
        
        $profesores = Profesor::where('activo',1)
                ->orderBy('apellido','asc')
                ->get();
        $horas = Horas::where('activo','1')
                ->where('num_cal','1')
                ->where('modalidad',$mod)
                ->orderBy('hora_ini')->get();
        $materias = Materia::where('activo','1')
                ->where('carrera_id',$carrera_id)
                ->orderBy('nombre','asc')->get();
        $dias=config('global.dias');   
        $tipo=config('global.tipo'); 
        $colors=config('global.colors'); 
        return view('back/horarioaddclass',compact('modalidad','hid','carrera_id','profesores','horas','materias','dias','tipo','colors','nomcarrera','periodo_id','horario'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        $clas=Clase::where('id',$id);
        if ($clas!=null){
            $clas->delete();
            return back(); 
            //return redirect()->route('editclass',$hid)
        }
    }
    public function deldosclass($id,$hid)
    {
        $clas=Clase::where('id',$id);
        if ($clas!=null){
            $clas->delete();
            //return back(); 
            return redirect()->route('editclass',$hid);
        }
    }

    /**
     * Exporta clase a excel de un horario
     */
    public function exportHorario($h_id) 
    {
        $horario = Horario :: where('id',$h_id)->first();
        if($horario){
            $nombreFile=$horario->codigo.'-'.$horario->modalidad.'.xlsx';
           
            //return Excel::download(new ClasesExport($h_id), $nombreFile);
            return Excel::download(new ClasesviewExport(), $nombreFile);
        }else{
            return back()->with('mensaje','No se puedo exportar a Excel');
        }
        
    }

    
}
