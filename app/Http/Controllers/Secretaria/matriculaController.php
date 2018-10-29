<?php

namespace App\Http\Controllers\secretaria;

use App\Models\secretaria\matriculas;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\General\Municipio;
use App\Models\Secretaria\EscolaAnterior;
use App\Models\Secretaria\Candidatos;

class matriculaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }
    public function Inscricao ()
    {
        return view("secretaria.forms.FormMatricula")->with("municipio", Municipio::All());
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            "firstName" => "required | min:4",
            "lastName" => "required | min:4",
            "futher" => "required | min:7",
            "mother" => " required | min:7",
            "Idnumber" => "required | min:14 | max:14 | numeric",
            "genre" => "required | min:1",
            "born" => "required | date",
            "Naturalidade" => "required | min:1",
            "residencia" => "required | min:10",
            "cellphoneFuther" => "required | min:909999999 | numeric",
            "cellphoneMother" => "required | min:909999999 | numeric",
            "cellphone" => "required | min:909999999 | numeric",
            "email" => "required | min:7",
            "escolaAnterior" => "required | min:7",
            "anoAnterior" => "required | min:2010"
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\secretaria\matriculas  $matriculas
     * @return \Illuminate\Http\Response
     */
    public function show(matriculas $matriculas)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\secretaria\matriculas  $matriculas
     * @return \Illuminate\Http\Response
     */
    public function edit(matriculas $matriculas)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\secretaria\matriculas  $matriculas
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, matriculas $matriculas)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\secretaria\matriculas  $matriculas
     * @return \Illuminate\Http\Response
     */
    public function destroy(matriculas $matriculas)
    {
        //
    }
}
