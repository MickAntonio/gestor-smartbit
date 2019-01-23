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
                        <h5>Saidas Pagamentos</h5>
                        <div class="ibox-tools">                        

                            <a href="" class="btn btn-white btn-sm"><i class="fa fa-refresh"></i> </a>

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
                                    <th>Valor Pago</th>
                                    <th>Descrição</th>
                                    <th>Data</th>
                                    <th>Acção</th>
                                </tr>
                                </thead>
                                <tbody>
                              
                                @php
                                    $i=1
                                @endphp                              
                                @foreach($saidas as $saida)

                                @if($saida->pagamentoPreco->tipoPagamento->tipo=="Saida")
                                <tr>
                                
                                    <td>{{ $i++ }}</td>
                                    <td>{{ $saida->pagamentoPreco->tipoPagamento->nome }}</td>
                                    <td>{{ $saida->valor_pago }}</td>
                                    <td>{{ $saida->descricao }}</td>
                                    <td>{{ $saida->created_at }}</td>
                                   
                                    <td>
                                        <a class="btn btn-primary btn-sm show-modal" data-id="{{ $saida->id }}" data-tipo="{{  $saida->pagamentoPreco->tipoPagamento->nome }}" data-preco="{{  $saida->pagamentoPreco->preco->preco }}" data-pago="{{  $saida->valor_pago }}" data-descricao="{{ $saida->descricao }}"  data-forma="{{ $saida->forma }}" data-updated="{{ $saida->updated_at }}" data-created="{{ $saida->created_at }}" ><i class="fa fa-eye"></i> </a>
                                        <a class="btn btn-info btn-sm edit-modal"    data-id="{{ $saida->id }}" data-tipo="{{  $saida->pagamentoPreco->tipoPagamento->id }}" data-preco="{{  $saida->pagamentoPreco->preco->preco }}" data-pago="{{  $saida->valor_pago }}" data-descricao="{{ $saida->descricao }}"  data-forma="{{ $saida->forma }}" data-updated="{{ $saida->updated_at }}" data-created="{{ $saida->created_at }}" ><i class="fa fa-pencil"></i> </a>
                                        <a class="btn btn-danger btn-sm delete-modal"  data-id="{{ $saida->id }}"><i class="fa fa-trash"></i> </a>
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

                    <h4 class="modal-title">Adicionar Saida</h4>
                </div>
                
                {!! Form::open(array('route' => 'saidas-pagamentos.store')) !!}   
                
                <div class="modal-body">

                    <div class="row">

                         <div class="col-md-12">
                            <div class="form-group">
                                <label>Tipo de Saida</label> 
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
                    <h4 class="modal-title">Visualizar Saida</h4>
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
                                <label>Tipo de Saida</label> 
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

        var url = "{{ url('secretaria/saidas-pagamentos') }}/"+$(this).data('id');

        $("#EditarModal form").attr("action", url);
        
    });

    // Edit Categoria Function
    $(document).on('click', '.delete-modal', function(){

        $("#ExcluirModal").modal("show");

        var url = "{{ url('secretaria/saidas-pagamentos') }}/"+$(this).data('id');

        $("#ExcluirModal form").attr("action", url);

    });
    
    </script>

    <script>
        $(document).ready(function() {


            var d1 = [[1262304000000, 6], [1264982400000, 3057], [1267401600000, 20434], [1270080000000, 31982], [1272672000000, 26602], [1275350400000, 27826], [1277942400000, 24302], [1280620800000, 24237], [1283299200000, 21004], [1285891200000, 12144], [1288569600000, 10577], [1291161600000, 10295]];
            var d2 = [[1262304000000, 5], [1264982400000, 200], [1267401600000, 1605], [1270080000000, 6129], [1272672000000, 11643], [1275350400000, 19055], [1277942400000, 30062], [1280620800000, 39197], [1283299200000, 37000], [1285891200000, 27000], [1288569600000, 21000], [1291161600000, 17000]];

            var data1 = [
                { label: "Data 1", data: d1, color: '#17a084'},
                { label: "Data 2", data: d2, color: '#127e68' }
            ];
            $.plot($("#flot-chart1"), data1, {
                xaxis: {
                    tickDecimals: 0
                },
                series: {
                    lines: {
                        show: true,
                        fill: true,
                        fillColor: {
                            colors: [{
                                opacity: 1
                            }, {
                                opacity: 1
                            }]
                        },
                    },
                    points: {
                        width: 0.1,
                        show: false
                    },
                },
                grid: {
                    show: false,
                    borderWidth: 0
                },
                legend: {
                    show: false,
                }
            });

            var lineData = {
                labels: ["January", "February", "March", "April", "May", "June", "July"],
                datasets: [
                    {
                        label: "Example dataset",
                        backgroundColor: "rgba(26,179,148,0.5)",
                        borderColor: "rgba(26,179,148,0.7)",
                        pointBackgroundColor: "rgba(26,179,148,1)",
                        pointBorderColor: "#fff",
                        data: [48, 48, 60, 39, 56, 37, 30]
                    },
                    {
                        label: "Example dataset",
                        backgroundColor: "rgba(220,220,220,0.5)",
                        borderColor: "rgba(220,220,220,1)",
                        pointBackgroundColor: "rgba(220,220,220,1)",
                        pointBorderColor: "#fff",
                        data: [65, 59, 40, 51, 36, 25, 40]
                    }
                ]
            };

            var lineOptions = {
                responsive: true
            };


            var ctx = document.getElementById("lineChart").getContext("2d");
            new Chart(ctx, {type: 'line', data: lineData, options:lineOptions});

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
                    {extend: 'excel', title: 'ExampleFile'}
                   

                    
                ]

            });

        });
    </script>


@endsection