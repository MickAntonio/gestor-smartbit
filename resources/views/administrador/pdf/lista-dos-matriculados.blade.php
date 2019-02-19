<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Lista de alunos matriculados para o ano lectivo <?=$date?></title>
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
    *{ margin: 1% !important; padding: 0px; font-family:  'Segoe UI', Tahoma, Geneva, Verdana, sans-serif}

article 
{
    border: 1px dotted #000;
    padding:5px !important;
    margin:5px ;
}

header { width: 100%; height: 200px; margin-bottom: 50px;}
header  div { border: none;  float: left; margin: 0px !important; padding: 0px !important; }
.head-img { width: 16%; height: 120px; }
.head-img img { width: 100%; height: 110px; margin: 15px 0px 0px 0px !important;}
.head-title { width: 70%; height: 100px; padding-top: 0px !important; text-align: center;}
.head-title h2 { font-size: 18px; font-weight: bold}
</style>
<body>
        <header>
                <div class="head-img">
                        <img src="{{url('img/logoSmartbits.png')}}" alt=" ">
                </div>
                <div class="head-title">
                        <h2>INSTITUTO MÉDIO POLITÉCNICO</h2>
                        <h2>SMARTBITS</h2>       
                        <h2>Lista de alunos matriculados para o ano lectivo <?= $date ?></h2>
                </div>
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
                <?php 
                foreach($matriculado as $text):
                    if(isset($text->turma->anolectivo) and $text->turma->anolectivo == $date):
                        $sexo = " "; 
                            if($text->aluno->candidato->sexo == "MASCULINO")
                                $sexo = "M";
                            elseif($text->aluno->candidato->sexo == "FEMENINO")
                                $sexo = "F";
                   
                        if($text->turma->estado == "NORMAL") :    ?>       
                            <tr>
                                <td><?=$text->aluno->processo ?> </td>
                                <td><?= $text->aluno->candidato->nome ?> </td>
                                <td><?= $sexo ?></td>
                                <td><?=$text->aluno->curso->nome ?> </td> 
                                <td><?=$text->turma->classe->nome ?> </td> 
                                <td><?=$text->turma->nome .' - '. $text->turma->anolectivo.' - '.$text->turma->periodo  ?> </td>                                                
                            </tr><?php  
                        endif;
                    endif;
                endforeach;
                ?>
                   
               </tbody>
           </table>
  
</body>
</html>