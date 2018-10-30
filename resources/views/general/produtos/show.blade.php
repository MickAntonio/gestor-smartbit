@extends('general.main')

@section('title', 'GEstoque-Adminsitrador')

@section('page-heading')

    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Visualizar Produto</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="/">Admin</a>
                </li>
                <li>
                    <a href="/admin/produtos">Produtos</a>
                </li>
                <li class="active">
                    <strong>Visualizar</strong>
                </li>
            </ol>
        </div>
    </div>

@endsection

@section('content')

                
<div class="row m-t-lg">
    <div class="col-lg-12">
        <div class="tabs-container">
            <ul class="nav nav-tabs">
                <li class="active">
                    <a data-toggle="tab" href="#tab-1">
                        Detalhes
                        <span class="label label-warning">Produto</span>
                    </a>
                </li>

                <li>
                    <a data-toggle="tab" href="#tab-2">
                        Preços
                    </a>
                </li>

                <li>
                    <a data-toggle="tab" href="#tab-3">
                        Estoque
                    </a>
                </li>

            </ul>
            <div class="tab-content">
            
                <div id="tab-1" class="tab-pane active">
                    <div class="panel-body">

                        <table class="table table-bordered table-th-200">

                            <tr>
                                <th>Código</th>
                                <td>{{ $produto->codigo }}</td>
                            </tr>

                             <tr>
                                <th>Produto</th>
                                <td>{{ $produto->nome }}</td>
                            </tr>

                            <tr>
                                <th>Categoria</th>
                                <td>{{ $produto->subcategoria->nome }}</td>
                            </tr>

                            <tr>
                                <th>Sub-categoria</th>
                                <td>{{ $produto->subcategoria->categoria->nome }}</td>
                            </tr>

                            <tr>
                                <th>Modelo</th>
                                <td>{{ $produto->modelo }}</td>
                            </tr>

                            <tr>
                                <th>Peso</th>
                                <td>{{ $produto->peso }}</td>
                            </tr>

                            <tr>
                                <th>Dimensões</th>
                                <td>{{ $produto->dimensoes }}</td>
                            </tr>

                             <tr>
                                <th>Fornecedor</th>
                                <td>{{ $produto->fornecedor->nome }}</td>
                            </tr>

                             <tr>
                                <th>Possui Variação</th>
                                <td>{{ $produto->variacao }}</td>
                            </tr>

                             <tr>
                                <th>Para Comercializar</th>
                                <td>{{ $produto->comercial }}</td>
                            </tr>

                            <tr>
                                <th>Descrição do Produto</th>
                                <td>{{ $produto->descricao }}</td>
                            </tr>

                            <tr>
                                <th>Acção</th>
                                <td>
                                    <a href="{{ route('produtos.edit', $produto->id) }}" class="btn btn-primary btn-sm"><i class="fa fa-pencil"></i> </a>
                                    <a href="#" data-toggle="modal" data-target="#excluirModal" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> </a>
                                </td>
                            </tr>

                        </table>
                    
                    </div>
                </div>

                <div id="tab-2" class="tab-pane">
                    <div class="panel-body">

                        <table class="table table-bordered table-th-200">

                            <tr>
                                <th>Preço de Custo</th>
                                <td>{{ $produto->valor_compra }}.00 kz</td>
                            </tr>

                            <tr>
                                <th>Despesas</th>
                                <td>{{ $produto->despesas }}.00 kz</td>
                            </tr>

                            <tr>
                                <th>Preço de Custo Final</th>
                                <td>{{ $produto->valor_compra + $produto->despesas }}.00 kz</td>
                            </tr>

                            @if($produto->comercial=='Sim')
                            <tr>
                                <th>Preço de Venda</th>
                                <td>{{ $produto->valor_venda }}</td>
                            </tr>
                            @endif

                            <tr>
                                <th>Descrição do Produto</th>
                                <td>{{ $produto->descricao }}</td>
                            </tr>

                            <tr>
                                <th>Acção</th>
                                <td>
                                    <a href="{{ route('produtos.edit', $produto->id) }}" class="btn btn-primary btn-sm"><i class="fa fa-pencil"></i> </a>
                                    <a href="#" data-toggle="modal" data-target="#excluirModal" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> </a>
                                </td>
                            </tr>

                        </table>
                    
                    </div>
                </div>

                <div id="tab-3" class="tab-pane">
                    <div class="panel-body">

                        <table class="table table-bordered table-th-200">

                            <tr>
                                <th>Estoque Mínimo</th>
                                <td>{{ $produto->estoque->estoque_minimo }}</td>
                            </tr>

                            <tr>
                                <th>Estoque Máximo</th>
                                <td>{{ $produto->estoque->estoque_maximo }}</td>
                            </tr>

                            <tr>
                                <th>Estoque Actual</th>
                                <td>{{ $produto->estoque->estoque_actual }}</td>
                            </tr>

                            <tr>
                                <th>Descrição do Produto</th>
                                <td>{{ $produto->descricao }}</td>
                            </tr>

                            <tr>
                                <th>Acção</th>
                                <td>
                                    <a href="{{ route('produtos.edit', $produto->id) }}" class="btn btn-primary btn-sm"><i class="fa fa-pencil"></i> </a>
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
                <small class="font-bold">Ao Excluires este Produto todos os dados deste Produto serão excluidos.</small>
            </div>
            <div class="modal-body">

                <div class="row">

                    {!! Form::open(['route'=> ['produtos.destroy', $produto->id], 'method'=>'DELETE']) !!}
                    <button type="submit" class="col-sm-12 btn btn-primary"> <strong>Sim Tenho</strong></button>
                    {!! Form::close() !!}

                    <button type="button" class="col-sm-12 btn btn-white mg-top-20" data-dismiss="modal"><strong>Cancelar</strong></button>
                    
                </div>

            </div>
           
        </div>
    </div>

</div>

        
@endsection
