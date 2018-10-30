<?php

namespace App\Http\Controllers\Secretaria;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Administrador\Cursos;
use App\Models\Administrador\Turmas;

class DashboardController extends Controller
{
    public function dashboard()
    {
        return view('secretaria.pages.dashboard');
    }
    public function index()
    {
        return view('secretaria.pages.dashboard');
    }
    public function ListCurso()
    {
        return view('secretaria.pages.ListCurso')->with("Curso", Cursos::All());
    }
    public function ListTurma()
    {
        return view('secretaria.pages.ListTurma')->with("Turma", Turmas::All());
    }
}
