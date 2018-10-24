<?php

namespace App\Http\Controllers\General;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\General\Clientes;
use App\Models\Administrador\Pagamentos;
use App\Models\General\Servicos;
use Session;
use PDF;
//use Charts;

class PagamentosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       /* $chart = Charts::create("line","google")
                    ->setTitle('graf')
                    ->setLabels(['dar','receber', 'negar'])
                    ->setValue([39,200,201])
                    ->setElementLabel('allone');
        
        return view('general.servicos-pagamentos.index')->withPagamentos(Pagamentos::all())->withChart($chart);*/
        return view('general.servicos-pagamentos.index')->withPagamentos(Pagamentos::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('general.servicos-pagamentos.create')->withClientes(Clientes::all())->withServicos(Servicos::all());
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
            'pagamento'=>'required',
            'forma_pagamento'=>'required',
            'cliente_id'=>'required'
        ));

        $Pagamentos = new Pagamentos;

        $Pagamentos->descricao  = $request->descricao;
        $Pagamentos->desconto = $request->desconto;
        $Pagamentos->pagamento= $request->pagamento;
        $Pagamentos->forma_pagamento= $request->forma_pagamento;
        $Pagamentos->cliente_id= $request->cliente_id;
        $Pagamentos->usuario_id= $request->usuario_id;
        
        $Pagamentos->save();

        $Pagamentos->servicos()->sync($request->servicos, false);


        Session::flash('successo', 'Pagamento Adicionada com Successo');

        return redirect()->route('pagamentos.index');
    }

        /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('general.servicos-pagamentos.show')->withPagamento(Pagamentos::find($id));        
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
            'pagamento'=>'required',
            'forma_pagamento'=>'required',
            'cliente_id'=>'required'
        ));

        $Pagamentos = Pagamentos::find($id);

        $Pagamentos->descricao  = $request->descricao;
        $Pagamentos->desconto = $request->desconto;
        $Pagamentos->pagamento= $request->pagamento;
        $Pagamentos->forma_pagamento= $request->forma_pagamento;
        $Pagamentos->cliente_id= $request->cliente_id;
        $Pagamentos->usuario_id= $request->usuario_id;
        
        $Pagamentos->save();

        $Pagamentos->servicos()->sync($request->servicos);        

        Session::flash('successo', 'Pagamento Adicionada com Successo');

        return redirect()->route('pagamentos.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
    
        $Pagamentos=Pagamentos::find($id);
        $Pagamentos->servicos()->detach();
        $Pagamentos->delete();

        Session::flash('successo', 'Pagamento Excluida com Successo');

        return redirect()->route('pagamentos.index');
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

        $Pagamentos = Pagamentos::whereBetween('created_at', [$start,  $end])->get();


      //  $chart = Charts::create();

    //  $pdf = PDF::loadView('general.servicos-pagamentos.pdf.lista',  $data=["pagamentos"=>$Pagamentos, "start"=>$request->start, "end"=>$request->end, "chart"=> $chart]);
      $pdf = PDF::loadView('general.servicos-pagamentos.pdf.lista',  $data=["pagamentos"=>$Pagamentos, "start"=>$request->start, "end"=>$request->end]);
        return $pdf->stream('servicos-pagamentos.pdf');


    }

    
}
