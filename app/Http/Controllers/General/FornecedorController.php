<?php

namespace App\Http\Controllers\General;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\General\ContactoController;
use App\Http\Controllers\General\EnderecoController;
use App\Models\General\Provincia;
use App\Models\General\Municipio;
use App\Models\General\Fornecedores;
use App\Models\General\Contacto;
use App\Models\General\Endereco;
use Session;
use PDF;


class FornecedorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('general.fornecedores.index')->withFornecedores(Fornecedores::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('general.fornecedores.create')->withProvincias(Provincia::all());
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

        $endereco   = (new EnderecoController)->store($request);
        $contacto   = (new ContactoController)->store($request);

        $fornecedor = new Fornecedores;

        $fornecedor->nome = $request->nome;
        $fornecedor->descricao = $request->descricao;
        $fornecedor->endereco_id = $endereco->id;
        $fornecedor->contacto_id = $contacto->id;

        $fornecedor->save();

        Session::flash('successo', 'Fornecedor Adicionada com Successo');

        return redirect()->route('fornecedor.index');
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('general.fornecedores.show')->withFornecedor(Fornecedores::find($id));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('general.fornecedores.edit')->withFornecedor(Fornecedores::find($id))
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

        $fornecedor = Fornecedores::find($id);
        
        $endereco   = (new EnderecoController)->update($request, $fornecedor->endereco_id);
        $contacto   = (new ContactoController)->update($request, $fornecedor->contacto_id);

        $fornecedor->nome = $request->nome;
        $fornecedor->descricao = $request->descricao;
        $fornecedor->endereco_id = $endereco->id;
        $fornecedor->contacto_id = $contacto->id;

        $fornecedor->save();

        Session::flash('successo', 'Modificações Efectuadas com Successo');

        return redirect()->route('fornecedor.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $fornecedor = Fornecedores::find($id);
        $fornecedor->delete();

        Contacto::find($fornecedor->contacto_id)->delete();
        Endereco::find($fornecedor->endereco_id)->delete();

        Session::flash('successo', 'Fornecedor Excluido com Successo');

        return redirect()->route('fornecedor.index');
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function pdfLista()
    {
        $pdf = PDF::loadView('general.fornecedores.pdf.lista',  $data=["fornecedores"=>Fornecedores::all()]);
        return $pdf->stream('fornecedores.pdf');
    }
}
