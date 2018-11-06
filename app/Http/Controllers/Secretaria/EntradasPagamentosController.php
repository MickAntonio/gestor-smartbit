<?php

namespace App\Http\Controllers\Secretaria;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Pagamentos\Pagamentos;

class EntradasPagamentosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('secretaria.pagamentos-entradas.index')
        ->withEntradas(Pagamentos::all())
        ;
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
            'valor_pago'=>'required',
            'forma'=>'required',
            'tipo_pagamento_id'=>'required',
        ));

        $pagamento = new Pagamentos();
        $pagamento->valor_pago = $request->valor_pago;
        $pagamento->forma = $request->forma;
        $pagamento->descricao = $request->descricao;
        $pagamento->tipo_pagamento_id = $request->tipo_pagamento_id;
        $pagamento->save();

        Session::flash('successo', 'Entrada Adicionada com Successo');

        return redirect()->route('entradas-pagamentos.index');
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
            'valor_pago'=>'required',
            'forma'=>'required',
            'tipo_pagamento_id'=>'required',
        ));

        $pagamento = Pagamentos::find($id);
        $pagamento->valor_pago = $request->valor_pago;
        $pagamento->forma = $request->forma;
        $pagamento->descricao = $request->descricao;
        $pagamento->tipo_pagamento_id = $request->tipo_pagamento_id;
        $pagamento->save();

        Session::flash('successo', 'Entrada Actualizado com Successo');

        return redirect()->route('entradas-pagamentos.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Pagamentos::find($id)->delete();

        Session::flash('successo', 'Entrada Excluida com Successo');

        return redirect()->route('entradas-pagamentos.index');
    }
}
