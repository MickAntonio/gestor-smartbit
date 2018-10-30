@extends('general.main')

@section('title', 'GEstoque-Adminsitrador')

@section('page-heading')

    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Visualizar Dados do Pagamento</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="/">Admin</a>
                </li>
                <li>
                    <a>Pagamento</a>
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
                    Dados do Pagamento
                    <span class="label label-warning">Informações</span>
                </a>

                <li><a data-toggle="tab" href="#tab-2">
                    Serviços Feitos
                </a>
                </li>
            </ul>
            <div class="tab-content">
                <div id="tab-10" class="tab-pane active">
                    <div class="panel-body">

                        <table class="table table-bordered table-th-200">

                            <tr>
                                <th>Cliente</th>
                                <td>{{ $pagamento->cliente->nome }}</td>
                            </tr>

                            <tr>
                                <th>Pagamento</th>
                                <td>{{ $pagamento->desconto }}</td>
                            </tr>

                            <tr>
                                <th>Desconto</th>
                                <td>{{ $pagamento->pagamento }}</td>
                            </tr>

                            <tr>
                                <th>forma_pagamento</th>
                                <td>{{ $pagamento->forma_pagamento }}</td>
                            </tr>

                            <tr>
                                <th>Descrição</th>
                                <td>{{ $pagamento->descricao }}</td>
                            </tr>

                            <tr>
                                <th>criado aos</th>
                                <td>{{ $pagamento->created_at }}</td>
                            </tr>

                            <tr>
                                <th>actualizado aos</th>
                                <td>{{ $pagamento->updated_at }}</td>
                            </tr>

                            <tr>
                                <th>Acção</th>
                                <td>
                                    <a href="#" data-toggle="modal" data-target="#excluirModal" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> </a>
                                </td>
                            </tr>


                        </table>

                    
                    </div>
                </div>

                <div id="tab-2" class="tab-pane">
                    <div class="panel-body">

                        <table class="table table-bordered table-th-200">


                        <thead>
                            <tr>
                                <th>Nº</th>
                                <th>Serviço</th>
                                <th>Preço</th>
                            </tr>
                        </thead>
                        
                        <tbody>

                         @php
                            $i=1
                        @endphp

                            @foreach($pagamento->servicos as $servico)
                            <tr class="gradeX">

                                <td>{{ $i++ }}</td>
                            
                                <td>
                                    {{ $servico->nome  }}
                                </td>
                               

                                <td>
                                <span class="label label-warning">{{ $servico->preco }} kz</span>
                                </td>

                            </tr>
                            @endforeach
                            
                        </tbody>


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
                <small class="font-bold">Ao Excluires este pagamento todos os dados deste pagamento serão excluidos.</small>
            </div>
            <div class="modal-body">

                <div class="row">

                    {!! Form::open(['route'=> ['pagamentos.destroy', $pagamento->id], 'method'=>'DELETE']) !!}
                    <button type="submit" class="col-sm-12 btn btn-primary"> <strong>Sim Tenho</strong></button>
                    {!! Form::close() !!}

                    <button type="button" class="col-sm-12 btn btn-white mg-top-20" data-dismiss="modal"><strong>Cancelar</strong></button>
                    
                </div>

            </div>
           
        </div>
    </div>

</div>

        
@endsection
