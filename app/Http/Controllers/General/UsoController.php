<?php

namespace App\Http\Controllers\General;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Administrador\Produtos;
use App\Models\General\Fornecedores;
use App\Models\Administrador\Movimentacoes;
use App\Models\Administrador\QuantidadeMovimentacoes;
use App\Models\Administrador\Estoques;
use Session;
use PDF;

class UsoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('general.usos.index')->withMovimentacoes(Movimentacoes::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('general.usos.create')->withFornecedores(Fornecedores::all())->withProdutos(Produtos::all());
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
            'usuario_id'=>'required'
        ));

        $movimentacao = new Movimentacoes;
        $movimentacao->descricao   = $request->descricao;
        $movimentacao->usuario_id  = $request->usuario_id;
        $movimentacao->save();

        foreach ($request->produto_id as $key => $produto) {
           
            $estoques = $request->quantidade[$request->produto_id[$key]];

            foreach ($estoques as $keyEstoque => $quantidade) {

                if($quantidade>0){

                    $quantidadeMov = new QuantidadeMovimentacoes;
                    $quantidadeMov->quantidade = $quantidade;
                    $quantidadeMov->produto_id = $request->produto_id[$key];
                    $quantidadeMov->estoque_id = $keyEstoque;
                    $quantidadeMov->movimentacao_id  = $movimentacao->id;
                    $quantidadeMov->save();

                        $estoque = Estoques::find($keyEstoque);
                        $estoqueAnterior         = $estoque->estoque_actual;
                        $estoque->estoque_actual = $estoqueAnterior - $quantidade;
                        $estoque->save();

                }

            }

        }

        Session::flash('successo', 'Movimentação Realizada com successo');

        return redirect()->route('usos.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('general.usos.show')->withMovimentacao(Movimentacoes::find($id));        
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
                    <input type="number" max="'.($estoque->estoque_maximo-$estoque->estoque_actual).'" min="0" placeholder="Qtde" name="quantidade['.$id.']['.$estoque->id.']" class="form-control">
                </div>
                
                ';

            }

            return $html;

        }else{

            return '

               <div class="input-group m-b col-md-12">
                    <span class="input-group-addon width-150">('.$produto->estoque->estoque_actual.')</span> 
                    <input type="number" max="'.($produto->estoque->estoque_maximo-$produto->estoque->estoque_actual).'" min="0" placeholder="Qtde" name="quantidade['.$id.']['.$produto->estoque->id.']" class="form-control">
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

        $usos = Movimentacoes::whereBetween('created_at', [$start,  $end])->get();

        $pdf = PDF::loadView('general.usos.pdf.lista',  $data=["usos"=>$usos, "start"=>$request->start, "end"=>$request->end]);
        return $pdf->stream('usos.pdf');
    }




}
