@extends('general.main')

@section('title', 'GEstoque-Adminsitrador')

@section('head')

    {!! Html::style('css/plugins/chosen/bootstrap-chosen.css') !!}

@endsection

@section('page-heading')

    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Realizar Vendas</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="index-2.html">Admin</a>
                </li>
                <li>
                    <a>Vendas</a>
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
                    <h5>Formulário Para Adicionar Vendas</h5>
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

                {!! Form::open(array('route' => 'vendas.store')) !!}   
                

                    <div class="row">

                        <div class="col-md-12">
                            @include('components.messages')
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Fornecedor</label> 
                                <select class="chosen-select form-control"  tabindex="2" name="fornecedor_id">
                                    @foreach($fornecedores as $fornecedor)
                                    <option value="{{$fornecedor->id }}">{{$fornecedor->nome }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Código da venda</label> 
                                <td class="width-150">
                                    <input type="number" value="{{ time() }}" disabled="disabled" class="form-control">
                                    <input type="hidden" value="{{ time() }}" name="codigo">
                                
                                </td>
                            </div>
                        </div>

                        
                    </div>

                    <div class="hr-line-dashed"></div>

                    <div class="row">

                         <div class="col-md-12 ">

                         <h2>Produtos</h2>
                    
                            <table class="table table-bordered table-hover table-responsive" >

                                <thead>
                                    <tr>
                                        <th>Produto</th>
                                        <th>Quantidade</th>
                                        <th>Preço Unitário</th>
                                        <th>Preço Total</th>
                                        <th>Acção</th>
                                    </tr>
                                </thead>
                                
                                <tbody id="tbody-produto">
                               
                                    <tr class="gradeX" id="tr-produto-main" tabindex="4">

                                        <td>
                                            <div class="form-group">
                                                <select id="selected-produto-1" product="1" class="form-control produto-compra" name="produto_id[]">
                                                
                                                @foreach($produtos as $produto)
                                                
                                                    <option value="{{ $produto->id }}">{{$produto->nome }}</option>
                                                
                                                @endforeach

                                                </select>
                                            </div>
                                            
                                        </td>
                                      
                                        <td class="width-320 td-produto-1">
                                            <div class="input-group m-b col-md-12">
                                                <span class="input-group-addon width-150">(0)</span> 
                                                <input type="number" max="0" min="0" name="quantidade" quant="1" placeholder="Qtde"  class="form-control qtd-count">
                                            </div>
                                        </td>

                                        <td class="width-150 td-produto-preco-1">
                                            <div class="input-group m-b col-md-12">
                                                <input type="number" value="00.00" disabled="disabled" name="preco_unitario" class="form-control preco-count">
                                            </div>
                                            
                                        </td>

                                        <td class="width-150">
                                            <input type="number"  value="00.00" name="preco" class="form-control preco-total-count">
                                        </td>
                                       
                                        <td class="width-80">
                                            <a href="#" class="btn btn-danger btn-sm  "><i class="fa fa-trash"></i> </a>
                                        </td>
                                    </tr>
                                    
                                </tbody>

                            </table>

                            <button type="button" class="btn btn-default btn-adicionar-produto"><i class="fa fa-plus"></i> Adicionar Produto</button>
                            

                        </div>

                    </div>

                    <div class="hr-line-dashed"></div>

                    <div class="row">

                         <div class="col-md-12 table-responsive">

                         <h2>Total dos Produtos</h2>
                    
                            <table class="table table-bordered table-hover" >

                                <thead>
                                    <tr>
                                        <th>Total dos Produtos</th>
                                        <th>Descontos</th>
                                        <th>Total Compra</th>
                                    </tr>
                                </thead>
                                
                                <tbody>
                                    <tr class="gradeX">

                                        <td class="width-150">
                                            <input type="number" disabled value="00.00" class="form-control total-preco">
                                        </td>

                                        <td class="width-150">
                                            <input type="number" value="00.00" name="desconto"  class="form-control total-desconto">
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
                            <input type="hidden" name="total"  class="form-control total-preco">
                            

                            <button type="submit" class="btn btn-primary btn-adicionar-variacao"><i class="fa fa-plus"></i> Finalizar Compra</button>


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
        var qtd   = document.getElementsByClassName("qtd-count")
        var total = document.getElementsByClassName("preco-total-count")
        var totalPreco=new Number()

        for (var i = 0; i < preco.length; i++) {
           
            total[i].value = new Number(qtd[i].value) * new Number(preco[i].value)+".00"

            totalPreco=(new Number(totalPreco) + new Number(total[i].value))
        }

        $(".total-preco").val(totalPreco-0+'.00')
        $(".total-apagar").val( totalPreco - $(".total-desconto").val()+'.00')

    }

    $(document).ready(function(){
        $('.chosen-select').chosen({width: "100%"});
    });

    $(document).on('click', '.produto-compra', function(){

        var id = $(this).val()
        var product = $(this).attr('product')

        $(function(){

            $.get('http://localhost:8000/html/produto-venda/'+id+'', function(data){

               $('td.td-produto-'+product).html(data);

            }, 'html');

            $.get('http://localhost:8000/html/produto-venda-preco/'+id+'', function(data){

               $('td.td-produto-preco-'+product).html(data);

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
            
            var tr = $("<tr/>").append($("<td/>").append($("<select/>", { id:"select-produto-"+produtoAdd, product:produtoAdd, name:"produto_id[]", class:"chosen-select form-control produto-compra" }).append("<option>Selecione O Produto</option>")))
                               .append($("<td/>", {class:"width-320 td-produto-"+produtoAdd})
                                    .append($("<div/>", {class:"input-group m-b col-md-12"})
                                        .append($("<span class='input-group-addon width-150'>(0)</span>"))
                                        .append($("<input/>", { type:"number", name:"quantidade[][]", quant:produtoAdd, id:"input-quantidade-produto-"+produtoAdd, placeholder:"Qtde", max:"0", min:"0", class:"form-control input-quantidade qtd-count td-produto-preco"+produtoAdd }))
                                    )
                                )
                               .append($("<td/>", {class:"width-150 td-produto-preco-"+produtoAdd}).append(
                                    $("<input/>", { type:"number", name:"preco_unitario[][]", value:"00.00", class:"form-control preco-count" })
                               ))
                               .append($("<td/>", {class:"width-150"}).append(
                                    $("<input/>", { type:"number", name:"preco_total", value:"00.00", class:"form-control preco-total-count" })
                               ))
                               .append($("<td/>").append($("<a/>", {href:"", class:"btn btn-danger btn-sm"})
                                    .append($("<i/>", {class:"fa fa-trash"} ))
                                ))
            
            $('#tbody-produto').append(tr);


             $(function(){
                $.get('http://localhost:8000/json/lista-de-produtos', function(data){
                   
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