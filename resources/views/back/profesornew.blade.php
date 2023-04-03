@extends('layouts.app')

@section('content')
@if (session('mensaje') )
<div class="alert alert-warning alert-dismissible fade show" role="alert">
  <strong>Error</strong> {{ session('mensaje') }}
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif
<div class="container">
    
    <div class="card text-left">
      <img class="card-img-top" src="holder.js/100px180/" alt="">
      <div class="card-body">
        <h5 class="card-title">NUEVO PROFESOR</h5>
        <form class="row g-3" action="{{route('saveprofe')}}" method="POST"  enctype="multipart/form-data">
            @csrf
            <div class="col-md-6">
                <label for="nombre" class="form-label">Nombre</label>
                <input type="text" class="form-control"  name="nombre" id="nombre" required>
              </div>
              <div class="col-md-6">
                <label for="nombre" class="form-label">Apellido</label>
                <input type="text" class="form-control"  name="nombre" id="nombre" required>
              </div>
              <div class="col-6">
                <label for="descripcion" class="form-label">descripcion</label>
                <input type="text" class="form-control" name="descripcion"  id="descripcion"  placeholder="Informacion relacionada para busquedas" required>
              </div>
              <div class="col-6">
                <label for="codigo" class="form-label">Cedula / Pasaporte</label>
                <input type="text" class="form-control" name="codigo" id="codigo" placeholder="codigo interno" required>
              </div>
            <div class="col-md-4">
                <label for="carrera" class="form-label" >Carreras</label>
                <select name="carrera_id"  id="carrera_id" class="form-select" >
                  @foreach ($carreras as $carr)
                  <option value="{{$carr->id}}">{{$carr->nombre}}</option>
                  @endforeach
                </select>
              </div>
              <div class="col-md-4">
                <label for="tiempo" class="form-label" >Tiempo</label>
                <select name="tiempo"  id="tiempo" class="form-select" >
                  @foreach ($tiempos as $tie)
                  <option value="{{$tie}}">{{$tie}}</option>
                  @endforeach
                </select>
              </div>
              {{-- <div class="container-flex border border-secondary m-2 p-2 "> --}}
                <hr>
                <div class="col-md-4">
                    <label for="hdocencia" class="form-label">Horas Docencia</label>
                    <input type="number" class="form-control" name="hdocencia" id="hdocencia" placeholder="numero entero" onchange="ingresa();" required>
                </div>
                <div class="col-md-4">
                    <label for="hinvestiga" class="form-label">Horas Investigacion</label>
                    <input type="number" class="form-control" name="hinvestiga" id="hinvestiga" placeholder="numero entero" required>
                </div>
                <div class="col-md-4">
                    <label for="hvincula" class="form-label">Horas Vinculacion</label>
                    <input type="number" class="form-control" name="hvincula" id="hvincula" placeholder="numero entero" required>
                </div>
                <div class="col-md-4">
                    <label for="hgestion" class="form-label">Horas Gestion Doc.</label>
                    <input type="number" class="form-control" name="hgestion" id="hgestion" placeholder="numero entero" required>
                </div>
                <div class="col-md-4">
                    <label for="total" class="form-label">Total</label>
                    <input type="number" class="form-control" name="total" id="total" value="0" placeholder="numero entero">
                </div>
                <hr>
              {{-- </div> --}}
              
              <div class="col-md-12">
                <label for="imagen" class="form-label">Agregue una imagen</label>
                <input class="form-control form-control-sm" id="imagen" name="imagen" type="file">
              </div>

              <div class="col-12">
                <button type="submit" class="btn btn-primary">Crear</button>
              </div>
        </form>
      </div>
    </div>
</div>
<script type="text/javascript">
    function ingresa(){
      alert(form.);
    }
</script>

@endsection