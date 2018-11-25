<?php

namespace App\Http\Controllers\Secretaria;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Pagamentos\Pagamentos;
use App\Models\Pagamentos\TipoPagamentos;
use App\Models\Pagamentos\PagamentoPrecos;
use App\Models\Pagamentos\AlunoPagamentos;
use App\Models\secretaria\Matriculas;
use Session;

class AlunosOutrosPagamentosController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('secretaria.pagamentos-alunos-outros.index')
        ->withEntradas(Pagamentos::all())
        ->withMatriculas(Matriculas::all())
        ->withAlunoPagamentos(AlunoPagamentos::all())
        ->withTipoPagamentos(TipoPagamentos::where("tipo", "Entrada")->where("proveniencia", "Aluno")->get());;
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

        $PagamentoPrecos = PagamentoPrecos::where("tipo_pagamento_id", $request->tipo_pagamento_id)->where("estado", "Activado")->get();        

        $pagamento = new Pagamentos();
        $pagamento->valor_pago = $request->valor_pago;
        $pagamento->forma = $request->forma;
        $pagamento->descricao = $request->descricao;
        $pagamento->pagamento_preco_id = $PagamentoPrecos[0]->id;
        $pagamento->user_id = $request->user_id;                
        $pagamento->save();

        $alunoPagamento = new AlunoPagamentos();
        $alunoPagamento->pagamento_id = $pagamento->id;
        $alunoPagamento->matricula_id = $request->matricula_id;             
        $alunoPagamento->save();

        Session::flash('successo', 'Pagamento Adicionada com Successo');

        return redirect()->route('alunos-outros-pagamentos.index');
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

        $PagamentoPrecos = PagamentoPrecos::where("tipo_pagamento_id", $request->tipo_pagamento_id)->where("estado", "Activado")->get();

        $pagamento = Pagamentos::find($id);
        $pagamento->valor_pago = $request->valor_pago;
        $pagamento->forma = $request->forma;
        $pagamento->descricao = $request->descricao;
        $pagamento->pagamento_preco_id = $PagamentoPrecos[0]->id;
        $pagamento->user_id = $request->user_id;        
        $pagamento->save();

        $alunoPagamento = AlunoPagamentos::find($request->aluno_pagamento);
        $alunoPagamento->pagamento_id = $pagamento->id;
        $alunoPagamento->matricula_id = $request->matricula_id;             
        $alunoPagamento->save();

        Session::flash('successo', 'Pagamento Actualizado com Successo');

        return redirect()->route('alunos-outros-pagamentos.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $aluno = AlunoPagamentos::find($id);
        Pagamentos::find($aluno->pagamento_id)->delete();
        $aluno->delete();

        Session::flash('successo', 'Pagamento Excluida com Successo');

        return redirect()->route('alunos-outros-pagamentos.index');
    }

    public function getPreco($tipo)
    {
       
        $PagamentoPrecos = PagamentoPrecos::where("tipo_pagamento_id", $tipo)->where("estado", "Activado")->get();
        
        if($PagamentoPrecos->count()>0){
            return $PagamentoPrecos[0]->preco->preco;;
        }else{
            return 0;            
        }

    }
}
