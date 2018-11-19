<?php

namespace App\Http\Controllers\Secretaria;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Administrador\Cursos;
use App\Models\Administrador\Turmas;
use App\Models\Secretaria\escola_anterior;

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
}
