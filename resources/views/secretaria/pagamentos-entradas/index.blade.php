@extends('secretaria.main')

@section('title', 'GE-Smartbit')

@section('head')
    
    {!! Html::style('css/plugins/dataTables/datatables.min.css') !!}
 

@endsection

@section('content')


    <div class="container">

        @include('components.messages')

        <div class="row">
            <div class="col-md-8">
                
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Entradas Pagamentos</h5>
                        <div class="ibox-tools">                        

                            <a href="" class="btn btn-white btn-sm"><i class="fa fa-refresh"></i> </a>

                            <a href="#" data-toggle="modal" data-target="#relatorioModal" class="btn btn-info btn-sm a-color-white"><i class="fa fa-file-pdf-o"></i> </a>

                            <a href="#" data-toggle="modal" data-target="#adicionarModal" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> </a>
                      
                        </div>

                    </div>
                    <div class="ibox-content">
                       
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover data-table-grid">
                                <thead>
                                <tr>

                                    <th>#</th>
                                    <th>Tipo </th>
                                    <th>Valor Recebido</th>
                                    <th>Descrição</th>
                                    <th>Data</th>
                                    <th>Acção</th>
                                </tr>
                                </thead>
                                <tbody>
                              
                                @php
                                    $i=1
                                @endphp                              
                                @foreach($entradas as $entrada)

                                @if($entrada->pagamentoPreco->tipoPagamento->tipo=="Entrada" && $entrada->pagamentoPreco->tipoPagamento->proveniencia=="Outro" )
                                <tr>
                                
                                    <td>{{ $i++ }}</td>
                                    <td>{{ $entrada->pagamentoPreco->tipoPagamento->nome }}</td>
                                    <td>{{ $entrada->valor_pago }}</td>
                                    <td>{{ $entrada->descricao }}</td>
                                    <td>{{ $entrada->created_at }}</td>
                                   
                                    <td>
                                        <a class="btn btn-primary btn-sm show-modal" data-id="{{ $entrada->id }}" data-tipo="{{  $entrada->pagamentoPreco->tipoPagamento->nome }}" data-preco="{{  $entrada->pagamentoPreco->preco->preco }}" data-pago="{{  $entrada->valor_pago }}" data-descricao="{{ $entrada->descricao }}"  data-forma="{{ $entrada->forma }}" data-updated="{{ $entrada->updated_at }}" data-created="{{ $entrada->created_at }}" ><i class="fa fa-eye"></i> </a>
                                        <a class="btn btn-info btn-sm edit-modal"    data-id="{{ $entrada->id }}" data-tipo="{{  $entrada->pagamentoPreco->tipoPagamento->id }}" data-preco="{{  $entrada->pagamentoPreco->preco->preco }}" data-pago="{{  $entrada->valor_pago }}" data-descricao="{{ $entrada->descricao }}"  data-forma="{{ $entrada->forma }}" data-updated="{{ $entrada->updated_at }}" data-created="{{ $entrada->created_at }}" ><i class="fa fa-pencil"></i> </a>
                                        <a class="btn btn-danger btn-sm delete-modal"  data-id="{{ $entrada->id }}"><i class="fa fa-trash"></i> </a>
                                    </td>

                                </tr>
                                @endif
                                
                                @endforeach

                                
                             
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>

            </div>

            @include('components.usuario')

        </div>
           
         
    </div>


    <div class="modal inmodal" id="adicionarModal" tabindex="-1" role="dialog" aria-hidden="true">
            
        <div class="modal-dialog">
            <div class="modal-content animated bounceInRight">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <i class="fa fa-laptop modal-icon"></i>

                    <h4 class="modal-title">Adicionar Entradas</h4>
                </div>
                
                {!! Form::open(array('route' => 'entradas-pagamentos.store')) !!}   
                
                <div class="modal-body">

                    <div class="row">

                         <div class="col-md-12">
                            <div class="form-group">
                                <label>Tipo de Entrada</label> 
                                <select class="form-control"  tabindex="2" name="tipo_pagamento_id">
                                    @foreach($tipoPagamentos as $tipoPagamento)                                
                                    <option value="{{ $tipoPagamento->id }}">{{ $tipoPagamento->nome }}</option>
                                    @endforeach
                                </select>
                            </div>                            
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Pago</label> 
                                <input type="number" name="valor_pago" placeholder="" class="form-control">                                
                            </div>                            
                        </div>

                           <div class="col-md-6">
                            <div class="form-group">
                                <label>Forma de Pagamento</label> 
                                <select class="form-control"  tabindex="2" name="forma">
                                    <option value="Banco">Banco</option>
                                    <option value="TPA">TPA</option>
                                    <option value="Dinheiro">Dinheiro</option>
                                </select>
                            </div>                            
                        </div>


                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Descrição</label> 
                                <textarea class="form-control" name="descricao" id="" cols="30" rows="4"></textarea>
                            </div>                            
                        </div>

                    </div>

                    <input type="hidden" name="user_id" value="{{ Auth::id() }}" placeholder="" class="form-control">                                
                    
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-white" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Adicionar</button>
                </div>

                {!! Form::close() !!} 
                
            </div>
        </div>
    
    </div>

    <div class="modal inmodal" id="visualizarModal" tabindex="-1" role="dialog" aria-hidden="true">
            
        <div class="modal-dialog">
            <div class="modal-content animated bounceInRight">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title">Visualizar Entrada</h4>
                </div>
                
                <div class="modal-body">

                    <div class="row">
     
                        <table class="table table-bordered table-th-200 bg-w">

                            <tr>
                                <th>Código</th>
                                <td id="show-id"></td>
                            </tr>

                            <tr>
                                <th>Tipo</th>
                                <td id="show-tipo"></td>
                            </tr>

                            <tr>
                                <th>Valor Pago</th>
                                <td id="show-pago"></td>
                            </tr>

                              <tr>
                                <th>Preço</th>
                                <td id="show-preco"></td>
                            </tr>

                            <tr>
                                <th>Forma de Pagamento</th>
                                <td id="show-forma"></td>
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

    <div class="modal inmodal" id="EditarModal" tabindex="-1" role="dialog" aria-hidden="true">
            
        <div class="modal-dialog">
            <div class="modal-content animated bounceInRight">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <i class="fa fa-laptop modal-icon"></i>

                    <h4 class="modal-title">Editar Tipo de Pagamento</h4>
                </div>
                
                {!! Form::open(array('method'=>'PUT')) !!}   

                <div class="modal-body">

                    <div class="row">

                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Tipo de Entrada</label> 
                                <select class="form-control"  tabindex="2" name="tipo_pagamento_id">
                                    @foreach($tipoPagamentos as $tipoPagamento)                                
                                    <option value="{{ $tipoPagamento->id }}">{{ $tipoPagamento->nome }}</option>
                                    @endforeach
                                </select>
                            </div>                            
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Pago</label> 
                                <input type="number" name="valor_pago" placeholder="" class="form-control">                                
                            </div>                            
                        </div>

                           <div class="col-md-6">
                            <div class="form-group">
                                <label>Forma de Pagamento</label> 
                                <select class="form-control"  tabindex="2" name="forma">
                                    <option value="Banco">Banco</option>
                                    <option value="TPA">TPA</option>
                                    <option value="Dinheiro">Dinheiro</option>
                                </select>
                            </div>                            
                        </div>


                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Descrição</label> 
                                <textarea class="form-control" name="descricao" id="" cols="30" rows="4"></textarea>
                            </div>                            
                        </div>

                        <input type="hidden" name="user_id" value="1" placeholder="" class="form-control">                                                        

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

    <div class="modal inmodal" id="ExcluirModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content animated bounceInRight">

            
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title">Tens Certeza Que Pretendes Excluir</h4>
                    <small class="font-bold">Ao Excluires este Serviço todos os dados deste Serviço serão excluidos.</small>
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

    <!--Relatorio modal-->

     <div class="modal inmodal" id="relatorioModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content animated bounceInRight">
        {!! Form::open(array('route' => 'outras.entradas.pdf')) !!}   
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

    <!-- Flot -->
    {!! Html::script('js/plugins/flot/jquery.flot.js') !!}
    {!! Html::script('js/plugins/flot/jquery.flot.tooltip.min.js') !!}   
    {!! Html::script('js/plugins/flot/jquery.flot.resize.js') !!}   

    <!-- ChartJS-->
    {!! Html::script('js/plugins/chartJs/Chart.min.js') !!}   
        
    <!-- Peity -->
    {!! Html::script('js/plugins/peity/jquery.peity.min.js') !!}   
        
    <!-- Peity demo -->
    {!! Html::script('js/demo/peity-demo.js') !!} 

    {!! Html::script('js/plugins/dataTables/datatables.min.js') !!}
 

    <script>

        // Show Categoria Function
        $(document).on('click', '.show-modal', function(){

            $("#visualizarModal").modal("show");

            $("#show-id").text($(this).data('id'));
            $("#show-tipo").text($(this).data('tipo'));
            $("#show-pago").text($(this).data('pago'));
            $("#show-forma").text($(this).data('forma'));
            $("#show-preco").text($(this).data('preco'));
            $("#show-descricao").text($(this).data('descricao'));        
            $("#show-created").text($(this).data('created'));
            $("#show-updated").text($(this).data('updated'));

        });

        // Edit Categoria Function
        $(document).on('click', '.edit-modal', function(){

            $("#EditarModal").modal("show");

            $("#EditarModal input[name=valor_pago]").val($(this).data('pago'));
            $("#EditarModal textarea[name=descricao]").text($(this).data('descricao'));

            // seleciona a option tipo
            var idTipoRemove = "#EditarModal select[name=tipo_pagamento_id] option";
            $(idTipoRemove).removeAttr("selected");
            
            var idTipo = "#EditarModal select[name=tipo_pagamento_id] option[value="+$(this).data('tipo')+"]";
            $(idTipo).attr({ selected:"selected" })

            // seleciona a option forma
            var idFormaRemove = "#EditarModal select[name=forma] option";
            $(idFormaRemove).removeAttr("selected");
            
            var idForma = "#EditarModal select[name=forma] option[value="+$(this).data('forma')+"]";
            $(idForma).attr({ selected:"selected" })

            var url = "{{ url('secretaria/entradas-pagamentos') }}/"+$(this).data('id');

            $("#EditarModal form").attr("action", url);
            
        });

        // Edit Categoria Function
        $(document).on('click', '.delete-modal', function(){

            $("#ExcluirModal").modal("show");

            var url = "{{ url('secretaria/entradas-pagamentos') }}/"+$(this).data('id');

            $("#ExcluirModal form").attr("action", url);

        });
    
    </script>

    <script>

        // Data table
        $(document).ready(function(){
            
            $('.data-table-grid').DataTable({
                pageLength: 25,
                responsive: true,
                dom: '<"html5buttons"B>lTfgitp',
                buttons: [
                    { extend: 'copy'},
                    {extend: 'csv'},
                    {extend: 'excel', title: 'ExampleFile'}
                   

                    
                ]

            });

        });

        

    </script>


@endsection