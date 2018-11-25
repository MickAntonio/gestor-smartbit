<?php

namespace App\Http\Controllers\secretaria;

use App\Models\secretaria\matriculas;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\General\Municipio;
use App\Models\Secretaria\escola_anterior;
use App\Models\Secretaria\Candidatos;
use App\Models\Administrador\Alunos;
use App\Models\Administrador\Cursos;
use App\Models\Administrador\Classes;
use App\Models\Administrador\Turmas;

use App\Models\Pagamentos\PagamentoPrecos;
use App\Models\Pagamentos\TipoPagamentos;
use App\Models\Pagamentos\Pagamentos;
use Session;

class InscricaoController extends Controller
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
        return view("secretaria.matricula-inscricao.Form-Matricula")
                ->withmunicipio(Municipio::All())
                ->withcurso(Cursos::All());
    }
    public function listaCandidatoInscritos()
    {
        return view("secretaria/matricula-inscricao/lista-candidato")
                ->withcandidato(Candidatos::All())
                ->withaluno(Alunos::All())
                ->withclasse(Classes::All());
    }
    public function MatriculaAnonima(Request $request)
    {
        $this->validate($request,
            [
                "classe" => " required"
            ]);
            if($request->classe==4)
            {
                Session::flash("successo","Candidato não pode ser matriculado  na 13ª classe...");
                return redirect()->back();
            }else
            {
                
                $turma = Turmas::where("estado","=","ANONIMA")
                                ->where("curso_id","=",$request->curso)
                                ->where("classe_id","=",$request->classe)
                                ->where("periodo","=",$request->periodo)->get()[0];
                if(isset($turma))
                {
                    $matricula = new matriculas;
                    $matricula->aluno_id = $request->idaluno;
                    $matricula->turma_id = $turma->id;
                    $matricula->tipo = "Matricula";
                    $matricula->condicao = "Limpo";
                    $matricula->save();

                    Session::flash("successo","Candidato matriculado com sucesso e encaminhado a coordenação");
                    return redirect("Administrador/Ficha-do-aluno/".$matricula->aluno_id);
                }
                return redirect()->back();
            }

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
       // print_r($request::All());
        $this->validate($request,[
            "firstName" => "required | min:3",
            "lastName"  => "required | min:3",
            "futher" => " required | min:6",
            "mother" => " required | min:6",
            "Idnumber" => "required | min:3 | max:14 | string",
            "genre" => "required | min:1",
            "born" =>  "required | date",
            "Naturalidade" => "required | min:1",
            "residencia" => "required | min:4",
            "escolaAnterior" => "required | min:3",
            "anoAnterior" => "required | min:4",
            "curso" => "required | min:1"
        ]);

        $EscolaAnterior = new escola_anterior;
        $EscolaAnterior->nome = $request->escolaAnterior;
        $EscolaAnterior->classe = "9ª classe";
        $EscolaAnterior->periodo =  "nothing";
        $EscolaAnterior->anolectivo = $request->anoAnterior;

        if($EscolaAnterior->save())
        {
            $Candidato = new Candidatos;

            $Candidato->nome = $request->firstName." ".$request->lastName;
            $Candidato->pai = $request->futher;
            $Candidato->mae = $request->mother;
            $Candidato->bi = $request->Idnumber;
            $Candidato->sexo = $request->genre;
            $Candidato->nascido = $request->born;
            $Candidato->municipio_id = $request->Naturalidade;
            $Candidato->bairro = $request->residencia;
            $Candidato->email = $request->email??"mail@mail.mail";
            $Candidato->telefone = $request->cellphone??"0101";
            $Candidato->telefone_pai = $request->TelefonePai??"0101";
            $Candidato->telefone_mae = $request->TelefoneMae??"0101";
            $Candidato->escola_anterior_id = $EscolaAnterior->id;
            $Candidato->naturalidade = "nothing";
            if($Candidato->save())
            {
                $Aluno = new Alunos; 
                $Aluno->candidato_id = $Candidato->id;
                $Aluno->curso_id = $request->curso;
                $Aluno->processo = 0;
                $Aluno->save();

                //TipoPagamentos::where("nome","matricula")->get()[0]
                Session::flash("successo","Candidato inscrito com sucesso...");
                return redirect()->back();
            }
            
        }
        Session::flash("successo","Candidato Não inscrito, verifique os campos preenchidos...");
        return redirect()->back();

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\secretaria\matriculas  $matriculas
     * @return \Illuminate\Http\Response
     */
    public function show(matriculas $matriculas)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\secretaria\matriculas  $matriculas
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
     * @param  \App\Models\secretaria\matriculas  $matriculas
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, matriculas $matriculas)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\secretaria\matriculas  $matriculas
     * @return \Illuminate\Http\Response
     */
    public function destroy(matriculas $matriculas)
    {
        //
    }
}
