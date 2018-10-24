<?php

namespace App\Http\Controllers\General;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\General\Contacto;


class ContactoController extends Controller
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
            'telefone'=>'required',
            'email'=>'email'
        ));

        $contacto = new Contacto;

        $contacto->telefone     = $request->telefone;
        $contacto->email        = $request->email;
        $contacto->redes_sociais = $request->redes_sociais;

        $contacto->save();

        return $contacto;
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
        $contacto = Contacto::find($id);
        
        $this->validate($request, array(
            'telefone'=>'required',
            'email'=>'email'
        ));

        $contacto->telefone     = $request->telefone;
        $contacto->email        = $request->email;
        $contacto->redes_sociais = $request->redes_sociais;

        $contacto->save();

        return $contacto;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $contacto = Contacto::find($id);
        $contacto->delete(); 
    }
}
