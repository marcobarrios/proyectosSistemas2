<?php 
namespace RED\Http\Controllers\Despensa;

use Illuminate\Http\Request;

use RED\Despensa\Consignacion;
use RED\Http\Requests;
use RED\Http\Controllers\Controller;
use RED\Repositories\ProveedorRepo;
use RED\Despensa\Proveedore;
use Resources;

class ConsignacionController extends Controller
{
    protected $proveedorrepo;
    public $opcionproveedor;

    public function __construct(ProveedorRepo $proveedorrepo)
    {
        $this->proveedorrepo=$proveedorrepo;
    }
	
    public function index(Request $request)
    {
        $this->authorize('listar', new Consignacion());

         if ($request->get('codigo')=='' && $request->get('fechaIni')=='')
        {           
        $consignacion = Consignacion::orderBy('id','DESC')->paginate(10);
			 
             return View('consignaciones.index',compact('consignacion'));
        }
       
		if ($request->get('codigo')!='' && $request->get('fechaIni')=='')
        {   
            
		   $consignacion = Consignacion::code($request->get('codigo'))->orderBy('id')->paginate(10);
			
         return View('consignaciones.index',compact('consignacion'));
        }
      
		if ($request->get('fechaIni')!='' && $request->get('codigo')=='')
        {   
           $consignacion = Consignacion::fechai($request->get('fechaInicial'))->orderBy('fechaInicial')->paginate(10);
           return View('consignaciones.index',compact('consignacion'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $this->authorize('crear', new Consignacion());
        
        $opcionproveedor = Proveedore::all()->lists('nombre','id');
        return view('consignaciones.create', compact('opcionproveedor'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        $this->authorize('crear', new Consignacion());
        
		$consignacion=Consignacion::create($request->all());
		$codigo = $consignacion->id+100;
		$codigo = "C-".$codigo;
		$consignacion->codigo= $codigo;
		$consignacion->save();
          return redirect('/detalleconsignacion/create');
	 
        /*Consignacion::create($request->all());
            return redirect('/consignaciones')->with('message','store');*/
    }
	
	 public function detalle(Request $request)
    {
        $this->authorize('crear', new Consignacion());
        
		Consignacion::create($request->all());
        return redirect('/detalleconsignacion/create');
	 }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $this->authorize('ver', new Consignacion());

        $detalle = Consignacion::find($id);
        return view('detalleconsignacion.detalleconsignacion',compact('detalle'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $this->authorize('editar', new Consignacion());
		
        $consignacion = Consignacion::find($id);
	    return view('consignaciones.edit', ['consignaciones'=>$consignacion]);
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
        $this->authorize('editar', new Consignacion());
		
        $consignacion = Consignacion::find($id);
        $consignacion->fill($request->all());
        $consignacion->save();
        return redirect('/consignaciones')->with('message','edit');

    }
	
	public function getNombreProveedor($id)
		{
			$result = \DB::table('proveedores')
				->select('proveedores.nombre')
				->where('id','=',$id)
				->get();
				
			return  $result;
		}

    public function proveedor($id)
    {
        $proveedore=$this->proveedorrepo->find($id);
		return View('consignacion.comprasaproveedor',compact('proveedore'));
    }
}