<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ficha de MAtricula</title>
    {!! Html::style('css/pdfAdmin.css') !!}
    <style>
        *{
    margin:10px 10px 10px 10px;
    padding: 0px;
}
body > h2,h3
{
    text-align: center !important;
    margin: 0% !important;
    font-size: 16px !important;
}
body > h3
{
    margin: 10px 0px 0px !important;
    padding: 5px !important;
}
article 
{
    border: 1px dotted #000;
    padding:5px !important;
    margin:5px ;
}
header { background: #aaa;padding:0px}
section,p
{ 
    margin:0px; 
    padding:0px;
}
    </style>
<body>
        <h2>INSTITUTO MEDIO POLITECNICO E CENTRO DE FORMAÇÃO PROFISSIONAL </h2>
        <h2>SMARTBIT</h2>
        
            <h3>BOLETIM DE MATRICULA</h3>
        
    

        <article>
            <p>MATRICULA Nº: {{ $matricula->aluno()->get()[0]->matricula()->get()[0]->id?? ""}} / Ano Lectivo: {{ date("Y") }}</p>
        </article>
        <article>
            <p>Nome: {{ $matricula->nome?? ""}}</p>
            <p>Nascido: Sexo:            {{ $matricula->sexo?? ""}}</p>
            <p>Natural de: {{ $matricula->municipio()->get()[0]->nome?? ""}} / Provincia de: {{ $matricula->municipio->get()[0]->provincia()->get()[0]->nome?? ""}}</p>
            <p>Número do B.I: {{ $matricula->bi?? ""}}</p>
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
            <p>O encarregado de educação (para alunos menores de 18 anos) ____________________________________</p>
            <p>______________________________________________________________________________________</p>
            <p>O aluno :_______________________________________________________________________________</p>
        </article>
        <p>===============================================================================</p>
        <article>
            <p><strong>Atenção: A apresentação de falsas informações pode implicar o cancelamento da matricula </strong></p>
            <p>RECIBO DE MATRICULA Nº:{{ $matricula->aluno()->get()[0]->matricula()->get()[0]->id?? ""}}</p>
            <p>Anolectivo: {{date("Y") }}</p>
            <p>Nome do Aluno: {{ $matricula->nome?? ""}}</p>
            <p>Curso de:  {{ $matricula->aluno()->get()[0]->curso()->get()[0]->nome?? ""}}  Classe: {{ $matricula->aluno()->get()[0]->matricula()->get()[0]->turma()->get()[0]->classe()->get()[0]->nome?? ""}}</p>
            <p>Data da matricula: {{ date("d-m-Y") }}</p>

        </article>
</body>
</html>