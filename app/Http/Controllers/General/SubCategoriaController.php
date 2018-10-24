<?php

namespace App\Http\Controllers\General;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\General\SubCategorias;
use App\Models\General\Categorias;
use Session;

class SubCategoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('general.subcategorias.index')->withSubCategorias(SubCategorias::all())->withCategorias(Categorias::all());;
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
            'nome'=>'required',
            'categoria_id'=>'required'
        ));

        $categoria = new SubCategorias;

        $categoria->nome      = $request->nome;
        $categoria->categoria_id = $request->categoria_id;
        $categoria->descricao = $request->descricao;

        $categoria->save();

        Session::flash('successo', 'Sub-Categoria Adicionada com Successo');

        return redirect()->route('sub-categoria.index');
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

        $categoria = SubCategorias::find($id);

        $categoria->nome      = $request->nome;
        $categoria->categoria_id = $request->categoria_id;
        $categoria->descricao = $request->descricao;

        $categoria->save();

        Session::flash('successo', 'Sub-Categoria Actualizada com Successo');

        return redirect()->route('sub-categoria.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        SubCategorias::find($id)->delete();

        Session::flash('successo', 'Sub-Categoria Excluida com Successo');

        return redirect()->route('sub-categoria.index');
    }


    // Other Methods


    /**
     * Return a list of su-categorias in json format
     *
     * @param  int  $categoria
     * @return \Illuminate\Http\Response
     */
    public function jsonListaDeSuCategorias($categoria)
    {
        return json_encode( SubCategorias::where('categoria_id', $categoria)->get() );
    }
}
