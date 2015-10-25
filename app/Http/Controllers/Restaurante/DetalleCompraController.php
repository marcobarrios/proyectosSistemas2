<?php

namespace RED\Http\Controllers\Restaurante;

use Illuminate\Http\Request;

use RED\Http\Requests;
use RED\Http\Controllers\Controller;
use RED\Restaurante\DetalleCompra;
use RED\Restaurante\Compra;
use Resources;


class DetalleCompraController extends Controller
{
	
     /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $DetalleCompra = DetalleCompra::all();
        return View('detallecompra.index',compact('DetalleCompra'));
    }

/**
     * Desplegar platillos por temporada
     *
     * @return Response
     */
    
    public function mostrardetallecompra($id)
    {
        $compra = Compra::find($id);
        return View('compra.detallecompra',compact('compra'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {	
		 $compra = Compra::all()->last()->id;
        return view('detallecompra.create',compact('compra'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        DetalleCompra::create($request->all());
	   //Aqui se actualiza la compra
	    $idcompra=$request['compras_id'];
	    $costo=$request['costo'];//Obtenemos el costo de la transaccion 
	   $compra = Compra::find($idcompra);//Buscamos la compra
		$compra->total=$compra->total+$costo;
	   $compra->save();//actualizar
        return redirect('/detallecompra')->with('message','store');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
         $DetalleCompra = DetalleCompra::find($id);
        return view('detallecompra.edit', ['detallecompra'=>$DetalleCompra]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $DetalleCompra = DetalleCompra::find($id);
        $DetalleCompra->fill($request->all());
        $DetalleCompra->save();
        return redirect('/detallecompra')->with('message','edit');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
    
}
