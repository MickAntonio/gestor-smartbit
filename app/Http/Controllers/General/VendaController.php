<?php

namespace App\Http\Controllers\General;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\General\Fornecedores;
use App\Models\Administrador\Produtos;
use App\Models\Administrador\Vendas;
use App\Models\Administrador\QuantidadeVendas;
use App\Models\Administrador\Estoques;
use Session;
use PDF;

class VendaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('general.vendas.index')->withVendas(Vendas::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('general.vendas.create')->withFornecedores(Fornecedores::all())->withProdutos(Produtos::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        // dd($request);
        // echo $request->preco_unitario[5][16];
        // die();

        $this->validate($request, array(
            'pagamento'=>'required',
        ));

        $venda = new Vendas;
        $venda->total           = $request->total;
        $venda->desconto           = $request->desconto;
        $venda->pagamento       = $request->pagamento;
        $venda->forma_pagamento = $request->forma_pagamento;
        $venda->estado   = "Concluido";
        $venda->usuario_id   = $request->usuario_id;
        $venda->save();

        foreach ($request->produto_id as $key => $produto) {
           
            $estoques = $request->quantidade[$request->produto_id[$key]];

            foreach ($estoques as $keyEstoque => $quantidade) {

                if($quantidade>0){

                    $quantidadeCompra = new QuantidadeVendas;
                    $quantidadeCompra->quantidade = $quantidade;
                  //  $quantidadeCompra->preco_unitario = $request->preco_unitario[$request->produto_id[$key]][$keyEstoque];
                    $quantidadeCompra->produto_id  = $request->produto_id[$key];
                    $quantidadeCompra->estoque_id = $keyEstoque;
                    $quantidadeCompra->venda_id  = $venda->id;
                    $quantidadeCompra->save();

                        $estoque = Estoques::find($keyEstoque);
                        $estoqueAnterior         = $estoque->estoque_actual;
                        $estoque->estoque_actual = $estoqueAnterior - $quantidade;
                        $estoque->save();

                }

            }


        }

        Session::flash('successo', 'venda Realizada com successo');

        return redirect()->route('vendas.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('general.vendas.show')->withVenda(Vendas::find($id));        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * Return al atriubutos of a produto
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function atributos($id)
    {
        
        $produto = Produtos::find($id);

        if($produto->variacao=='Sim'){

            $html='';

            foreach ($produto->estoques as $estoque) 
            {
                $nomeVariacoes='';

                foreach($estoque->produto_variacoes as $variacao)
                {
                    $nomeVariacoes.=' '.$variacao->atributo->nome;
                }

                $html.='

                <div class="input-group m-b col-md-12">
                    <span class="input-group-addon width-150">'.$nomeVariacoes.' ('.$estoque->estoque_actual.')</span> 
                    <input type="number" max="'.($estoque->estoque_maximo-$estoque->estoque_actual).'" min="0" placeholder="Qtde" name="quantidade['.$id.']['.$estoque->id.']" class="form-control qtd-count">
                </div>
                
                ';

            }

            return $html;

        }else{

            return '

               <div class="input-group m-b col-md-12">
                    <span class="input-group-addon width-150">('.$produto->estoque->estoque_actual.')</span> 
                    <input type="number" max="'.($produto->estoque->estoque_maximo-$produto->estoque->estoque_actual).'" min="0" placeholder="Qtde" name="quantidade['.$id.']['.$produto->estoque->id.']" class="form-control qtd-count">
                </div>
               
               ';
        }

    }

    /**
     * Return al atriubutos of a produto
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function atributosPreco($id)
    {
        
        $produto = Produtos::find($id);

        if($produto->variacao=='Sim'){

            $html='';

            foreach ($produto->estoques as $estoque) 
            {
                $nomeVariacoes='';

                foreach($estoque->produto_variacoes as $variacao)
                {
                    $nomeVariacoes.=' '.$variacao->atributo->nome;
                }

                $html.='
                <div class="input-group m-b col-md-12">

                <input type="number" disabled="disabled" value="'.$produto->valor_venda.'" name="preco_unitario['.$id.']['.$estoque->id.']" class="form-control preco-count">
                </div>
                
                ';

            }

            return $html;

        }else{

            return '
            <div class="input-group m-b col-md-12">

            <input type="number" disabled="disabled" value="'.$produto->valor_venda.'" name="preco_unitario['.$id.']['.$produto->estoque->id.']" class="form-control preco-count">
            </div>
              
               
               ';
        }

    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function pdfLista(Request $request)
    {
      
        $start = $request->start .' 00:00:00';
        $end   = $request->end   .' 23:59:59';

        $vendas = Vendas::whereBetween('created_at', [$start,  $end])->get();

        $pdf = PDF::loadView('general.vendas.pdf.lista',  $data=["vendas"=>$vendas, "start"=>$request->start, "end"=>$request->end]);
        return $pdf->stream('vendas.pdf');
    }


    
}
