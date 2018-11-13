
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
        
        <h1 class="h1-title">Relatório de  Saidas   <br><span class="data-span">  de {{ $start }} à {{ $end }}  </span></h1>
       
        <table class="table table-striped table-bordered table-hover data-table-grid">
            <thead>

            <tr class="td-bg- text-align-center">
                <th colspan="6" class="text-align-center"> Saidas </th>
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
            @foreach($saidas as $saida)

            @if($saida->pagamentoPreco->tipoPagamento->tipo=="Saida" && $saida->pagamentoPreco->tipoPagamento->proveniencia=="Outro" )
            <tr>
            
                <td>{{ $i++ }}</td>
                <td class="td-bg-green bold">{{ $saida->pagamentoPreco->tipoPagamento->nome }}</td>
                <td>{{ $saida->forma }}</td>
                <td class="td-bg-green bold">{{ $saida->valor_pago }}</td>
                <td>{{ $saida->descricao }}</td>
                <td>{{ $saida->created_at }}</td>
                
               
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