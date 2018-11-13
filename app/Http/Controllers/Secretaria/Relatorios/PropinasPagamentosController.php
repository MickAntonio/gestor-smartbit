<?php

namespace App\Http\Controllers\Secretaria\Relatorios;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\secretaria\Matriculas;
use App\Models\Administrador\Meses;
use App\Models\Administrador\Turmas;
use App\Models\Pagamentos\PrecoClasses;
use App\Models\Pagamentos\PagamentoPropinas;
use App\Models\Pagamentos\Propinas;

use Session;
use PDF;

class PropinasPagamentosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('secretaria.relatorios.pagamentos-propinas.index')->withTurmas(Turmas::all());
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getPagamento($matricula, $mes)
    {
        $matricula  = Matriculas::find($matricula);
        $pagamentos = PagamentoPropinas::where("matricula_id", $matricula->id)->get();

        foreach ($pagamentos as $pagamento) {

            foreach ($pagamento->propinas as $propina) {
                if($propina->mes_id==$mes){
                    return $propina->preco->preco->preco + $propina->multa;
                }
            }
            
        }

        return 0;

    }

   
     /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function pdfPagamentos($id)
    {
        $pdf = PDF::loadView('secretaria.relatorios.pagamentos-propinas.pdf.pagamentos',  $data=["matriculas"=>[Matriculas::where('turma_id',$id)->get()], "turma"=>Turmas::find($id)] )->setPaper('a3', 'landscape');
        return $pdf->stream('pagamentos.pdf');
    }

   
}
