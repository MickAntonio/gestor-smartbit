<?php

namespace App\Http\Controllers\General;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\General\Servicos;
use Session;
use PDF;

class ServicosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('general.servicos.index')->withServicos(Servicos::all());
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
            'preco'=>'required',
        ));

        $Servicos = new Servicos;

        $Servicos->descricao  = $request->descricao;
        $Servicos->nome = $request->nome;
        $Servicos->preco= $request->preco;
        
        $Servicos->save();

        Session::flash('successo', 'Servico Adicionada com Successo');

        return redirect()->route('servicos.index');
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
            'preco'=>'required',
        ));

        $Servicos = Servicos::find($id);

        $Servicos->descricao  = $request->descricao;
        $Servicos->nome = $request->nome;
        $Servicos->preco= $request->preco;
        
        $Servicos->save();

        Session::flash('successo', 'Servico Actualizado com Successo');

        return redirect()->route('servicos.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Servicos::find($id)->delete();

        Session::flash('successo', 'Servico Excluida com Successo');

        return redirect()->route('servicos.index');
    }

     /**
     * Return al atriubutos of a produto
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function servicoPreco($id)
    {
        
        $Servico = Servicos::find($id);


            
                $html='

                <div class="input-group m-b col-md-12">
                    <input type="number" min="0" placeholder="Preço" value="'.$Servico->preco.'" class="form-control preco-count">
                </div>
                
                ';

            return $html;

            //print_r($Servicos);
       
    }

    /**
     * Return a list of objects in json format
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function jsonListaDeServicos()
    {
        return json_encode( Servicos::all() );
    }

     /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function pdfLista()
    {
        $pdf = PDF::loadView('general.servicos.pdf.lista',  $data=["servicos"=>Servicos::all()]);
        return $pdf->stream('servicos.pdf');
    }


    
}
