@extends('layouts.app')

@section('content')
@if (session('mensaje') )
<div class="alert alert-warning alert-dismissible fade show" role="alert">
  <strong>Info</strong> {{ session('mensaje') }}
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

<div class="container">
    <div class="card text-left">
        <div class="card-body">
          <div class="table-responsive">            
          <table class="table table-bordered table-sm">
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Periodo</th>
                  <th scope="col">Carrera</th>
                  <th scope="col">Nivel</th>
                  <th scope="col">Modalidad</th>
                  <th scope="col">Fecha Ini</th>
                  <th scope="col">Fecha Fin</th>
                  <th scope="col">Acciones</th>
                
                </tr>
              </thead>
              <tbody>
                  @foreach ($horarios as $item)
                      <tr>
                          <th scope="row">{{$item->id}} </th>
                          <td> {{$item->periodo->anio}} {{$item->periodo->periodo}} </td>                          
                          <td>{{$item->carrera->nombre}} </td>
                          <td>{{$item->nivel}} </td>
                          <td>{{$item->modalidad}} </td>
                          <td>{{$item->fec_ini}} </td>
                          <td>{{$item->fec_fin}} </td>
                          <td>
                            <a class="btn btn-warning btn-sm" href="{{route('edithorario',$item->id)}}" role="button">Edit <i class="bi bi-pencil-square"></i></a>     
                            @if ($item->activo==1)
                                <a class="btn btn-primary btn-sm" href="{{route('editclass',$item->id)}}" role="button">Class <i class="bi bi-plus-square"></i></a>                                
                                <a class="btn btn-success btn-sm" href="{{route('exporthorario',$item->id)}}" role="button"><i class="bi bi-filetype-xlsx"></i> </a>                                
                            @endif                       
                                                        
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