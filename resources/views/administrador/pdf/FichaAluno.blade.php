<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ficha de MAtricula</title>
    <link rel="stylesheet" href="css/animate.css">
    <link rel="stylesheet" href="css/custom.css">
    <style>

*{ margin: 1% !important; padding: 0px; font-family:  'Segoe UI', Tahoma, Geneva, Verdana, sans-serif}

article 
{
    border: 1px dotted #000;
    padding:5px !important;
    margin:5px ;
}

header { width: 100%; height: 100px;}
header  div { float: left; margin: 0px !important; padding: 0px !important; }
.head-img { width: 18%; height: 100px;}
.head-img img { width: 100%; height: 110px; margin: 0px !important;}
.head-title { width: 80%; height: 100px; padding-top: 20px !important; text-align: center;}
.head-title h2 { font-size: 14px;}

section,p
{ 
    margin:0px; 
    padding:0px;
}

    </style>
<body>
        <header>
                <div class="head-img">
                        <img src="{{url('img/logoSmartbits.png')}}" alt=" ">
                </div>
                <div class="head-title">
                        <h2>INSTITUTO MÉDIO POLITÉCNICO</h2>
                        <h2>SMARTBITS</h2>       
                        <h2>BOLETIM DE MATRICULA </h2>
                </div>
            </header>
        
    
<section>
        <article>
            <p>MATRICULA Nº: {{ $matricula->aluno()->get()[0]->matricula()->get()[0]->id?? ""}} / Ano Lectivo: {{ date("Y") }}</p>
        </article>
        <article>
            <p>Nome: {{ $matricula->nome?? ""}}</p>
            <p>Nascido: {{ $matricula->nascido?? ""}} Sexo:            {{ $matricula->sexo?? ""}}</p>
            <p>Natural de: {{ $matricula->municipio()->get()[0]->nome?? ""}} / Provincia de: {{ $matricula->municipio->get()[0]->provincia()->get()[0]->nome?? ""}}</p>
            <p>Número de Identificação: {{ $matricula->bi?? ""}}</p>
            <p>Filho de: {{ $matricula->pai?? ""}} / e de: {{ $matricula->mae?? ""}}</p>
        </article>
        <article>
            <p>Residencia actual: {{ $matricula->bairro?? ""}}</p>
            <p>Telefone do aluno: {{ $matricula->telefone?? ""}} / Telefone do pai: {{ $matricula->telefone_pai?? ""}} / Telefone da mãe: {{ $matricula->telefone_mae?? ""}}</p>
        </article>
        <article>
            <p>Inscreve-se na {{ $matricula->aluno()->get()[0]->matricula()->get()[0]->turma()->get()[0]->classe()->get()[0]->nome?? ""}} Pela 1 vez </p>
                        <p>No curso de: {{ $matricula->aluno()->get()[0]->curso()->get()[0]->nome?? ""}} </p>
            <p>Estabelecimento de ensino que frequentou o ano anterior: {{ $matricula->escolaanterior()->get()[0]->nome?? ""}}</p>
        </article>
        <article>
            <p>Assinaturas: (de acordo com o bilhete de identidade)</p>
            <p>O encarregado de educação (para alunos menores de 18 anos) ____________________________</p>
            <p>________________________________________________________________________________</p>
            <p>O aluno: ________________________________________________________________________</p>
        </article>
        <p>==============================================================================</p>
        <article>
            <p><strong>Atenção: A apresentação de falsas informações pode implicar o cancelamento da matricula </strong></p>
            <p>RECIBO DE MATRICULA Nº:{{ $matricula->aluno()->get()[0]->matricula()->get()[0]->id?? ""}}</p>
            <p>Anolectivo: {{date("Y") }}</p>
            <p>Nome do Aluno: {{ $matricula->nome?? ""}}</p>
            <p>Curso de:  {{ $matricula->aluno()->get()[0]->curso()->get()[0]->nome?? ""}}  Classe: {{ $matricula->aluno()->get()[0]->matricula()->get()[0]->turma()->get()[0]->classe()->get()[0]->nome?? ""}}</p>
            <p>Data da matricula: {{ date("d-m-Y") }}</p>
            <br>
            <p>O funcionário: ________________________________________</p>

        </article>
    </section>
</body>
</html>