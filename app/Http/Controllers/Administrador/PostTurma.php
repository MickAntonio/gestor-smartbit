<?php

namespace App\Http\Controllers\Administrador;

use App\Models\Administrador\Turmas;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Administrador\matriculas;
use App\Models\Administrador\Classes;
use App\Models\Administrador\Cursos;
use App\Models\Secretaria\Candidatos;
use Session;
use PDF;

class PostTurma extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

   
    /**
     * Create a new controller instance.
     */

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('Administrador.forms.FormTurma')->with('Curso', Cursos::All())->with('classe', Classes::All());
    }

    public function ListTurma()
    {
        return view('Administrador.pages.ListTurma')->with('Turma', Turmas::where('estado', '>=', 'NORMAL')->get());
    }

    public function ListTurmaAntigas($ano = 0)
    {
        $turma = Turmas::where('estado', '=', 'NORMAL')->where('anolectivo', '=', $ano)
                         ->where('anolectivo', '<', date('Y'))->get();
        if (isset($turma[0])) {
            return view('Administrador.pages.Lista-turma-antiga')->with('Turma', $turma);
        } else {
            Session::flash('failed', "O ano lectivo $ano não existe...");

            return view('Administrador.pages.Lista-turma-antiga');
        }
    }

    public function ListTurmaFuturas()
    {
        return view('Administrador.pages.Lista-turma-futuras')
                ->with('Turma', Turmas::where('estado', '=', 'NORMAL')->where('anolectivo', '>', date('Y'))->get());
    }

    public function JsonTurma($idclasse, $idcurso)
    {
        return json_encode(
                Turmas::where('classe_id', $idclasse)
                ->where('Quantidade', '!=', 0)
                ->where('anolectivo', '>=', date('Y'))
                ->where('curso_id', $idcurso)
                ->where('estado', 'NORMAL')->get());
    }

    public function JsonTurmaShare($idclasse, $idcurso, $except = 0, $ano = 0)
    {
        return json_encode(
                Turmas::where('classe_id', $idclasse)
                ->where('id', '!=', $except)
                ->where('Quantidade', '!=', 0)
                ->where('anolectivo', '=', $ano)
                ->where('curso_id', $idcurso)
                ->where('estado', 'NORMAL')->get());
    }

    public function AlunosDaTurma($idturma = 0)
    {
        return view('Administrador.pages.lista-alunos-matriculados-com-turma')
                 ->withidturma($idturma)
                 ->withturma(turmas::find($idturma)->nome)
                 ->withmatriculado(new matriculas())
                 ->withmatricula(Candidatos::orderBy('nome', 'ASC')->get());
    }

    public function ListaDosAlunos($idturma = 0)
    {
        return PDF::loadView('administrador.pdf.lista-dos-alunos-da-turma',
                    [
                        'matricula' => Candidatos::orderBy('nome', 'ASC')->get(),
                        'matriculado' => new matriculas(),
                        'idturma' => $idturma,
                        'turma' => Turmas::where('id', $idturma)->get()[0],
                    ])
                // Se quiser que fique no formato a4 retrato:
                ->setPaper('a4', 'portraite')->stream();
        //  ->download('nome-arquivo-pdf-gerado.pdf');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,
        [
            'turma' => 'required | min : 1',
            'Quantidade' => 'required | numeric | max:100',
            'periodo' => 'required |string| min:5|max:10',
            'Classe' => 'required | numeric | min:1',
            'Curso' => 'required | numeric | min:1',
            'Anoletivo' => 'required | numeric | min:2015',
        ]);

        $turma = new  Turmas();
        $turma->nome = $request->turma;
        $turma->anolectivo = $request->Anoletivo;
        $turma->periodo = $request->periodo;
        $turma->classe_id = $request->Classe;
        $turma->curso_id = $request->Curso;
        $turma->Quantidade = $request->Quantidade;
        $turma->estado = 'NORMAL';

        $turma->save();

        Session::flash('successo', 'Turma Adicionada com Successo');

        return redirect()->back();
    }

    public function TrocarTurma($idm, $idt, $oldt)
    {
        $aluno = matriculas::find($idm);
        $aluno->turma_id = $idt;
        $aluno->save();

        $turma = Turmas::find($idt);
        $turma->Quantidade = $turma->Quantidade - 1;
        $turma->save();

        $turma = Turmas::find($oldt);
        $turma->Quantidade = $turma->Quantidade + 1;
        $turma->save();
        Session::flash('successo', 'Aluno movido para outra turma com sucesso!');

        return redirect()->back();
    }

    public function ALterarVaga(Request $request)
    {
        $turma = Turmas::find($request->turma);
        $turma->quantidade = $request->quantidade;
        $turma->save();

        Session::flash('successo', 'Vaga da turma alterada com sucesso!');

        return redirect()->back();
    }

    public function destroyAluno($id)
    {
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Administrador\Turmas $turmas
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Turmas $turmas)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Administrador\Turmas $turmas
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Turmas $turmas)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request         $request
     * @param \App\Models\Administrador\Turmas $turmas
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Turmas $turmas)
    {
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $key = Turmas::find($id);

        $turma = Turmas::where('estado', 'ANONIMA')->where('periodo', '=', $key->periodo)->where('curso_id', $key->curso_id)->where('classe_id', 1)->get();

        $matricula = Matriculas::where('turma_id', $id)->get();

        if ($key->classe_id == 1) {
            foreach ($matricula as $mat) {
                $mat->turma_id = $turma[0]->id;
                $mat->save();
            }
        }
        $key->delete();
        Session::flash('successo', 'A Turma '.$key->nome.' da '.$key->classe->nome.' do curso '.$key->curso->nome.' exluida com sucesso');

        return redirect()->back();
    }
}
