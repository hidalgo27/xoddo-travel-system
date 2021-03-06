@extends('layouts.admin.book')
@section('archivos-css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.15/css/dataTables.bootstrap4.min.css">
@stop
@section('archivos-js')
    <script src="{{asset("https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js")}}"></script>
    <script src="{{asset("https://cdn.datatables.net/1.10.15/js/dataTables.bootstrap4.min.js")}}"></script>
    <script src="https://cdn.ckeditor.com/4.8.0/standard/ckeditor.js"></script>
@stop
@section('content')
    <div class="row">
        <ol class="breadcrumb">
            <li><a href="/">Home</a></li>
            <li>Inventory</li>
            <li>Day by Day</li>
            <li class="active">Edit</li>
        </ol>
    </div>
    <div class="row margin-top-20">
        <form action="{{route('nuevo_servicio_add_path')}}" method="post" id="destination_save_id" enctype="multipart/form-data">

            <div class="row margin-top-20">
                <div class="col-md-12">
                    <h4 class="font-montserrat text-orange-goto">Lista de servicios para el dia {{$dia}}</h4>
                    <div class="divider margin-bottom-20"></div>
                </div>
            </div>
            <div class="row">
                {{csrf_field()}}

                @foreach($destinations as $destino)
                    <?php $estado=''?>

                    <div class="col-md-3">
                        <div class="checkbox11">
                            <label>
                                <input class="grupo_edit" type="checkbox" name="destinos[]" value="{{$destino->id}}_{{$destino->destino}}_{{$itinerartio_cotis_id}}" onchange="filtrar_grupos_edit({{$itinerartio_cotis_id}})">
                                {{$destino->destino}}
                            </label>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="row margin-top-20">
                @foreach($categorias as $categoria)
                    <?php
                    $tipoServicio[]=$categoria->nombre;
                    ?>
                @endforeach
                <div class="btn-group col-lg-12" role="group" aria-label="...">
                    <button id="filtro_1_edit" class="btn btn-info" type="button" onclick="escojerPos_edit('{{$itinerartio_cotis_id}}',1,'{{$tipoServicio[1]}}')"><i class="fa fa-map-o fa-3x" aria-hidden="true"></i><p class="text-10">{{$tipoServicio[1]}}</p></button>
                    <button id="filtro_2_edit" class="btn btn-warning" type="button" onclick="escojerPos_edit('{{$itinerartio_cotis_id}}',2,'{{$tipoServicio[2]}}')"><i class="fa fa-bus fa-3x" aria-hidden="true"></i><p class="text-10">{{$tipoServicio[2]}}</p></button>
                    <button id="filtro_3_edit" class="btn btn-success" type="button" onclick="escojerPos_edit('{{$itinerartio_cotis_id}}',3,'{{$tipoServicio[3]}}')"><i class="fa fa-users fa-3x" aria-hidden="true"></i><p class="text-10">{{$tipoServicio[3]}}</p></button>
                    <button id="filtro_4_edit" class="btn btn-warning" type="button" onclick="escojerPos_edit('{{$itinerartio_cotis_id}}',4,'{{$tipoServicio[4]}}')"><i class="fa fa-ticket fa-3x" aria-hidden="true"></i><p class="text-10">{{$tipoServicio[4]}}</p></button>
                    <button id="filtro_5_edit" class="btn btn-danger" type="button" onclick="escojerPos_edit('{{$itinerartio_cotis_id}}',5,'{{$tipoServicio[5]}}')"><i class="fa fa-cutlery fa-3x" aria-hidden="true"></i><p class="text-10">{{$tipoServicio[5]}}</p></button>
                    <button id="filtro_6_edit" class="btn btn-info" type="button" onclick="escojerPos_edit('{{$itinerartio_cotis_id}}',6,'{{$tipoServicio[6]}}')"><i class="fa fa-train fa-3x" aria-hidden="true"></i><p class="text-10">{{$tipoServicio[6]}}</p></button>
                    <button id="filtro_7_edit" class="btn btn-primary" type="button" onclick="escojerPos_edit('{{$itinerartio_cotis_id}}',7,'{{$tipoServicio[7]}}')"><i class="fa fa-plane fa-3x" aria-hidden="true"></i><p class="text-10">{{$tipoServicio[7]}}</p></button>
                    <button id="filtro_8_edit" class="btn btn-success" type="button" onclick="escojerPos_edit('{{$itinerartio_cotis_id}}',8,'{{$tipoServicio[8]}}')"><i class="fa fa-question fa-3x" aria-hidden="true"></i><p class="text-10">{{$tipoServicio[8]}}</p></button>
                </div>
            </div>
            @php
                $total_pre_ven_edit=0;
            @endphp
            <div class="row margin-top-10">
                <div id="t_edit_{{$itinerartio_cotis_id}}_{{$tipoServicio[1]}}" class=" col-lg-12">
                    <ul class="nav nav-tabs">
                        <li class="active bg-info"><a data-toggle="tab" href="#t_edit_{{$itinerartio_cotis_id}}_{{$tipoServicio[1]}}_PRIVATE">PRIVATE</a></li>
                        <li class="bg-info"><a data-toggle="tab" href="#t_edit_{{$itinerartio_cotis_id}}_{{$tipoServicio[1]}}_GROUP">GROUP</a></li>
                    </ul>

                    <div class="tab-content margin-top-20">
                        <div id="t_edit_{{$itinerartio_cotis_id}}_{{$tipoServicio[1]}}_PRIVATE" class="tab-pane fade in active">

                            @foreach($services as $service)
                                @if($service->grupo==$tipoServicio[1])
                                    @php $estado='';@endphp


                                    @if($service->tipoServicio=='PRIVATE')
                                        @php
                                            $visual=' hide';
                                        @endphp
                                        <div id="service_edit_{{$itinerartio_cotis_id}}_{{$service->id}}" class="col-md-4{{$visual}}">
                                            @php
                                                $service_p=0;
                                            @endphp
                                            @if($service->precio_grupo==1)
                                                @php
                                                    $service_p=round($service->precio_venta/2,2);
                                                @endphp
                                            @else
                                                @php
                                                    $service_p=$service->precio_venta;
                                                @endphp
                                            @endif
                                            @if($estado!='')
                                                @php
                                                    $total_pre_ven_edit+=$service_p;
                                                @endphp
                                            @endif
                                            <div class="checkbox11">
                                                <label>
                                                    <input type="checkbox" class="servicios_edit" name="servicios{{$itinerartio_cotis_id}}[]" value="{{$itinerartio_cotis_id}}_{{$service_p}}_{{$service->id}}_{{$service->localizacion}}" onchange="sumar_servicios_edit({{$itinerartio_cotis_id}})" {{$estado}}>
                                                    {{$service->nombre}} <span class="text-10 text-green-goto">{{$service->localizacion}}</span> <span class="text-12 text-orange-goto">$ {{$service_p}} p.p</span>
                                                </label>
                                            </div>
                                        </div>
                                    @endif

                                @endif
                            @endforeach

                        </div>
                        <div id="t_edit_{{$itinerartio_cotis_id}}_{{$tipoServicio[1]}}_GROUP" class="tab-pane fade">

                            @foreach($services as $service)
                                @if($service->grupo==$tipoServicio[1])
                                    @php $estado='';@endphp

                                    @if($service->tipoServicio=='GROUP')
                                        @php
                                            $visual=' hide';
                                        @endphp
                                        <div id="service_edit_{{$itinerartio_cotis_id}}_{{$service->id}}" class="col-md-4{{$visual}}">
                                            @php
                                                $service_p=0;
                                            @endphp
                                            @if($service->precio_grupo==1)
                                                @php
                                                    $service_p=round($service->precio_venta/2,2);
                                                @endphp
                                            @else
                                                @php
                                                    $service_p=$service->precio_venta;
                                                @endphp
                                            @endif
                                            @if($estado!='')
                                                @php
                                                    $total_pre_ven_edit+=$service_p;
                                                @endphp
                                            @endif
                                            <div class="checkbox11">
                                                <label>
                                                    <input type="checkbox" class="servicios_edit" name="servicios{{$itinerartio_cotis_id}}[]" value="{{$itinerartio_cotis_id}}_{{$service_p}}_{{$service->id}}_{{$service->localizacion}}" onchange="sumar_servicios_edit({{$itinerartio_cotis_id}})" {{$estado}}>
                                                    {{$service->nombre}} <span class="text-10 text-green-goto">{{$service->localizacion}}</span> <span class="text-12 text-orange-goto">$ {{$service_p}} p.p</span>
                                                </label>
                                            </div>
                                        </div>
                                    @endif
                                @endif
                            @endforeach

                        </div>
                    </div>
                </div>
                <div id="t_edit_{{$itinerartio_cotis_id}}_{{$tipoServicio[2]}}" class="hide col-lg-12">
                    <ul class="nav nav-tabs">
                        <li class="active bg-warning"><a data-toggle="tab" href="#t_edit_{{$itinerartio_cotis_id}}_{{$tipoServicio[2]}}_AUTO">AUTO</a></li>
                        <li class="bg-warning"><a data-toggle="tab" href="#t_edit_{{$itinerartio_cotis_id}}_{{$tipoServicio[2]}}_SUV">SUV</a></li>
                        <li class="bg-warning"><a data-toggle="tab" href="#t_edit_{{$itinerartio_cotis_id}}_{{$tipoServicio[2]}}_VAN">VAN</a></li>
                        <li class="bg-warning"><a data-toggle="tab" href="#t_edit_{{$itinerartio_cotis_id}}_{{$tipoServicio[2]}}_H1">H1</a></li>
                        <li class="bg-warning"><a data-toggle="tab" href="#t_edit_{{$itinerartio_cotis_id}}_{{$tipoServicio[2]}}_SPRINTER">SPRINTER</a></li>
                        <li class="bg-warning"><a data-toggle="tab" href="#t_edit_{{$itinerartio_cotis_id}}_{{$tipoServicio[2]}}_BUS">BUS</a></li>
                    </ul>
                    {{--{{dd($tipos)}}--}}
                    <div class="tab-content margin-top-20">
                        <div id="t_edit_{{$itinerartio_cotis_id}}_{{$tipoServicio[2]}}_AUTO" class="tab-pane fade in active">

                            @foreach($services as $service)
                                @if($service->grupo==$tipoServicio[2])
                                    @php $estado='';@endphp


                                    @if($service->tipoServicio=='AUTO')
                                        @php
                                            $visual=' hide';
                                        @endphp
                                        <div id="service_edit_{{$itinerartio_cotis_id}}_{{$service->id}}" class="nueva col-md-4{{$visual}}">
                                            @php
                                                $service_p=0;
                                            @endphp
                                            @if($service->precio_grupo==1)
                                                @php
                                                    $service_p=round($service->precio_venta/2,2);
                                                @endphp
                                            @else
                                                @php
                                                    $service_p=$service->precio_venta;
                                                @endphp
                                            @endif
                                            @if($estado!='')
                                                @php
                                                    $total_pre_ven_edit+=$service_p;
                                                @endphp
                                            @endif
                                            <div class="checkbox11">
                                                <label>
                                                    <input type="checkbox" class="servicios_edit" name="servicios{{$itinerartio_cotis_id}}[]" value="{{$itinerartio_cotis_id}}_{{$service_p}}_{{$service->id}}_{{$service->localizacion}}" onchange="sumar_servicios_edit({{$itinerartio_cotis_id}})" {{$estado}}>
                                                    {{$service->nombre}} <span class="text-10 text-green-goto">{{$service->localizacion}}</span> <span class="text-12 text-orange-goto">$ {{$service_p}} p.p</span>
                                                </label>
                                            </div>
                                        </div>
                                    @endif
                                @endif
                            @endforeach
                        </div>
                        <div id="t_edit_{{$itinerartio_cotis_id}}_{{$tipoServicio[2]}}_SUV" class="tab-pane fade">

                            @foreach($services as $service)
                                @if($service->grupo==$tipoServicio[2])
                                    @php $estado='';@endphp

                                    @if($service->tipoServicio=='SUV')
                                        @php
                                            $visual=' hide';
                                        @endphp
                                        <div id="service_edit_{{$itinerartio_cotis_id}}_{{$service->id}}" class="col-md-4{{$visual}}">
                                            @php
                                                $service_p=0;
                                            @endphp
                                            @if($service->precio_grupo==1)
                                                @php
                                                    $service_p=round($service->precio_venta/2,2);
                                                @endphp
                                            @else
                                                @php
                                                    $service_p=$service->precio_venta;
                                                @endphp
                                            @endif
                                            @if($estado!='')
                                                @php
                                                    $total_pre_ven_edit+=$service_p;
                                                @endphp
                                            @endif
                                            <div class="checkbox11">
                                                <label>
                                                    <input type="checkbox" class="servicios_edit" name="servicios{{$itinerartio_cotis_id}}[]" value="{{$itinerartio_cotis_id}}_{{$service_p}}_{{$service->id}}_{{$service->localizacion}}" onchange="sumar_servicios_edit({{$itinerartio_cotis_id}})" {{$estado}}>
                                                    {{$service->nombre}} <span class="text-10 text-green-goto">{{$service->localizacion}}</span> <span class="text-12 text-orange-goto">$ {{$service_p}} p.p</span>
                                                </label>
                                            </div>
                                        </div>
                                    @endif
                                @endif
                            @endforeach
                            <p class="text-danger">SUMA PARCIAL:{{$total_pre_ven_edit}}</p>
                        </div>
                        <div id="t_edit_{{$itinerartio_cotis_id}}_{{$tipoServicio[2]}}_VAN" class="tab-pane fade">

                            @foreach($services as $service)
                                @if($service->grupo==$tipoServicio[2])
                                    @php $estado='';@endphp

                                    @if($service->tipoServicio=='VAN')
                                        @php
                                            $visual=' hide';
                                        @endphp
                                        <div id="service_edit_{{$itinerartio_cotis_id}}_{{$service->id}}" class="col-md-4{{$visual}}">
                                            @php
                                                $service_p=0;
                                            @endphp
                                            @if($service->precio_grupo==1)
                                                @php
                                                    $service_p=round($service->precio_venta/2,2);
                                                @endphp
                                            @else
                                                @php
                                                    $service_p=$service->precio_venta;
                                                @endphp
                                            @endif
                                            @if($estado!='')
                                                @php
                                                    $total_pre_ven_edit+=$service_p;
                                                @endphp
                                            @endif
                                            <div class="checkbox11">
                                                <label>
                                                    <input type="checkbox" class="servicios_edit" name="servicios{{$itinerartio_cotis_id}}[]" value="{{$itinerartio_cotis_id}}_{{$service_p}}_{{$service->id}}_{{$service->localizacion}}" onchange="sumar_servicios_edit({{$itinerartio_cotis_id}})" {{$estado}}>
                                                    {{$service->nombre}} <span class="text-10 text-green-goto">{{$service->localizacion}}</span> <span class="text-12 text-orange-goto">$ {{$service_p}} p.p</span>
                                                </label>
                                            </div>
                                        </div>
                                    @endif
                                @endif
                            @endforeach
                        </div>
                        <div id="t_edit_{{$itinerartio_cotis_id}}_{{$tipoServicio[2]}}_H1" class="tab-pane fade">

                            @foreach($services as $service)
                                @if($service->grupo==$tipoServicio[2])
                                    @php $estado='';@endphp

                                    @if($service->tipoServicio=='H1')
                                        @php
                                            $visual=' hide';
                                        @endphp
                                        <div id="service_edit_{{$itinerartio_cotis_id}}_{{$service->id}}" class="col-md-4{{$visual}}">
                                            @php
                                                $service_p=0;
                                            @endphp
                                            @if($service->precio_grupo==1)
                                                @php
                                                    $service_p=round($service->precio_venta/2,2);
                                                @endphp
                                            @else
                                                @php
                                                    $service_p=$service->precio_venta;
                                                @endphp
                                            @endif
                                            @if($estado!='')
                                                @php
                                                    $total_pre_ven_edit+=$service_p;
                                                @endphp
                                            @endif
                                            <div class="checkbox11">
                                                <label>
                                                    <input type="checkbox" class="servicios_edit" name="servicios{{$itinerartio_cotis_id}}[]" value="{{$itinerartio_cotis_id}}_{{$service_p}}_{{$service->id}}_{{$service->localizacion}}" onchange="sumar_servicios_edit({{$itinerartio_cotis_id}})" {{$estado}}>
                                                    {{$service->nombre}} <span class="text-10 text-green-goto">{{$service->localizacion}}</span> <span class="text-12 text-orange-goto">$ {{$service_p}} p.p</span>
                                                </label>
                                            </div>
                                        </div>
                                    @endif
                                @endif
                            @endforeach
                        </div>
                        <div id="t_edit_{{$itinerartio_cotis_id}}_{{$tipoServicio[2]}}_SPRINTER" class="tab-pane fade">

                            @foreach($services as $service)
                                @if($service->grupo==$tipoServicio[2])
                                    @php $estado='';@endphp

                                    @if($service->tipoServicio=='SPRINTER')
                                        @php
                                            $visual=' hide';
                                        @endphp
                                        <div id="service_edit_{{$itinerartio_cotis_id}}_{{$service->id}}" class="col-md-4{{$visual}}">
                                            @php
                                                $service_p=0;
                                            @endphp
                                            @if($service->precio_grupo==1)
                                                @php
                                                    $service_p=round($service->precio_venta/2,2);
                                                @endphp
                                            @else
                                                @php
                                                    $service_p=$service->precio_venta;
                                                @endphp
                                            @endif
                                            @if($estado!='')
                                                @php
                                                    $total_pre_ven_edit+=$service_p;
                                                @endphp
                                            @endif
                                            <div class="checkbox11">
                                                <label>
                                                    <input type="checkbox" class="servicios_edit" name="servicios{{$itinerartio_cotis_id}}[]" value="{{$itinerartio_cotis_id}}_{{$service_p}}_{{$service->id}}_{{$service->localizacion}}" onchange="sumar_servicios_edit({{$itinerartio_cotis_id}})" {{$estado}}>
                                                    {{$service->nombre}} <span class="text-10 text-green-goto">{{$service->localizacion}}</span> <span class="text-12 text-orange-goto">$ {{$service_p}} p.p</span>
                                                </label>
                                            </div>
                                        </div>
                                    @endif
                                @endif
                            @endforeach
                        </div>
                        <div id="t_edit_{{$itinerartio_cotis_id}}_{{$tipoServicio[2]}}_BUS" class="tab-pane fade">

                            @foreach($services as $service)
                                @if($service->grupo==$tipoServicio[2])
                                    @php $estado='';@endphp

                                    @if($service->tipoServicio=='BUS')
                                        @php
                                            $visual=' hide';
                                        @endphp
                                        <div id="service_edit_{{$itinerartio_cotis_id}}_{{$service->id}}" class="col-md-4{{$visual}}">
                                            @php
                                                $service_p=0;
                                            @endphp
                                            @if($service->precio_grupo==1)
                                                @php
                                                    $service_p=round($service->precio_venta/2,2);
                                                @endphp
                                            @else
                                                @php
                                                    $service_p=$service->precio_venta;
                                                @endphp
                                            @endif
                                            @if($estado!='')
                                                @php
                                                    $total_pre_ven_edit+=$service_p;
                                                @endphp
                                            @endif
                                            <div class="checkbox11">
                                                <label>
                                                    <input type="checkbox" class="servicios_edit" name="servicios{{$itinerartio_cotis_id}}[]" value="{{$itinerartio_cotis_id}}_{{$service_p}}_{{$service->id}}_{{$service->localizacion}}" onchange="sumar_servicios_edit({{$itinerartio_cotis_id}})" {{$estado}}>
                                                    {{$service->nombre}} <span class="text-10 text-green-goto">{{$service->localizacion}}</span> <span class="text-12 text-orange-goto">$ {{$service_p}} p.p</span>
                                                </label>
                                            </div>
                                        </div>
                                    @endif
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
                <div id="t_edit_{{$itinerartio_cotis_id}}_{{$tipoServicio[3]}}" class="hide col-lg-12">
                    <ul class="nav nav-tabs">
                        <li class="active bg-success"><a data-toggle="tab" href="#t_edit_{{$itinerartio_cotis_id}}_{{$tipoServicio[3]}}_GUIDE">GUIDE</a></li>
                        <li class="bg-success"><a data-toggle="tab" href="#t_edit_{{$itinerartio_cotis_id}}_{{$tipoServicio[3]}}_TRANSFER">TRANSFER</a></li>
                        <li class="bg-success"><a data-toggle="tab" href="#t_edit_{{$itinerartio_cotis_id}}_{{$tipoServicio[3]}}_ASSISTANCE">ASSISTANCE</a></li>
                    </ul>
                    {{--{{dd($tipos)}}--}}
                    <div class="tab-content margin-top-20">
                        <div id="t_edit_{{$itinerartio_cotis_id}}_{{$tipoServicio[3]}}_GUIDE" class="tab-pane fade in active">

                            @foreach($services as $service)
                                @if($service->grupo==$tipoServicio[3])
                                    @php $estado='';@endphp

                                    @if($service->tipoServicio=='GUIDE')
                                        @php
                                            $visual=' hide';
                                        @endphp
                                        <div id="service_edit_{{$itinerartio_cotis_id}}_{{$service->id}}" class="col-md-4{{$visual}}">
                                            @php
                                                $service_p=0;
                                            @endphp
                                            @if($service->precio_grupo==1)
                                                @php
                                                    $service_p=round($service->precio_venta/2,2);
                                                @endphp
                                            @else
                                                @php
                                                    $service_p=$service->precio_venta;
                                                @endphp
                                            @endif
                                            @if($estado!='')
                                                @php
                                                    $total_pre_ven_edit+=$service_p;
                                                @endphp
                                            @endif
                                            <div class="checkbox11">
                                                <label>
                                                    <input type="checkbox" class="servicios_edit" name="servicios{{$itinerartio_cotis_id}}[]" value="{{$itinerartio_cotis_id}}_{{$service_p}}_{{$service->id}}_{{$service->localizacion}}" onchange="sumar_servicios_edit({{$itinerartio_cotis_id}})" {{$estado}}>
                                                    {{$service->nombre}} <span class="text-10 text-green-goto">{{$service->localizacion}}</span> <span class="text-12 text-orange-goto">$ {{$service_p}} p.p</span>
                                                </label>
                                            </div>
                                        </div>
                                    @endif
                                @endif
                            @endforeach
                        </div>
                        <div id="t_edit_{{$itinerartio_cotis_id}}_{{$tipoServicio[3]}}_TRANSFER" class="tab-pane fade">

                            @foreach($services as $service)
                                @if($service->grupo==$tipoServicio[3])
                                    @php $estado='';@endphp

                                    @if($service->tipoServicio=='TRANSFER')
                                        @php
                                            $visual=' hide';
                                        @endphp
                                        <div id="service_edit_{{$itinerartio_cotis_id}}_{{$service->id}}" class="col-md-4{{$visual}}">
                                            @php
                                                $service_p=0;
                                            @endphp
                                            @if($service->precio_grupo==1)
                                                @php
                                                    $service_p=round($service->precio_venta/2,2);
                                                @endphp
                                            @else
                                                @php
                                                    $service_p=$service->precio_venta;
                                                @endphp
                                            @endif
                                            @if($estado!='')
                                                @php
                                                    $total_pre_ven_edit+=$service_p;
                                                @endphp
                                            @endif
                                            <div class="checkbox11">
                                                <label>
                                                    <input type="checkbox" class="servicios_edit" name="servicios{{$itinerartio_cotis_id}}[]" value="{{$itinerartio_cotis_id}}_{{$service_p}}_{{$service->id}}_{{$service->localizacion}}" onchange="sumar_servicios_edit({{$itinerartio_cotis_id}})" {{$estado}}>
                                                    {{$service->nombre}} <span class="text-10 text-green-goto">{{$service->localizacion}}</span> <span class="text-12 text-orange-goto">$ {{$service_p}} p.p</span>
                                                </label>
                                            </div>
                                        </div>
                                    @endif
                                @endif
                            @endforeach
                        </div>
                        <div id="t_edit_{{$itinerartio_cotis_id}}_{{$tipoServicio[3]}}_ASSISTANCE" class="tab-pane fade">

                            @foreach($services as $service)
                                @if($service->grupo==$tipoServicio[3])
                                    @php $estado='';@endphp


                                    @if($service->tipoServicio=='ASSISTANCE')
                                        @php
                                            $visual=' hide';
                                        @endphp
                                        <div id="service_edit_{{$itinerartio_cotis_id}}_{{$service->id}}" class="col-md-4{{$visual}}">
                                            @php
                                                $service_p=0;
                                            @endphp
                                            @if($service->precio_grupo==1)
                                                @php
                                                    $service_p=round($service->precio_venta/2,2);
                                                @endphp
                                            @else
                                                @php
                                                    $service_p=$service->precio_venta;
                                                @endphp
                                            @endif
                                            @if($estado!='')
                                                @php
                                                    $total_pre_ven_edit+=$service_p;
                                                @endphp
                                            @endif
                                            <div class="checkbox11">
                                                <label>
                                                    <input type="checkbox" class="servicios_edit" name="servicios{{$itinerartio_cotis_id}}[]" value="{{$itinerartio_cotis_id}}_{{$service_p}}_{{$service->id}}_{{$service->localizacion}}" onchange="sumar_servicios_edit({{$itinerartio_cotis_id}})" {{$estado}}>
                                                    {{$service->nombre}} <span class="text-10 text-green-goto">{{$service->localizacion}}</span> <span class="text-12 text-orange-goto">$ {{$service_p}} p.p</span>

                                                </label>
                                            </div>
                                        </div>
                                    @endif
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
                <div id="t_edit_{{$itinerartio_cotis_id}}_{{$tipoServicio[4]}}" class="hide col-lg-12">
                    <ul class="nav nav-tabs">
                        <li class="active bg-warning"><a data-toggle="tab" href="#t_edit_{{$itinerartio_cotis_id}}_{{$tipoServicio[4]}}_EXTRANJERO">EXTRANJERO</a></li>
                        <li class="bg-warning"><a data-toggle="tab" href="#t_edit_{{$itinerartio_cotis_id}}_{{$tipoServicio[4]}}_NATIONAL">NATIONAL</a></li>
                    </ul>

                    <div class="tab-content margin-top-20">
                        <div id="t_edit_{{$itinerartio_cotis_id}}_{{$tipoServicio[4]}}_EXTRANJERO" class="tab-pane fade in active">

                            @foreach($services as $service)
                                @if($service->grupo==$tipoServicio[4])
                                    @php $estado='';@endphp

                                    @if($service->tipoServicio=='EXTRANJERO')
                                        @php
                                            $visual=' hide';
                                        @endphp
                                        <div id="service_edit_{{$itinerartio_cotis_id}}_{{$service->id}}" class="col-md-4{{$visual}}">
                                            @php
                                                $service_p=0;
                                            @endphp
                                            @if($service->precio_grupo==1)
                                                @php
                                                    $service_p=round($service->precio_venta/2,2);
                                                @endphp
                                            @else
                                                @php
                                                    $service_p=$service->precio_venta;
                                                @endphp
                                            @endif
                                            @if($estado!='')
                                                @php
                                                    $total_pre_ven_edit+=$service_p;
                                                @endphp
                                            @endif
                                            <div class="checkbox11">
                                                <label>
                                                    <input type="checkbox" class="servicios_edit" name="servicios{{$itinerartio_cotis_id}}[]" value="{{$itinerartio_cotis_id}}_{{$service_p}}_{{$service->id}}_{{$service->localizacion}}" onchange="sumar_servicios_edit({{$itinerartio_cotis_id}})" {{$estado}}>
                                                    {{$service->nombre}} <span class="text-10 text-green-goto">{{$service->localizacion}}</span> <span class="text-12 text-orange-goto">$ {{$service_p}} p.p</span>
                                                </label>
                                            </div>
                                        </div>
                                    @endif
                                @endif
                            @endforeach
                        </div>
                        <div id="t_edit_{{$itinerartio_cotis_id}}_{{$tipoServicio[4]}}_NATIONAL" class="tab-pane fade">

                            @foreach($services as $service)
                                @if($service->grupo==$tipoServicio[4])
                                    @php $estado='';@endphp

                                    @if($service->tipoServicio=='NATIONAL')
                                        @php
                                            $visual=' hide';
                                        @endphp
                                        <div id="service_edit_{{$itinerartio_cotis_id}}_{{$service->id}}" class="col-md-4{{$visual}}">
                                            @php
                                                $service_p=0;
                                            @endphp
                                            @if($service->precio_grupo==1)
                                                @php
                                                    $service_p=round($service->precio_venta/2,2);
                                                @endphp
                                            @else
                                                @php
                                                    $service_p=$service->precio_venta;
                                                @endphp
                                            @endif
                                            @if($estado!='')
                                                @php
                                                    $total_pre_ven_edit+=$service_p;
                                                @endphp
                                            @endif
                                            <div class="checkbox11">
                                                <label>
                                                    <input type="checkbox" class="servicios_edit" name="servicios{{$itinerartio_cotis_id}}[]" value="{{$itinerartio_cotis_id}}_{{$service_p}}_{{$service->id}}_{{$service->localizacion}}" onchange="sumar_servicios_edit({{$itinerartio_cotis_id}})" {{$estado}}>
                                                    {{$service->nombre}} <span class="text-10 text-green-goto">{{$service->localizacion}}</span> <span class="text-12 text-orange-goto">$ {{$service_p}} p.p</span>
                                                </label>
                                            </div>
                                        </div>
                                    @endif
                                @endif
                            @endforeach
                        </div>
                    </div>

                </div>
                <div id="t_edit_{{$itinerartio_cotis_id}}_{{$tipoServicio[5]}}" class="hide col-lg-12">
                    <ul class="nav nav-tabs">
                        <li class="active bg-danger"><a data-toggle="tab" href="#t_edit_{{$itinerartio_cotis_id}}_{{$tipoServicio[5]}}_LUNCH">LUNCH</a></li>
                        <li class="bg-danger"><a data-toggle="tab" href="#t_edit_{{$itinerartio_cotis_id}}_{{$tipoServicio[5]}}_DINNER">DINNER</a></li>
                        <li class="bg-danger"><a data-toggle="tab" href="#t_edit_{{$itinerartio_cotis_id}}_{{$tipoServicio[5]}}_BOX_LUNCH">BOX LUNCH</a></li>
                    </ul>
                    {{--{{dd($tipos)}}--}}
                    <div class="tab-content margin-top-20">
                        <div id="t_edit_{{$itinerartio_cotis_id}}_{{$tipoServicio[5]}}_LUNCH" class="tab-pane fade in active">

                            @foreach($services as $service)
                                @if($service->grupo==$tipoServicio[5])
                                    @php $estado='';@endphp

                                    @if($service->tipoServicio=='LUNCH')
                                        @php
                                            $visual=' hide';
                                        @endphp
                                        <div id="service_edit_{{$itinerartio_cotis_id}}_{{$service->id}}" class="col-md-4{{$visual}}">
                                            @php
                                                $service_p=0;
                                            @endphp
                                            @if($service->precio_grupo==1)
                                                @php
                                                    $service_p=round($service->precio_venta/2,2);
                                                @endphp
                                            @else
                                                @php
                                                    $service_p=$service->precio_venta;
                                                @endphp
                                            @endif
                                            @if($estado!='')
                                                @php
                                                    $total_pre_ven_edit+=$service_p;
                                                @endphp
                                            @endif
                                            <div class="checkbox11">
                                                <label>
                                                    <input type="checkbox" class="servicios_edit" name="servicios{{$itinerartio_cotis_id}}[]" value="{{$itinerartio_cotis_id}}_{{$service_p}}_{{$service->id}}_{{$service->localizacion}}" onchange="sumar_servicios_edit({{$itinerartio_cotis_id}})" {{$estado}}>
                                                    {{$service->nombre}} <span class="text-10 text-green-goto">{{$service->localizacion}}</span> <span class="text-12 text-orange-goto">$ {{$service_p}} p.p</span>
                                                </label>
                                            </div>
                                        </div>
                                    @endif
                                @endif
                            @endforeach
                        </div>
                        <div id="t_edit_{{$itinerartio_cotis_id}}_{{$tipoServicio[5]}}_DINNER" class="tab-pane fade">

                            @foreach($services as $service)
                                @if($service->grupo==$tipoServicio[5])
                                    @php $estado='';@endphp

                                    @if($service->tipoServicio=='DINNER')
                                        @php
                                            $visual=' hide';
                                        @endphp
                                        <div id="service_edit_{{$itinerartio_cotis_id}}_{{$service->id}}" class="col-md-4{{$visual}}">
                                            @php
                                                $service_p=0;
                                            @endphp
                                            @if($service->precio_grupo==1)
                                                @php
                                                    $service_p=round($service->precio_venta/2,2);
                                                @endphp
                                            @else
                                                @php
                                                    $service_p=$service->precio_venta;
                                                @endphp
                                            @endif
                                            @if($estado!='')
                                                @php
                                                    $total_pre_ven_edit+=$service_p;
                                                @endphp
                                            @endif
                                            <div class="checkbox11">
                                                <label>
                                                    <input type="checkbox" class="servicios_edit" name="servicios{{$itinerartio_cotis_id}}[]" value="{{$itinerartio_cotis_id}}_{{$service_p}}_{{$service->id}}_{{$service->localizacion}}" onchange="sumar_servicios_edit({{$itinerartio_cotis_id}})" {{$estado}}>
                                                    {{$service->nombre}} <span class="text-10 text-green-goto">{{$service->localizacion}}</span> <span class="text-12 text-orange-goto">$ {{$service_p}} p.p</span>
                                                </label>
                                            </div>
                                        </div>
                                    @endif
                                @endif
                            @endforeach
                        </div>
                        <div id="t_edit_{{$itinerartio_cotis_id}}_{{$tipoServicio[5]}}_BOX_LUNCH" class="tab-pane fade">

                            @foreach($services as $service)
                                @if($service->grupo==$tipoServicio[5])
                                    @php $estado='';@endphp

                                    @if($service->tipoServicio=='BOX LUNCH')
                                        @php
                                            $visual=' hide';
                                        @endphp
                                        <div id="service_edit_{{$itinerartio_cotis_id}}_{{$service->id}}" class="col-md-4{{$visual}}">
                                            @php
                                                $service_p=0;
                                            @endphp
                                            @if($service->precio_grupo==1)
                                                @php
                                                    $service_p=round($service->precio_venta/2,2);
                                                @endphp
                                            @else
                                                @php
                                                    $service_p=$service->precio_venta;
                                                @endphp
                                            @endif
                                            @if($estado!='')
                                                @php
                                                    $total_pre_ven_edit+=$service_p;
                                                @endphp
                                            @endif
                                            <div class="checkbox11">
                                                <label>
                                                    <input type="checkbox" class="servicios_edit" name="servicios{{$itinerartio_cotis_id}}[]" value="{{$itinerartio_cotis_id}}_{{$service_p}}_{{$service->id}}_{{$service->localizacion}}" onchange="sumar_servicios_edit({{$itinerartio_cotis_id}})" {{$estado}}>
                                                    {{$service->nombre}} <span class="text-10 text-green-goto">{{$service->localizacion}}</span> <span class="text-12 text-orange-goto">$ {{$service_p}} p.p</span>
                                                </label>
                                            </div>
                                        </div>
                                    @endif
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
                <div id="t_edit_{{$itinerartio_cotis_id}}_{{$tipoServicio[6]}}" class="hide col-lg-12">
                    <ul class="nav nav-tabs">
                        <li class="active bg-info"><a data-toggle="tab" href="#t_edit_{{$itinerartio_cotis_id}}_{{$tipoServicio[6]}}_EXPEDITION">EXPEDITION</a></li>
                        <li class="bg-info"><a data-toggle="tab" href="#t_edit_{{$itinerartio_cotis_id}}_{{$tipoServicio[6]}}_VISITADOME">VISITADOME</a></li>
                        <li class="bg-info"><a data-toggle="tab" href="#t_edit_{{$itinerartio_cotis_id}}_{{$tipoServicio[6]}}_EJECUTIVO">EJECUTIVO</a></li>
                        <li class="bg-info"><a data-toggle="tab" href="#t_edit_{{$itinerartio_cotis_id}}_{{$tipoServicio[6]}}_FIRST_CLASS">FIRST CLASS</a></li>
                        <li class="bg-info"><a data-toggle="tab" href="#t_edit_{{$itinerartio_cotis_id}}_{{$tipoServicio[6]}}_HIRAN_BINGHAN">HIRAN BINGHAN</a></li>
                        <li class="bg-info"><a data-toggle="tab" href="#t_edit_{{$itinerartio_cotis_id}}_{{$tipoServicio[6]}}_PRESIDENTIAL">PRESIDENTIAL</a></li>
                    </ul>
                    {{--{{dd($tipos)}}--}}
                    <div class="tab-content margin-top-20">
                        <div id="t_edit_{{$itinerartio_cotis_id}}_{{$tipoServicio[6]}}_EXPEDITION" class="tab-pane fade in active">

                            @foreach($services as $service)
                                @if($service->grupo==$tipoServicio[6])
                                    @php $estado='';@endphp

                                    @if($service->tipoServicio=='EXPEDITION')
                                        @php
                                            $visual=' hide';
                                        @endphp
                                        <div id="service_edit_{{$itinerartio_cotis_id}}_{{$service->id}}" class="col-md-4{{$visual}}">
                                            @php
                                                $service_p=0;
                                            @endphp
                                            @if($service->precio_grupo==1)
                                                @php
                                                    $service_p=round($service->precio_venta/2,2);
                                                @endphp
                                            @else
                                                @php
                                                    $service_p=$service->precio_venta;
                                                @endphp
                                            @endif
                                            @if($estado!='')
                                                @php
                                                    $total_pre_ven_edit+=$service_p;
                                                @endphp
                                            @endif
                                            <div class="checkbox11">
                                                <label>
                                                    <input type="checkbox" class="servicios_edit" name="servicios{{$itinerartio_cotis_id}}[]" value="{{$itinerartio_cotis_id}}_{{$service_p}}_{{$service->id}}_{{$service->localizacion}}" onchange="sumar_servicios_edit({{$itinerartio_cotis_id}})" {{$estado}}>
                                                    {{$service->nombre}} <span class="text-10 text-green-goto">{{$service->localizacion}}</span> <span class="text-12 text-orange-goto">$ {{$service_p}} p.p</span>
                                                </label>
                                            </div>
                                        </div>
                                    @endif
                                @endif
                            @endforeach
                        </div>
                        <div id="t_edit_{{$itinerartio_cotis_id}}_{{$tipoServicio[6]}}_VISITADOME" class="tab-pane fade">

                            @foreach($services as $service)
                                @if($service->grupo==$tipoServicio[6])
                                    @php $estado='';@endphp

                                    @if($service->tipoServicio=='VISITADOME')
                                        @php
                                            $visual=' hide';
                                        @endphp
                                        <div id="service_edit_{{$itinerartio_cotis_id}}_{{$service->id}}" class="col-md-4{{$visual}}">
                                            @php
                                                $service_p=0;
                                            @endphp
                                            @if($service->precio_grupo==1)
                                                @php
                                                    $service_p=round($service->precio_venta/2,2);
                                                @endphp
                                            @else
                                                @php
                                                    $service_p=$service->precio_venta;
                                                @endphp
                                            @endif
                                            @if($estado!='')
                                                @php
                                                    $total_pre_ven_edit+=$service_p;
                                                @endphp
                                            @endif
                                            <div class="checkbox11">
                                                <label>
                                                    <input type="checkbox" class="servicios_edit" name="servicios{{$itinerartio_cotis_id}}[]" value="{{$itinerartio_cotis_id}}_{{$service_p}}_{{$service->id}}_{{$service->localizacion}}" onchange="sumar_servicios_edit({{$itinerartio_cotis_id}})" {{$estado}}>
                                                    {{$service->nombre}} <span class="text-10 text-green-goto">{{$service->localizacion}}</span> <span class="text-12 text-orange-goto">$ {{$service_p}} p.p</span>
                                                </label>
                                            </div>
                                        </div>
                                    @endif
                                @endif
                            @endforeach
                        </div>
                        <div id="t_edit_{{$itinerartio_cotis_id}}_{{$tipoServicio[6]}}_EJECUTIVO" class="tab-pane fade">

                            @foreach($services as $service)
                                @if($service->grupo==$tipoServicio[6])
                                    @php $estado='';@endphp

                                    @if($service->tipoServicio=='EJECUTIVO')
                                        @php
                                            $visual=' hide';
                                        @endphp
                                        <div id="service_edit_{{$itinerartio_cotis_id}}_{{$service->id}}" class="col-md-4{{$visual}}">
                                            @php
                                                $service_p=0;
                                            @endphp
                                            @if($service->precio_grupo==1)
                                                @php
                                                    $service_p=round($service->precio_venta/2,2);
                                                @endphp
                                            @else
                                                @php
                                                    $service_p=$service->precio_venta;
                                                @endphp
                                            @endif
                                            @if($estado!='')
                                                @php
                                                    $total_pre_ven_edit+=$service_p;
                                                @endphp
                                            @endif
                                            <div class="checkbox11">
                                                <label>
                                                    <input type="checkbox" class="servicios_edit" name="servicios{{$itinerartio_cotis_id}}[]" value="{{$itinerartio_cotis_id}}_{{$service_p}}_{{$service->id}}_{{$service->localizacion}}" onchange="sumar_servicios_edit({{$itinerartio_cotis_id}})" {{$estado}}>
                                                    {{$service->nombre}} <span class="text-10 text-green-goto">{{$service->localizacion}}</span> <span class="text-12 text-orange-goto">$ {{$service_p}} p.p</span>
                                                </label>
                                            </div>
                                        </div>
                                    @endif
                                @endif
                            @endforeach
                        </div>
                        <div id="t_edit_{{$itinerartio_cotis_id}}_{{$tipoServicio[6]}}_FIRST_CLASS" class="tab-pane fade">

                            @foreach($services as $service)
                                @if($service->grupo==$tipoServicio[6])
                                    @php $estado='';@endphp

                                    @if($service->tipoServicio=='FIRST CLASS')
                                        @php
                                            $visual=' hide';
                                        @endphp
                                        <div id="service_edit_{{$itinerartio_cotis_id}}_{{$service->id}}" class="col-md-4{{$visual}}">
                                            @php
                                                $service_p=0;
                                            @endphp
                                            @if($service->precio_grupo==1)
                                                @php
                                                    $service_p=round($service->precio_venta/2,2);
                                                @endphp
                                            @else
                                                @php
                                                    $service_p=$service->precio_venta;
                                                @endphp
                                            @endif
                                            @if($estado!='')
                                                @php
                                                    $total_pre_ven_edit+=$service_p;
                                                @endphp
                                            @endif
                                            <div class="checkbox11">
                                                <label>
                                                    <input type="checkbox" class="servicios_edit" name="servicios{{$itinerartio_cotis_id}}[]" value="{{$itinerartio_cotis_id}}_{{$service_p}}_{{$service->id}}_{{$service->localizacion}}" onchange="sumar_servicios_edit({{$itinerartio_cotis_id}})" {{$estado}}>
                                                    {{$service->nombre}} <span class="text-10 text-green-goto">{{$service->localizacion}}</span> <span class="text-12 text-orange-goto">$ {{$service_p}} p.p</span>
                                                </label>
                                            </div>
                                        </div>
                                    @endif
                                @endif
                            @endforeach
                        </div>
                        <div id="t_edit_{{$itinerartio_cotis_id}}_{{$tipoServicio[6]}}_HIRAN_BINGHAN" class="tab-pane fade">

                            @foreach($services as $service)
                                @if($service->grupo==$tipoServicio[6])
                                    @php $estado='';@endphp

                                    @if($service->tipoServicio=='HIRAN BINGHAN')
                                        @php
                                            $visual=' hide';
                                        @endphp
                                        <div id="service_edit_{{$itinerartio_cotis_id}}_{{$service->id}}" class="col-md-4{{$visual}}">
                                            @php
                                                $service_p=0;
                                            @endphp
                                            @if($service->precio_grupo==1)
                                                @php
                                                    $service_p=round($service->precio_venta/2,2);
                                                @endphp
                                            @else
                                                @php
                                                    $service_p=$service->precio_venta;
                                                @endphp
                                            @endif
                                            @if($estado!='')
                                                @php
                                                    $total_pre_ven_edit+=$service_p;
                                                @endphp
                                            @endif
                                            <div class="checkbox11">
                                                <label>
                                                    <input type="checkbox" class="servicios_edit" name="servicios{{$itinerartio_cotis_id}}[]" value="{{$itinerartio_cotis_id}}_{{$service_p}}_{{$service->id}}_{{$service->localizacion}}" onchange="sumar_servicios_edit({{$itinerartio_cotis_id}})" {{$estado}}>
                                                    {{$service->nombre}} <span class="text-10 text-green-goto">{{$service->localizacion}}</span> <span class="text-12 text-orange-goto">$ {{$service_p}} p.p</span>
                                                </label>
                                            </div>
                                        </div>
                                    @endif
                                @endif
                            @endforeach
                        </div>
                        <div id="t_edit_{{$itinerartio_cotis_id}}_{{$tipoServicio[6]}}_PRESIDENTIAL" class="tab-pane fade">

                            @foreach($services as $service)
                                @if($service->grupo==$tipoServicio[6])
                                    @php $estado='';@endphp

                                    @if($service->tipoServicio=='PRESIDENTIAL')
                                        @php
                                            $visual=' hide';
                                        @endphp
                                        <div id="service_edit_{{$itinerartio_cotis_id}}_{{$service->id}}" class="col-md-4{{$visual}}">
                                            @php
                                                $service_p=0;
                                            @endphp
                                            @if($service->precio_grupo==1)
                                                @php
                                                    $service_p=round($service->precio_venta/2,2);
                                                @endphp
                                            @else
                                                @php
                                                    $service_p=$service->precio_venta;
                                                @endphp
                                            @endif
                                            @if($estado!='')
                                                @php
                                                    $total_pre_ven_edit+=$service_p;
                                                @endphp
                                            @endif
                                            <div class="checkbox11">
                                                <label>
                                                    <input type="checkbox" class="servicios_edit" name="servicios{{$itinerartio_cotis_id}}[]" value="{{$itinerartio_cotis_id}}_{{$service_p}}_{{$service->id}}_{{$service->localizacion}}" onchange="sumar_servicios_edit({{$itinerartio_cotis_id}})" {{$estado}}>
                                                    {{$service->nombre}} <span class="text-10 text-green-goto">{{$service->localizacion}}</span> <span class="text-12 text-orange-goto">$ {{$service_p}} p.p</span>
                                                </label>
                                            </div>
                                        </div>
                                    @endif
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
                <div id="t_edit_{{$itinerartio_cotis_id}}_{{$tipoServicio[7]}}" class="hide col-lg-12">
                    <ul class="nav nav-tabs">
                        <li class="active bg-info"><a data-toggle="tab" href="#t_edit_{{$itinerartio_cotis_id}}_{{$tipoServicio[7]}}_NATIONAL">NATIONAL</a></li>
                        <li class="bg-info"><a data-toggle="tab" href="#t_edit_{{$itinerartio_cotis_id}}_{{$tipoServicio[7]}}_INTERNATIONAL">INTERNATIONAL</a></li>
                    </ul>
                    {{--{{dd($tipos)}}--}}
                    <div class="tab-content margin-top-20">
                        <div id="t_edit_{{$itinerartio_cotis_id}}_{{$tipoServicio[7]}}_NATIONAL" class="tab-pane fade in active">

                            @foreach($services as $service)
                                @if($service->grupo==$tipoServicio[7])
                                    @php $estado='';@endphp

                                    @if($service->tipoServicio=='NATIONAL')
                                        @php
                                            $visual=' hide';
                                        @endphp
                                        <div id="service_edit_{{$itinerartio_cotis_id}}_{{$service->id}}" class="col-md-4{{$visual}}">
                                            @php
                                                $service_p=0;
                                            @endphp
                                            @if($service->precio_grupo==1)
                                                @php
                                                    $service_p=round($service->precio_venta/2,2);
                                                @endphp
                                            @else
                                                @php
                                                    $service_p=$service->precio_venta;
                                                @endphp
                                            @endif
                                            @if($estado!='')
                                                @php
                                                    $total_pre_ven_edit+=$service_p;
                                                @endphp
                                            @endif
                                            <div class="checkbox11">
                                                <label>
                                                    <input type="checkbox" class="servicios_edit" name="servicios{{$itinerartio_cotis_id}}[]" value="{{$itinerartio_cotis_id}}_{{$service_p}}_{{$service->id}}_{{$service->localizacion}}" onchange="sumar_servicios_edit({{$itinerartio_cotis_id}})" {{$estado}}>
                                                    {{$service->nombre}} <span class="text-10 text-green-goto">{{$service->localizacion}}</span> <span class="text-12 text-orange-goto">$ {{$service_p}} p.p</span>
                                                </label>
                                            </div>
                                        </div>
                                    @endif
                                @endif
                            @endforeach
                        </div>
                        <div id="t_edit_{{$itinerartio_cotis_id}}_{{$tipoServicio[7]}}_INTERNATIONAL" class="tab-pane fade">

                            @foreach($services as $service)
                                @if($service->grupo==$tipoServicio[7])
                                    @php $estado='';@endphp

                                    @if($service->tipoServicio=='INTERNATIONAL')
                                        @php
                                            $visual=' hide';
                                        @endphp
                                        <div id="service_edit_{{$itinerartio_cotis_id}}_{{$service->id}}" class="col-md-4{{$visual}}">
                                            @php
                                                $service_p=0;
                                            @endphp
                                            @if($service->precio_grupo==1)
                                                @php
                                                    $service_p=round($service->precio_venta/2,2);
                                                @endphp
                                            @else
                                                @php
                                                    $service_p=$service->precio_venta;
                                                @endphp
                                            @endif
                                            @if($estado!='')
                                                @php
                                                    $total_pre_ven_edit+=$service_p;
                                                @endphp
                                            @endif
                                            <div class="checkbox11">
                                                <label>
                                                    <input type="checkbox" class="servicios_edit" name="servicios{{$itinerartio_cotis_id}}[]" value="{{$itinerartio_cotis_id}}_{{$service_p}}_{{$service->id}}_{{$service->localizacion}}" onchange="sumar_servicios_edit({{$itinerartio_cotis_id}})" {{$estado}}>
                                                    {{$service->nombre}} <span class="text-10 text-green-goto">{{$service->localizacion}}</span> <span class="text-12 text-orange-goto">$ {{$service_p}} p.p</span>
                                                </label>
                                            </div>
                                        </div>
                                    @endif
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
                <div id="t_edit_{{$itinerartio_cotis_id}}_{{$tipoServicio[8]}}" class="hide col-lg-12">
                    @php
                        $array_tipos=array();
                    @endphp
                    @foreach($services as $service)
                        @if($service->grupo==$tipoServicio[8])

                            <?php
                            $array_tipos[$service->tipoServicio]=$service->tipoServicio;
                            ?>
                        @endif
                    @endforeach

                    <ul class="nav nav-tabs">
                        @foreach($array_tipos as $array_tipo)
                            <li class="active bg-info"><a data-toggle="tab" href="#t_edit_{{$itinerartio_cotis_id}}_{{$array_tipo}}">$array_tipo</a></li>
                        @endforeach
                    </ul>
                    <div class="tab-content margin-top-20">
                        @php
                            $veces=' in active';
                        @endphp

                        @foreach($array_tipos as $array_tipo)

                            <div id="t_edit_{{$itinerartio_cotis_id}}_{{$array_tipo}}" class="tab-pane fade {{$veces}}">
                                @foreach($services as $service)
                                    @if($service->grupo==$tipoServicio[8])
                                        @php $estado='';@endphp

                                        @if($service->tipoServicio==$array_tipo)
                                            @php
                                                $visual=' hide';
                                            @endphp

                                            <div id="service_edit_{{$itinerartio_cotis_id}}_{{$service->id}}" class="col-md-4{{$visual}}">
                                                @php
                                                    $service_p=0;
                                                @endphp
                                                @if($service->precio_grupo==1)
                                                    @php
                                                        $service_p=round($service->precio_venta/2,2);
                                                    @endphp
                                                @else
                                                    @php
                                                        $service_p=$service->precio_venta;
                                                    @endphp
                                                @endif
                                                @if($estado!='')
                                                    @php
                                                        $total_pre_ven_edit+=$service_p;
                                                    @endphp
                                                @endif
                                                <div class="checkbox11">
                                                    <label>
                                                        <input type="checkbox" class="servicios_edit" name="servicios{{$itinerartio_cotis_id}}[]" value="{{$itinerartio_cotis_id}}_{{$service_p}}_{{$service->id}}_{{$service->localizacion}}" onchange="sumar_servicios_edit({{$itinerartio_cotis_id}})" {{$estado}}>
                                                        {{$service->nombre}} <span class="text-10 text-green-goto">{{$service->localizacion}}</span> <span class="text-12 text-orange-goto">$ {{$service_p}} p.p</span>
                                                    </label>
                                                </div>
                                            </div>
                                        @endif
                                    @endif
                                @endforeach
                            </div>
                            @php
                                $veces='';
                            @endphp
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-6 text-left text-16">
                    <label class="text-green-goto">Total $<span id="total_ci_{{$itinerartio_cotis_id}}">{{$total_pre_ven_edit}}</span></label>
                </div>
                <div class="col-lg-6">
                    <input type="hidden" name="origen" value="ventas">
                    <button type="submit" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </div>
            {{csrf_field()}}
            <input type="hidden" name="precio_itinerario" id="precio_itinerario" value="{{$total_pre_ven_edit}}">
            <input type="hidden" name="itinerario_id" id="itinerario_id" value="{{$itinerartio_cotis_id}}">
            <input type="hidden" name="cotizaciones_id" id="cotizaciones_id" value="{{$cotizaciones_id}}">

        </form>
    </div>
    <script>
        $(document).ready(function() {
            $('#example').DataTable();
            /* Valida el tamaño maximo de un archivo adjunto */

        } );

        function ValidarImagen(obj,nro){
            var uploadFile = obj.files[0];

            if (!window.FileReader) {
//                alert('El navegador no soporta la lectura de archivos');
                $('#mensaje_file'+nro).html('El navegador no soporta la lectura de archivos');
                $('#mensaje_file'+nro).removeClass('text-success');
                $('#mensaje_file'+nro).addClass('text-danger');

                return;
            }

            if (!(/\.(jpg|png|gif)$/i).test(uploadFile.name)) {
                $('#mensaje_file'+nro).html('El archivo a adjuntar no es una imagen');
                $('#mensaje_file'+nro).removeClass('text-success');
                $('#mensaje_file'+nro).addClass('text-danger');
//                alert('El archivo a adjuntar no es una imagen');
            }
            else {
                var img = new Image();
                img.onload = function () {
                    if (this.width.toFixed(0) != 360 && this.height.toFixed(0) != 360) {
                        $('#mensaje_file'+nro).html('Las medidas deben ser: 360 x 360, no '+this.width.toFixed(0)+'x'+this.height.toFixed(0));
                        $('#mensaje_file'+nro).removeClass('text-success');
                        $('#mensaje_file'+nro).addClass('text-danger');
//                        alert('Las medidas deben ser: 360 * 360');
                    }
                    else if (uploadFile.size > 20000000)
                    {
                        $('#mensaje_file'+nro).html('El peso de la imagen no puede exceder los 2Mb, no '+uploadFile.size);
//                         alert('El peso de la imagen no puede exceder los 200kb')
                        $('#mensaje_file'+nro).removeClass('text-success');
                        $('#mensaje_file'+nro).addClass('text-danger');
                    }
                    else {
                        $('#mensaje_file'+nro).html('Imagen correcta :)');
                        $('#mensaje_file'+nro).removeClass('text-danger');
                        $('#mensaje_file'+nro).addClass('text-success');
//                      alert('Imagen correcta :)')
                    }
                };
                img.src = URL.createObjectURL(uploadFile);
            }
        }

    </script>
    <script>
        // Replace the <textarea id="editor1"> with a CKEditor
        // instance, using default configuration.
        CKEDITOR.replace( 'txt_descripcion' );
    </script>
@stop