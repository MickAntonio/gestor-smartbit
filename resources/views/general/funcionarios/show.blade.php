@extends('general.main')

@section('title', 'GEstoque-Adminsitrador')

@section('page-heading')

    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Visualizar Funcionário</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="index-2.html">Admin</a>
                </li>
                <li>
                    <a>funcionarios</a>
                </li>
                <li class="active">
                    <strong>Visualizar</strong>
                </li>
            </ol>
        </div>
        <div class="col-lg-2">

        </div>
    </div>

@endsection

@section('content')

                
<div class="row m-t-lg">
    <div class="col-lg-12">
        <div class="tabs-container">
            <ul class="nav nav-tabs">
                <li class="active"><a data-toggle="tab" href="#tab-10">
                    Dados do Funcionário
                    <span class="label label-warning">NEW</span>
                </a>
                </li>
            </ul>
            <div class="tab-content">
                <div id="tab-10" class="tab-pane active">
                    <div class="panel-body">

                        <table class="table table-bordered table-th-200">

                            <tr>
                                <th>Nome</th>
                                <td>{{ $funcionario->nome }}</td>
                            </tr>

                            <tr>
                                <th>Bilhete de Identidade</th>
                                <td>{{ $funcionario->bi }}</td>
                            </tr>

                            <tr>
                                <th>Genero</th>
                                <td>{{ $funcionario->genero }}</td>
                            </tr>

                            <tr>
                                <th>Cargo</th>
                                <td>{{ $funcionario->cargo }}</td>
                            </tr>

                            <tr>
                                <th>Data de Nascimento</th>
                                <td>{{ $funcionario->data_nascimento }}</td>
                            </tr>

                            <tr>
                                <th>Telefone</th>
                                <td>{{ $funcionario->contacto->telefone }}</td>
                            </tr>

                            <tr>
                                <th>Cargo</th>
                                <td>{{ $funcionario->contacto->email }}</td>
                            </tr>

                            <tr>
                                <th>Redes Sociais</th>
                                <td>{{ $funcionario->contacto->redes_sociais }}</td>
                            </tr>

                            <tr>
                                <th>Província</th>
                                <td>{{ $funcionario->endereco->municipio->provincia->nome }}</td>
                            </tr>

                            <tr>
                                <th>Munícipio</th>
                                <td>{{ $funcionario->endereco->municipio->nome }}</td>
                            </tr>

                            <tr>
                                <th>Bairro</th>
                                <td>{{ $funcionario->endereco->bairro }}</td>
                            </tr>

                            <tr>
                                <th>Rua</th>
                                <td>{{ $funcionario->endereco->bairro }}</td>
                            </tr>

                            <tr>
                                <th>Acção</th>
                                <td>
                                    <a href="{{ route('funcionario.edit', $funcionario->id) }}" class="btn btn-primary btn-sm"><i class="fa fa-pencil"></i> </a>
                                    <a href="#" data-toggle="modal" data-target="#excluirModal" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> </a>
                                </td>
                            </tr>

                        </table>
                    
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



<div class="modal inmodal" id="excluirModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content animated bounceInRight">

        
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">Tens Certeza Que Pretendes Excluir</h4>
                <small class="font-bold">Ao Excluires este Funcionário todos os dados deste funcionário serão excluidos.</small>
            </div>
            <div class="modal-body">

                <div class="row">

                    {!! Form::open(['route'=> ['funcionario.destroy', $funcionario->id], 'method'=>'DELETE']) !!}
                    <button type="submit" class="col-sm-12 btn btn-primary"> <strong>Sim Tenho</strong></button>
                    {!! Form::close() !!}

                    <button type="button" class="col-sm-12 btn btn-white mg-top-20" data-dismiss="modal"><strong>Cancelar</strong></button>
                    
                </div>

            </div>
           
        </div>
    </div>

</div>

        
@endsection
