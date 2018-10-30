<?php

namespace App\Http\Controllers\Administrador;

use App\Models\Administrador\Turmas;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PostTurma extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $this->validate($request,
        [
            "turma" => "required | min : 1 | max : 5",
            "Quantidade" => "required | numeric | min:1 | max:100",
            "periodo" => "required |string| min:5|max:10",
            "Classe" => "required | numeric | min:1",
            "Curso" => "required | numeric | min:1",
            "Anoletivo" => "required | numeric | min:2015"
        ]);

        $turma = new  Turmas;
        $turma->nome = $request->turma;
        $turma->anolectivo = $request->Anoletivo;
        $turma->periodo = $request->periodo;
        $turma->classe_id = $request->Classe;
        $turma->curso_id = $request->Curso;
        $turma->Quantidade = $request->Quantidade;

        $turma->save();

        return redirect()->route("NewClass",["status" => "success"]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Administrador\Turmas  $turmas
     * @return \Illuminate\Http\Response
     */
    public function show(Turmas $turmas)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Administrador\Turmas  $turmas
     * @return \Illuminate\Http\Response
     */
    public function edit(Turmas $turmas)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Administrador\Turmas  $turmas
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Turmas $turmas)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Administrador\Turmas  $turmas
     * @return \Illuminate\Http\Response
     */
    public function destroy(Turmas $turmas)
    {
        //
    }
}
