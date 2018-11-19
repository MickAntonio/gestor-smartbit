<?php

namespace App\Http\Controllers\Secretaria;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Administrador\Cursos;
use App\Models\Administrador\Turmas;
use App\Models\Secretaria\escola_anterior;
use App\Models\Administrador\matriculas;
use Session;

class DashboardController extends Controller
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
    
    public function dashboard()
    {
        return view('secretaria.pages.dashboard');
    }
    public function index()
    {
       $a = new escola_anterior;
        print_r($a);
    }
    public function ListCurso()
    {
        return view('secretaria.pages.ListCurso')->with("Curso", Cursos::All());
    }
    public function ListTurma()
    {
        return view('secretaria.pages.ListTurma')->with("Turma", Turmas::All());
    }
    public function listaAlunosConfirmados($date = 0)
    {
        Session::flash("failed","Não há alunos confirmados neste ano lectivo $date ...");
        if($date != 0)
        {
            return view("secretaria.confirmacao.lista-confirmacao")
            ->withmatricula(matriculas::All())
            ->withdate($date);
        }
        else
        {
            return view("secretaria.confirmacao.lista-confirmacao")
            ->withdate($date);
        }
    }
}
