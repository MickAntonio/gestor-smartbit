<?php

namespace App\Http\Controllers\Administrador;

use App\Models\Secretaria\Candidatos;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Administrador\Alunos;
use App\Models\Administrador\Classes;
use App\Models\Administrador\matriculas;
use App\Models\Administrador\Turmas;
use Session;
use PDF;

class ConfirmacaoController extends Controller
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
    public function index($processo = 0)
    {
        $Aluno = Alunos::where("processo",$processo)->get();
        if(isset($Aluno[0]))
        {
            if(isset(matriculas::where("aluno_id",$Aluno[0]->id)->orderBy("id","DESC")->get()[0]))
                return view("secretaria.confirmacao.confirmar-matricula")
                    ->withprocesso($processo)
                    ->withmatricula(matriculas::where("aluno_id",$Aluno[0]->id)->orderBy("id","DESC")->get()[0])
                    ->withclasse(Classes::all());
            else 
            {
                Session::flash("failed","O aluno com o processo nº ".$processo." não existe...");
                return view("secretaria.confirmacao.confirmar-matricula")->withprocesso($processo);
            }
        }
        else
        {
            Session::flash("failed","O aluno com o processo nº ".$processo." não existe...");
            return view("secretaria.confirmacao.confirmar-matricula")->withprocesso($processo);
        }
    }
    public function listaAlunosConfirmados($date = 0)
    {
        Session::flash("failed","Não há alunos confirmados neste ano lectivo $date ...");
        if($date != 0)
        {
            return view("Administrador.confirmacao.lista-confirmacao")
            ->withmatricula(matriculas::where("tipo","Confirmacao")->get())
            ->withdate($date);
        }
        else
        {
            return view("Administrador.confirmacao.lista-confirmacao")
            ->withdate($date);
        }
    }
    public function PdfAllConfirmados($date = 0 )
    {
        return PDF::loadView('administrador.pdf.lista-dos-confirmados',
                    [
                        "matriculado" =>matriculas::where("tipo","Confirmacao")->get(),
                        "date" => $date
                    ])->setPaper('a4', 'portraite')->stream();
    }
    public function ConfirmacaoPagamento($idaluno = 0)
    {
        return view("secretaria.confirmacao.lista-confirmacao")
        ->withmatricula(matriculas::All());
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
            "idaluno" => "required",
            "AnoAnterior" => "required"
        ]);
        $turma = Turmas::find($request->turma);
        if($turma->anolectivo>$request->AnoAnterior)
        {
            $matricula = new matriculas;
            $matricula->aluno_id = $request->idaluno;
            $matricula->turma_id = $request->turma;
            $matricula->tipo = "Confirmação";
            $matricula->condicao = "Limpo";
            if($matricula->save())
            {
                $turma = Turmas::find($request->turma);
                $turma->Quantidade = $turma->Quantidade - 1;
                $turma->save();
                Session::flash("successo","Aluno confirmado com sucesso");
                return redirect()->back();
            }
        }else
        {   Session::flash("faileds",
            "Este aluno não pode ser matriculado na ".$turma->classe()->get()[0]->nome.",
             porque ele ainda não terminou a classe anterior");
            return redirect()->back();
        }
       
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
