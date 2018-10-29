<?php

namespace App\Http\Controllers\Administrador;

use App\Models\Administrador\Cursos;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PostCursoController extends Controller
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
            "Curso" => "required | max:255 | min:10",
            "Descricao" => "required | min: 5",
            "Abreviacao" => "required | min: 2"
        ]);
            $curso = new Cursos;
            $curso->nome = $request->Curso;
            $curso->descricao = $request->Descricao;
            $curso->abreviacao = $request->Abreviacao;
            $curso->save();
        return redirect()->route("NewCourse",["Status" => "success"]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Administrador\Cursos  $cursos
     * @return \Illuminate\Http\Response
     */
    public function show(Cursos $cursos)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Administrador\Cursos  $cursos
     * @return \Illuminate\Http\Response
     */
    public function edit(Cursos $cursos)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Administrador\Cursos  $cursos
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cursos $cursos)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Administrador\Cursos  $cursos
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cursos $cursos)
    {
        //
    }
}
