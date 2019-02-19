<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ficha de MAtricula</title>
    <link rel="stylesheet" href="css/fontes.css">
   <!-- <link rel="stylesheet" href="css/pdfAdmin.css">
    <link rel="stylesheet" href="css/animate.css">
    <link rel="stylesheet" href="css/custom.css"> -->
    <style>
         @font-face 
         { 
             font-family: "Caviar"; 
             src: url('fonts/Caviar.ttf');
         }
*{ margin: 1% !important; padding: 0px; font-family:  'Segoe UI', Tahoma, Geneva, Verdana, sans-serif}
header { width: 100%; height: 100px;}
header  div { float: left; margin: 0px !important; padding: 0px !important; }
.head-img { width: 27%; height: 120px;}
.head-img img { width: 100%; height: 100px}
.head-title { width: 73%; height: 100px; padding-top: 20px !important; text-align: center;}
.head-title h2 { font-size: 14px;}
section { width: 100%; height: 200px;margin-top: 0px !important;}
section p { font-size: 13px;}
    </style>
<body>
    <header>
        <div class="head-img">
                <img src="{{url('img/logoSmartbits.png')}}" alt=" ">
        </div>
        <div class="head-title">
                <h2>INSTITUTO MÉDIO POLITÉCNICO</h2>
                <h2>SMARTBITS</h2>       
                <h2>BOLETIM DE MATRICULA Nº {{ $matricula->aluno()->get()[0]->matricula()->get()[0]->id?? ""}}</h2>
        </div>
    </header>
    <section>
            <p>Nome do Aluno: {{ $matricula->nome?? ""}}</p>
            <p>Classe: {{ $matricula->aluno()->get()[0]->matricula()->get()[0]->turma()->get()[0]->classe()->get()[0]->nome?? ""}}</p>
            <p>Curso de:  {{ $matricula->aluno()->get()[0]->curso()->get()[0]->nome?? ""}}</p>      
            <p>Data da matricula: {{ date("d-m-Y") }}</p>
            <p>___________________________________________________</p>
            <p style="font-size:9px">*Atenção: A apresentação de falsas informações pode implicar o cancelamento da matricula</p>
            <br>
            <p style="font-size:11px">O funcionário:</p>
            <br>            
            <p style="font-size:8px">*processado por computador</p>

    </section>
     <!--
        <article>
            <p>Nome do Aluno: {{ $matricula->nome?? ""}}</p>
            <p>Classe: {{ $matricula->aluno()->get()[0]->matricula()->get()[0]->turma()->get()[0]->classe()->get()[0]->nome?? ""}}</p>
            <p>Curso de:  {{ $matricula->aluno()->get()[0]->curso()->get()[0]->nome?? ""}}</p>      
            <p>Data da matricula: {{ date("d-m-Y") }}</p>
            <p style="font-size:10px">*Atenção: A apresentação de falsas informações pode implicar o cancelamento da matricula</p>
            <br>
             <p>atendido por: {{$user}}</p>            
            <p style="font-size:10px">*processado por computador</p>

        </article> -->
</body>
</html>