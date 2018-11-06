<?php

namespace App\Http\Controllers\Secretaria;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Pagamentos\Precos;
use App\Models\Pagamentos\TipoPagamentos;
use App\Models\Pagamentos\PagamentoPrecos;
use Session;

class TipoPagamentosController extends Controller
{
        /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('secretaria.tipos-de-pagamentos.index')->withPrecos(Precos::all())->withTipoPagamentos(TipoPagamentos::all());
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
            'tipo'=>'required',
            'proveniencia'=>'required',
            'preco_id'=>'required',
        ));

        $tipo = new TipoPagamentos();

        $tipo->nome = $request->nome;
        $tipo->tipo = $request->tipo;
        $tipo->proveniencia = $request->proveniencia;

        $tipo->save();
        
        $pagamento = new PagamentoPrecos();
        
        $pagamento->estado = 'Activado';
        $pagamento->tipo_pagamento_id = $tipo->id;
        $pagamento->preco_id = $request->preco_id;

        $pagamento->save();

        Session::flash('successo', 'Tipo Pagamento Adicionada com Successo');

        return redirect()->route('tipos-de-pagamentos.index');
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
            'tipo'=>'required',
            'proveniencia'=>'required',
            'preco_id'=>'required',
        ));

        $tipo = TipoPagamentos::find($id);

        $tipo->nome = $request->nome;
        $tipo->tipo = $request->tipo;
        $tipo->proveniencia = $request->proveniencia;

        $tipo->save();
        
        $PagamentoPrecos = PagamentoPrecos::where("tipo_pagamento_id", $tipo->id)->where("estado", "Activado")->get();

        $pagamento=PagamentoPrecos::find($PagamentoPrecos[0]->id);

        if($pagamento->preco_id!=$request->preco_id){

            $pagamento->estado = 'Desactivo';
            $pagamento->save();


            $PagamentoDesativado = PagamentoPrecos::where("tipo_pagamento_id", $tipo->id)->where("estado", "Desactivo")->where("preco_id", $request->preco_id)->get();            
           
            if($PagamentoDesativado->count()>0){

                $novoPagamento=PagamentoPrecos::find($PagamentoDesativado[0]->id); 
                $novoPagamento->estado = 'Activado';
                $novoPagamento->tipo_pagamento_id = $tipo->id;
                $novoPagamento->preco_id = $request->preco_id;
        
                $novoPagamento->save();               

            }else{
                $novoPagamento = new PagamentoPrecos();
        
                $novoPagamento->estado = 'Activado';
                $novoPagamento->tipo_pagamento_id = $tipo->id;
                $novoPagamento->preco_id = $request->preco_id;
        
                $novoPagamento->save();
            }

            

        }

        Session::flash('successo', 'Tipo Pagamento Actualizado com Successo');

        return redirect()->route('tipos-de-pagamentos.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $PagamentoPrecos=PagamentoPrecos::where("tipo_pagamento_id", $id)->get()[0]->id;
        
        PagamentoPrecos::find($PagamentoPrecos)->delete();
        TipoPagamentos::find($id)->delete();

        Session::flash('successo', 'Tipo Pagamento Excluida com Successo');

        return redirect()->route('tipos-de-pagamentos.index');
    }
}
