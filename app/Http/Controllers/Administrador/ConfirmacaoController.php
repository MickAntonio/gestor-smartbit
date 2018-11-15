<?php

namespace App\Http\Controllers\Administrador;

use App\Models\Secretaria\Candidatos;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Administrador\Alunos;
use App\Models\Administrador\Classes;

class ConfirmacaoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($processo = 0)
    {
        $Aluno = Alunos::where("processo",$processo)->get();
        if(isset($Aluno[0]))
            return view("secretaria.confirmacao.confirmar-matricula")
                    ->withprocesso($processo)
                    ->withaluno($Aluno)
                    ->withclasse(Classes::all());
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Secretaria\Candidatos  $candidatos
     * @return \Illuminate\Http\Response
     */
    public function show(Candidatos $candidatos)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Secretaria\Candidatos  $candidatos
     * @return \Illuminate\Http\Response
     */
    public function edit(Candidatos $candidatos)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Secretaria\Candidatos  $candidatos
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Candidatos $candidatos)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Secretaria\Candidatos  $candidatos
     * @return \Illuminate\Http\Response
     */
    public function destroy(Candidatos $candidatos)
    {
        //
    }
}
