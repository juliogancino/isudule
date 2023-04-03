@extends('layouts.app')

@section('content')
@if (session('mensaje') )
<div class="alert alert-warning alert-dismissible fade show" role="alert">
  <strong>Mensaje</strong> {{ session('mensaje') }}
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif
<div class="container">
    <h1>EDITAR HORARIO </h1>
    
    <div class="card text-left">
      <img class="card-img-top" src="holder.js/100px180/" alt="">
      <div class="card-body">
        <form class="row g-3" id="update-form" action="{{route('updahorario',$horario->id)}}" method="POST"  enctype="multipart/form-data">
          @csrf
          <div class="col-md-6">
            <label for="nombre" class="form-label">Nombre</label>
            <input type="text" class="form-control"  name="nombre" id="nombre" value="{{$horario->nombre}}" required>
          </div>
          {{-- <div class="col-md-6">
            <label for="periodo" class="form-label">periodo</label>
            <input type="text" class="form-control" name="periodo"  id="periodo" value="{{$horario->periodo}}" required>
          </div> --}}
          <div class="col-md-4">
            <label for="periodo_id" class="form-label">Periodo</label>
            <select name="periodo_id"  id="periodo_id" class="form-select">
              @foreach ($periodos as $per)
                @if ($per->id == $horario->periodo_id)
                  <option value="{{$per->id}}" selected>{{$per->anio}} - {{$per->periodo}}</option>
                @else
                  <option value="{{$per->id}}">{{$per->anio}} - {{$per->periodo}}</option>    
                @endif
              
              @endforeach
            </select>
          </div>
          <div class="col-md-4">
            @php $i=0;
              @endphp
            <label for="nivel" class="form-label">Nivel</label>
            <select name="nivel"  id="nivel" class="form-select">
              @foreach ($niveles as $nivel)
                @if ($i == $horario->nivel)
                  <option value="{{$i}}" selected>{{$nivel}}</option>
                @else
                  <option value="{{$i}}">{{$nivel}}</option>
                @endif
                @php $i++;
                @endphp
              @endforeach
            </select>
          </div>
          <div class="col-12">
            <label for="descripcion" class="form-label">descripcion</label>
            <input type="text" class="form-control" name="descripcion"  id="descripcion"  placeholder="Informacion relacionada para busquedas"  value="{{$horario->descripcion}}" required>
          </div>
          <div class="col-12">
            <label for="codigo" class="form-label">codigo</label>
            <input type="text" class="form-control" name="codigo" id="codigo" placeholder="codigo interno"  value="{{$horario->codigo}}" required>
          </div>
          <div class="col-md-6">
            <label for="fec_ini" class="form-label">Fecha Inicial del periodo</label>
            <input type="date" class="form-control"  name="fec_ini" id="fec_ini"   value="{{$horario->fec_ini}}" onchange="validaFechas()" required>
          </div>
          <div class="col-md-6">
            <label for="fec_fin" class="form-label">Fecha Final del periodo</label>
            <input type="date" class="form-control" name="fec_fin" id="fec_fin"    value="{{$horario->fec_fin}}" onchange="validaFechas()" required>
          </div>
          <div class="col-md-4">
            <label for="carrera" class="form-label">Carreras</label>
            <select name="carrera_id"  id="carrera_id" class="form-select">
              @foreach ($carreras as $carr)
              
              @if ($carr->id==$horario->carrera_id)
                <option value="{{$carr->id}}" selected>{{$carr->nombre}}</option>
              @else
                <option value="{{$carr->id}}">{{$carr->nombre}}</option>
                @endif   
              @endforeach
            </select>
          </div>
          <div class="col-md-4">
            <label for="carrera" class="form-label">Modalidad</label>
            <select name="modalidad" id="modalidad" class="form-select">
              @foreach ($modalidad as $mod)
                @if ($mod==$horario->modalidad)
                  <option value="{{$mod}}" selected>{{$mod}}</option>
                @else
                  <option value="{{$mod}}">{{$mod}}</option>
                @endif              
              @endforeach
            </select>
          </div>
          <hr>
          <div class="col-md-4 bg-danger p-1">
            <label for="activo" class="form-label text-light ">CERRAR HORARIO</label>
            <select name="activo" id="activo" class="form-select">
              @if ($horario->activo==1)                  
                <option value="0" >CERRADO</option>
                <option value="1" selected>ABIERTO</option>
              @else
                <option value="1" >ABIERTO</option>
                <option value="0" selected>CERRADO</option>
              @endif
             
            </select>
          </div>
          <div class="col-12">
            <button type="submit" class="btn btn-primary">Modificar</button>
          </div>
        </form>
        
        <a href="{{url()->previous()}}"  class="btn btn-primary mt-1" id="btnbuy">Volver</a>    
      </div>
    </div>
</div>
<script type="text/javascript">
   const feci = document.getElementById("fec_ini").value;
   const fecf = document.getElementById("fec_fin").value;
  function validaFechas(){
    // Obtener los valores de las fechas inicial y final
    const fechaInicial = new Date(document.getElementById("fec_ini").value);
    const fechaFinal = new Date(document.getElementById("fec_fin").value);   

    // Comparar las fechas
    if (fechaFinal < fechaInicial) {
      // Mostrar un mensaje de error
      alert("La fecha final no puede ser menor que la fecha inicial.");
      document.getElementById("fec_ini").value = feci;
      document.getElementById("fec_fin").value = fecf;
      event.stopPropagation(); 
      event.preventDefault();
    }
  }
    

</script>

@endsection
