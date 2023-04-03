@extends('layouts.app')

@section('content')
@if (session('mensaje') )
<div class="alert alert-warning alert-dismissible fade show" role="alert">
  <strong>Error</strong> {{ session('mensaje') }}
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif
<div class="container">
    <h1>NUEVO HORARIO </h1>
    
    <div class="card text-left">
      <img class="card-img-top" src="holder.js/100px180/" alt="">
      <div class="card-body">
        <form class="row g-3" action="{{route('savehorario')}}" method="POST"  enctype="multipart/form-data">
          @csrf
          <div class="col-md-6">
            <label for="nombre" class="form-label">Nombre</label>
            <input type="text" class="form-control"  name="nombre" id="nombre" required>
          </div>
          <div class="col-md-4">
            <label for="periodo_id" class="form-label">Periodo</label>
            <select name="periodo_id"  id="periodo_id" class="form-select">
              @foreach ($periodos as $per)
              <option value="{{$per->id}}">{{$per->anio}} - {{$per->periodo}}</option>
              @endforeach
            </select>
          </div>
          <div class="col-md-4">
            @php $i=0;
              @endphp
            <label for="nivel" class="form-label">Nivel</label>
            <select name="nivel"  id="nivel" class="form-select">
              @foreach ($niveles as $nivel)
                 <option value="{{$i}}">{{$nivel}}</option>
                @php $i++;
                @endphp
              @endforeach
            </select>
          </div>
          
          <div class="col-12">
            <label for="descripcion" class="form-label">descripcion</label>
            <input type="text" class="form-control" name="descripcion"  id="descripcion"  placeholder="Informacion relacionada para busquedas" required>
          </div>
          <div class="col-12">
            <label for="codigo" class="form-label">codigo</label>
            <input type="text" class="form-control" name="codigo" id="codigo" placeholder="codigo interno" required>
          </div>
          <div class="col-md-6">
            <label for="fec_ini" class="form-label">fec_ini</label>
            <input type="date" class="form-control"  name="fec_ini" id="fec_ini"  required>
          </div>
          <div class="col-md-6">
            <label for="fec_fin" class="form-label">fec_fin</label>
            <input type="date" class="form-control" name="fec_fin" id="fec_fin"   required>
          </div>
          <div class="col-md-4">
            <label for="carrera" class="form-label">Carreras</label>
            <select name="carrera_id"  id="carrera_id" class="form-select">
              @foreach ($carreras as $carr)
              <option value="{{$carr->id}}">{{$carr->nombre}}</option>
              @endforeach
            </select>
          </div>
          <div class="col-md-4">
            <label for="carrera" class="form-label">Modalidad</label>
            <select name="modalidad" id="modalidad" class="form-select">
              @foreach ($modalidad as $mod)
              <option value="{{$mod}}">{{$mod}}</option>
              @endforeach
            </select>
          </div>
          <div class="col-12">
            <button type="submit" class="btn btn-primary">Crear</button>
          </div>
        </form>
        
      </div>
    </div>
</div>

@endsection
