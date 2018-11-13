
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <link rel="stylesheet" href="css/pdfs/custom.css">
    <link rel="stylesheet" href="css/bootstrap.css">
    <title>Relatório de  Entradas</title>
</head>
<body>

    

    <div class="page-container">
        
        <h1 class="h1-title">Relatório de  Entradas   <br><span class="data-span">  de {{ $start }} à {{ $end }}  </span></h1>
        
        <table class="table table-striped table-bordered table-hover data-table-grid">
            <thead>

            <tr class="td-bg- text-align-center">
                <th colspan="8" class="text-align-center">Pagamentos de Propinas</th>
            </tr>

            <tr class="td-bg-green">

                <th>#</th>
                <th>Nome </th>
                <th>Sexo </th>
                <th>Turma</th>
                <th>Meses</th>
                <th>Multa</th>
                <th>Total Pago</th>
                <th>Data</th>
            </tr>
            </thead>
            <tbody>

            @php
                $i=1
            @endphp                              
            
            @foreach($propinas as $pagamento)
            
            <tr>
                <td>{{ $i++ }}</td>
                <td class="td-bg-green bold">{{ $pagamento->matricula->aluno->candidato->nome }}</td>
                <td>{{ $pagamento->matricula->aluno->candidato->sexo }}</td>
                <td>
                    {{ $pagamento->matricula->turma->curso->abreviacao }}&nbsp;
                    {{ $pagamento->matricula->turma->classe->nome }}&nbsp;
                    {{ $pagamento->matricula->turma->nome }}&nbsp;
                </td>
                <td>
                    
                @foreach($pagamento->propinas as $propina)
                    {{ $propina->mes->mes }}&nbsp; 
                @endforeach

                </td>

                @php
                    $multas=0
                @endphp  

                @foreach($pagamento->propinas as $propina)

                    @if($propina->multa>0)

                    @php $multas=$multas+$propina->multa @endphp 
                    
                    @endif                           

                @endforeach
                <td>{{ $multas }}.00</td>
                <td class="td-bg-green bold">{{ $pagamento->valor_pago }}</td>
                <td>{{ $pagamento->created_at }}</td>
               
            </tr>

            @endforeach

            
            </tbody>
        </table>

        
        <table class="table table-striped table-bordered table-hover data-table-grid">
            <thead>

            <tr class="td-bg- text-align-center">
                <th colspan="8" class="text-align-center">Outras Entradas de Alunos</th>
            </tr>

            <tr class="td-bg-green">

                <th>#</th>
                <th>Tipo </th>
                <th>Aluno</th>
                <th>Turma</th>
                <th>Valor Recebido</th>
                <th>Forma Pagamento</th>
                <th>Descrição</th>
                <th>Data</th>
            </tr>

            </thead>
            <tbody>
            
            @php
                $i=1
            @endphp                              
            @foreach($alunoPagamentos as $aluno)

            @if($aluno->pagamento->pagamentoPreco->tipoPagamento->proveniencia=="Aluno" && $aluno->pagamento->pagamentoPreco->tipoPagamento->tipo=="Entrada" )
            <tr>
            
                <td>{{ $i++ }}</td>
                <td class="td-bg-green bold">{{ $aluno->pagamento->pagamentoPreco->tipoPagamento->nome }}</td>
                <td>{{ $aluno->matricula->aluno->candidato->nome }}</td>
                <td>{{ $aluno->matricula->turma->curso->abreviacao }} - {{ $aluno->matricula->turma->nome }} - {{ $aluno->matricula->turma->classe->nome }}</td>
                <td class="td-bg-green bold">{{ $aluno->pagamento->valor_pago }}</td>
                <td>{{ $aluno->pagamento->forma }}</td>
                <td>{{ $aluno->pagamento->descricao }}</td>
                <td>{{ $aluno->created_at }}</td>
              

            </tr>
            @endif
            
            @endforeach
    
            
            </tbody>

            <tfoot>

            <tr class="td-bg-green">

                <th>#</th>
                <th>Tipo </th>
                <th>Aluno</th>
                <th>Turma</th>
                <th>Valor Recebido</th>
                <th>Forma Pagamento</th>
                <th>Descrição</th>
                <th>Data</th>
            </tr>

            </tfoot>
        </table>
        
        <table class="table table-striped table-bordered table-hover data-table-grid">
            <thead>

            <tr class="td-bg- text-align-center">
                <th colspan="6" class="text-align-center">Outras Entradas </th>
            </tr>

            <tr class="td-bg-green">

                <th>#</th>
                <th>Tipo </th>
                <th>Forma de Pagamento</th>
                <th>Valor Recebido</th>
                <th>Descrição</th>
                <th>Data</th>
            </tr>
            </thead>
            <tbody>
            
            @php
                $i=1
            @endphp                              
            @foreach($entradas as $entrada)

            @if($entrada->pagamentoPreco->tipoPagamento->tipo=="Entrada" && $entrada->pagamentoPreco->tipoPagamento->proveniencia=="Outro" )
            <tr>
            
                <td>{{ $i++ }}</td>
                <td class="td-bg-green bold">{{ $entrada->pagamentoPreco->tipoPagamento->nome }}</td>
                <td>{{ $entrada->forma }}</td>
                <td class="td-bg-green bold">{{ $entrada->valor_pago }}</td>
                <td>{{ $entrada->descricao }}</td>
                <td>{{ $entrada->created_at }}</td>
                
               
            </tr>
            @endif
            
            @endforeach

            </tbody>

            <tfoot>

            <tr class="td-bg-green">

                <th>#</th>
                <th>Tipo </th>
                <th>Valor Recebido</th>
                <th>Forma de Pagamento</th>
                <th>Descrição</th>
                <th>Data</th>
            </tr>

            </tfoot>
        </table>

    </div>
    

    
</body>
</html>