<?php

namespace App\Http\Controllers\Administrador;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Administrador\Turmas;
use App\Models\Administrador\Alunos;
use App\Models\Administrador\Cursos;

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
        for($c=0;$c<count(Cursos::all());$c++)
        {
           $data [$c]["quantidade"] = count(Alunos::where("curso_id",Cursos::all()[$c]->id)->get());
           $data [$c]["curso"] = Cursos::all()[$c]->nome;
        }
        //print_r($data);
        return view('Administrador.pages.dashboard')
                ->withsemvaga(turmas::where("quantidade",0)->where("estado","NORMAL")->get())
                ->withvagas(turmas::where("estado","NORMAL")->get())
                ->withcursoquantidade($data)
                ->withalunosemturma(Alunos::where("processo",0)->get());
    }
   
}
