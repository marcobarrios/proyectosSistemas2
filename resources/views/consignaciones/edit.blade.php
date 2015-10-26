@extends('layouts.principal')
@section('content')
    {!!Form::model($consignaciones,['route'=>['consignaciones.update', $consignaciones->id], 'method'=>'PUT'])!!}
        <h3>Consignaciones</h3>
        <div class="container col-xs-12">
            <div class="form-grup">
                {!!Form::label('Fecha Inicio:')!!}
                {!!Form::date('fechaInicial',null,['class'=>'form-control','placeholder'=>'Ingrese fecha inicio', 'required'])!!}
            </div><br>
            <div class="form-grup">
                {!!Form::label('Fecha Final:')!!}
                {!!Form::date('fechaFinal',null,['class'=>'form-control','placeholder'=>'Ingrese fecha final', 'required'])!!}
            </div><br>
            <div class="form-grup">
                {!!Form::label('Observaciones:')!!}
                {!!Form::text('detalleConsignacion',null,['class'=>'form-control','placeholder'=>'Observaciones', 'required'])!!}
            </div><br>
            <div class="form-grup">
                {!!Form::label('Proveedor:')!!}
                {!!Form::text('proveedores_id',null,['class'=>'form-control','placeholder'=>'Ingrese Proveedor', 'required'])!!}
            </div><br>
        <div class="form-btn">
            {!!Form::submit('Actualizar',['class'=>'btn btn-primary'])!!}
        </div>
    {!!form::close()!!}
    </div>
@stop