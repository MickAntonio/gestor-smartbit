<?php

namespace App\Http\Controllers\General;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Administrador\Estoque;


class EstoqueController extends Controller
{

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, array(
            'estoque_minimo'=>'required',
            'estoque_maximo'=>'required',
            'estoque_actual'=>'required',
            'referencia'=>'required',
            'produto_id'=>'required'
        ));

        $estoque = new Estoque;

        $estoque->estoque_minimo  = $request->estoque_minimo;
        $estoque->estoque_maximo = $request->estoque_maximo;
        $estoque->estoque_actual = $request->estoque_actual;
        $estoque->referencia = $request->referencia;
        $estoque->produto_id = $request->produto_id;

        $estoque->save();

        return $estoque;
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
            'estoque_minimo'=>'required',
            'estoque_maximo'=>'required',
            'estoque_actual'=>'required',
            'referencia'=>'required',
            'produto_id'=>'required'
        ));

        $estoque = Estoque::find($id);

        $estoque->estoque_minimo  = $request->estoque_minimo;
        $estoque->estoque_maximo = $request->estoque_maximo;
        $estoque->estoque_actual = $request->estoque_actual;
        $estoque->referencia = $request->referencia;
        $estoque->produto_id = $request->produto_id;

        $estoque->save();

        return $estoque;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $estoque = Estoque::find($id);
        $estoque->delete(); 
    }
}
