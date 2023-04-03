

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
                          <small class="m-0"> {{$linkl->tipo}}<br></small>
                          <small class="m-0">{{$linkl->codigo}}<br></small>
                          <small class="m-0">{{$linkl->profesor->nombre}} {{$linkl->profesor->apellido}}<br></small>
                          <small class="m-0">{{$linkl->materia->nombre}}</small>
                        </div>
                        @endforeach  
                          
                      </td>
                      <td class="text-center fs-6">
                        @foreach($clases->getClaseProfe($item->id,'MARTES',$hid) as $linkm)   
                        <div class=" bg-{{$colors[$linkm->materia->color]}} p-1" style="line-height: 70%">                                             
                          <small class="p-1"> {{$linkm->tipo}}<br></small>
                          <small class="m-0">{{$linkm->codigo}}<br></small>
                          <small class="m-0">{{$linkm->profesor->nombre}} {{$linkm->profesor->apellido}}<br></small>
                          <small class="m-0">{{$linkm->materia->nombre}}<br></small>
                       </div>
                        @endforeach  
                      </td>
                      <td class="text-center ">
                        @foreach($clases->getClaseProfe($item->id,'MIERCOLES',$hid) as $linkn)      
                        <div class=" bg-{{$colors[$linkn->materia->color]}} p-1" style="line-height: 70%">                                             
                          <small class="p-1"> {{$linkn->tipo}}<br></small>
                          <small class="m-0">{{$linkn->codigo}}<br></small>
                          <small class="m-0">{{$linkn->profesor->nombre}} {{$linkn->profesor->apellido}}<br></small>
                          <small class="m-0">{{$linkn->materia->nombre}}<br></small>
                        </div>
                        @endforeach 
                      </td>
                      <td class="text-center ">
                        @foreach($clases->getClaseProfe($item->id,'JUEVES',$hid) as $linkj)        
                        <div class=" bg-{{$colors[$linkj->materia->color]}} p-1" style="line-height: 70%">                                           
                          <small class="p-1"> {{$linkj->tipo}}<br></small>
                          <small class="m-0">{{$linkj->codigo}}<br></small>
                          <small class="m-0">{{$linkj->profesor->nombre}} {{$linkj->profesor->apellido}}<br></small>
                          <small class="m-0">{{$linkj->materia->nombre}}<br></small>
                        </div>
                        @endforeach 
                      </td>
                      <td class="text-center ">
                        @foreach($clases->getClaseProfe($item->id,'VIERNES',$hid) as $linkv)         
                        <div class=" bg-{{$colors[$linkv->materia->color]}} p-1" style="line-height: 70%">                                          
                          <small class="p-1"> {{$linkv->tipo}}<br></small>
                          <small class="m-0">{{$linkv->codigo}}<br></small>
                          <small class="m-0">{{$linkv->profesor->nombre}} {{$linkv->profesor->apellido}}<br></small>
                          <small class="m-0">{{$linkv->materia->nombre}}<br></small>
                        </div>
                        @endforeach 
                      </td>
                      <td>
                        @foreach($clases->getClaseProfe($item->id,'SABADO',$hid) as $links)       
                        <div class=" bg-{{$colors[$links->materia->color]}} p-1" style="line-height: 70%">                                            
                          <small class="p-1"> {{$links->tipo}}<br></small>
                          <small class="m-0">{{$links->codigo}}<br></small>
                          <small class="m-0">{{$links->profesor->nombre}} {{$links->profesor->apellido}}<br></small>
                          <small class="m-0">{{$links->materia->nombre}}<br></small>
                        </div>
                        @endforeach</td>
                      <td>
                        @foreach($clases->getClaseProfe($item->id,'DOMINGO',$hid) as $linkd)   
                        <div class=" bg-{{$colors[$linkd->materia->color]}} p-1" style="line-height: 70%">                                                
                          <small class="p-1"> {{$linkd->tipo}}<br></small>
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