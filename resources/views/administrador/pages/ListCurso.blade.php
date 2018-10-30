@extends("Administrador.main")
@section("title"," Lista de cursos")

@section("content")

<div class="row">
<div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>LISTA DOS CURSOS</h5>
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

    <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                    <tr>
                                        <th>Curso</th>
                                        <th>Abreviação </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                   <?php for ($i=0; $i <count($Curso) ; $i++) { ?>
                                    <tr>
                                        <td><?=$Curso[$i]->nome?></td>
                                        <td><?=$Curso[$i]->Abreviacao?></td>
                                    </tr>
                                    <?php } ?>
                                    </tbody>
                                </table>
                            </div>
        </div>
    </div>
                        
</div>
@endsection