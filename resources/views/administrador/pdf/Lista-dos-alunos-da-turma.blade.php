<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Lista da turma - {{$turma->nome?? ""}}  - {{ $turma->curso()->get()[0]->nome?? "" }} - {{$turma->classe()->get()[0]->nome?? ""}} - {{$turma->periodo?? ""}}</title>
    <link rel="stylesheet" href="css/pdfAdmin.css">
    <link rel="stylesheet" href="css/animate.css">
    <link rel="stylesheet" href="css/custom.css">
<style>
   body{ background: #fff;}
   table, tr, td, th{ border-color:rgba(0,0,0,1) !important;}
   tr,td,th 
   { 
        font-size: 12px;
        height: 10px !important;
        margin:0px;
        padding: 2px 0px !important;
    }
    header
{
    width: 80%;
    margin: 0px auto;
    text-align: center;
}
header div
{
    border:1px solid #000;
}
header img
{
    width: 75px;
    height: 70px;
    margin: -20px 0px 0px 0px;
} 
header h1,h2,h3,h4
{
    margin:0px;
}
header h1
{
    font-size: 18px; 
}
header h2
{
    font-size: 22px;
    font-weight: bold; 
}
header h3
{
    font-size: 17px;
    font-weight: bold;
    margin: 0px;   
}
header h4
{
    font-size: 17px;
    font-weight: bold;
    color:red; 
} th {text-align:center;}
table {
    margin-top:-40px;
}
</style>
<body>
    <header >
        <img src="{{url('img/logoSmartbits.png')}}" alt=" ">
        <div>
            <h1>INSTITUTO MÉDIO POLITÉCNICO</h1>
            <h2>SMARTBITS</h2>
            <h3>Curso: {{ $turma->curso()->get()[0]->nome?? "" }}   </h3>
            <h4>{{$turma->classe()->get()[0]->nome?? ""}}</h4>
        </div>        
    </header>
       
             <table class="table table-bordered">
                <thead >
                    <tr >
                        <th  scope="col"  colspan="2" >Turma </th>
                        <th  scope="col" style="color:red;font-weight:bold;font-size:12"><strong>{{$turma->nome?? ""}}</strong></th>
                        <th  scope="col" colspan="3" > Contacto dos encarregados </th>
                    </tr>
                    <tr>
                            <th  scope="col">Nº processo </th>
                            <th  scope="col">Nº de Ordem.</th>
                            <th style="width: 250px" scope="col">Nome</th>
                            <th  scope="col"> Pai </th>
                            <th  scope="col"> Mãe </th>
                            <th scope="col">Outro</th>
                        </tr>
                </thead>
                <tbody> <?php  $conta = 0 ; ?>
                @foreach($matricula as $text)
                                    @if(isset($matriculado->where("aluno_id",$text->aluno()->get()[0]->id)->where("turma_id",$idturma)->get()[0]))
                                        @php  
                                            $aluno = $matriculado->where("aluno_id",$text->aluno()->get()[0]->id)->where("turma_id",$idturma)->get()[0];
                                        @endphp
                                            <tr>
                                                <td>{{ $text->aluno()->get()[0]->processo }} </td>
                                                <td>{{ $conta = $conta + 1 }}</td>
                                                <td>{{ $text->nome }}</td>
                                                <td>{{$text->telefone_pai }} </td>
                                                <td>{{$text->telefone_mae }} </td> 
                                                <td>{{$text->telefone }} </td> 
                                            </tr>
                                    @endif
                                @endforeach 
                   
               </tbody>
           </table>
  
</body>
</html>