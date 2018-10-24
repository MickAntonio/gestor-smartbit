<?php

namespace App\Http\Controllers\General;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\General\Clientes;
use App\Models\General\Marcacoes;
use Session;
use PDF;
use Illuminate\Support\Facades\DB;

class MarcacoesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('general.marcacoes.index')->withMarcacoes(Marcacoes::all())->withClientes(Clientes::all());
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
            'dia'=>'required',
            'hora'=>'required',
            'cliente_id'=>'required'
        ));

        $Marcacoes = new Marcacoes;

        $Marcacoes->descricao  = $request->descricao;
        $Marcacoes->estado = $request->estado;
        $Marcacoes->dia= $request->dia;
        $Marcacoes->hora= $request->hora;
        $Marcacoes->cliente_id= $request->cliente_id;
        
        $Marcacoes->save();

        Session::flash('successo', 'Marcaçao Adicionada com Successo');

        return redirect()->route('marcacoes.index');
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
            'dia'=>'required',
            'hora'=>'required',
            'cliente_id'=>'required'
        ));

        $Marcacoes = Marcacoes::find($id);

        $Marcacoes->descricao  = $request->descricao;
        $Marcacoes->estado = $request->estado;
        $Marcacoes->dia= $request->dia;
        $Marcacoes->hora= $request->hora;
        $Marcacoes->cliente_id= $request->cliente_id;
        
        $Marcacoes->save();

        Session::flash('successo', 'Marcaçao Actualizada com Successo');

        return redirect()->route('marcacoes.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Marcacoes::find($id)->delete();

        Session::flash('successo', 'Marcaçao Excluida com Successo');

        return redirect()->route('marcacoes.index');
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

        $marcacoes = Marcacoes::whereBetween('created_at', [$start,  $end])->get();

        $pdf = PDF::loadView('general.marcacoes.pdf.lista',  $data=["marcacoes"=>$marcacoes, "start"=>$request->start, "end"=>$request->end]);
        return $pdf->stream('marcacoes.pdf');

    }

    
}
