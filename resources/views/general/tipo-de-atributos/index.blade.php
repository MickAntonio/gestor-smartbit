@extends('general.main')

@section('title', 'GEstoque-Adminsitrador')

@section('head')
    {!! Html::style('css/plugins/dataTables/datatables.min.css') !!}
@endsection

@section('page-heading')

<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Tipo de Variação dos Produtos</h2>
        <ol class="breadcrumb">
            <li>
                <a href="index-2.html">Admin</a>
            </li>
            <li>
                <a>Tipo de Variação</a>
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
                    <h5>Lista dos Tipos de Variações Cadastrados</h5>
                    <div class="ibox-tools">

                        <a href="" class="btn btn-white btn-sm"><i class="fa fa-refresh"></i> </a>
                       
                        <a href="#" data-toggle="modal" data-target="#adicionarCategoriaModal" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> </a>
                    </div>
                </div>

                <div class="ibox-content">

                <div class="table-responsive">
                    
                    <table class="table table-striped table-bordered table-hover data-table-grid" >

                        <thead>
                            <tr>
                                <th>Nº</th>
                                <th>Nome</th>
                                <th>Data de Criação</th>
                                <th>Ultima Actualização</th>
                                <th>Acção</th>
                            </tr>
                        </thead>

                         @php
                            $i=1
                        @endphp
                        
                        <tbody>
                            @foreach($tipoAtributos as $variacao)
                            <tr class="gradeX">
                              
                                <td>{{ $i++ }}</td>
                              
                                <td>
                                <span class="label label-info">{{ $variacao->nome }}</span>
                                </td>

                                <td>
                                {{ $variacao->created_at }}
                                </td>

                                <td>
                                {{ $variacao->updated_at }}
                                </td>

                                <td>
                                    <a class="btn btn-primary btn-sm show-categoria-modal"   data-id="{{ $variacao->id }}" data-nome="{{ $variacao->nome }}" data-created="{{ $variacao->created_at }}"  data-updated="{{ $variacao->updated_at }}"><i class="fa fa-eye"></i> </a>
                                    <a class="btn btn-info btn-sm edit-categoria-modal"      data-id="{{ $variacao->id }}" data-nome="{{ $variacao->nome }}" ><i class="fa fa-pencil"></i> </a>
                                    <a class="btn btn-danger btn-sm delete-categoria-modal"  data-id="{{ $variacao->id }}" ><i class="fa fa-trash"></i> </a>
                                </td>

                            </tr>
                            @endforeach
                        </tbody>
                        
                        <tfoot>
                            <tr>
                                <th>Nº</th>
                                <th>Nome</th>
                                <th>Data de Criação</th>
                                <th>Ultima Actualização</th>
                                <th>Acção</th>
                            </tr>
                        </tfoot>

                    </table>

                </div>

                </div>
            </div>

        </div>
        
    </div>

    <div class="modal inmodal" id="adicionarCategoriaModal" tabindex="-1" role="dialog" aria-hidden="true">
            
        <div class="modal-dialog">
            <div class="modal-content animated bounceInRight">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title">Adicionar Novo Tipo de Variação</h4>
                </div>
               
                {!! Form::open(array('route' => 'tipo-de-atributo.store')) !!}   
                
                <div class="modal-body">

                    <div class="row">

                        <div class="col-md-12">
                            @include('components.messages')
                        </div>


                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Nome do Tipo de Variação</label> 
                                <input type="text" name="nome" placeholder="" class="form-control">
                            </div>
                        </div>

                    </div>
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-white" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Adicionar</button>
                </div>

                {!! Form::close() !!} 
                
            </div>
        </div>
    
    </div>

    <div class="modal inmodal" id="visualizarCategoriaModal" tabindex="-1" role="dialog" aria-hidden="true">
            
        <div class="modal-dialog">
            <div class="modal-content animated bounceInRight">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title">Visualizar Tipo de Variação</h4>
                </div>
                
                <div class="modal-body">

                    <div class="row">

                        <div class="col-md-12">
                            @include('components.messages')
                        </div>

                        <table class="table table-bordered table-th-200">

                             <tr>
                                <th>Código</th>
                                <td id="show-id"></td>
                            </tr>

                            <tr>
                                <th>Tipo de Variação</th>
                                <td id="show-nome"></td>
                            </tr>

                            <tr>
                                <th>Criado Aos</th>
                                <td id="show-created"></td>
                            </tr>

                            <tr>
                                <th>Ultima Actualização Aos</th>
                                <td id="show-updated"></td>
                            </tr>
                            
                        </table>


                    </div>
                    
                </div>

            </div>
        </div>
    
    </div>

    <div class="modal inmodal" id="excluirCategoriaModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content animated bounceInRight">

            
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title">Tens Certeza Que Pretendes Excluir</h4>
                    <small class="font-bold">Ao Excluires este Tipo de Variação todos os dados deste Tipo de Variação serão excluidos.</small>
                </div>
                <div class="modal-body">

                    <div class="row">

                        {!! Form::open(['method'=>'DELETE']) !!}
                        <button type="submit" class="col-sm-12 btn btn-primary"> <strong>Sim Tenho</strong></button>
                        {!! Form::close() !!}

                        <button type="button" class="col-sm-12 btn btn-white mg-top-20" data-dismiss="modal"><strong>Cancelar</strong></button>
                        
                    </div>

                </div>
            
            </div>
        </div>

    </div>

    <div class="modal inmodal" id="editarCategoriaModal" tabindex="-1" role="dialog" aria-hidden="true">
            
        <div class="modal-dialog">
            <div class="modal-content animated bounceInRight">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title">Actualizar Tipo de Variação</h4>
                </div>
                
                {!! Form::open(array('method'=>'PUT')) !!}   
                
                <div class="modal-body">

                    <div class="row">

                        <div class="col-md-12">
                            @include('components.messages')
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Nome do Tipo de Variação</label> 
                                <input type="text" name="nome" placeholder="" class="form-control">
                            </div>
                        </div>

                    </div>
                    
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-white" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Actualizar</button>
                </div>

                {!! Form::close() !!} 
                
            </div>
        </div>
    
    </div>

@endsection

@section('scripts')

    {!! Html::script('js/plugins/dataTables/datatables.min.js') !!}

    <!-- Page-Level Scripts -->
    <script>

        // Show Categoria Function
        $(document).on('click', '.show-categoria-modal', function(){

            $("#visualizarCategoriaModal").modal("show");

            $("#show-id").text($(this).data('id'));
            $("#show-nome").text($(this).data('nome'));
            $("#show-created").text($(this).data('created'));
            $("#show-updated").text($(this).data('updated'));

        });

        // Edit Categoria Function
        $(document).on('click', '.edit-categoria-modal', function(){

            $("#editarCategoriaModal").modal("show");

            $("#editarCategoriaModal input[name=nome]").val($(this).data('nome'));

            var url = "{{ url('admin/tipo-de-atributo') }}/"+$(this).data('id');

            $("#editarCategoriaModal form").attr("action", url);
            
        });

        // Edit Categoria Function
        $(document).on('click', '.delete-categoria-modal', function(){

            $("#excluirCategoriaModal").modal("show");


            var url = "{{ url('admin/tipo-de-atributo') }}/"+$(this).data('id');

            $("#excluirCategoriaModal form").attr("action", url);

        });

        // Data table
        $(document).ready(function(){
            
            $('.data-table-grid').DataTable({
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