<?php

namespace App\Http\Controllers\General;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Administrador\ProdutoVariacoes;


class ProdutoVariacaoController extends Controller
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
            'referencia'=>'required',
            'produto_id'=>'required',
            'atributo_id'=>'required'
        ));

        $variacao = new ProdutoVariacoes;

        $variacao->referencia  = $request->referencia;
        $variacao->produto_id  = $request->produto_id;
        $variacao->atributo_id = $request->atributo_id;

        $variacao->save();

        return $variacao;
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
            'referencia'=>'required',
            'produto_id'=>'required',
            'atributo_id'=>'required'
        ));

        $variacao = ProdutoVariacoes::find($id);

        $variacao->referencia  = $request->referencia;
        $variacao->produto_id  = $request->produto_id;
        $variacao->atributo_id = $request->atributo_id;

        $variacao->save();

        return $variacao;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $variacao = ProdutoVariacoes::find($id);
        $variacao->delete(); 
    }
}
