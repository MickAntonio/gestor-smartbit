<?php

namespace App\Http\Controllers\General;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\General\TipoAtributos;
use Session;

class TipoAtributoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('general.tipo-de-atributos.index')->withTipoAtributos(TipoAtributos::all());
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

        $tipo = new TipoAtributos;
        $tipo->nome = $request->nome;
        $tipo->save();

        Session::flash('successo', 'Tipo Atributo Adicionada com Successo');

        return redirect()->route('tipo-de-atributo.index');
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

        $tipo = TipoAtributos::find($id);
        $tipo->nome = $request->nome;
        $tipo->save();


        Session::flash('successo', 'Tipo Atributo Actualizada com Successo');

        return redirect()->route('tipo-de-atributo.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        TipoAtributos::find($id)->delete();

        Session::flash('successo', 'Tipo Atributo  Excluida com Successo');

        return redirect()->route('tipo-de-atributo.index');
    }
}
