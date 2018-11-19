<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Lista da turma - {{$turma->nome?? ""}}  - {{ $turma->curso()->get()[0]->nome?? "" }} - {{$turma->classe()->get()[0]->nome?? ""}} - {{$turma->periodo?? ""}}</title>
    {!! Html::style('css/pdfAdmin.css') !!}
    {!! Html::style('css/animate.css') !!}
    {!! Html::style('css/custom.css') !!}
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
        <h2>SMARTBIT</h2>
       
            <p>Curso: {{ $turma->curso()->get()[0]->nome?? "" }} / {{$turma->classe()->get()[0]->nome?? ""}}</p>
            <p>Turma: {{$turma->nome?? ""}} / Periodo: {{$turma->periodo?? ""}} / Ano lectivo: {{$turma->anolectivo?? ""}}</p>
        
    </header>
       
             <table class="table table-bordered">
                <thead>
                    <tr>
                        <th  scope="col">Nº </th>
                        <th  scope="col">Proc.</th>
                        <th style="width: 250px" scope="col">Nome</th>
                        <th  scope="col"> Sexo </th>
                        <th  scope="col"> Idade </th>
                        <th scope="col">Telf.</th>
                    </tr>
                </thead>
                <tbody>
                <?php  $conta = 0 ?>
                @foreach($matricula as $text)
                                    @if(isset($matriculado->where("aluno_id",$text->aluno()->get()[0]->id)->where("turma_id",$idturma)->get()[0]))
                                        @php  
                                            $aluno = $matriculado->where("aluno_id",$text->aluno()->get()[0]->id)->where("turma_id",$idturma)->get()[0];
                                        @endphp
                                            <tr>
                                                <td>{{ $conta = $conta + 1 }}</td>
                                                <td>{{ $text->aluno()->get()[0]->processo }} </td>
                                                <td>{{ $text->nome }}</td>
                                                <td>{{$text->sexo }} </td>
                                                <td>{{$text->nascido }} </td> 
                                                <td>{{$text->telefone }} </td> 
                                            </tr>
                                    @endif
                                @endforeach
                   
               </tbody>
           </table>
  
</body>
</html>