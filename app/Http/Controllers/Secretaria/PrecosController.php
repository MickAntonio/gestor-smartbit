<?php

namespace App\Http\Controllers\Secretaria;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Pagamentos\Precos;
use Session;

class PrecosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('secretaria.precos.index')->withPrecos(Precos::all());
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
            'preco'=>'required',
        ));

        $preco = new Precos();
        $preco->preco = $request->preco;
        $preco->moeda = $request->moeda;
        $preco->save();

        Session::flash('successo', 'Preço Adicionada com Successo');

        return redirect()->route('precos.index');
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
            'preco'=>'required',
        ));

        $preco = Precos::find($id);
        $preco->preco = $request->preco;
        $preco->moeda = $request->moeda;
        $preco->save();

        Session::flash('successo', 'Preço Actualizado com Successo');

        return redirect()->route('precos.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Precos::find($id)->delete();

        Session::flash('successo', 'Preço Excluida com Successo');

        return redirect()->route('precos.index');
    }
}
