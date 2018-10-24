@extends('general.main')

@section('title', 'GEstoque-Adminsitrador')

@section('head')
    {!! Html::style('css/plugins/dataTables/datatables.min.css') !!}
@endsection

@section('page-heading')

<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Sub-Categorias</h2>
        <ol class="breadcrumb">
            <li>
                <a href="index-2.html">Admin</a>
            </li>
            <li>
                <a>Sub-Categorias</a>
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
                    <h5>Lista de Sub-Categorias Cadastrados</h5>
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
                                <th>Categoria</th>
                                <th>Nome</th>
                                <th>Descrição</th>
                                <th>Data de Criação</th>
                                <th>Acção</th>
                            </tr>
                        </thead>

                         @php
                            $i=1
                        @endphp
                        
                        <tbody>
                            @foreach($subCategorias as $categoria)
                            <tr class="gradeX">
                              
                                <td>{{ $i++ }}</td>
                              
                                <td>
                                <span class="label label-info">{{ $categoria->categoria->nome }}</span>
                                </td>

                                <td>
                                <span>{{ $categoria->nome }}
                                </td>

                                <td class="width-400">{{ $categoria->descricao }}</td>

                                <td>
                                {{ $categoria->created_at }}
                                </td>

                                <td>
                                    <a class="btn btn-primary btn-sm show-categoria-modal"   data-id="{{ $categoria->id }}" data-categoria="{{ $categoria->categoria->nome }}" data-nome="{{ $categoria->nome }}" data-descricao="{{ $categoria->descricao }}" data-created="{{ $categoria->created_at }}"  data-updated="{{ $categoria->updated_at }}"><i class="fa fa-eye"></i> </a>
                                    <a class="btn btn-info btn-sm edit-categoria-modal"      data-id="{{ $categoria->id }}" data-categoria="{{ $categoria->categoria->nome }}" data-nome="{{ $categoria->nome }}" data-descricao="{{ $categoria->descricao }}" data-categoria-id="{{ $categoria->categoria->id }}"><i class="fa fa-pencil"></i> </a>
                                    <a class="btn btn-danger btn-sm delete-categoria-modal"  data-id="{{ $categoria->id }}" ><i class="fa fa-trash"></i> </a>
                                </td>

                            </tr>
                            @endforeach
                        </tbody>
                        
                        <tfoot>
                            <tr>
                                <th>Nº</th>
                                <th>Categoria</th>
                                <th>Nome</th>
                                <th>Descrição</th>
                                <th>Data de Criação</th>
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
                    <h4 class="modal-title">Adicionar Sub-Categorias</h4>
                </div>
               
                {!! Form::open(array('route' => 'sub-categoria.store')) !!}   
                
                <div class="modal-body">

                    <div class="row">

                        <div class="col-md-12">
                            @include('components.messages')
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Categoria</label> 
                                <select class="form-control" name="categoria_id">
                                   @foreach($categorias as $categoria)
                                        <option value="{{ $categoria->id }}">{{ $categoria->nome }}</option>
                                   @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Nome da SubCategoria</label> 
                                <input type="text" name="nome" placeholder="" class="form-control">
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Descrição da SubCategoria</label> 
                                <textarea name="descricao" id="" cols="30" rows="3"  class="form-control"></textarea>
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
                    <h4 class="modal-title">Visualizar Sub-Categoria</h4>
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
                                <th>Categoria</th>
                                <td id="show-categoria"></td>
                            </tr>

                            <tr>
                                <th>Sub-Categoria</th>
                                <td id="show-nome"></td>
                            </tr>

                            <tr>
                                <th>Descrição</th>
                                <td id="show-descricao"></td>
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
                    <small class="font-bold">Ao Excluires esta Categoria todos os dados desta Categoria serão excluidos.</small>
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
                    <h4 class="modal-title">Actualizar Sub-Categoria</h4>
                </div>
                
                {!! Form::open(array('method'=>'PUT')) !!}   
                
                <div class="modal-body">

                    <div class="row">

                        <div class="col-md-12">
                            @include('components.messages')
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Categoria</label> 
                                <select class="form-control" name="categoria_id">
                                   @foreach($categorias as $categoria)
                                        <option value="{{ $categoria->id }}">{{ $categoria->nome }}</option>
                                   @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Nome da Sub-Categoria</label> 
                                <input type="text" name="nome" placeholder="" class="form-control">
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Descrição da Sub-Categoria</label> 
                                <textarea name="descricao" id="" cols="30" rows="3"  class="form-control"></textarea>
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

            // mostrar a modal
            $("#visualizarCategoriaModal").modal("show");

            // enserir o dados
            $("#show-id").text($(this).data('id'));
            $("#show-categoria").text($(this).data('categoria'));
            $("#show-nome").text($(this).data('nome'));
            $("#show-descricao").text($(this).data('descricao'));
            $("#show-created").text($(this).data('created'));
            $("#show-updated").text($(this).data('updated'));

        });

        // Edit Categoria Function
        $(document).on('click', '.edit-categoria-modal', function(){

            // mostrar a modal
            $("#editarCategoriaModal").modal("show");

            // seleciona a option cadastrada
            var id = "#editarCategoriaModal option[value="+$(this).data('categoria-id')+"]";
            $(id).attr({ selected:"selected" })
            
            // enserir o dados
            $("#editarCategoriaModal input[name=nome]").val($(this).data('nome'));
            $("#editarCategoriaModal textarea[name=descricao]").val($(this).data('descricao'));

            // adicionar a route para enviar os dados
            var url = "{{ url('admin/sub-categoria') }}/"+$(this).data('id');
            $("#editarCategoriaModal form").attr("action", url);
            
        });

        // Delete Categoria Function
        $(document).on('click', '.delete-categoria-modal', function(){
            
            // mostrar a modal
            $("#excluirCategoriaModal").modal("show");

            // adicionar a route para enviar os dados
            var url = "{{ url('admin/sub-categoria') }}/"+$(this).data('id');
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