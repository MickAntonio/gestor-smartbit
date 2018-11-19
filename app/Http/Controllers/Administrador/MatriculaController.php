<?php

namespace App\Http\Controllers\Administrador;

use App\Models\Administrador\matriculas;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Secretaria\Candidatos;
use App\Models\Administrador\Alunos;
use App\Models\Administrador\Cursos;
use App\Models\Administrador\Classes;
use App\Models\Administrador\Turmas;
use Session;
use PDF;

class MatriculaController extends Controller
{
     /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view("Administrador.pages.lista-alunos-matriculados-sem-turma") ->withmatricula(matriculas::All());
    }
    public function listaAlunosMatriculados($date = 0)
    {
        Session::flash("failed","Não há alunos matriculados neste ano lectivo $date ...");
        if($date != 0)
        {
            return view("secretaria.confirmacao.lista-matriculado")
            ->withmatricula(matriculas::where("tipo","Matricula")->get())
            ->withdate($date);
        }
        else
        {
            return view("secretaria.confirmacao.lista-matriculado")
            ->withdate($date);
        }
    }
    public function PdfAllMatriculados($date = 0 )
    {
        return PDF::loadView('administrador.pdf.lista-dos-matriculados',
                    [
                        "matriculado" =>matriculas::where("tipo","Matricula")->get(),
                        "date" => $date
                    ])->setPaper('a4', 'portraite')->stream();
    }
    public function FichaMatricula($id = 0)
    {
      $products =[2,2,3];//\Product::all();
        Session::flash("MatriFicha","verdadeiro");
        return PDF::loadView('administrador.pdf.FichaAluno',["matricula" => Candidatos::where("id",$id)->get()[0]])
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
            "turma" => "required",
            "idaluno" => "required"
        ]);
       
        $matricula = matriculas::find($request->idaluno);
        $matricula->turma_id = $request->turma;
        if($matricula->save())
        {
            $aluno = Alunos::find($matricula->aluno_id);
            $aluno->processo = Alunos::orderBy("processo","DESC")->get()[0]->processo + 1; 
            $aluno->save();
            $turma = Turmas::find($request->turma);
            $turma->Quantidade = $turma->Quantidade - 1;
            $turma->save();
            Session::flash("successo","Aluno matriculado com sucesso");
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Administrador\matriculas  $matriculas
     * @return \Illuminate\Http\Response
     */
    public function show(matriculas $matriculas)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Administrador\matriculas  $matriculas
     * @return \Illuminate\Http\Response
     */
    public function edit(matriculas $matriculas)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Administrador\matriculas  $matriculas
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, matriculas $matriculas)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Administrador\matriculas  $matriculas
     * @return \Illuminate\Http\Response
     */
    public function destroy(matriculas $matriculas)
    {
        //
    }
}
