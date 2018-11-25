<?php

namespace App\Http\Controllers\Financeiro;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Pagamentos\Pagamentos;
use App\Models\Pagamentos\TipoPagamentos;
use App\Models\Pagamentos\PagamentoPrecos;
use App\Models\Pagamentos\AlunoPagamentos;
use App\Models\Pagamentos\PagamentoPropinas;
use Session;
use PDF;

class EntradasPagamentosController extends Controller
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
        return view('financeiro.pagamentos-entradas.index')
        ->withEntradas(Pagamentos::all())
        ->withTipoPagamentos(TipoPagamentos::where("tipo", "Entrada")->where("proveniencia", "Outro")->get());
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

        $entradas = Pagamentos::whereBetween('created_at', [$start,  $end])->get();
        $alunos=AlunoPagamentos::all();
        $propinas=PagamentoPropinas::all();

        $pdf = PDF::loadView('secretaria.pagamentos-entradas.pdf.entradas',  $data=["entradas"=>$entradas, "alunoPagamentos"=>$alunos, "propinas"=>$propinas, "start"=>$request->start, "end"=>$request->end])->setPaper('a4', 'landscape');
        return $pdf->stream('marcacoes.pdf');
    }

}
