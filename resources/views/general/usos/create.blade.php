@extends('general.main')

@section('title', 'GEstoque-Adminsitrador')

@section('head')

    {!! Html::style('css/plugins/chosen/bootstrap-chosen.css') !!}

@endsection

@section('page-heading')

    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Produtos Movimentados Para Uso</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="index-2.html">Admin</a>
                </li>
                <li>
                    <a>Movimentação de Produtos</a>
                </li>
                <li class="active">
                    <strong>Usos</strong>
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
                    <h5>Formulário Para Realizar Movimentação</h5>
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

                {!! Form::open(array('route' => 'usos.store')) !!}   

                    <div class="row">

                     <div class="col-md-12">
                            @include('components.messages')
                        </div>

                         <div class="col-md-12 table-responsive">

                         <h2>Produtos</h2>
                    
                     
                         <table class="table table-bordered table-hover table-responsive" >

                            <thead>
                                <tr>
                                    <th>Produto</th>
                                    <th>Quantidade</th>
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
                                
                                    <td class="td-produto-1">
                                        <div class="input-group m-b col-md-12">
                                            <span class="input-group-addon width-150">(0)</span> 
                                            <input type="number" max="0" min="0" name="quantidade" placeholder="Qtde"  class="form-control qtd-count">
                                        </div>
                                    </td>
                                
                                    <td class="width-80">
                                        <a href="#" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> </a>
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

                         <h2>Total dos Produtos Movimentados</h2>
                    
                            <table class="table table-bordered table-hover" >

                                <thead>
                                    <tr>
                                        <th>Total dos Produtos</th>
                                        <th>Descriçao</th>
                                    </tr>
                                </thead>
                                
                                <tbody>
                                    <tr class="gradeX">

                                        <td class="width-150">
                                            <input type="number" disabled class="form-control total-qdt">
                                        </td>

                                        <td class="width-150">
                                            <input type="text" name="descricao" required placeholder="descriçao sobre a movimentação do estoque(uso)" class="form-control">
                                        </td>
                                        
                                    </tr>
                                    
                                </tbody>

                            </table>


                            <input type="hidden" value="1" name="usuario_id" class="form-control">

                            <button type="submit" class="btn btn-primary btn-adicionar-variacao"><i class="fa fa-plus"></i> Finalizar Movimentação</button>
                            

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

     var qtd = document.getElementsByClassName("qtd-count")
     var totalPreco=new Number()

     for (var i = 0; i < qtd.length; i++) {
        
         totalPreco = ( new Number(totalPreco) + new Number(qtd[i].value) )
     }

     $(".total-qdt").val(totalPreco)

 }



    $(document).ready(function(){

              $('.chosen-select').chosen({width: "100%"});

    });
</script>

<script>
    $(document).ready(function(){
        $('.chosen-select').chosen({width: "100%"});
    });

    $(document).on('click', '.produto-compra', function(){

        var id = $(this).val()
        var product = $(this).attr('product')


        $(function(){

            $.get('http://localhost:8000/html/produto-estoque/'+id+'', function(data){

               $('td.td-produto-'+product).html(data);

            }, 'html');


        });

    });

    var produtoAdd = 1

    $(document).on('click', '.btn-adicionar-produto', function(){

        if(produtoAdd<=20){
            
            produtoAdd++
            
            var tr = $("<tr/>").append($("<td/>").append($("<select/>", { id:"select-produto-"+produtoAdd, product:produtoAdd, name:"produto_id[]", class:"chosen-select form-control produto-compra" }).append("<option>Selecione O Produto</option>")))
                               .append($("<td/>", {class:"td-produto-"+produtoAdd})
                                    .append($("<div/>", {class:"input-group m-b col-md-12"})
                                        .append($("<span class='input-group-addon width-150'>(0)</span>"))
                                        .append($("<input/>", { type:"number", name:"quantidade[][]", placeholder:"Qtde", max:"0", min:"0", class:"form-control qtd-count td-produto-preco"+produtoAdd }))
                                    )
                                )
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