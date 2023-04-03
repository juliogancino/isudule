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
          <table class="table table-bordered table-sm align-middle">
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Nombre</th>
                  <th scope="col">Carrera</th>
                  <th scope="col">Tiempo</th>
                  <th scope="col">Doce</th>
                  <th scope="col">Inve</th>
                  <th scope="col">Vinc</th>
                  <th scope="col">GestAca</th>
                  <th scope="col">Activo</th>
                  <th scope="col">Acciones</th>
                
                </tr>
              </thead>
              <tbody>
                  @foreach ($profesores as $item)
                      <tr>
                          <th scope="row">{{$item->id}} </th>
                          <td> {{$item->nombre}} {{$item->apellido}} </td>                          
                          <td>{{$item->carrera_id}} </td>
                          <td>{{$item->tiempo}} </td>
                          <td>{{$item->hdocencia}} </td>
                          <td>{{$item->hinvestiga}} </td>
                          <td>{{$item->hvincula}} </td>
                          <td >
                            <form action="{{route('actuahprofedos',[$item->id,3])}}" method="post">
                              @csrf
                              {{$item->hgestion}} &nbsp;&nbsp;&nbsp;
                              <select class="form-control-sm" name="periodo_id"  id="periodo_id">
                                @foreach ($periodos as $peri)
                                    <option value="{{$peri->id}}" selected>{{$peri->anio}}-{{$peri->periodo}}</option>                                 
                                @endforeach
                              </select>
                              <input type="hidden" name="id" id="id" value="{{$item->id}}">
                              <button type="submit" class="btn btn-warning btn-sm" data-toggle="tooltip" data-placement="top" title="Actualiza Horas">Upda</button>
                            </form>
                            {{-- <a class="btn btn-warning" href="{{route('actuahprofe',[$item->id,3])}}" role="button"><i class="bi bi-clipboard2-plus"></i>  </a>      --}}
                          </td>
                          <td>
                            @if($item->activo==1)
                            <i class="bi bi-check2"></i>
                            @else 
                            <i class="bi bi-x-circle"></i>
                          @endif    <a class="btn btn-danger btn-sm" href="{{route('editprofe',$item->id)}}" role="button" data-toggle="tooltip" data-placement="top" title="Edita Profesor"><i class="bi bi-clipboard2-plus"></i> </a>     
                        
                          </td>
                          <td>
                            @if ($item->activo==1)
                                {{-- <a class="btn btn-primary btn-sm" href="{{route('profehorario',[$item->id,1])}}" role="button"><i class="bi bi-calendar2-week"></i>  </a> --}}
                                <form action="{{route('profehorariodos',[$item->id,3])}}" method="post">
                                  @csrf
                                  <select class="form-control-sm" name="periodo_id"  id="periodo_id">
                                    @foreach ($periodos as $peri)
                                        <option value="{{$peri->id}}" selected>{{$peri->anio}}-{{$peri->periodo}}</option>                                 
                                    @endforeach
                                  </select>
                                  <input type="hidden" name="id" id="id" value="{{$item->id}}">
                                  <button type="submit" class="btn btn-primary btn-sm"  data-toggle="tooltip" data-placement="top" title="Ver Horario"><i class="bi bi-calendar2-week"></i></button>
                                </form>

                                {{-- <form action="{{route('exportprofesordos',[$item->id,3])}}" method="post">
                                  @csrf
                                  <select class="form-control-sm" name="periodo_id"  id="periodo_id">
                                    @foreach ($periodos as $peri)
                                        <option value="{{$peri->id}}" selected>{{$peri->anio}}-{{$peri->periodo}}</option>                                 
                                    @endforeach
                                  </select>
                                  <input type="hidden" name="id" id="id" value="{{$item->id}}">
                                  <button type="submit" class="btn btn-primary btn-sm"><i class="bi bi-filetype-xlsx"></i></button>
                                </form> --}}
                                {{-- <a class="btn btn-success btn-sm" href="{{route('exportprofesor',$item->id)}}" role="button"><i class="bi bi-filetype-xlsx"></i> </a>    --}}                             
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
<script type="text/javascript">
  $(function () {
      $('[data-toggle="tooltip"]').tooltip()
    })
  </script>
@endsection