<?php

namespace App\Http\Controllers\Financeiro;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Pagamentos\PrecoClasses;
use App\Models\Administrador\Cursos;
use App\Models\Administrador\Classes;
use App\Models\Pagamentos\Precos;
use Session;

class PrecoClassesController extends Controller
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
        return view('financeiro.preco-classes.index')
        ->withPrecoClasses(PrecoClasses::all())
        ->withCursos(Cursos::all())
        ->withClasses(Classes::all())
        ->withPrecos(Precos::all());
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, array(
            'estado'=>'required',
            'classe_id'=>'required',
            'preco_id'=>'required',
            'curso_id'=>'required',
        ));

        $preco = new PrecoClasses();

        $preco->estado = $request->estado;
        $preco->classe_id = $request->classe_id;
        $preco->preco_id = $request->preco_id;
        $preco->curso_id = $request->curso_id;
        $preco->save();

        Session::flash('successo', 'Preço Adicionada com Successo');

        return redirect()->route('preco-das-propinas.index');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, array(
            'estado'=>'required',
            'classe_id'=>'required',
            'preco_id'=>'required',
            'curso_id'=>'required',
        ));


        $preco = PrecoClasses::find($id);

        $preco->estado = $request->estado;
        $preco->classe_id = $request->classe_id;
        $preco->preco_id = $request->preco_id;
        $preco->curso_id = $request->curso_id;
        $preco->save();

        Session::flash('successo', 'Preço Adicionada com Successo');

        return redirect()->route('preco-das-propinas.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        PrecoClasses::find($id)->delete();

        Session::flash('successo', 'Preço Excluida com Successo');

        return redirect()->route('preco-das-propinas.index');
    }
}
