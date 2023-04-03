<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


use App\Models\Horario;
use App\Models\Profesor;
use App\Models\Horas;
use App\Models\Carrera;
use App\Models\Materia;
use App\Models\Periodo;
use Carbon\Carbon;
use App\Models\User;


class HorarioController extends Controller
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
        $request->user()->authorizeRoles([ 'admin','cord']);
        $horarios = Horario :: where('activo',1)
        ->orderBy('carrera_id','asc')
        ->orderBy('modalidad','asc')
        ->orderBy('nivel','asc')->get();
        return view('back/horariolist', compact('horarios'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $carreras = Carrera::where ('activo','1')
                ->get();
        return view('back/clasenew', compact('modalidad','hid','carreras'));
        
            
            
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $buscar = Horario :: where ('periodo_id',$request->periodo_id)
        -> where ('modalidad',$request->modalidad)
        -> where ('carrera_id',$request->carrera_id)
        -> where ('nivel',$request->nivel)->get();
        $cant = $buscar->count();
        if ($cant>0){
            return back()->with('mensaje','El horario no pudo ser agregado, ya existe !!');
        }
        //dd($request);
            $nuevonuevohorario=new Horario;
            $nuevonuevohorario->nombre=$request->nombre;
            $nuevonuevohorario->descripcion=$request->descripcion;
            $nuevonuevohorario->codigo=$request->codigo;
            $nuevonuevohorario->fec_ini=$request->fec_ini;
            $nuevonuevohorario->fec_fin=$request->fec_fin;
            $nuevonuevohorario->modalidad=$request->modalidad;
            $nuevonuevohorario->nivel=$request->nivel;
            $nuevonuevohorario->activo=1;
            $nuevonuevohorario->user_id=auth()->user()->id; 
            $nuevonuevohorario->carrera_id=$request->carrera_id; 
            $nuevonuevohorario->periodo_id=$request->periodo_id; 
            $res=$nuevonuevohorario->save();
            if ($res){
                 $hid=$nuevonuevohorario->id;                
                /*$nomcarrera=$nuevonuevohorario->carrera->nombre;    
                $carrera_id = $nuevonuevohorario->carrera_id;
                $modalidad = $nuevonuevohorario->modalidad;
                $profesores = Profesor::where('activo',1)
                ->orderBy('nombre','asc')
                ->get();
                $horas = Horas::where('activo','1')
                ->where('num_cal','1')->get();
                $materias = Materia::where('activo','1')
                ->where('carrera_id',$carrera_id)
                ->orderBy('nombre','asc')->get();
                $dias=config('global.dias');  
            $colors=config('global.colors'); 
            $tipo=config('global.tipo');  
                return view('back/horarioaddclass', compact('modalidad','hid','carrera_id','profesores','horas', 'materias','dias','tipo','colors','nomcarrera'));   */ 
                return redirect()->route('listhorario')->with('mensaje','El HORARIO SE AGREGÓ EXITOSAMENTE'); 
                
            }else{
                return back()->with('mensaje','El calendario no pudo ser agregado, intente nuevamente');
                $hid=0;
            }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
        $horario = Horario:: where('id',$id)->first();
            $modalidad=config('global.modalidad'); 
        $niveles=config('global.niveles');        
            $carreras = Carrera:: where ('activo','1')->get();
            $periodos = Periodo :: orderBy('id','desc')->get();
        return view ('back/horarioedit',compact('horario','carreras','modalidad','periodos','niveles'));
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
        $edithorario = Horario :: findorfail($id);
        $edithorario->nombre=$request->nombre;
            $edithorario->descripcion=$request->descripcion;
            $edithorario->codigo=$request->codigo;
            $edithorario->fec_ini=$request->fec_ini;
            $edithorario->fec_fin=$request->fec_fin;
            $edithorario->modalidad=$request->modalidad;
            $edithorario->nivel=$request->nivel;
            $edithorario->activo=$request->activo;
            $edithorario->user_id=auth()->user()->id; 
            $edithorario->carrera_id=$request->carrera_id; 
            $edithorario->periodo_id=$request->periodo_id; 
            $res=$edithorario->save();
            if ($res){
                return back()->with('mensaje','Horario Modificado con exito');
            }
            else{
                return back()->with('mensaje','No se puedo modificar el horario');
            }
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
}
