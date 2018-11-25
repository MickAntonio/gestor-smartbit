
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <link rel="stylesheet" href="css/pdfs/custom.css">
    <link rel="stylesheet" href="css/bootstrap.css">
    <title>Relatório de Pagamento da Propina</title>
</head>
<body>

    

    <div class="page-container">
        
        <h1 class="h1-title">Pagamentos de Propinas   {{ $turma->anolectivo }}<br><span class="data-span"> Turma - {{ $turma->curso->abreviacao }} - {{ $turma->classe->nome }} - {{ $turma->nome }} </span></h1>
        
        <table class="table table-striped table-bordered table-hover dataTables-example" >

            <thead>
                <tr class="td-bg-green">
                    <th>Nº</th>
                    <th class="width-200">Nome</th>
                    <th>Fevereiro</th>
                    <th>Março</th>
                    <th>Abril</th>
                    <th>Maio</th>
                    <th>Junho</th>
                    <th>Julho</th>
                    <th>Agosto</th>
                    <th>Setembro</th>
                    <th>Outubro</th>
                    <th>Novembro</th>
                    <th>Dezembro</th>
                    <th>Total</th>
                </tr>
            </thead>

            @php
                $i=1
            @endphp

            <tbody>


            @php
                $i=1;
                $pag = new App\Http\Controllers\Secretaria\Relatorios\PropinasPagamentosController();

                $Fevereiro=0;
                $Marco=0;
                $Abril=0;
                $Maio=0;
                $Junho=0;
                $Julho=0;
                $Agosto=0;
                $Setembro=0;
                $Outubro=0;
                $Novembro=0;
                $Dezembro=0;

            @endphp  
                                        
            @foreach($matriculas[0] as $matricula)

            @php
                $Total=0;
            @endphp

            <tr>
            
                <td>{{ $i++ }}</td>
                <td class="td-bg-green bold">{{ $matricula->aluno->candidato->nome }}</td>

                <td>
                   @php
                       $Fev=$pag->getPagamento($matricula->id, 2);
                   @endphp

                    @if($Fev>0)

                        @php
                            $Fevereiro=$Fevereiro+$Fev;
                            $Total=$Total+$Fev;
                        @endphp
                      
                      {{  $Fev }}.00
                      
                    @endif
                </td>
                
                <td>
                   @php
                       $Mar=$pag->getPagamento($matricula->id, 3);
                   @endphp

                    @if($Mar>0)

                        @php
                            $Marco=$Marco+$Mar;
                            $Total=$Total+$Mar;
                        @endphp
                      
                      {{  $Marco }}.00
                      
                    @endif
                </td>

                <td>
                   @php
                       $Abr=$pag->getPagamento($matricula->id, 4);
                   @endphp

                    @if($Abr>0)

                        @php
                            $Abril=$Abril+$Abr;
                            $Total=$Total+$Abr;
                        @endphp
                      
                      {{  $Abr }}.00
                      
                    @endif
                </td>

                <td>
                   @php
                       $Mai=$pag->getPagamento($matricula->id, 5);
                   @endphp

                    @if($Mai>0)

                        @php
                            $Maio=$Maio+$Mai;
                            $Total=$Total+$Mai;
                        @endphp
                      
                      {{  $Mai }}.00
                      
                    @endif
                </td>

                <td>
                   @php
                       $Jun=$pag->getPagamento($matricula->id, 6);
                   @endphp

                    @if($Jun>0)

                        @php
                            $Junho=$Junho+$Jun;
                            $Total=$Total+$Jun;
                        @endphp
                      
                      {{  $Jun }}.00
                      
                    @endif
                </td>

                <td>
                   @php
                       $Jul=$pag->getPagamento($matricula->id, 7);
                   @endphp

                    @if($Jul>0)

                        @php
                            $Julho=$Julho+$Jul;
                            $Total=$Total+$Jul;
                        @endphp
                      
                      {{  $Jul }}.00
                      
                    @endif
                </td>

                <td>
                   @php
                       $Ago=$pag->getPagamento($matricula->id, 8);
                   @endphp

                    @if($Ago>0)

                        @php
                            $Agosto=$Agosto+$Ago;
                            $Total=$Total+$Ago;
                        @endphp
                      
                      {{  $Ago }}.00
                      
                    @endif
                </td>

                <td>
                   @php
                       $Set=$pag->getPagamento($matricula->id, 9);
                   @endphp

                    @if($Set>0)

                        @php
                            $Setembro=$Setembro+$Set;
                            $Total=$Total+$Set;
                        @endphp
                      
                      {{  $Set }}.00
                      
                    @endif
                </td>

                <td>
                   @php
                       $Out=$pag->getPagamento($matricula->id, 10);
                   @endphp

                    @if($Out>0)

                        @php
                            $Outubro=$Outubro+$Out;
                            $Total=$Total+$Out;
                        @endphp
                      
                      {{  $Out }}.00
                      
                    @endif
                </td>

                <td>
                   @php
                       $Nov=$pag->getPagamento($matricula->id, 11);
                   @endphp

                    @if($Nov>0)

                        @php
                            $Novembro=$Novembro+$Nov;
                            $Total=$Total+$Nov;
                        @endphp
                      
                      {{  $Nov }}.00
                      
                    @endif
                </td>

                <td>
                   @php
                       $Dez=$pag->getPagamento($matricula->id, 12);
                   @endphp

                    @if($Dez>0)

                        @php
                            $Dezembro=$Dezembro+$Dez;
                            $Total=$Total+$Dez;
                        @endphp
                      
                      {{  $Dez }}.00
                      
                    @endif
                </td>

                <td>
                    {{ $Total }}.00
                </td>


                
            </tr>
            @endforeach

            <tfoot>

            @php
                $TotalPagamento = $Fevereiro + $Marco + $Abril + $Maio + $Junho + $Julho + $Agosto + $Setembro + $Outubro + $Novembro + $Dezembro ;
            @endphp 

            <tr class="td-bg-green">

                <th colspan="2">
                     Subtotal dos Pagamentos   
                </th>

                <th>
                {{ $Fevereiro }}.00
                </th>

                <th>
                {{ $Marco }}.00
                </th>

                <th>
                {{ $Abril }}.00
                </th>

                <th>
                {{ $Maio }}.00
                </th>

                <th>
                {{ $Junho }}.00
                </th>

                <th>
                {{ $Julho }}.00
                </th>

                <th>
                {{ $Agosto }}.00
                </th>

                <th>
                {{ $Setembro }}.00
                </th>

                <th>
                {{ $Outubro }}.00
                </th>

                <th>
                {{ $Novembro }}.00
                </th>

                <th>
                {{ $Dezembro }}.00
                </th>

                <th>
                {{ $TotalPagamento }}.00
                </th>

            </tr>
            </tfoot>
                        
            </tbody>

        </table>



    </div>
    

    
</body>
</html>