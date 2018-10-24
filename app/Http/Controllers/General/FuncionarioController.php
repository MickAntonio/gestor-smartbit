<?php

namespace App\Http\Controllers\General;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\General\ContactoController;
use App\Http\Controllers\General\EnderecoController;
use App\Models\General\Provincia;
use App\Models\General\Municipio;
use App\Models\General\Funcionarios;
use App\Models\General\Contacto;
use App\Models\General\Endereco;
use Session;
use Image;
use PDF;


class FuncionarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('general.funcionarios.index')->withFuncionarios(Funcionarios::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('general.funcionarios.create')->withProvincias(Provincia::all());
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
            'bi'=>'required',
            'genero'=>'required',
            'cargo'=>'required'
        ));

        $endereco   = (new EnderecoController)->store($request);
        $contacto   = (new ContactoController)->store($request);

        $funcionario = new Funcionarios;

        $funcionario->nome = $request->nome;
        $funcionario->bi = $request->bi;
        $funcionario->genero = $request->genero;
        $funcionario->cargo = $request->cargo;
        $funcionario->data_nascimento = $request->data_nascimento;
        $funcionario->endereco_id = $endereco->id;
        $funcionario->contacto_id = $contacto->id;

        if($request->hasFile('foto'))
        {
            
            $image = $request->file('foto');
            $filename = time() . '.' . $image->getClientOriginalExtension();

            $location = public_path('img/funcionarios/' . $filename);

            Image::make($image)->save($location);

            $funcionario->foto = $filename;

        }else{
            $funcionario->foto = 'default.jpg';
        }

        $funcionario->save();

        Session::flash('successo', 'Funcionário Adicionada com Successo');

        return redirect()->route('funcionario.index');
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('general.funcionarios.show')->withFuncionario(Funcionarios::find($id));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('general.funcionarios.edit')->withFuncionario(Funcionarios::find($id))
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
            'nome'=>'required',
            'bi'=>'required',
            'genero'=>'required',
            'cargo'=>'required'
        ));

        $funcionario = Funcionarios::find($id);
        
        $endereco   = (new EnderecoController)->update($request, $funcionario->endereco_id);
        $contacto   = (new ContactoController)->update($request, $funcionario->contacto_id);

        $funcionario->nome = $request->nome;
        $funcionario->bi = $request->bi;
        $funcionario->genero = $request->genero;
        $funcionario->cargo = $request->cargo;
        $funcionario->data_nascimento = $request->data_nascimento;
        $funcionario->endereco_id = $endereco->id;
        $funcionario->contacto_id = $contacto->id;

        if($request->hasFile('foto'))
        {
            
            $image = $request->file('foto');
            $filename = time() . '.' . $image->getClientOriginalExtension();

            $location = public_path('img/funcionarios/' . $filename);

            Image::make($image)->save($location);

            $funcionario->foto = $filename;

        }

        $funcionario->save();

        Session::flash('successo', 'Modificações Efectuadas com Successo');

        return redirect()->route('funcionario.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $funcionario = Funcionarios::find($id);
        $funcionario->delete();

        Contacto::find($funcionario->contacto_id)->delete();
        Endereco::find($funcionario->endereco_id)->delete();

        Session::flash('successo', 'Funcionário Excluido com Successo');

        return redirect()->route('funcionario.index');
    }

     /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function pdfLista()
    {
        $pdf = PDF::loadView('general.funcionarios.pdf.lista',  $data=["funcionarios"=>Funcionarios::all()]);
        return $pdf->stream('funcionarios.pdf');
    }
}
