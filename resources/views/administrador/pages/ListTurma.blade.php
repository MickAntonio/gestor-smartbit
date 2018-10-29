@extends("Administrador.main")
@section("title"," Lista de Turmas")

@section("content")

<div class="row">
<div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>LISTA DAS TURMAS</h5>
                            <div class="ibox-tools">
                                <a class="collapse-link">
                                    <i class="fa fa-chevron-up"></i>
                                </a>
                                
                                <a class="close-link">
                                    <i class="fa fa-times"></i>
                                </a>
                            </div>
                        </div>
<div class="ibox-content">
    <div class="row">
        <div class="col-sm-9 m-b-xs">
            <div data-toggle="" class="btn-group">
            <label class="btn btn-sm btn-white"> <a href="#" class="">Turma sem vaga</a> </label>
            <label class="btn btn-sm btn-white"> <a href="#" class=""> TUrma com vaga</a> </label>
            <label class="btn btn-sm btn-white"> <a href="#" class=""> Turma com vaga e sem alunos</a> </label>
            </div>
                                </div>
                            </div>
    <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                    <tr>
                                        <th>Nome</th>
                                        <th>Quantidade </th>
                                        <th>Periodo</th>
                                        <th>Classe </th>
                                        <th>Curso</th>
                                        <th>Ano Lectivo </th>
                                        <th>Acção</th>
                                        <th>Acção</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                   <?php for ($i=0; $i <count($Turma) ; $i++) { ?>
                                    <tr>
                                        <td><?=$Turma[$i]->nome?></td>
                                        <td><?=$Turma[$i]->Quantidade?></td>
                                        <td><?=$Turma[$i]->periodo?></td>
                                        <td><?=$Turma[$i]->classe()->get()[0]->nome ?></td>
                                        <td><?=$Turma[$i]->curso()->get()[0]->nome?></td>
                                        <td><?=$Turma[$i]->anolectivo?></td>
                                        <td><a href="#" class="btn btn-success" >Editar</a></td>
                                        <td><a href="#" class="btn btn-danger" >Eliminar</a></td>

                                    </tr>
                                    <?php } ?>
                                    </tbody>
                                </table>
                            </div>
        </div>
    </div>
                        
</div>
@endsection