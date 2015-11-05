@extends('layouts.principal')

<?php $message=Session::get('message')?>

@if($message == 'store')
<div class="alert alert-success alert-dismissible" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <strong>En horabuena!</strong> Proveedor creado exitosamente.
</div>
@endif
@if($message == 'edit')
<div class="alert alert-info alert-dismissible" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <strong>En horabuena!</strong> Proveedor editado exitosamente.
</div>
@endif

@section('content')
    
    <div class="container col-xs-12">
      <h3 class="title" selected="selected">Proveedores</h3>
    <a href="proveedores/create" class="btn btn-danger">Crear Proveedor</a>
	{!! Form::open(['rout'=>'proveedores.index', 'method' => 'GET', 'class' => 'navbar-form navbar-left pull-right' , 'role' => 'search']) !!}
    <div class="form-group">
        {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Nombre del proveedor']) !!}
    </div>
        <button type="submit" class="btn btn-primary">Buscar</button> 
{!! Form::close() !!}
        <table class="table">
            <thead>
                <th>Nombre</th>
                <th>Telefono</th>
                <th>Direccion</th>
            </thead>
            @foreach($proveedor as $proveedores)
            <tbody>
                <td>{{$proveedores->nombre}}</td>
                <td>{{$proveedores->telefono}}</td>
                <td>{{$proveedores->direccion}}</td>
                <td>{!!link_to_route('proveedores.edit', $title = 'Editar', $parameters = $proveedores->id, $attributes = ['class'=>'btn btn-primary']);!!}</td>
            </tbody>
            @endforeach
        </table>
    </div>
        <div>{!!$proveedor->render()!!}</div>
@stop