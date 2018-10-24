<?php

namespace App\Http\Controllers\General;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\General\TipoAtributos;
use App\Models\General\Atributos;
use Session;

class AtributoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('general.atributos.index')->withAtributos(Atributos::all())->withTipoAtributos(TipoAtributos::all());;
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
            'tipo_atributo_id'=>'required'
        ));

        $atributo = new Atributos;

        $atributo->nome      = $request->nome;
        $atributo->tipo_atributo_id = $request->tipo_atributo_id;

        $atributo->save();

        Session::flash('successo', 'Atributo Adicionada com Successo');

        return redirect()->route('atributo.index');
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
            'nome'=>'required',
            'tipo_atributo_id'=>'required'
        ));

        $atributo = Atributos::find($id);

        $atributo->nome      = $request->nome;
        $atributo->tipo_atributo_id = $request->tipo_atributo_id;

        $atributo->save();

        Session::flash('successo', 'Atributo Actualizado com Successo');

        return redirect()->route('atributo.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Atributos::find($id)->delete();

        Session::flash('successo', 'Atributo Excluida com Successo');

        return redirect()->route('atributo.index');
    }

    /**
     * Return a list of objects in json format
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function jsonListaDeAtributos($tipo)
    {
        return json_encode( Atributos::where('tipo_atributo_id', $tipo)->get() );
    }
    
}
