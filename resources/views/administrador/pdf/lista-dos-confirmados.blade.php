<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Lista de alunos que confirmaram a matricula para o ano lectivo {{$date}}</title>
    <link rel="stylesheet" href="css/pdfAdmin.css">
    <link rel="stylesheet" href="css/animate.css">
    <link rel="stylesheet" href="css/custom.css">
<style>
   body{ background: #fff;}
   table, tr, td, th{ border-color:rgba(0,0,0,.7) !important;}
   tr,td,th 
   { 
        font-size: 11px;
        height: 10px !important;
        margin:0px;
        padding: 2px 0px !important;
    }
    header > div 
{
    margin: 20px 0px 0px 0px;
}
</style>
<body>
    <header >
        <h2>INSTITUTO MEDIO POLITECNICO E CENTRO DE FORMAÇÃO PROFISSIONAL </h2>
        <h2>SMARTBITS</h2>
        <h2>Lista de alunos com matricula confirmada {{ $date }}</h2>
       
                 
    </header> 
             <table class="table table-bordered">
                <thead>
                    <tr>
                        <th  scope="col">Nº Proc.</th>
                        <th style="width: 250px" scope="col">Nome</th>
                        <th  scope="col">sexo</th>
                        <th  scope="col"> curso </th>
                        <th  scope="col"> classe </th>
                        <th  scope="col"> Turma </th>
                    </tr>
                </thead>
                <tbody>
                @foreach($matriculado as $text)
                    @if(isset($text->turma->anolectivo) and $text->turma->anolectivo == $date)
                        @php $sexo = " "; 
                            if($text->aluno->candidato->sexo == "MASCULINO")
                                $sexo = "M";
                            elseif($text->aluno->candidato->sexo == "FEMENINO")
                                $sexo = "F";
                        @endphp 
                        @if($text->turma->estado == "NORMAL")              
                            <tr>
                                <td>{{$text->aluno->processo }} </td>
                                <td>{{ $text->aluno->candidato->nome }} </td>
                                <td>{{ $sexo }}</td>
                                <td>{{$text->aluno->curso->nome }} </td> 
                                <td>{{$text->turma->classe->nome }} </td> 
                                <td>{{$text->turma->nome .' - '. $text->turma->anolectivo.' - '.$text->turma->periodo  }} </td>                                                
                            </tr>
                        @endif
                    @endif
                @endforeach
                   
               </tbody>
           </table>
  
</body>
</html>