@extends('secretaria.main')

@section('title', 'GE-Smartbit')

@section('head')
    
    {!! Html::style('css/plugins/dataTables/datatables.min.css') !!}
    {!! Html::style('css/plugins/chosen/bootstrap-chosen.css') !!}

@endsection

@section('content')

    <div class="container">

        @include('components.messages')
    
        <div class="row">
        
            <div class="col-md-12">
                
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Lista de Alunos</h5>
                        <div class="ibox-tools">                        

                            <a href="" class="btn btn-white btn-sm"><i class="fa fa-refresh"></i> </a>

                            <a href="/servicos/pdf" class="btn btn-primary btn-sm a-color-white"><i class="fa fa-file-pdf-o"></i> </a>                        
                      
                        </div>

                    </div>
                    <div class="ibox-content">
                       
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover data-table-grid">
                                <thead>
                                <tr>

                                    <th>#</th>
                                    <th>Nome </th>
                                    <th>Sexo </th>
                                    <th>Curso</th>
                                    <th>Classe</th>
                                    <th>Turma</th>
                                    <th>Periódo</th>
                                    <th>Acção</th>
                                </tr>
                                </thead>
                                <tbody>
                              
                                @php
                                    $i=1
                                @endphp                              
                                @foreach($matriculas as $matricula)

                                <tr>
                                
                                    <td>{{ $i++ }}</td>
                                    <td>{{ $matricula->aluno->candidato->nome }}</td>
                                    <td>{{ $matricula->aluno->candidato->sexo }}</td>
                                    <td>{{ $matricula->turma->curso->nome }}</td>                                                                        
                                    <td>{{ $matricula->turma->classe->nome }}</td>
                                    <td>{{ $matricula->turma->nome }}</td>
                                    <td>{{ $matricula->turma->periodo }}</td>
                                   
                                    <td>
                                        <a href="/secretaria/alunos-propinas-pagamentos/{{ $matricula->id }}" class="btn btn-primary btn-sm show-modal"><i class="fa fa-user-circle"></i> </a>
                                        <a class="btn btn-info btn-sm pagar-modal"    data-id="{{ $matricula->id }}" data-nome="{{ $matricula->aluno->candidato->nome }}" data-curso="{{ $matricula->turma->curso->id }}" data-classe="{{ $matricula->turma->classe->id }}" data-saldo="{{ $matricula->aluno->saldo->valor??'' }}"><i class="fa fa-money"></i> </a>
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


    <div class="modal inmodal" id="adicionarModal" tabindex="-1" role="dialog" aria-hidden="true">
            
        <div class="modal-dialog">
            <div class="modal-content animated bounceInRight">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>

                </div>
                
                {!! Form::open(array('route' => 'alunos-propinas-pagamentos.store')) !!}   
                
                <div class="modal-body">

                    <div class="row">

                        <div class="col-md-5">
                            <div class="form-group">
                                <label>Aluno</label> 
                                <input type="text" name="nome" placeholder="" disabled class="form-control">                                
                            </div>                            
                        </div>

                        <div class="col-md-4">

                       <!--     <div class="form-group">
                                <label>Saldo</label> 
                                <input type="text" name="saldo_show" value="0.00" placeholder="" disabled class="form-control">                                
                            </div> 
                        -->

                            <div class="form-group" id="data_1">
                                <label>Data do Pagamento</label>
                                <div class="input-group date">
                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" class="form-control" name="created_at" value="{{ date('Y-m-d') }}">
                                </div>
                            </div>                           
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Forma Pagam.</label> 
                                 <select class="form-control"  tabindex="2" name="forma">
                                    <option value="Banco">Banco</option>
                                    <option value="TPA">TPA</option>
                                    <option value="Dinheiro">Dinheiro</option>
                                </select>
                            </div>                            
                        </div>

                        <div class="col-md-12">   
                        
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                    <tr>
                                        <th>Mês</th>
                                        <th>Multa</th>
                                        <th>Subtotal</th>
                                        <th></th>
                                    </tr>
                                    </thead>
                                    <tbody id="tbody-pagamento">
                                
                                    <tr id="tr-pagamento-main">
                                        <td>

                                            <select class="form-control width-180 mes" id="ad" tabindex="2" name="mes[]">
                                                <option value="0">Selecione o Mês</option>
                                                @foreach($meses as $mes)                                
                                                <option value="{{ $mes->id }}">{{ $mes->mes }}</option>
                                                @endforeach
                                            </select>
                                        
                                        </td>
                                        <td>
                                            <input type="number" name="multa[]" placeholder="" value="00.00" class="form-control width-120 multas">
                                        </td>
                                        <td>
                                            <input type="text" name="sub" placeholder="" value="00.00 kz" class="form-control width-120 subs">
                                        </td>
                                        <td>
                                            <a class="btn btn-primary btn-sm btn-adicionar-mes"  ><i class="fa fa-plus"></i> </a>
                                        </td>
                                    </tr>
                                   
                                    </tbody>
                                </table>
                                
                            </div>

                        </div>

                        <div class="col-md-12">   
                        
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                    <tr>
                                        <th>Total dos Meses</th>
                                        <th>Total das Multas</th>
                                        <th>Total a Pagar</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                
                                    <tr>
                                        <td>

                                            <input type="text" name="total_meses" placeholder="" value="00.00" class="form-control width-180">                                    
                                        
                                        </td>
                                        <td>
                                            <input type="text" name="total_multas" placeholder="" value="00.00" class="form-control">
                                        </td>
                                        <td>
                                            <input type="text" name="total_a_pagar" placeholder="" value="00.00" class="form-control">
                                        </td>
                                    
                                    </tr>

                                    <input type="hidden" name="total" placeholder="" class="form-control">                                
      
                                    </tbody>
                                </table>
                                
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
                                <label>Descrição</label> 
                                <textarea class="form-control" name="descricao" id="" cols="30" rows="1"></textarea>
                            </div>                            
                        </div>

                        <input type="hidden" name="user_id" value="{{ Auth::id() }}" placeholder="" class="form-control">                                
                        <input type="hidden" name="matricula_id" value="1" placeholder="" class="form-control">                                
                        <input type="hidden" name="preco_propina" class="form-control">                                
                        <input type="hidden" name="preco_propina_id" class="form-control">                                
                        <input type="hidden" name="saldo"  class="form-control">                                
                        

                    </div>
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-white" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Efectuar Pagamento</button>
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
                    <h4 class="modal-title">Visualizar Preço</h4>
                </div>
                
                <div class="modal-body">

                    <div class="row">

                        <div class="col-md-12">
                            @include('components.messages')
                        </div>
     
                        <table class="table table-bordered table-th-200 bg-w">

                            <tr>
                                <th>Código</th>
                                <td id="show-id"></td>
                            </tr>

                            <tr>
                                <th>Tipo de Saida</th>
                                <td id="show-nome"></td>
                            </tr>

                            <tr>
                                <th>Pago</th>
                                <td id="show-nome"></td>
                            </tr>

                            <tr>
                                <th>Forma de Pagamento</th>
                                <td id="show-preco"></td>
                            </tr>

                            <tr>
                                <th>Descrição</th>
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

                            <tr>

                            <tr>
                                <th>Acção</th>
                                <td id="">
                                    <a class="btn btn-info btn-sm edit-modal"     ><i class="fa fa-pencil"></i> </a>
                                    <a class="btn btn-danger btn-sm delete-modal"  ><i class="fa fa-trash"></i> </a>
                                </td>
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
                            @include('components.messages')
                        </div>

                      
                      <div class="col-md-12">
                            <div class="form-group">
                                <label>Tipo de Saida</label> 
                                <select class="form-control"  tabindex="2" name="forma_pagamento">
                                    <option value="Dinheiro">Pagamento da cantina</option>
                                </select>
                            </div>                            
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Pago</label> 
                                <input type="number" name="pago" placeholder="" class="form-control">                                
                            </div>                            
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Forma de Pagamento</label> 
                                <select class="form-control"  tabindex="2" name="forma_pagamento">
                                    <option value="Dinheiro">Banco</option>
                                </select>
                            </div>                            
                        </div>


                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Descrição</label> 
                                <textarea class="form-control" name="" id="" cols="30" rows="4"></textarea>
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

    {!! Html::script('js/plugins/chosen/chosen.jquery.js') !!}

    <script>

        var d = new Date();

        setInterval(calculate, 1000)

        function calculate(){

            var mes = document.getElementsByClassName("mes")

            var multas = document.getElementsByClassName("multas")
            var subs   = document.getElementsByClassName("subs")
            var preco = $("#adicionarModal input[name=preco_propina]").val();
            var total_multas=new Number()
            var total_a_pagar=new Number()

            for (var i = 0; i < multas.length; i++) {

                var m=new Number()

                if(mes[i].value!=0){

                    if(mes[i].value==d.getMonth()+1){

                        if(d.getDate()>=11 && d.getDate()<=20){
                            m = 0.10;
                        }else if(d.getDate()>=21 && d.getDate()<=31){
                            m = 0.20;
                        }

                    }else if(mes[i].value<d.getMonth()+1){
                        m = 0.30;
                    }else{
                        m = 0.0;           
                    }
                
            
                    multas[i].value = (new Number(preco) * m)+'.00';

                    subs[i].value = ((new Number(preco) * m) + new Number(preco))+'.00 kz';

                    total_multas=total_multas+( new Number(preco) * m);
                    total_a_pagar=total_a_pagar+((new Number(preco) * m) + new Number(preco));

                }

                
            }

            $("#adicionarModal input[name=total_meses]").val(0+''+multas.length);
            $("#adicionarModal input[name=total_multas]").val(total_multas+'.00 kz');
            $("#adicionarModal input[name=total_a_pagar]").val(total_a_pagar+'.00 kz');
            $("#adicionarModal input[name=total]").val(total_a_pagar);

        

        }

        // pagar Function
        $(document).on('click', '.pagar-modal', function(){

            $("#adicionarModal").modal("show");

            $("#adicionarModal input[name=nome]").val($(this).data('nome'));
            $("#adicionarModal input[name=saldo_show]").val($(this).data('saldo'));
            $("#adicionarModal input[name=saldo]").val($(this).data('saldo'));
            $("#adicionarModal input[name=matricula_id]").val($(this).data('id'));

            var url = "{{ url('admin/servicos') }}/"+$(this).data('id');
            var classe = $(this).data('classe');
            var curso = $(this).data('curso');

            $("#EditarModal form").attr("action", url);

            $(function(){
                $.get('http://localhost:8000/secretaria/preco-propina/'+curso+'/'+classe+'', function(data){
                    
                    $("#adicionarModal input[name=preco_propina]").val(data[1].preco);
                    $("#adicionarModal input[name=preco_propina_id]").val(data[0]);
                

                }, 'json');
            });
            
        });

        var produtoAdd = 1

        $(document).on('click', '.btn-adicionar-mes', function(){

            if(produtoAdd<=10){
                
                produtoAdd++

                var tr = $("<tr/>")
                                .append($("<td/>").append($("<select/>", { id:"select-mes-"+produtoAdd, name:"mes[]", class:"form-control width-180 mes" }).append("<option value='0'>Selecione o Mês</option>")))
                                .append($("<td/>").append(
                                        $("<input/>", { type:"text", name:"multa[]", value:"00.00 kz", class:"form-control width-120 multas" })
                                ))
                                .append($("<td/>").append(
                                        $("<input/>", { type:"text", name:"subtotal[]", value:"00.00 kz", class:"form-control width-120 subs" })
                                ))
                                .append($("<td/>").append($("<a/>", {class:"btn btn-danger btn-sm btn-remove"})
                                    .append($("<i/>", {class:"fa fa-window-close"} ))
                                ));
                                
                
                $('#tbody-pagamento').append(tr);
                
                $(function(){
                    $.get('http://localhost:8000/json/lista-de-meses', function(data){
                    
                        for(var i=0; i<data.length; i++){
                            $("#select-mes-"+produtoAdd).append('<option value="'+data[i].id+'">'+data[i].mes+'</option>');
                        }

                        return false;
                        //  alert(data[0].nome)

                    }, 'json');
                });
                

            }else{
                alert('Antigiu o Limite De Adição dos Meses de Pagamento');
            }
            

        });


        $(document).on('click', '.btn-remove', function(){

            $(this).parents('tr').remove();

            produtoAdd--;

        });

    
    </script>

    <script>

        $('.chosen-select').chosen({width: "100%"});

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