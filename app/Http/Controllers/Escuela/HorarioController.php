<?php

namespace RED\Http\Controllers\Escuela;

use Illuminate\Http\Request;
use RED\Http\Requests;
use RED\Escuela\Curso;
use RED\Escuela\Horarios;
use RED\Http\Controllers\Controller;
use Carbon\Carbon;

class HorarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('ver_horarios', new Curso());
        
       $carbon = new Carbon();
       $date = $carbon->now(); 

       $horarios = Horarios::orderBy('hora_inicio')->whereHas('curso', function($q) use($date)
        {     
            $q->where('fecha_fin','>',$date);
        })->get();
        return view('Escuela.horario.index', compact('horarios'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('horario_agregar', new Curso());

        $idcurso = $request['curso'];
        $horario = new Horarios;
        $horario->dia = $request['dia'];
        $horario->hora_inicio = $request['hora_inicio'];
        $horario->hora_fin = $request['hora_fin'];
        $horario->salon = $request['salon'];
        $horario->curso_id = $idcurso;
        $horario->save();

    return redirect('/horarios/'.$idcurso)->with('message','assign');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $this->authorize('horario_editar', new Curso());

        $horario = Horarios::find($id);
        return view('Escuela.horario.edit', compact('horario'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->authorize('horario_editar', new Curso());

        $horario = Horarios::find($id);
        $idcurso = $horario->curso_id;
        $horario->dia = $request['dia'];
        $horario->hora_inicio = $request['hora_inicio'];
        $horario->hora_fin = $request['hora_fin'];
        $horario->salon = $request['salon'];
        $horario->save();

     return redirect('/cursos/'.$idcurso)->with('message','edit');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->authorize('horario_eliminar', new Curso());

        $horario = Horarios::find($id);
        $idcurso = $horario->curso_id;
        $horario->delete();  

        return redirect('/cursos/'.$idcurso)->with('message','erase');
    }
}
