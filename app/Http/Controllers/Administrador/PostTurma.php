<?php

namespace App\Http\Controllers\Administrador;

use App\Models\Administrador\Turmas;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Administrador\matriculas;
use App\Models\Administrador\Classes;
use App\Models\Administrador\Cursos;
use App\Models\Secretaria\Candidatos;
use App\Models\Administrador\Alunos;
use Session;
use PDF;

class PostTurma extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('Administrador.forms.FormTurma')->with("Curso", Cursos::All())->with("classe", Classes::All());
    }
    public function ListTurma()
    {
        
        return view('Administrador.pages.ListTurma')->with("Turma", Turmas::where("estado",">=","NORMAL")->get());
    }
    public function ListTurmaAntigas ()
    {
        return view('Administrador.pages.Lista-turma-antiga')
                ->with("Turma", Turmas::where("estado","=","NORMAL")->where("anolectivo","<",date("Y"))->get());
    }
    public function JsonTurma($idclasse,$idcurso)
    {
        return json_encode( 
                Turmas::where("classe_id",$idclasse)
                ->where("Quantidade","!=",0)
                ->where("curso_id",$idcurso)
                ->where("estado","NORMAL")->get() );
    }
    public function AlunosDaTurma($idturma = 0)
    {
        return view("Administrador.pages.lista-alunos-matriculados-com-turma")
                 ->withidturma($idturma)
                 ->withmatricula(Candidatos::orderBy("nome","ASC")->get());
    }
    public function ListaDosAlunos($idturma = 0)
    {
      $products =[2,2,3];//\Product::all();

        return PDF::loadView('administrador.pdf.lista-dos-alunos-da-turma',
                    [
                        "matricula" => Candidatos::orderBy("nome","ASC")->get(),
                        "idturma" => $idturma,
                        "turma" => Turmas::where("id",$idturma)->get()[0]
                    ])
                // Se quiser que fique no formato a4 retrato:
                ->setPaper('a4', 'portraite')->stream();;
              //  ->download('nome-arquivo-pdf-gerado.pdf');
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
        $turma->estado = "NORMAL";

        $turma->save();

        Session::flash('successo', 'Turma Adicionada com Successo');
        return redirect()->back();
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
     * @param   int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy( $id)
    {
        Turmas::find($id)->delete();

        Session::flash('successo', 'Turma exluida com sucesso');

        return redirect()->back();
    }
}
