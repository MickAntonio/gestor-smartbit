<?php

namespace App\Http\Controllers\General;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\General\ContactoController;
use App\Http\Controllers\General\EnderecoController;
use App\Models\General\Provincia;
use App\Models\General\Municipio;
use App\Models\General\Clientes;
use App\Models\General\Contacto;
use App\Models\General\Endereco;
use Session;
use PDF;


class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('general.clientes.index')->withClientes(Clientes::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('general.clientes.create')->withProvincias(Provincia::all());
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
            'nome'=>'required'
        ));

        $contacto   = (new ContactoController)->store($request);

        $cliente = new Clientes;

        $cliente->nome              = $request->nome;
        $cliente->bi                = $request->bi;
        $cliente->data_nascimento   = $request->data_nascimento;
        $cliente->genero            = $request->genero;
        $cliente->contacto_id       = $contacto->id;

        $cliente->save();

        Session::flash('successo', 'Cliente Adicionada com Successo');

        return redirect()->route('cliente.index');
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('general.clientes.show')->withCliente(Clientes::find($id));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('general.clientes.edit')->withCliente(Clientes::find($id))
                                                  ->withProvincias($this->converto(Provincia::all(), "id", "nome"))
                                                  ->withMunicipios($this->converto(Municipio::all(), "id", "nome"));
    }

    /**
     * convert an list with many atributes to a list with one atribuite identified by index.
     *
     * @param  array  $list
     * @param  int or string the identifier
     * @param  string or int the only atributes that must stay 
     * @return array
     */
    public function converto($list, $index, $name)
    {
        $result = [];
        foreach($list as $value){
            $result[$value[$index]] = $value[$name];
        }

        return $result;
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
            'nome'=>'required'
        ));

        $cliente = Clientes::find($id);
        
        $contacto   = (new ContactoController)->update($request, $cliente->contacto_id);

        $cliente->nome              = $request->nome;
        $cliente->bi                = $request->bi;
        $cliente->data_nascimento   = $request->data_nascimento;
        $cliente->genero            = $request->genero;
        $cliente->contacto_id       = $contacto->id;

        $cliente->save();

        Session::flash('successo', 'Modificações Efectuadas com Successo');

        return redirect()->route('cliente.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cliente = Clientes::find($id);
        $cliente->delete();

        Contacto::find($cliente->contacto_id)->delete();

        Session::flash('successo', 'Cliente Excluido com Successo');

        return redirect()->route('cliente.index');
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function pdfLista()
    {
        $pdf = PDF::loadView('general.clientes.pdf.lista',  $data=["clientes"=>Clientes::all()]);
        return $pdf->stream('clientes.pdf');
    }
}
