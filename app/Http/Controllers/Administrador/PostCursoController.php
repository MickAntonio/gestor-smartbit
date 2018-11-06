<?php

namespace App\Http\Controllers\Administrador;

use App\Models\Administrador\Cursos;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;
use App\Models\Administrador\Turmas;

class PostCursoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('Administrador.forms.FormCurso');
    }
    public function ListCurso()
    {
        return view('Administrador.pages.ListCurso')->with("Curso", Cursos::All());
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
            if($curso->save())
            :                  
                for($a=0;$a<=2;$a++):
                    $periodo = "Manhã";
                    for($b=0;$b<=2;$b++):
                        for($c=0; $c<=2;$c++):
                            $turma = new  Turmas;
                            $turma->nome = $request->Abreviacao.($b+1);
                            $turma->anolectivo = 0000;
                            $turma->periodo = $periodo;
                            $turma->classe_id = $c+1;
                            $turma->curso_id = $curso->id;
                            $turma->Quantidade = 0;
                            $turma->estado = "ANONIMA";        
                            $turma->save();
                        endfor;
                        if($b==0) $periodo= "Tarde";
                        else if($b==1) $periodo = "Noite";
                    endfor;
                endfor;                
            endif;
        
        Session::flash('successo', 'Curso Adicionado com Successo');
        return redirect()->back();
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
