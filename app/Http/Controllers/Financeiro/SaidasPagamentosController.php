<?php

namespace App\Http\Controllers\Financeiro;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Pagamentos\Pagamentos;
use App\Models\Pagamentos\TipoPagamentos;
use App\Models\Pagamentos\PagamentoPrecos;
use Session;
use PDF;

class SaidasPagamentosController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('financeiro.pagamentos-saidas.index')
        ->withSaidas(Pagamentos::all())
        ->withTipoPagamentos(TipoPagamentos::where("tipo", "Saida")->where("proveniencia", "Outro")->get())
        ;
    }


     /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function pdfRelatorio(Request $request)
    {
       
        $start = $request->start .' 00:00:00';
        $end   = $request->end   .' 23:59:59';

        $saidas = Pagamentos::whereBetween('created_at', [$start,  $end])->get();

        $pdf = PDF::loadView('secretaria.pagamentos-saidas.pdf.saidas',  $data=["saidas"=>$saidas,  "start"=>$request->start, "end"=>$request->end])->setPaper('a4', 'landscape');
        return $pdf->stream('marcacoes.pdf');
    }
}
