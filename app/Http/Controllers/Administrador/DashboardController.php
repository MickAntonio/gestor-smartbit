<?php

namespace App\Http\Controllers\Administrador;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Administrador\Turmas;

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
        return view('Administrador.pages.dashboard')
                ->withsemvaga(turmas::where("quantidade",0)->where("estado","NORMAL")->get())
                ->withvagas(turmas::where("estado","NORMAL")->get());
    }
   
}
