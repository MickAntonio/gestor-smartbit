
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <link rel="stylesheet" href="css/pdfs/recibo-termica.css">
    <link rel="stylesheet" href="css/bootstrap.css">
    <title>Recibo de Pagamento da Propina</title>
</head>
<body>


    <div class="containe">

        <div class="header mg-t--20">

            <div>
            <img src="img/logo.png" class="smartbit-logo" alt="smartbit logo">
            </div>
            <h3 class="mg-t--5">INSTITUTO MÉDIO POLITÉCNICO </h3>
            <h3>SMARTBITS</h3>

            {{-- <h4 class="mg-t-10">TELEFONE: 938 838 843</h4> --}}
            <h4 class="mg-t-10">NIF: 54773833</h4>
            <h4 class="mg-t-10">RECIBO DE PAGAMENTO DE PROPINA - Nº {{ $pagamento[0]->id }}</h4>

        </div>
       
        <div class="content">

            <div class="line" >------------------------------------------------------------------</div>
                <div class="title">IDENTIFICAÇÃO DO ALUNO</div> 
            <div class="line" >------------------------------------------------------------------</div>
            
            <div class="filds">
                <span class="field-name">Nome:</span>
                <span class="field">{{ $pagamento[0]->matricula->aluno->candidato->nome }}</span>
            </div>

            <div class="filds">
                <span class="field-name">Curso:</span>
                <span class="field">{{ $pagamento[0]->matricula->turma->curso->nome }}</span>
            </div>

            <div class="filds">
                <span class="field-name">Turma:</span>
                <span class="field">{{ $pagamento[0]->matricula->turma->nome }}</span>
            </div>

            <div class="line" >------------------------------------------------------------------</div>
                <div class="title">DADOS DO PAGAMENTO</div> 
            <div class="line" >------------------------------------------------------------------</div>

            <table class="table">
                <thead>
                    <tr>
                        <th>Mês</th>
                        <th>Multa</th>
                        <th>Subtotal</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($pagamento[0]->propinas as $propina)
                    <tr>
                        <td>{{ $propina->mes->mes }}</td>
                        <td>{{ $propina->multa }}</td>
                        <td>{{ $propina->preco->preco->preco }}</td>
                    </tr>
                    @endforeach

                </tbody>
            </table>

            <div class="line" >------------------------------------------------------------------</div>

            <div class="filds-2">
                <span class="field-name-2">TOTAL:</span>
                <span class="field">&nbsp;
                    {{ $pagamento[0]->total }} kz
                </span>
            </div>

            <div class="filds-2">
                <span class="field-name-2">TOTAL PAGO:</span>
                <span class="field">&nbsp;
                    {{ $pagamento[0]->valor_pago }} kz 
                </span>
            </div>

            <div class="line" >------------------------------------------------------------------</div>

        </div>

        <div class="header">

            <h4 class="mg-t-10">Assinatura e Carrimbo</h4>

            <div class="line-2">
            ________________________
            </div>

            <h4 class="mg-t-40">Documento processado por computador</h4>
            <h4 class="mg-t-10">{{ $pagamento[0]->created_at }}</h4>
            <h4 class="mg-t-10"> <i> Instalado por new-artisans - 992 556 018 </i></h4>

        
        </div>



    </div>
    
    
</body>
</html>