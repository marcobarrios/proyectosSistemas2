<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

/******************
  MODULO ESCUELA
******************/
Route::resource('estudiantes','Escuela\EstudianteController');
Route::resource('maestros','Escuela\MaestroController');
Route::resource('cursos','Escuela\CursoController');

/******************/

/******************************
  MODULO CAFETERÍA/RESTAURANTE
******************************/
//Rutas Materia prima
Route::resource('materiaprima','Restaurante\MateriaPrimaController');

//Rutas Compras
//Ruta para obtener las compras de un proveedor
Route::get('/comprasproveedor/{id}',['as'=>'compras','uses'=>'Restaurante\ComprasController@proveedor']);
//Rutas para todos los platillos
Route::resource('platillo','Restaurante\PlatilloController');
//Rutas para platillos de una temporada
Route::get('temporadas/{id}', 'Restaurante\PlatilloController@mostrarplatillotemporada');
//Rutas para mostrar las temporadas
Route::resource('temporada','Restaurante\TemporadaController');
//Ruta para llamar tabla clientes y deplegar
Route::resource('clientes', 'Restaurante\ClientesController');
//Rutas para mostrar las compras
Route::resource('compra','Restaurante\ComprasController');

/*****************************/
/******************************
  MODULO DESPENSA
******************************/
/*----------------------VENTAS----------------------------------*/
Route::get ('venta','Despensa\VentasController@index');
Route::get ('venta/crear','Despensa\VentasController@crear');
Route::get ('venta/lista','Despensa\VentasController@lista');
Route::get ('venta/editar','Despensa\VentasController@editar');
Route::get ('venta/borrar','Despensa\VentasController@borrar');
/*--------------------------------------------------------------*/

/*----------------------COMPRAS---------------------------------*/
 Route::get('proveedores', 'proveedoresController@mostrar');
/*--------------------------------------------------------------*/

/*****************************/