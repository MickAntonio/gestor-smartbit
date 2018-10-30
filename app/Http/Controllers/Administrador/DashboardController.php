<?php

namespace App\Http\Controllers\Administrador;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Administrador\Classes;
use App\Models\Administrador\Cursos;
use App\Models\Administrador\Turmas;

class DashboardController extends Controller
{
    public function dashboard()
    {
        return view('Administrador.pages.dashboard');
    }
    public function setCurso()
    {
        return view('Administrador.forms.FormCurso');
    }
    public function ListCurso()
    {
        return view('Administrador.pages.ListCurso')->with("Curso", Cursos::All());
    }
    public function setTurma()
    {
        return view('Administrador.forms.FormTurma')->with("Curso", Cursos::All())->with("classe", Classes::All());
    }
    public function ListTurma()
    {
        //print_r($turma->find(2)->curso()->get()[0]->nome);
        return view('Administrador.pages.ListTurma')->with("Turma", Turmas::All());
    }
}
