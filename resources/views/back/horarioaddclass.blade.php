@extends('layouts.app')

@section('content')
@if (session('mensaje') )
<div class="alert alert-warning alert-dismissible fade show" role="alert">
  <strong>Error</strong> {{ session('mensaje') }}
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif
<div class="container">
    <h1>NUEVAS CLASES / {{$nomcarrera}} / {{$horario->modalidad}} / NIVEL: {{$horario->nivel}}</h1>
    
    <p>
      <a class="btn btn-primary" data-bs-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
        Agregar Clase
      </a>
    </p>
    <div class="collapse" id="collapseExample">
      <div class="card text-left">
        <img class="card-img-top" src="holder.js/100px180/" alt="">
        <div class="card-body">
          <form class="row g-3" action="{{route('saveclass')}}" method="POST" enctype="multipart/form-data">
            @csrf
                  
            <div class="col-8">
              <label for="descripcion" class="form-label">Descripcion </label>
              <input type="text" class="form-control" name="descripcion" id="descripcion" placeholder="Descripcion de la materia / opcional" >
            </div>   
            <div class="col-4">
              <label for="codigo" class="form-label">codigo </label>
              <input type="text" class="form-control" name="codigo" id="codigo" placeholder="Codigo de la materia en PLataforma" value="{{$horario->carrera->codigo}}-{{$horario->nivel}}-{{$horario->modalidad}}" required>
            </div>        
            
            <div class="col-md-12">
              <label for="profesor_id" class="form-label">Profesor</label>
              <select name="profesor_id" id="profesor_id"class="form-select" onchange="gethoraprofe()">
                <option selected>Selecciona el profesor</option>
                @foreach ($profesores as $prof)
                <option value="{{$prof->id}}">{{$prof->apellido}} {{$prof->nombre}}</option>
                @endforeach
              </select>
            </div>
            
              <div class="col-md-2">
              <label for="hdocencia" class="form-label">Docencia</label>
              <input type="text" class="form-control w-25" name="hdocencia" id="hdocencia" value="0">
            </div>
              <div class="col-md-2">
              <label for="hinvestiga" class="form-label">Investigacion</label>
              <input type="text" class="form-control w-25" name="hinvestiga" id="hinvestiga" value="0">
            </div>
            <div class="col-md-2">
              <label for="hvincula" class="form-label">Vinculación</label>
              <input type="text" class="form-control w-25" name="hvincula" id="hvincula" value="0">
            </div>
              <div class="col-md-2">
                <label for="hgestion" class="form-label">Académico</label>
              <input type="text" class="form-control w-25" name="hgestion" id="hgestion" value="0">
              </div>
              <div class="col-md-2">
                <label for="total" class="form-label">TOTAL</label>
              <input type="text" class="form-control w-25" name="total" id="total" value="0">
              </div>
              <hr>
            <div class="col-md-4">
              <label for="materia_id" class="form-label">Materia</label>
              <select name="materia_id" id="materia_id" class="form-select">
                @foreach ($materias as $mat)
                <option value="{{$mat->id}}">{{$mat->nombre}}</option>
                @endforeach
              </select>
            </div>
            
            <div class="col-md-4">
              <label for="modalidad" class="form-label">Modalidad</label>
              <select name="modalidad" id="modalidad" class="form-select">
                <option value="{{$modalidad}}">{{$modalidad}}</option>
              </select>
            </div>
            <div class="col-md-4">
              <label for="tipo" class="form-label">Tipo</label>
              <select name="tipo" id="tipo" class="form-select">
                @foreach ($tipo as $tip)
                <option value="{{$tip}}">{{$tip}}</option>
                @endforeach
              </select>
            </div>
            <div class="col-md-4">
              <label for="dia" class="form-label">Día</label>
              <select name="dia" id="dia" class="form-select">
                @foreach ($dias as $dia)
                <option value="{{$dia}}">{{$dia}}</option>
                @endforeach
              </select>
            </div>
            <div class="col-md-4">
              <label for="horario_id" class="form-label">Hora</label>
              <select name="horario_id" id="horario_id" class="form-select">
                @foreach ($horas as $horai)
                <option value="{{$horai->id}}">{{$horai->hora_ini}} a {{$horai->hora_fin}}</option>
                @endforeach
              </select>
            </div>
            {{-- <div class="col-md-4">
              <label for="horariof_id" class="form-label">Hora Final</label>
              <select name="horariof_id" id="horariof_id" class="form-select">
                @foreach ($horas as $horaf)
                <option value="{{$horaf->id}}">{{$horaf->hora_fin}}</option>
                @endforeach
              </select>
            </div> --}}
            <input type="hidden" name="carrera_id" id="carrera_id" value="{{$carrera_id}}">
            <input type="hidden" name="periodo_id" id="periodo_id" value="{{$periodo_id}}">
            <input type="hidden" name="h_id" id="h_id" value="{{$hid}}">
            <div class="col-12">
              <button type="submit" class="btn btn-primary">Crear</button>
            </div>
          </form>
  
  
           
          
        </div>
      </div>
    </div>


    
</div>
<div class="container pt-2">

  <div class="card text-left">
    <div class="card-body">
      <div class="table-responsive">            
      <table class="table table-bordered table-sm">
          <thead>
            <tr>
              <th scope="col"><small>HORA</small></th>
              @foreach ($dias as $days)
              <th scope="col"><small>{{$days}}</small></th>
              @endforeach
            
            </tr>
          </thead>
          <tbody >
              @foreach ($horas as $item)
                  <tr>
                      <th scope="row"><small>{{$item->hora_ini}} - {{$item->hora_fin}}</small></th>
                      <td class="text-center fs-6" >
                        @inject('clases','App\Http\Controllers\BladeHoraClaseController')
                                 
                        @foreach($clases->getClaseProfe($item->id,'LUNES',$hid) as $linkl)   
                        <div class=" bg-{{$colors[$linkl->materia->color]}} p-1" style="line-height: 70%"> 
                          <small class="m-0"> {{$linkl->tipo}}
                            <a class="btn btn-danger btn-sm border border-light py-0" href="{{route('deldosclass',[$linkl->id,$hid])}}" role="button"><i class="bi bi-x-circle" style="color: red" ></i></a><br></small>
                          <small class="m-0">{{$linkl->codigo}}<br></small>
                          <small class="m-0">{{$linkl->profesor->nombre}} {{$linkl->profesor->apellido}}<br></small>
                          <small class="m-0">{{$linkl->materia->nombre}}</small>
                        </div>
                        @endforeach  
                          
                      </td>
                      <td class="text-center fs-6">
                        @foreach($clases->getClaseProfe($item->id,'MARTES',$hid) as $linkm)   
                        <div class=" bg-{{$colors[$linkm->materia->color]}} p-1" style="line-height: 70%">                                             
                          <small class="p-1"> {{$linkm->tipo}}
                            <a class="btn btn-danger btn-sm border border-light py-0" href="{{route('deldosclass',[$linkm->id,$hid])}}" role="button"><i class="bi bi-x-circle" ></i></a><br></small>
                          <small class="m-0">{{$linkm->codigo}}<br></small>
                          <small class="m-0">{{$linkm->profesor->nombre}} {{$linkm->profesor->apellido}}<br></small>
                          <small class="m-0">{{$linkm->materia->nombre}}<br></small>
                       </div>
                        @endforeach  
                      </td>
                      <td class="text-center ">
                        @foreach($clases->getClaseProfe($item->id,'MIERCOLES',$hid) as $linkn)      
                        <div class=" bg-{{$colors[$linkn->materia->color]}} p-1" style="line-height: 70%">                                             
                          <small class="p-1"> {{$linkn->tipo}}
                          <a class="btn btn-danger btn-sm border border-light py-0" href="{{route('deldosclass',[$linkn->id,$hid])}}" role="button"><i class="bi bi-x-circle" ></i></a><br></small>
                          <small class="m-0">{{$linkn->codigo}}<br></small>
                          <small class="m-0">{{$linkn->profesor->nombre}} {{$linkn->profesor->apellido}}<br></small>
                          <small class="m-0">{{$linkn->materia->nombre}}<br></small>
                        </div>
                        @endforeach 
                      </td>
                      <td class="text-center ">
                        @foreach($clases->getClaseProfe($item->id,'JUEVES',$hid) as $linkj)        
                        <div class=" bg-{{$colors[$linkj->materia->color]}} p-1" style="line-height: 70%">                                           
                          <small class="p-1"> {{$linkj->tipo}}
                            <a class="btn btn-danger btn-sm border border-light py-0" href="{{route('deldosclass',[$linkj->id,$hid])}}" role="button"><i class="bi bi-x-circle"  ></i></a><br></small>
                          <small class="m-0">{{$linkj->codigo}}<br></small>
                          <small class="m-0">{{$linkj->profesor->nombre}} {{$linkj->profesor->apellido}}<br></small>
                          <small class="m-0">{{$linkj->materia->nombre}}<br></small>
                        </div>
                        @endforeach 
                      </td>
                      <td class="text-center ">
                        @foreach($clases->getClaseProfe($item->id,'VIERNES',$hid) as $linkv)         
                        <div class=" bg-{{$colors[$linkv->materia->color]}} p-1" style="line-height: 70%">                                          
                          <small class="p-1"> {{$linkv->tipo}}
                            <a class="btn btn-danger btn-sm border border-light py-0" href="{{route('deldosclass',[$linkv->id,$hid])}}" role="button"><i class="bi bi-x-circle"  ></i></a><br></small>
                          <small class="m-0">{{$linkv->codigo}}<br></small>
                          <small class="m-0">{{$linkv->profesor->nombre}} {{$linkv->profesor->apellido}}<br></small>
                          <small class="m-0">{{$linkv->materia->nombre}}<br></small>
                        </div>
                        @endforeach 
                      </td>
                      <td>
                        @foreach($clases->getClaseProfe($item->id,'SABADO',$hid) as $links)       
                        <div class=" bg-{{$colors[$links->materia->color]}} p-1" style="line-height: 70%">                                            
                          <small class="p-1"> {{$links->tipo}}
                            <a class="btn btn-danger btn-sm border border-light py-0" href="{{route('deldosclass',[$links->id,$hid])}}" role="button"><i class="bi bi-x-circle" ></i></a><br></small>
                          <small class="m-0">{{$links->codigo}}<br></small>
                          <small class="m-0">{{$links->profesor->nombre}} {{$links->profesor->apellido}}<br></small>
                          <small class="m-0">{{$links->materia->nombre}}<br></small>
                        </div>
                        @endforeach</td>
                      <td>
                        @foreach($clases->getClaseProfe($item->id,'DOMINGO',$hid) as $linkd)   
                        <div class=" bg-{{$colors[$linkd->materia->color]}} p-1" style="line-height: 70%">                                                
                          <small class="p-1"> {{$linkd->tipo}}
                            <a class="btn btn-danger btn-sm border border-light py-0" href="{{route('deldosclass',[$linkd->id,$hid])}}" role="button"><i class="bi bi-x-circle" ></i></a><br></small>
                          <small class="m-0">{{$linkd->codigo}}<br></small>
                          <small class="m-0">{{$linkd->profesor->nombre}} {{$linkd->profesor->apellido}}<br></small>
                          <small class="m-0">{{$linkd->materia->nombre}}<br></small>
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
<script>

  function gethoraprofe(){
      // Obtener el elemento select
    const miSelect = document.getElementById("profesor_id");

    // Obtener el valor seleccionado
    const id = miSelect.value;

    //ajax
    var url="{{route('getProfes')}}";
    $.ajax({
      url: url,
      data:{id: id},
      type: 'GET',
      dataType: 'json',
      success: function(data) {
        // Iterar sobre los datos de los profesores
        $.each(data, function(index, profesor) {
          // Mostrar los datos del profesor en la página 
          $("#hdocencia").val(profesor.hdocencia);
          $("#hinvestiga").val(profesor.hinvestiga);
          $("#hvincula").val(profesor.hvincula);        
          $("#hgestion").val(profesor.hgestion);        
          $("#total").val(profesor.hdocencia+profesor.hinvestiga+profesor.hvincula+profesor.hgestion);

        });
      },
      error: function(xhr, status, error) {
        // Mostrar un mensaje de error si falla la solicitud AJAX
        alert('Ha ocurrido un error al recuperar los datos de los profesores.');
      }
    });


  }

  function val() {
      d = document.getElementById("floatingSelect").value;
      console.log(d);
      document.f1.fid.value =10;
      
  }
  </script>
@endsection
