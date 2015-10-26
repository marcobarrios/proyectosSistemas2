<?php

namespace RED\Http\Controllers\Despensa;

use Illuminate\Http\Request;
use RED;
use RED\Http\Requests;
use RED\Http\Controllers\Controller;
use RED\Repositories\ClienteRepo;
use RED\Despensa\Ventum;

class VentasController extends Controller
{
    //   
    
    public function index ()
    {
        $venta = Ventum::All();
        return view ('Despensa.venta.index',compact('venta'));
    }
    
    public function create ()
    {
        return view ('Despensa.venta.create');
    }
    
    public function store (Request $request)
    {
        RED\Despensa\Ventum::create($request->all());
        return redirect ('/venta')->with('message','store');
    }
    
    public function show($idVenta)
    {
        //
    }
    
    public function edit($idVenta)
    {
        $venta = RED\Despensa\Ventum::find($id);
        return view('Despensa.venta.edit', ['venta'=>$venta]);
    }
    
    
   public function update(Request $request, $id)
    {
        $venta = RED\Despensa\Ventum::find($id);
        $venta->fill($request->all());
        $venta->save();
        return redirect('/venta')->with('message','edit');
    }
    
    public function destroy($id)
    {
        //
    }
    
}
