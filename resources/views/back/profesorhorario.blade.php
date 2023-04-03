@extends('layouts.app')

@section('content')
@if (session('mensaje') )
<div class="alert alert-warning alert-dismissible fade show" role="alert">
  <strong>Info</strong> {{ session('mensaje') }}
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif
<div class="container">
  <form action="{{route('exportprofesordos')}}" method="post">
    @csrf
    {{-- <select class="form-control-sm" name="periodo_id"  id="periodo_id">
      @foreach ($periodos as $peri)
          <option value="{{$peri->id}}" selected>{{$peri->anio}}-{{$peri->periodo}}</option>                                 
      @endforeach
    </select> --}}
    <input type="hidden" name="periodo_id" id="periodo_id" value="{{$periodo_id}}">
    <input type="hidden" name="id" id="id" value="{{$profesor->id}}">
    <button type="submit" class="btn btn-primary btn-sm">Exportar Horario <i class="bi bi-filetype-xlsx"></i></button>
  </form>
</div>

<div class="container">
    <div class="container pt-2">

        <div class="card text-left">
          <div class="card-body">
            <div class="card-title">
                <h4>HORARIO PERSONAL DE: <span class="text-primary" >{{$profesor->nombre}} {{$profesor->apellido}}</span> <BR>
                  PERIODO:<span class="text-primary" >{{$nombrep}}</span> </h4>
            </div>
            <div class="table-responsive">            
            <table class="table table-bordered table-sm">
                <thead>
                  <tr>
                    <th scope="col"><small class="m-0">HORA</small></th>
                    @foreach ($dias as $days)
                    <th scope="col"><small class="m-0">{{$days}}</small></th>
                    @endforeach
                  
                  </tr>
                </thead>
                <tbody >
                    @foreach ($horas as $item)
                        <tr>
                            <th scope="row"><small class="m-0">{{$item->hora_ini}} - {{$item->hora_fin}}</small></th>
                            <td class="text-center fs-6" >
                                @inject('clases','App\Http\Controllers\BladeProfeClaseController')
                                 
                                @foreach($clases->getClase($item->id,'LUNES',$profesor->id,$periodo_id) as $link)   
                                <div class=" bg-{{$colors[$link->materia->color]}} p-1" style="line-height: 75%">                                        
                                  <small class="m-0">{{$link->tipo}}<br></small>
                                    <small class="m-0">{{$link->codigo}}<br></small>
                                      <small class="m-0"> {{$link->profesor->nombre}} {{$link->profesor->apellido}}<br></small>
                                        <small class="m-0"> {{$link->materia->nombre}}</small>
                                  </small>
                                   </div>
                                @endforeach       
                                
                            </td>
                            <td class="text-center fs-6">
                                @foreach($clases->getClase($item->id,'MARTES',$profesor->id,$periodo_id) as $link)   
                                <small class="m-0"><div class=" bg-{{$colors[$link->materia->color]}} p-1" style="line-height: 75%">                                        
                                  <small class="m-0"> {{$link->tipo}}<br></small>
                                    <small class="m-0"> {{$link->codigo}}<br></small>
                                      <small class="m-0"> {{$link->profesor->nombre}} {{$link->profesor->apellido}}<br></small>
                                        <small class="m-0"> {{$link->materia->nombre}}</small>
                                   </div>
                                @endforeach  
                            </td>
                            <td class="text-center ">
                                @foreach($clases->getClase($item->id,'MIERCOLES',$profesor->id,$periodo_id) as $link)   
                                <div class=" bg-{{$colors[$link->materia->color]}} p-1" style="line-height: 75%">                                        
                                  <small class="m-0">{{$link->tipo}}<br></small>
                                    <small class="m-0"> {{$link->codigo}}<br></small>
                                      <small class="m-0"> {{$link->profesor->nombre}} {{$link->profesor->apellido}}<br></small>
                                        <small class="m-0"> {{$link->materia->nombre}}</small>
                                   </div>
                                @endforeach  
                            </td>
                            <td class="text-center ">
                                @foreach($clases->getClase($item->id,'JUEVES',$profesor->id,$periodo_id) as $link)   
                                <div class=" bg-{{$colors[$link->materia->color]}} p-1" style="line-height: 75%">                                        
                                  <small class="m-0">{{$link->tipo}}<br></small>
                                    <small class="m-0">{{$link->codigo}}<br></small>
                                      <small class="m-0">{{$link->profesor->nombre}} {{$link->profesor->apellido}}<br></small>
                                        <small class="m-0">{{$link->materia->nombre}}</small>
                                   </div>
                                @endforeach  
                            </td>
                            <td class="text-center ">
                                @foreach($clases->getClase($item->id,'VIERNES',$profesor->id,$periodo_id) as $link)   
                                <div class=" bg-{{$colors[$link->materia->color]}} p-1" style="line-height: 75%">                                        
                                  <small class="m-0">{{$link->tipo}}<br></small>
                                    <small class="m-0">{{$link->codigo}}<br></small>
                                      <small class="m-0">{{$link->profesor->nombre}} {{$link->profesor->apellido}}<br></small>
                                        <small class="m-0">{{$link->materia->nombre}}</small>
                                   </div>
                                @endforeach  
                            </td>
                            <td class="text-center ">
                                @foreach($clases->getClase($item->id,'SABADO',$profesor->id,$periodo_id) as $link)   
                                <div class=" bg-{{$colors[$link->materia->color]}} p-1" style="line-height: 75%">                                        
                                  <small class="m-0">{{$link->tipo}}<br></small>
                                    <small class="m-0">{{$link->codigo}}<br></small>
                                      <small class="m-0">{{$link->profesor->nombre}} {{$link->profesor->apellido}}<br></small>
                                        <small class="m-0">{{$link->materia->nombre}}</small>
                                   </div>
                                @endforeach  
                            </td>
                            <td class="text-center ">
                                @foreach($clases->getClase($item->id,'DOMINGO',$profesor->id,$periodo_id) as $link)   
                                <div class=" bg-{{$colors[$link->materia->color]}} p-1" style="line-height: 75%">                                        
                                  <small class="m-0">{{$link->tipo}}<br></small>
                                  <small class="m-0">{{$link->codigo}}<br></small>
                                  <small class="m-0">{{$link->profesor->nombre}} {{$link->profesor->apellido}}<br></small>
                                  <small class="m-0">{{$link->materia->nombre}}<small>
                                   </div>
                                @endforeach 
                            </td>
                        </tr>
                    @endforeach
                
                </tbody>
            </table>
          </div>
          </div>
        </div>
        
      </div>
@endsection