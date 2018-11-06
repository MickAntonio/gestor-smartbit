@extends('general.main')

@section('title', 'GEstoque-Adminsitrador')

@section('head')

    {!! Html::style('css/plugins/chosen/bootstrap-chosen.css') !!}

@endsection

@section('page-heading')

    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Gerenciar Compras</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="index-2.html">Admin</a>
                </li>
                <li>
                    <a>Compras</a>
                </li>
                <li class="active">
                    <strong>Adicionar</strong>
                </li>
            </ol>
        </div>
        <div class="col-lg-2">

        </div>
    </div>

@endsection

@section('content')

<div class="row">
                
        <div class="col-lg-12">

            <div class="ibox float-e-margins">
               
                <div class="ibox-title">
                    <h5>Formulário Para Adicionar Pagamentos</h5>
                    <div class="ibox-tools">
                        <a class="collapse-link">
                            <i class="fa fa-chevron-up"></i>
                        </a>
                        
                        <a class="close-link">
                            <i class="fa fa-times"></i>
                        </a>
                    </div>
                </div>

                <div class="ibox-content">

                {!! Form::open(array('route' => 'pagamentos.store')) !!}   
                

                    <div class="row">

                        <div class="col-md-12">
                            @include('components.messages')
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Cliente</label> 
                                <select class="chosen-select form-control"  tabindex="2" name="cliente_id">
                                    @foreach($clientes as $cliente)
                                    <option value="{{$cliente->id }}">{{$cliente->nome }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                   
                    </div>

                    <div class="hr-line-dashed"></div>

                    <div class="row">

                         <div class="col-md-12 ">

                         <h2>Serviços</h2>
                    
                            <table class="table table-bordered table-hover table-responsive" >

                                <thead>
                                    <tr>
                                        <th>Serviço</th>
                                        <th>Preço Total</th>
                                        <th>Acção</th>
                                    </tr>
                                </thead>
                                
                                <tbody id="tbody-produto">
                               
                                    <tr class="gradeX" id="tr-produto-main" tabindex="4">

                                        <td>
                                            <div class="form-group">
                                                <select id="selected-produto-1" servico="1" class="form-control produto-compra" name="servicos[]">
                                                
                                                @foreach($servicos as $servico)
                                                
                                                    <option value="{{ $servico->id }}">{{$servico->nome }}</option>
                                                
                                                @endforeach

                                                </select>
                                            </div>
                                            
                                        </td>

                                        <td class="width-400 td-servico-preco-1">
                                            <input type="number"  value="00.00" name="preco" class="form-control preco-count">
                                        </td>
                                       
                                        <td class="width-80">
                                            <a href="#" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> </a>
                                        </td>
                                    </tr>
                                    
                                </tbody>

                            </table>

                            <button type="button" class="btn btn-default btn-adicionar-produto"><i class="fa fa-plus"></i> Adicionar Serviço</button>
                            

                        </div>

                    </div>

                    <div class="hr-line-dashed"></div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>OBS</label> 
                                <textarea name="descricao" id="" cols="30" rows="2" class="form-control"></textarea>
                            </div>
                        </div>
                    </div>

                    <div class="hr-line-dashed"></div>                        

                    <div class="row">

                         <div class="col-md-12 table-responsive">

                         <h2>Total dos Serviços</h2>
                    
                            <table class="table table-bordered table-hover" >

                                <thead>
                                    <tr>
                                        <th>Total de Serviço</th>
                                        <th>Descontos</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>
                                
                                <tbody>
                                    <tr class="gradeX">

                                        <td class="width-150">
                                            <input type="number" disabled value="00.00" class="form-control total-preco">
                                        </td>

                                        <td class="width-150">
                                            <input type="number" name="desconto" value="00.00" class="form-control total-desconto">
                                        </td>

                                        <td class="width-150">
                                            <input type="number" value="00.00" class="form-control total-apagar">
                                        </td>
                                        
                                    </tr>
                                    
                                </tbody>

                            </table>


                        </div>

                    </div>

                    <div class="hr-line-dashed"></div>

                    <div class="row">

                        <div class="col-md-12 table-responsive">

                        <h2>Pagamento</h2>

                            <table class="table table-bordered table-hover" >

                                <thead>
                                    <tr>
                                        <th>Forma de Pagamento</th>
                                        <th>Total a Pagar</th>
                                        <th>Pago</th>
                                    </tr>
                                </thead>
                                
                                <tbody>
                                    
                                    <tr class="gradeX">

                                        <td>
                                            <div class="form-group">
                                                <select class="form-control"  tabindex="2" name="forma_pagamento">
                                                    <option value="Dinheiro">Dinheiro</option>
                                                    <option value="Cheque">Cheque</option>
                                                    <option value="Cartao">Cartão</option>
                                                </select>
                                            </div>
                                        </td>

                                        <td>
                                            <input type="number" disabled value="00.00" class="form-control total-apagar">
                                        </td>

                                        <td>
                                            <input type="number" name="pagamento" value="00.00" class="form-control">
                                        </td>

                                        
                                    </tr>
                                    
                                </tbody>

                            </table>

                            <input type="hidden" name="usuario_id" value="1" class="form-control">
                            

                            <button type="submit" class="btn btn-primary btn-adicionar-variacao"><i class="fa fa-plus"></i> Finalizar Pagamento</button>


                        </div>

                    </div>

                {!! Form::close() !!}           


                </div>
            </div>

        </div>
        
</div>

@endsection


@section('scripts')

{!! Html::script('js/plugins/chosen/chosen.jquery.js') !!}

<script>

    setInterval(calculatePrice, 1000)

    function calculatePrice(){

        var preco = document.getElementsByClassName("preco-count")
        var totalPreco=new Number()

        for (var i = 0; i < preco.length; i++) {
            
            totalPreco=(new Number(totalPreco) + new Number(preco[i].value))
        }

        $(".total-preco").val(totalPreco+'.00')
        $(".total-apagar").val( totalPreco - $(".total-desconto").val()+'.00')

    }

    $(document).ready(function(){
        $('.chosen-select').chosen({width: "100%"});
    });

    $(document).on('click', '.produto-compra', function(){

        var id = $(this).val()
        var servico = $(this).attr('servico')


        $(function(){

            $.get('http://localhost:8000/html/servicos-preco/'+id+'', function(data){

               $('td.td-servico-preco-'+servico).html(data);

            }, 'html');

        });

    });

     $(document).on('click', '.input-quantidade', function(){

        var id = $(this).val()
        var quantidade = $(this).attr('quant')

      //  alert(quantidade)


    });

    var produtoAdd = 1

    $(document).on('click', '.btn-adicionar-produto', function(){

        if(produtoAdd<=20){
            
            produtoAdd++
            
            var tr = $("<tr/>").append($("<td/>")
                                .append($("<select/>", { id:"select-produto-"+produtoAdd, servico:produtoAdd, name:"servicos[]", class:"chosen-select form-control produto-compra" })
                                .append("<option>Selecione O Serviço</option>")))
                               .append($("<td/>", {class:"width-400 td-servico-preco-"+produtoAdd}).append(
                                    $("<input/>", { type:"number", name:"preco", value:"00.00", class:"form-control preco-count", disabled:"disabled" })
                               ))
                               .append($("<td/>").append($("<a/>", {href:"", class:"btn btn-danger btn-sm"})
                                    .append($("<i/>", {class:"fa fa-trash"} ))
                                ))
            
            $('#tbody-produto').append(tr);


             $(function(){
                $.get('http://localhost:8000/json/lista-de-servicos', function(data){
                   
                     for(var i=0; i<data.length; i++){
                         $("#select-produto-"+produtoAdd).append('<option value="'+data[i].id+'">'+data[i].nome+'</option>');
                     }

                     return false;
                    //  alert(data[0].nome)

                }, 'json');
             });



        }else{
            alert('Antigiu o Limite De Adição de Variação');
        }
        

    });
</script>

@endsection