@extends('general.main')

@section('title', 'GEstoque-Adminsitrador')

@section('page-heading')

    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Visualizar Fornecedor</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="index-2.html">Admin</a>
                </li>
                <li>
                    <a>Fornecedores</a>
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
                    Fornecedor
                    <span class="label label-warning">Informações</span>
                </a>
                </li>
            </ul>
            <div class="tab-content">
                <div id="tab-10" class="tab-pane active">
                    <div class="panel-body">

                        <table class="table table-bordered table-th-200">

                            <tr>
                                <th>Nome</th>
                                <td>{{ $fornecedor->nome }}</td>
                            </tr>

                            <tr>
                                <th>Descrição</th>
                                <td>{{ $fornecedor->descricao }}</td>
                            </tr>

                            <tr>
                                <th>Telefone</th>
                                <td>{{ $fornecedor->contacto->telefone }}</td>
                            </tr>

                            <tr>
                                <th>Redes Sociais</th>
                                <td>{{ $fornecedor->contacto->redes_sociais }}</td>
                            </tr>

                            <tr>
                                <th>Província</th>
                                <td>{{ $fornecedor->endereco->municipio->provincia->nome }}</td>
                            </tr>

                            <tr>
                                <th>Munícipio</th>
                                <td>{{ $fornecedor->endereco->municipio->nome }}</td>
                            </tr>

                            <tr>
                                <th>Bairro</th>
                                <td>{{ $fornecedor->endereco->bairro }}</td>
                            </tr>

                            <tr>
                                <th>Rua</th>
                                <td>{{ $fornecedor->endereco->bairro }}</td>
                            </tr>

                            <tr>
                                <th>Acção</th>
                                <td>
                                    <a href="{{ route('fornecedor.edit', $fornecedor->id) }}" class="btn btn-primary btn-sm"><i class="fa fa-pencil"></i> </a>
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
                <small class="font-bold">Ao Excluires este fornecedor todos os dados deste fornecedor serão excluidos.</small>
            </div>
            <div class="modal-body">

                <div class="row">

                    {!! Form::open(['route'=> ['fornecedor.destroy', $fornecedor->id], 'method'=>'DELETE']) !!}
                    <button type="submit" class="col-sm-12 btn btn-primary"> <strong>Sim Tenho</strong></button>
                    {!! Form::close() !!}

                    <button type="button" class="col-sm-12 btn btn-white mg-top-20" data-dismiss="modal"><strong>Cancelar</strong></button>
                    
                </div>

            </div>
           
        </div>
    </div>

</div>

        
@endsection
