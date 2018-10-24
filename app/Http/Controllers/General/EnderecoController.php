<?php

namespace App\Http\Controllers\General;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\General\Endereco;

class EnderecoController extends Controller
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
            'municipio_id'=>'required'
        ));

        $endereco = new Endereco;

        $endereco->municipio_id = $request->municipio_id;
        $endereco->bairro       = $request->bairro;
        $endereco->rua          = $request->rua;

        $endereco->save();

        return $endereco;
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
        $endereco = Endereco::find($id);
        
        $this->validate($request, array(
            'municipio_id'=>'required'
        ));


        $endereco->municipio_id = $request->input('municipio_id');
        $endereco->bairro       = $request->input('bairro');
        $endereco->rua          = $request->input('rua');

        $endereco->save();

        return $endereco;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $endereco = Endereco::find($id);
        $endereco->delete();        
    }
}
