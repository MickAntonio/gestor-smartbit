@extends('general.main')

@section('title', 'GEstoque-Adminsitrador')

@section('head')
    {!! Html::style('css/plugins/dataTables/datatables.min.css') !!}
    {!! Html::style('css/plugins/chosen/bootstrap-chosen.css') !!}
    {!! Html::style('css/plugins/datapicker/datepicker3.css') !!}   
    {!! Html::style('css/plugins/clockpicker/clockpicker.css') !!}   

    
@endsection

@section('page-heading')

<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Marcações de Clientes</h2>
        <ol class="breadcrumb">
            <li>
                <a href="index-2.html">Admin</a>
            </li>
            <li>
                <a>Marcações</a>
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
                    <h5>Lista de Marcações</h5>
                    <div class="ibox-tools">

                       
                        <a href="" class="btn btn-white btn-sm"><i class="fa fa-refresh"></i> </a>

                        <a href="#" data-toggle="modal" data-target="#relatorioModal" class="btn btn-info btn-sm a-color-white"><i class="fa fa-file-pdf-o"></i> </a>
                       
                        <a href="#" data-toggle="modal" data-target="#adicionarCategoriaModal" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> </a>
                    </div>
                </div>

                <div class="ibox-content">

                <div class="table-responsive">
                    
                    <table class="table table-striped table-bordered table-hover data-table-grid" >

                        <thead>
                            <tr>
                                <th>Nº</th>
                                <th>Cliente</th>
                                <th>Descrição</th>
                                <th>Data de Marcada</th>
                                <th>Estado</th>
                                <th>Acção</th>
                            </tr>
                        </thead>

                         @php
                            $i=1
                        @endphp
                        
                        <tbody>
                            @foreach($marcacoes as $marcacao)
                            <tr class="gradeX">
                              
                                <td>{{ $i++ }}</td>
                              
                                <td>
                                {{ $marcacao->cliente->nome }}
                                </td>

                                <td>
                                {{ $marcacao->descricao }}
                                </td>

                                <td>
                                <span class="label label-info">{{ $marcacao->dia }} {{ $marcacao->hora }}</span>
                                </td>

                                <td>
                                <span class="label label-success">{{ $marcacao->estado }}</span>
                                </td>

                                <td>
                                    <a class="btn btn-primary btn-sm show-categoria-modal"   data-id="{{ $marcacao->id }}" data-cliente="{{ $marcacao->cliente->nome }}" data-marcacao="{{ $marcacao->dia }} {{ $marcacao->hora }}" data-estado="{{ $marcacao->estado }}" data-descricao="{{ $marcacao->descricao }}" data-created="{{ $marcacao->created_at }}"  data-updated="{{ $marcacao->updated_at }}"><i class="fa fa-eye"></i> </a>
                                    <a class="btn btn-info btn-sm edit-categoria-modal"      data-id="{{ $marcacao->id }}" data-cliente="{{ $marcacao->cliente->nome }}" data-clienteid="{{ $marcacao->cliente->id }}" data-dia="{{ $marcacao->dia }}" data-hora="{{ $marcacao->hora }}" data-estado="{{ $marcacao->estado }}" data-descricao="{{ $marcacao->descricao }}"><i class="fa fa-pencil"></i> </a>
                                    <a class="btn btn-danger btn-sm delete-categoria-modal"  data-id="{{ $marcacao->id }}" ><i class="fa fa-trash"></i> </a>
                                </td>

                            </tr>
                            @endforeach
                        </tbody>
                        
                        <tfoot>
                            <tr>
                                <th>Nº</th>
                                <th>Cliente</th>
                                <th>Descrição</th>
                                <th>Data de Marcada</th>
                                <th>Estado</th>
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
                    <h4 class="modal-title">Adicionar Marcação</h4>
                </div>
               
                {!! Form::open(array('route' => 'marcacoes.store')) !!}   
                
                <div class="modal-body">

                    <div class="row">

                        <div class="col-md-12">
                            @include('components.messages')
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Cliente</label> 
                                <select class="chosen-select form-control"  tabindex="2" name="cliente_id">
                                   @foreach($clientes as $cliente)
                                        <option value="{{ $cliente->id }}">{{ $cliente->nome }}</option>
                                   @endforeach
                                </select>
                            </div>
                        </div>

                        <input type="hidden" class="form-control" name="estado" value="Espera" >

                        <div class="col-md-6">
                        

                            <div class="form-group" id="data_1">
                                <label class="font-normal">Dia</label>
                                <div class="input-group date">
                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" class="form-control" name="dia" value="{{ date('d/m/Y') }}">
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">

                        <div class="form-group" id="data_1">
                            <label class="font-normal">Hora</label>
                            <div class="input-group clockpicker" data-autoclose="true">
                                <input type="text" class="form-control" name="hora" value="09:30" >
                                <span class="input-group-addon">
                                    <span class="fa fa-clock-o"></span>
                                </span>
                            </div>
                        </div>

                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Descrição</label> 
                                <textarea name="descricao" id="" cols="30" rows="2" class="form-control"></textarea>
                            </div>
                        </div>

                        

                    </div>
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-white" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Marcar</button>
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
                    <h4 class="modal-title">Visualizar Variação de Produto</h4>
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
                                <th>Cliente</th>
                                <td id="show-cliente"></td>
                            </tr>

                            <tr>
                                <th>Descrição</th>
                                <td id="show-descricao"></td>
                            </tr>

                            <tr>
                                <th>Data de Marcada</th>
                                <td id="show-marcada"></td>
                            </tr>

                            <tr>
                                <th>Estado</th>
                                <td id="show-estado"></td>
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
                    <small class="font-bold">Ao Excluires esta Marcação todos os dados desta Marcação serão excluidos.</small>
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
                    <h4 class="modal-title">Actualizar Marcação</h4>
                </div>
                
                {!! Form::open(array('method'=>'PUT')) !!}   
                
                <div class="modal-body">

                    <div class="row">

                        <div class="col-md-12">
                            @include('components.messages')
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Cliente</label> 
                                <select class="chosen-selec form-control" id="editarModalCliente" tabindex="2" name="cliente_id">
                                   @foreach($clientes as $cliente)
                                        <option value="{{ $cliente->id }}">{{ $cliente->nome }}</option>
                                   @endforeach
                                </select>
                            </div>
                        </div>

                        <input type="hidden" class="form-control" name="estado" value="Espera" >

                        <div class="col-md-6">
                        

                            <div class="form-group" id="data_1">
                                <label class="font-normal">Dia</label>
                                <div class="input-group date">
                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" class="form-control" name="dia" value="">
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">

                        <div class="form-group" id="data_1">
                            <label class="font-normal">Hora</label>
                            <div class="input-group clockpicker" data-autoclose="true">
                                <input type="text" class="form-control" name="hora" value="" >
                                <span class="input-group-addon">
                                    <span class="fa fa-clock-o"></span>
                                </span>
                            </div>
                        </div>

                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Descrição</label> 
                                <textarea name="descricao" id="" cols="30" rows="2" class="form-control"></textarea>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Estado</label> 
                                <select class="chosen-selec form-control" id="editarModalEstado" tabindex="2" name="estado">
                                   <option value="Espera">Espera</option>
                                   <option value="Compareceu">Compareceu</option>
                                   <option value="Nao Compareceu">Nao Compareceu</option>
                                   <option value="Cancelado">Cancelado</option>
                                </select>
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


    <!--Relatorio modal-->

     <div class="modal inmodal" id="relatorioModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content animated bounceInRight">
        {!! Form::open(array('route' => 'marcacoes.pdf')) !!}   
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <i class="fa fa-laptop modal-icon"></i>
                    <h4 class="modal-title">Gerar Relatório</h4>
                    <small class="font-bold">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</small>
                </div>
                <div class="modal-body">
            
                    <div class="form-group" id="data_5">
                        <div class="input-daterange input-group" id="datepicker">
                            <input type="text" class="form-control" name="start" value="2018-02-22"/>
                            <span class="input-group-addon">à</span>
                            <input type="text" class="form-control" name="end" value="2018-02-22" />
                        </div>
                    </div>
               
               
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-white" data-dismiss="modal">Sair</button>
                    <button type="submit" class="btn btn-primary">Visualizar</button>
                </div>
        {!! Form::close() !!} 
            </div>
        </div>
    </div>

@endsection

@section('scripts')



    {!! Html::script('js/plugins/dataTables/datatables.min.js') !!}
    {!! Html::script('js/plugins/clockpicker/clockpicker.js') !!}   

    <!-- Page-Level Scripts -->
    <script>

  //  $('.clockpicker').clockpicker();
    

        // Show Categoria Function
        $(document).on('click', '.show-categoria-modal', function(){

            // mostrar a modal
            $("#visualizarCategoriaModal").modal("show");

            // enserir o dados
            $("#show-id").text($(this).data('id'));
            $("#show-cliente").text($(this).data('cliente'));
            $("#show-estado").text($(this).data('estado'));
            $("#show-descricao").text($(this).data('descricao'));
            $("#show-marcada").text($(this).data('marcada'));
            $("#show-created").text($(this).data('created'));
            $("#show-updated").text($(this).data('updated'));

        });

        // Edit Categoria Function
        $(document).on('click', '.edit-categoria-modal', function(){

            // mostrar a modal
            $("#editarCategoriaModal").modal("show");

            // seleciona a option cadastrada
            var id = "#editarModalCliente option[value="+$(this).data('clienteid')+"]";
            $(id).attr({ selected:"selected" })

            // seleciona a option cadastrada
            var id = "#editarModalEstado option[value="+$(this).data('estado')+"]";
            $(id).attr({ selected:"selected" })
            
            // enserir o dados
            $("#editarCategoriaModal input[name=dia]").val($(this).data('dia'));
            $("#editarCategoriaModal textarea[name=descricao]").text($(this).data('descricao'));
            $("#editarCategoriaModal input[name=hora]").val($(this).data('hora'));

            // adicionar a route para enviar os dados
            var url = "{{ url('admin/marcacoes') }}/"+$(this).data('id');
            $("#editarCategoriaModal form").attr("action", url);
            
        });

        // Delete Categoria Function
        $(document).on('click', '.delete-categoria-modal', function(){
            
            // mostrar a modal
            $("#excluirCategoriaModal").modal("show");

            // adicionar a route para enviar os dados
            var url = "{{ url('admin/marcacoes') }}/"+$(this).data('id');
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

{!! Html::script('js/plugins/chosen/chosen.jquery.js') !!}   
{!! Html::script('js/plugins/datapicker/bootstrap-datepicker.js') !!}   


<script>
    $(document).ready(function(){
        $('.chosen-select').chosen({width: "100%"});
    });

     $('#data_1 .input-group.date').datepicker({
                todayBtn: "linked",
                keyboardNavigation: false,
                forceParse: false,
                calendarWeeks: true,
                autoclose: true
            });

         $('#data_5 .input-daterange').datepicker({
                keyboardNavigation: false,
                forceParse: false,
                autoclose: true,
                format: "yyyy-mm-dd"
            });


</script>



@endsection