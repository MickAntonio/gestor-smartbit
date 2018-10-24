<?php

namespace App\Http\Controllers\General;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\General\Categorias;
use Session;

class CategoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('general.categorias.index')->withCategorias(Categorias::all());
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
            'nome'=>'required'
        ));

        $categoria = new Categorias;

        $categoria->nome = $request->nome;
        $categoria->descricao = $request->descricao;

        $categoria->save();

        Session::flash('successo', 'Categoria Adicionada com Successo');

        return redirect()->route('categoria.index');
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
            'nome'=>'required'
        ));

        $categoria = Categorias::find($id);

        $categoria->nome = $request->nome;
        $categoria->descricao = $request->descricao;

        $categoria->save();

        Session::flash('successo', 'Categoria Actualizada com Successo');

        return redirect()->route('categoria.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Categorias::find($id)->delete();

        Session::flash('successo', 'Categoria Excluida com Successo');

        return redirect()->route('categoria.index');
    }
}
