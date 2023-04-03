

    <div class="container pt-2">

        <div class="card text-left">
          <div class="card-body">
            <div class="card-title">
                <h4>HORARIO PERSONAL DE: {{$profesor->nombre}} {{$profesor->apellido}}</h4>
            </div>
            <div class="table-responsive">            
            <table class="table table-bordered">
                <thead>
                  <tr>
                    <th scope="col">HORA</th>
                    @foreach ($dias as $days)
                    <th scope="col">{{$days}}</th>
                    @endforeach
                  
                  </tr>
                </thead>
                <tbody >
                    @foreach ($horas as $item)
                        <tr>
                            <th scope="row">{{$item->hora_ini}} - {{$item->hora_fin}}</th>
                           <td class="text-center fs-6" >
                                @inject('clases','App\Http\Controllers\BladeProfeClaseController')
                                 
                                @foreach($clases->getClase($item->id,'LUNES',$profesor->id,$periodo_id) as $link)   
                                <div class=" bg-{{$colors[$link->materia->color]}}">                                        
                                  {{$link->tipo}}<br>
                                  {{$link->codigo}}<br>
                                  {{$link->profesor->nombre}} {{$link->profesor->apellido}}<br>
                                  {{$link->materia->nombre}}<br>
                                   </div>
                                @endforeach       
                                
                            </td>
                             <td class="text-center fs-6">
                                @foreach($clases->getClase($item->id,'MARTES',$profesor->id,$periodo_id) as $link)   
                                <div class=" bg-{{$colors[$link->materia->color]}}">                                        
                                  {{$link->tipo}}<br>
                                  {{$link->codigo}}<br>
                                  {{$link->profesor->nombre}} {{$link->profesor->apellido}}<br>
                                  {{$link->materia->nombre}}<br>
                                   </div>
                                @endforeach  
                            </td>
                            <td class="text-center ">
                                @foreach($clases->getClase($item->id,'MIERCOLES',$profesor->id,$periodo_id) as $link)   
                                <div class=" bg-{{$colors[$link->materia->color]}}">                                        
                                  {{$link->tipo}}<br>
                                  {{$link->codigo}}<br>
                                  {{$link->profesor->nombre}} {{$link->profesor->apellido}}<br>
                                  {{$link->materia->nombre}}<br>
                                   </div>
                                @endforeach  
                            </td>
                            <td class="text-center ">
                                @foreach($clases->getClase($item->id,'JUEVES',$profesor->id,$periodo_id) as $link)   
                                <div class=" bg-{{$colors[$link->materia->color]}}">                                        
                                  {{$link->tipo}}<br>
                                  {{$link->codigo}}<br>
                                  {{$link->profesor->nombre}} {{$link->profesor->apellido}}<br>
                                  {{$link->materia->nombre}}<br>
                                   </div>
                                @endforeach  
                            </td>
                            <td class="text-center ">
                                @foreach($clases->getClase($item->id,'VIERNES',$profesor->id,$periodo_id) as $link)   
                                <div class=" bg-{{$colors[$link->materia->color]}}">                                        
                                  {{$link->tipo}}<br>
                                  {{$link->codigo}}<br>
                                  {{$link->profesor->nombre}} {{$link->profesor->apellido}}<br>
                                  {{$link->materia->nombre}}<br>
                                   </div>
                                @endforeach  
                            </td >
                            <td class="text-center ">
                                @foreach($clases->getClase($item->id,'SABADO',$profesor->id,$periodo_id) as $link)   
                                <div class=" bg-{{$colors[$link->materia->color]}}">                                        
                                  {{$link->tipo}}<br>
                                  {{$link->codigo}}<br>
                                  {{$link->profesor->nombre}} {{$link->profesor->apellido}}<br>
                                  {{$link->materia->nombre}}<br>
                                   </div>
                                @endforeach  
                            </td>
                            <td class="text-center ">
                                @foreach($clases->getClase($item->id,'DOMINGO',$profesor->id,$periodo_id) as $link)   
                                <div class=" bg-{{$colors[$link->materia->color]}}">                                        
                                  {{$link->tipo}}<br>
                                  {{$link->codigo}}<br>
                                  {{$link->profesor->nombre}} {{$link->profesor->apellido}}<br>
                                  {{$link->materia->nombre}}<br>
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
        

