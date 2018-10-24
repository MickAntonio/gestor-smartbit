@extends('general.main')

@section('title', 'GEstoque-Adminsitrador')

@section('head')
    {!! Html::style('css/plugins/dataTables/datatables.min.css') !!}
@endsection


@section('page-heading')

<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Produtos</h2>
        <ol class="breadcrumb">
            <li>
                <a href="index-2.html">Admin</a>
            </li>
            <li>
                <a>Produtos</a>
            </li>
            <li class="active">
                <strong>Lista</strong>
            </li>
        </ol>
    </div>
    <div class="col-lg-2">

    </div>
</div>

@endsection


@section('content')

    <div class="row">

        <div class="col-md-12">
            @include('components.messages')
        </div>
        
        <div class="col-lg-12">

            <div class="ibox float-e-margins">
                
                <div class="ibox-title">
                    <h5>Lista de Produtos</h5>
                    <div class="ibox-tools">

                        <a href="" class="btn btn-white btn-sm"><i class="fa fa-refresh"></i> </a>

                        <a href="/produtos/pdf" class="btn btn-info btn-sm a-color-white"><i class="fa fa-file-pdf-o"></i> </a>                                                
                       
                        <a href="/admin/produtos/create" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> </a>
                    </div>
                </div>

                <div class="ibox-content">

                <div class="table-responsive">
                    
                    <table class="table table-striped table-bordered table-hover dataTables-example" >

                        <thead>
                            <tr>
                                <th>Imagem</th>
                                <th>Produto</th>
                                <th>Categoria</th>
                                <th>Sub-Categoria</th>
                                <th>Preço de Compra</th>
                                <th>Fornecedor</th>
                                <th>Estoque/Qtde</th>
                                <th>Acção</th>
                            </tr>
                        </thead>
                        
                        <tbody>
                            @foreach($produtos as $produto)
                            <tr class="gradeX">
                                <td>
                                    <a href="#">
                                        <img alt="image" class="img-square img-td" src="/img/produtos/{{ $produto->imagem }}">
                                    </a>
                                </td>
                                <td>
                                {{ $produto->nome }}
                                </td>
                                <td><span class="label label-success label-strong">{{ $produto->subcategoria->categoria->nome }}</span></td>
                                <td><span>{{ $produto->subcategoria->nome }}</span></td>
                                <td><span class="label label-primary label-strong">{{ $produto->valor_compra + $produto->despesas }}.00 kz</span></td>
                                <td>
                                    {{ $produto->fornecedor->nome }}
                                </td>

                                <td>

                                    @if($produto->variacao=='Sim')
                                       
                                        @foreach($produto->estoques as $estoque)

                                            @if($estoque->estoque_actual <= $estoque->estoque_minimo )
                                            
                                                <span class="label label-danger label-stoque hover" data-toggle="tooltip" data-placement="left" title="Estoque Baixo">
                                                @foreach($estoque->produto_variacoes as $variacao)
                                                    {{ $variacao->atributo->nome }} 
                                                    &nbsp; 
                                                @endforeach
                                                {{ $estoque->estoque_actual }}
                                                </span>
                                                <br>

                                            @else

                                                <span class="label label-info label-stoque hover">
                                                @foreach($estoque->produto_variacoes as $variacao)
                                                    {{ $variacao->atributo->nome }} 
                                                    &nbsp; 
                                                @endforeach
                                                {{ $estoque->estoque_actual }}
                                                </span>
                                                <br>

                                            @endif
                                            
                                        @endforeach
                                    @else
                                        @if($produto->estoque->estoque_actual <= $produto->estoque->estoque_minimo )
                                        <span class="label label-danger hover" data-toggle="tooltip" data-placement="left" title="Estoque Baixo">{{ $produto->estoque->estoque_actual }}</span>
                                        @else
                                        <span class="label label-info hover">{{ $produto->estoque->estoque_actual }}</span>
                                        @endif
                                    @endif
                                
                                </td>

                                <td>
                                    <a href="{{ route('produtos.show', $produto->id) }}" class="btn btn-default btn-sm"><i class="fa fa-eye"></i> </a>
                                </td>
                            </tr>
                            @endforeach
                            
                        </tbody>

                        <tfoot>
                            <tr>
                                <th>Imagem</th>
                                <th>Produto</th>
                                <th>Categoria</th>
                                <th>Sub-Categoria</th>
                                <th>Preço de Compra</th>
                                <th>Fornecedor</th>
                                <th>Estoque/Qtde</th>
                                <th>Acção</th>
                            </tr>
                        </tfoot>

                    </table>

                </div>

                </div>
            </div>

        </div>
        
    </div>

@endsection

@section('scripts')

{!! Html::script('js/plugins/dataTables/datatables.min.js') !!}

<!-- Page-Level Scripts -->
<script>
       
    $(document).ready(function(){
        $('.dataTables-example').DataTable({
            pageLength: 25,
            responsive: true,
            dom: '<"html5buttons"B>lTfgitp',
            buttons: [
                { extend: 'copy'},
                {extend: 'csv'},
                {extend: 'excel', title: 'ExampleFile'},
                {extend: 'pdf', title: 'ExampleFile'},

                {extend: 'print',
                customize: function (win){
                        $(win.document.body).addClass('white-bg');
                        $(win.document.body).css('font-size', '10px');

                        $(win.document.body).find('table')
                                .addClass('compact')
                                .css('font-size', 'inherit');
                }
                }
            ]

        });

    });

</script>

@endsection