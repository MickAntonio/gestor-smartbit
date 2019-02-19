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
                
            <div class="tabs-container">
                
                <ul class="nav nav-tabs">
                    <li>
                        <a data-toggle="tab" href="#tab-01">
                            Dados Pessoais
                        </a>
                    </li>

                    <li>
                        <a data-toggle="tab" href="#tab-10">
                            Dados Acadêmicos
                        </a>
                    </li>

                    <li class="active">
                        <a data-toggle="tab" href="#tab-02">
                            Propinas
                            <span class="label label-warning">Anolectivo @if($aluno->matricula->first()->turma->anolectivo!=0) {{ $aluno->matricula->first()->turma->anolectivo }} @else {{  date('Y') }} @endif</span>
                        </a>
                    </li>

                    <li class="">
                        <a data-toggle="tab" href="#tab-03">
                            Efectuar Pagamentos
                        </a>
                    </li>

                </ul>
                
                <div class="tab-content">

                    <div id="tab-01" class="tab-pane">
                        <div class="panel-body">

                            <table class="table table-bordered table-th-200">

                                <tr>
                                    <th>Nome</th>
                                    <td>{{ $aluno->candidato->nome }}</td>
                                </tr>

                                <tr>
                                    <th>Bilhete de Identidade</th>
                                    <td>{{ $aluno->candidato->bi }}</td>
                                </tr>

                                <tr>
                                    <th>Genero</th>
                                    <td>{{ $aluno->candidato->sexo }}</td>
                                </tr>


                                <tr>
                                    <th>Data de Nascimento</th>
                                    <td>{{ $aluno->candidato->nascido }}</td>
                                </tr>

                                <tr>
                                    <th>Telefone</th>
                                    <td>{{ $aluno->candidato->telefone }}</td>
                                </tr>

                                <tr>
                                    <th>Filho de</th>
                                    <td>{{ $aluno->candidato->pai }} e {{ $aluno->candidato->mae }}</td>
                                </tr>


                                <tr>
                                    <th>Acção</th>
                                    <td>
                                    </td>
                                </tr>

                            </table>
                        
                        </div>
                    </div>

                    <div id="tab-02" class="tab-pane active">
                        <div class="panel-body">

                            <table class="table table-bordered table-th-200">
    
                                
                            <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Meses</th>
                                        <th>Multas</th>
                                        <th>Subtotal</th>
                                        <th>Forma de Pagamento</th>
                                        <th>Total das Multas</th>
                                        <th>Total a Pagar</th>                                    
                                        <th>Total Pago</th>                                    
                                        <th>Descrição</th>                                    
                                    </tr>
                                </thead>

                                <tbody>
                                
                                @php
                                    $i=1
                                @endphp                              
                                @foreach($pagamentos as $pagamento)

                                <tr>
                                    <td rowspan="2" class="td-bg-gray">{{ $i++ }}</td>
                                    <th colspan="7" class="td-bg-green">Pagamento Efectuado aos {{ $pagamento->created_at }}</th>
                                    <td class="td-bg-green">
                                        <a href="/secretaria/propina-recibo/{{ $pagamento->id }}" target="__BLANK" class="btn btn-info btn-sm a-color-white"><i class="fa fa-file-pdf-o"></i> </a>                                                            
                                        <a href="/secretaria/propina-recibo-termica/{{ $pagamento->id }}" target="__BLANK" class="btn btn-warning btn-sm a-color-white"><i class="fa fa-file-pdf-o"></i> </a>                                                            
                                    </td>
                                
                                </tr>

                                <tr>

                                    <td>
                                    @foreach($pagamento->propinas as $propina)
                
                                        <div class="form-group">
                                            <input type="text" value="{{ $propina->mes->mes }}" disabled class="form-control">                                
                                        </div>                            

                                    @endforeach
                                    </td>

                                    <td>
                                        
                                    @php
                                        $multas=0
                                    @endphp  

                                    @foreach($pagamento->propinas as $propina)

                                        @if($propina->multa>0)

                                        @php $multas=$multas+$propina->multa @endphp 

                                            <div class="form-group">
                                                <input type="text" value="{{ $propina->multa }} kz" disabled class="form-control">                                
                                            </div> 
                                            
                                        @endif                           

                                    @endforeach
                                    </td>

                                    <td>
                                    @foreach($pagamento->propinas as $propina)
                                    
                                        <div class="form-group">
                                            <input type="text" value="{!! $propina->preco->preco->preco + $propina->multa !!}.00 kz" disabled class="form-control">                                
                                        </div>                            

                                    @endforeach
                                    </td>

                                    <td>
                                        <div class="form-group">
                                                <input type="text" value="{{ $pagamento->forma }}" disabled class="form-control">                                
                                            </div> 
                                    </td>
                                    <td>

                                        @if($multas>0)
                                    
                                        <div class="form-group">
                                                <input type="text" value="{{ $multas }}.00 kz" disabled class="form-control">                                
                                            </div> 

                                        @endif                           
                                            
                                    </td>
                                    <td>
                                        <div class="form-group">
                                                <input type="text" value="{{ $pagamento->total }} kz" disabled class="form-control">                                
                                            </div> 
                                    </td>
                                    <td>
                                        <div class="form-group">
                                                <input type="text" value="{{ $pagamento->valor_pago }} kz" disabled class="form-control">                                
                                            </div> 
                                    </td>
                                    <td>
                                        <div class="form-group">
                                                <input type="text" value="{{ $pagamento->descricao }}" disabled class="form-control">                                
                                            </div> 
                                    </td>
                                    

                                </tr>
                                
                                @endforeach
                                
                                </tbody>


                            </table>
                        
                        </div>
                    </div>
                    
                    <div id="tab-03" class="tab-pane">
                        
                        {!! Form::open(array('route' => 'alunos-propinas-pagamentos.store')) !!}   
                       
                        <div class="panel-body" id="area-pagamento">

                            <div class="row">

                                <div class="col-md-12 table-responsive">
            
                                    <h2>Informações do Pagamento</h2>
                                
                                        <table class="table table-bordered table-hover" >
            
                                            <thead>
                                                <tr>
                                                    <th>Nome</th>
                                                    <th>Data de Pagamento</th>
                                                    <th>Forma de Pagamento</th>
                                                    <th>Saldo Actual do Estudante</th>
                                                </tr>
                                            </thead>
                                            
                                            <tbody>
                                                <tr class="gradeX">
            
                                                    <td class="width-150">
                                                        <input type="text" disabled value="{{ $aluno->candidato->nome }}" class="form-control total-preco">
                                                    </td>
            
                                                    <td class="width-150">
                                                        <div class="form-group" id="data_1">
                                                            <div class="input-group date">
                                                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" class="form-control" name="created_at" value="{{ date('Y-m-d') }}">
                                                            </div>
                                                        </div> 
                                                    </td>
            
                                                    <td class="width-150">
                                                        <select class="form-control"  tabindex="2" name="forma">
                                                            <option value="Banco">Banco</option>
                                                            <option value="TPA">TPA</option>
                                                            <option value="Dinheiro">Dinheiro</option>
                                                        </select>
                                                    </td>

                                                    <td class="width-150">
                                                        @if ($aluno->saldo->valor>=0)
                                                            <input type="number" value="{{ $aluno->saldo->valor??'' }}" class="form-control total-apagar input-bg-green">
                                                        @else
                                                            <input type="number" value="{{ $aluno->saldo->valor??'' }}" class="form-control total-apagar input-bg-red">
                                                        @endif
                                                    </td>
                                                    
                                                </tr>
                                                
                                            </tbody>
            
                                        </table>
            
                                </div>
            
                            </div>

                            <div class="row">

                                <div class="col-md-12 table-responsive">

                                <table class="table table-bordered  table-hover">
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

                                            <select class="form-control mes" id="ad" tabindex="2" name="mes[]">
                                                <option value="0">Selecione o Mês</option>
                                                @foreach($meses as $mes)                                
                                                <option value="{{ $mes->id }}">{{ $mes->mes }}</option>
                                                @endforeach
                                            </select>
                                        
                                        </td>
                                        <td>
                                            <input type="number" name="multa[]" placeholder="" value="00.00" class="form-control multas">
                                        </td>
                                        <td>
                                            <input type="text" name="sub" placeholder="" value="00.00 kz" class="form-control subs">
                                        </td>
                                        <td>
                                            <a class="btn btn-primary btn-sm btn-adicionar-mes"  ><i class="fa fa-plus"></i> </a>
                                        </td>
                                    </tr>
                                    
                                    </tbody>
                                </table>
                                    

                                </div>

                            </div>

                            <div class="hr-line-dashed"></div>                        

                            <div class="row">

                                <div class="col-md-12 table-responsive">

                                    <table class="table table-bordered table-hover">
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
    
                                                <input type="text" name="total_meses" placeholder="" value="00.00" class="form-control">                                    
                                            
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

                                    <table class="table table-bordered table-hover">
                                            <thead>
                                            <tr>
                                                <th>Valor Pago</th>
                                                <th>Observações</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                        
                                            <tr>
                                                <td>
                                                    <input type="number" name="valor_pago" value="0.00" placeholder="" class="form-control">                                
                                                </td>

                                                <td>
                                                    <textarea class="form-control" name="descricao" id="" cols="30" rows="1">obs</textarea>
                                                </td>
                                            </tr>
        
                                            <input type="hidden" name="total" placeholder="" class="form-control">                                
                
                                            </tbody>
                                        </table>

                                </div>

                            </div>

                            <input type="hidden" name="user_id"           value="{{ Auth::id() }}">                                
                            <input type="hidden" name="matricula_id"      value="{{ $aluno->matricula->first()->id }}">                                
                            <input type="hidden" name="preco_propina"     value="{{ $precoPropina[1]->preco }}">                                
                            <input type="hidden" name="preco_propina_id"  value="{{ $precoPropina[0] }}">                                
                            <input type="hidden" name="saldo"             value="{{ $aluno->saldo->valor??'' }}">  
                            <input type="hidden" name="curso"             value="{{ $aluno->matricula->first()->turma->curso->id }}">  
                            <input type="hidden" name="classe"            value="{{ $aluno->matricula->first()->turma->classe->id }}">  
                            <input type="hidden" name="aluno_id"          value="{{ $aluno->id }}">  
                            
                            <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Efectuar Pagamento</button>

                        </div>

                    
                        {!! Form::close() !!} 

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

        
    <!-- Peity -->
    {!! Html::script('js/plugins/peity/jquery.peity.min.js') !!}   
        
    <!-- Peity demo -->
    {!! Html::script('js/demo/peity-demo.js') !!} 


    
    <script>

        var d = new Date();

        setInterval(calculate, 1000)

        function calculate(){

            var mes = document.getElementsByClassName("mes")

            var multas = document.getElementsByClassName("multas")
            var subs   = document.getElementsByClassName("subs")
            var preco = $("#area-pagamento input[name=preco_propina]").val();
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

            $("#area-pagamento input[name=total_meses]").val(0+''+multas.length);
            $("#area-pagamento input[name=total_multas]").val(total_multas+'.00 kz');
            $("#area-pagamento input[name=total_a_pagar]").val(total_a_pagar+'.00 kz');
            $("#area-pagamento input[name=total]").val(total_a_pagar);

        

        }

        var produtoAdd = 1

        $(document).on('click', '.btn-adicionar-mes', function(){

            if(produtoAdd<=10){
                
                produtoAdd++

                var tr = $("<tr/>")
                                .append($("<td/>").append($("<select/>", { id:"select-mes-"+produtoAdd, name:"mes[]", class:"form-control mes" }).append("<option value='0'>Selecione o Mês</option>")))
                                .append($("<td/>").append(
                                        $("<input/>", { type:"text", name:"multa[]", value:"00.00 kz", class:"form-control multas" })
                                ))
                                .append($("<td/>").append(
                                        $("<input/>", { type:"text", name:"subtotal[]", value:"00.00 kz", class:"form-control subs" })
                                ))
                                .append($("<td/>").append($("<a/>", {class:"btn btn-danger btn-sm btn-remove"})
                                    .append($("<i/>", {class:"fa fa-window-close"} ))
                                ));
                                
                $('#tbody-pagamento').append(tr);
                
                $(function(){
                    $.get('/json/lista-de-meses', function(data){
                    
                        for(var i=0; i<data.length; i++){
                            $("#select-mes-"+produtoAdd).append('<option value="'+data[i].id+'">'+data[i].mes+'</option>');
                        }

                        return false;

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


@endsection