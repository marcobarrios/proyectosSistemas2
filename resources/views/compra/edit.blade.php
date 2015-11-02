@extends('layouts.principal')
@section('content')
    {!!Form::model($compra,['route'=>['compra.update', $compra->id], 'method'=>'PUT'])!!}
        <h3>Compras</h3>
        <div class="container col-xs-12">
            <div class="form-grup">
                {!!Form::label('Fecha:')!!}
                {!!Form::date('fecha',null,['class'=>'form-control','placeholder'=>'Ingrese fecha', 'required'])!!}
            </div><br>
            <div class="form-grup">
                {!!Form::label('subTotal:')!!}
                {!!Form::text('subTotal',null,['class'=>'form-control','placeholder'=>'Ingrese Sub Total', 'required'])!!}
            </div><br>
            <div class="form-grup">
                {!!Form::label('Descuento:')!!}
                {!!Form::text('descuento',null,['class'=>'form-control','placeholder'=>'Ingrese Descuento', 'required'])!!}
            </div><br>
            <div class="form-grup">
                {!!Form::label('Total:')!!}
                {!!Form::text('total',null,['class'=>'form-control','placeholder'=>'Ingrese Total', 'required'])!!}
            </div><br>
            <div class="form-grup">
                {!!Form::label('Proveedor:')!!}
                <select required class="form-control" id="proveedores_id" name="proveedores_id" >
                    <option value="" selected disabled="">Seleccione Proveedor</option>
                    @foreach ($opcionproveedor as $opcionproveedor)
                        <option value="{{$opcionproveedor->id}}" >{{$opcionproveedor->nombre}}</option>
                    @endforeach
                </select>
               <!--{!!Form::text('proveedores_id',null,['class'=>'form-control','placeholder'=>'Ingrese Proveedor', 'required'])!!}-->
            </div><br>
        <div class="form-btn">
            {!!Form::submit('Actualizar',['class'=>'btn btn-primary'])!!}
        </div>
    {!!form::close()!!}
    </div>
@stop