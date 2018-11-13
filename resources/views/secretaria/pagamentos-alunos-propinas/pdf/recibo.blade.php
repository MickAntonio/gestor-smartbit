
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <link rel="stylesheet" href="css/pdfs/custom.css">
    <title>Recibo de Pagamento da Propina</title>
</head>
<body>

    <div class="pg-container">
        
        <div class="pg-header">
        
            <h3>República de Angola</h3>
            <h3>Ministério da Educação</h3>
            <h3>Instituto Médio Politecnico</h3>

            <h3 class="pg-header-sub"> <u> Smartbits</u></h3>


        </div>

         @php
            $multas=0
        @endphp  

        @foreach($pagamento[0]->propinas as $propina)

            @if($propina->multa>0)

            @php $multas=$multas+$propina->multa @endphp 
            
            @endif                           

        @endforeach

        <div class="pg-border-body">
        
            <span class="under-title">Nome:</span> <span class="under-line">&nbsp;&nbsp; <i>{{ $pagamento[0]->matricula->aluno->candidato->nome }}</i></span>
            <br/>
            <br/>
            <span class="under-title">Curso:</span> <span class="under-line">&nbsp;&nbsp; <i>{{ $pagamento[0]->matricula->turma->curso->nome }}</i></span>
            <br/>
            <br/>
            <span class="under-title">Turma:</span> <span class="under-line-2">&nbsp;&nbsp; <i>{{ $pagamento[0]->matricula->turma->nome }}</i></span>
            
            <span class="under-title">Mês:</span> <span class="under-line-2">&nbsp;&nbsp; 
            
                <i>
                @foreach($pagamento[0]->propinas as $propina)
                {{ $propina->mes->mes }}&nbsp;&nbsp; 
                @endforeach

                </i>
            </span>

            <br/>
            <br/>
            <span class="under-title">Valor:</span> <span class="under-line-3">&nbsp;&nbsp; <i>{{ $pagamento[0]->valor_pago }} kz</i></span>
            
            <span class="under-title">Multa:</span> <span class="under-line-3">&nbsp;&nbsp; <i>{{ $multas }}.00 kz</i></span>
            <span class="under-title">Data de Pagamento:</span> <span class="under-line-3">&nbsp;&nbsp; <i>{{ $pagamento[0]->created_at }}</i></span>
           
        </div>

        <div class="pg-footer">

            <div class="pg-f-right">

                <span class="">Responsável</span>
                <br/>
                ___________________________

            </div>

            <div class="pg-f-left">

                <span class="">Assinatura e Carimbo</span>
                <br/>
                _______________________________

            </div>

        </div>



    </div>
    
</body>
</html>